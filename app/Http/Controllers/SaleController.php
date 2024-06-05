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
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sales.create')->only(['create', 'store']);
        $this->middleware('can:sales.index')->only(['index']);
        $this->middleware('can:sales.show')->only(['show']);
        $this->middleware('can:change.status.sales')->only(['change_status']);
        $this->middleware('can:sales.pdf')->only(['pdf']);
        $this->middleware('can:sales.print')->only(['print']);
    }

    public function index()
    {
        try {
            $sales = Sale::get();
            return view('admin.sale.index', compact('sales'));
        } catch (\Exception $e) {
            Log::error('Error fetching sales: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener las ventas.');
        }
    }

    public function create()
    {
        try {
            $clients = Client::get();
            $products = Product::get();
            return view('admin.sale.create', compact('clients', 'products'));
        } catch (\Exception $e) {
            Log::error('Error creating sale form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al preparar el formulario de venta.');
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $sale = Sale::create($request->all() + [
                'user_id' => Auth::user()->id,
                'sale_date' => Carbon::now('Europe/Madrid'),
            ]);

            $results = [];
            foreach ($request->product_id as $key => $product) {
                $results[] = [
                    "product_id" => $request->product_id[$key],
                    "quantity" => $request->quantity[$key],
                    "price" => $request->price[$key],
                    "discount" => $request->discount[$key]
                ];
                event(new ProductSold($request->product_id[$key], $request->quantity[$key]));
            }
            $sale->saleDetails()->createMany($results);

            return redirect()->route('sales.index')->with('success', 'Venta creada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error storing sale: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al crear la venta.');
        }
    }

    public function show(Sale $sale)
    {
        try {
            $subtotal = 0;
            $saleDetails = $sale->saleDetails;
            foreach ($saleDetails as $saleDetail) {
                $subtotal += $saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100);
            }
            return view('admin.sale.show', compact('sale', 'saleDetails', 'subtotal'));
        } catch (\Exception $e) {
            Log::error('Error showing sale: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar la venta.');
        }
    }

    public function pdf(Sale $sale)
    {
        try {
            $subtotal = 0;
            $saleDetails = $sale->saleDetails;
            foreach ($saleDetails as $saleDetail) {
                $subtotal += $saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100);
            }
            $pdf = Pdf::loadView('admin.sale.pdf', compact('sale', 'subtotal', 'saleDetails'));
            return $pdf->download('Reporte_de_venta_' . $sale->id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al generar el PDF.');
        }
    }

    public function change_status(Sale $sale)
    {
        try {
            foreach ($sale->saleDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product->status != 'ACTIVE') {
                    return redirect()->back()->with('error', 'No se puede cambiar el estado de la venta porque contiene productos desactivados.');
                }

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

            return redirect()->back()->with('success', 'Estado de la venta cambiado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error changing sale status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cambiar el estado de la venta.');
        }
    }
}
