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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:purchases.create')->only(['create', 'store']);
        $this->middleware('can:purchases.index')->only(['index']);
        $this->middleware('can:purchases.show')->only(['show']);
        $this->middleware('can:change.status.purchases')->only(['change_status']);
        $this->middleware('can:purchases.pdf')->only(['pdf']);
        $this->middleware('can:upload.purchases')->only(['upload']);
    }


    public function index()
    {
        try {
            $purchases = Purchase::get();
            return view('admin.purchase.index', compact('purchases'));
        } catch (\Exception $e) {
            Log::error('Error fetching purchases: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener las compras.');
        }
    }


    public function create()
    {
        try {
            $providers = Provider::get();
            $products = Product::where('status', 'ACTIVE')->get();
            return view('admin.purchase.create', compact('providers', 'products'));
        } catch (\Exception $e) {
            Log::error('Error creating purchase form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al preparar el formulario de compra.');
        }
    }


    public function store(StoreRequest $request)
    {
       
        DB::beginTransaction();

        try {
            $purchase = Purchase::create($request->all() + [
                'user_id' => Auth::user()->id,
                'purchase_date' => Carbon::now('Europe/Madrid'),
            ]);

            $results = [];
            foreach ($request->product_id as $key => $product) {
                $results[] = [
                    "product_id" => $request->product_id[$key],
                    "quantity" => $request->quantity[$key],
                    "price" => $request->price[$key],
                ];
                event(new ProductPurchased($request->product_id[$key], $request->quantity[$key]));
            }

           
            $purchase->purchaseDetails()->createMany($results);

       
            DB::commit();

            return redirect()->route('purchases.index')->with('success', 'Compra creada correctamente.');
        } catch (\Exception $e) {
           
            DB::rollback();

            Log::error('Error storing purchase: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al crear la compra.');
        }
    }


    public function show(Purchase $purchase)
    {
        try {
            $subtotal = 0;
            $purchaseDetails = $purchase->purchaseDetails;
            foreach ($purchaseDetails as $purchaseDetail) {
                $subtotal += $purchaseDetail->quantity * $purchaseDetail->price;
            }
            return view('admin.purchase.show', compact('purchase', 'subtotal', 'purchaseDetails'));
        } catch (\Exception $e) {
            Log::error('Error showing purchase: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar la compra.');
        }
    }


    public function pdf(Purchase $purchase)
    {
        try {
            $subtotal = 0;
            $purchaseDetails = $purchase->purchaseDetails;
            foreach ($purchaseDetails as $purchaseDetail) {
                $subtotal += $purchaseDetail->quantity * $purchaseDetail->price;
            }

            $pdf = Pdf::loadView('admin.purchase.pdf', compact('purchase', 'subtotal', 'purchaseDetails'));
            return $pdf->download('Reporte_de_compra_' . $purchase->id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al generar el PDF.');
        }
    }


    public function upload(Request $request, Purchase $purchase)
    {
        try {
            $purchase->update($request->all());
            return redirect()->route('purchases.index')->with('success', 'Compra actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error uploading purchase: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al actualizar la compra.');
        }
    }

    public function change_status(Purchase $purchase)
    {
        try {
            foreach ($purchase->purchaseDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product->status != 'ACTIVE') {
                    return redirect()->back()->with('error', 'No se puede cambiar el estado de la compra porque contiene productos desactivados.');
                }

                $quantityChange = $detail->quantity;

                if ($purchase->status == 'VALID') {
                    if ($product->stock - $quantityChange < 0) {
                        return redirect()->back()->withErrors(['error' => 'No se puede cancelar la compra porque resultará en un stock negativo.']);
                    }
                    event(new ProductPurchased($detail->product_id, $detail->quantity, true)); 
                    $purchase->update(['status' => 'CANCELED']);
                } else {
                    event(new ProductPurchased($detail->product_id, $detail->quantity)); 
                    $purchase->update(['status' => 'VALID']);
                }
            }

            return redirect()->back()->with('success', 'Estado de la compra cambiado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error changing purchase status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cambiar el estado de la compra.');
        }
    }
}
