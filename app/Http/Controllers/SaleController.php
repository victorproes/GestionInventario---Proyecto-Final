<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\ProductSold;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Requests\Sale\UpdateRequest;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sales.create')->only(['create','store']);
        $this->middleware('can:sales.index')->only(['index']);
        $this->middleware('can:sales.show')->only(['show']);
        $this->middleware('can:change.status.sales')->only(['change_status']);
        $this->middleware('can:sales.pdf')->only(['pdf']);
        $this->middleware('can:sales.print')->only(['print']);
        
       
    }

    public function index()
    {
        $sales = Sale::get();
        return view('admin.sale.index', compact('sales'));
    }


    public function create()
    {
        $clients = Client::get();
        $products = Product::get();
        return view('admin.sale.create', compact('clients', 'products'));
    }


    public function store(StoreRequest $request)
    {
        $sale = Sale::create($request->all() + [
            'user_id' => Auth::user()->id,
            'sale_date' => Carbon::now('Europe/Madrid'),
        ]);

        foreach ($request->product_id as $key => $product) {
            $results[] = array(
                "product_id" => $request->product_id[$key],
                "quantity" => $request->quantity[$key], "price" => $request->price[$key],
                "discount" => $request->discount[$key]
            );
            event(new ProductSold($request->product_id[$key], $request->quantity[$key]));
        }
        $sale->saleDetails()->createMany($results);

        return redirect()->route('sales.index');
    }


    public function show(Sale $sale)
    {

        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100);
        }
        return view('admin.sale.show', compact('sale', 'saleDetails', 'subtotal'));
    }



    public function pdf(Sale $sale)
    {
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100);
        }
        $pdf = Pdf::loadView('admin.sale.pdf', compact('sale', 'subtotal', 'saleDetails'));
        return $pdf->download('Reporte_de_venta_' . $sale->id . '.pdf');
    }

    public function print(Sale $sale)
    {

        try {
            $subtotal = 0;
            $saleDetails = $sale->saleDetails;
            foreach ($saleDetails as $saleDetail) {
                $subtotal += $saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100);
            }

            $printer_name="TM20";
            $connector=new WindowsPrintConnector($printer_name);
            $printer=new Printer($connector);

            $printer->text("$9,95\n");

            $printer->cut();
            $printer->close();



            return redirect()->back();
        } catch (\Throwable $th) {
           return redirect()->back();
        }
    }

    public function change_status(Sale $sale)
    {
        foreach ($sale->saleDetails as $detail) {
            $product = Product::find($detail->product_id);
            $quantityChange = $detail->quantity;

            if ($sale->status == 'VALID') {
                event(new ProductSold($detail->product_id, $detail->quantity, true)); // Cancelar
                $sale->update(['status' => 'CANCELED']);
            } else {
                if ($product->stock - $quantityChange < 0) {
                    return redirect()->back()->withErrors(['error' => 'No se puede reactivar la venta porque resultará en un stock negativo.']);
                }
                event(new ProductSold($detail->product_id, $detail->quantity)); // Reactivar
                $sale->update(['status' => 'VALID']);
            }
        }

        return redirect()->back();
    }
}
