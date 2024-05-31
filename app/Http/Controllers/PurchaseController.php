<?php

namespace App\Http\Controllers;

use App\Events\ProductPurchased;
use App\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Product;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:purchases.create')->only(['create','store']);
        $this->middleware('can:purchases.index')->only(['index']);
        $this->middleware('can:purchases.show')->only(['show']);
        $this->middleware('can:change.status.purchases')->only(['change_status']);
        $this->middleware('can:purchases.pdf')->only(['pdf']);
        $this->middleware('can:upload.purchases')->only(['upload']);
        
       
    }

    
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchase.index', compact('purchases'));
    }


    public function create()
    {
        $providers = Provider::get();
        $products=Product::where('status','ACTIVE')->get();
        return view('admin.purchase.create', compact('providers','products'));
    }


    public function store(StoreRequest $request)
{
    
    $purchase = Purchase::create($request->all() + [
        'user_id' => Auth::user()->id,
        'purchase_date' => Carbon::now('Europe/Madrid'),
    ]);

    foreach ($request->product_id as $key => $product) {
        $results[] = array(
            "product_id" => $request->product_id[$key], 
            "quantity" => $request->quantity[$key], 
            "price" => $request->price[$key],
            
        );
        // Disparar el evento para actualizar el stock
        event(new ProductPurchased($request->product_id[$key], $request->quantity[$key]));
    }
   
    $purchase->purchaseDetails()->createMany($results);

    return redirect()->route('purchases.index');
}



    public function show(Purchase $purchase)
    {
       
        $subtotal=0;
        $purchaseDetails=$purchase->purchaseDetails;
        foreach ($purchaseDetails as $purchaseDetail) {
            $subtotal+=$purchaseDetail->quantity*$purchaseDetail->price;
        }
        return view('admin.purchase.show', compact('purchase','subtotal','purchaseDetails'));
    }





    public function pdf(Purchase $purchase)
    {
        $subtotal=0;
        $purchaseDetails=$purchase->purchaseDetails;
        foreach ($purchaseDetails as $purchaseDetail) {
            $subtotal+=$purchaseDetail->quantity*$purchaseDetail->price;
        }

        $pdf = Pdf::loadView('admin.purchase.pdf', compact('purchase','subtotal','purchaseDetails'));
        return $pdf->download('Reporte_de_compra_'.$purchase->id.'.pdf');
    }


    public function upload(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return redirect()->route('purchases.index');
    }

    public function change_status(Purchase $purchase)
    {
        foreach ($purchase->purchaseDetails as $detail) {
            $product = Product::find($detail->product_id);
            $quantityChange = $detail->quantity;
            
            if ($purchase->status == 'VALID') {
                if ($product->stock - $quantityChange < 0) {
                    return redirect()->back()->withErrors(['error' => 'No se puede cancelar la compra porque resultará en un stock negativo.']);
                }
                event(new ProductPurchased($detail->product_id, $detail->quantity, true)); // Cancelar
                $purchase->update(['status' => 'CANCELED']);
            } else {
                event(new ProductPurchased($detail->product_id, $detail->quantity)); // Reactivar
                $purchase->update(['status' => 'VALID']);
            }
        }

        return redirect()->back();
    }
}
