<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Provider;
use App\PurchaseDetails;
use App\SaleDetail;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:products.create')->only(['create', 'store']);
        $this->middleware('can:products.index')->only(['index']);
        $this->middleware('can:products.edit')->only(['edit', 'update']);
        $this->middleware('can:products.show')->only(['show']);
        $this->middleware('can:products.destroy')->only(['destroy']);
        $this->middleware('can:change.status.products')->only(['change_status']);
    }



    public function index()
    {
        try {
            $products = Product::get();
            return view('admin.product.index', compact('products'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al obtener la lista de productos.');
        }
    }


    public function create()
    {
        try {
            $categories = Category::all();
            $providers = Provider::all();
            return view('admin.product.agregarEditar', compact('categories', 'providers'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al cargar la vista de crear producto.');
        }
    }


    public function store(StoreRequest $request)
    {

        try {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $image_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/image"), $image_name);
            } else {
                $image_name = null; 
            }

           
            $product = Product::create($request->all() + ['image' => $image_name]);

           
            $product->update(['code' => $product->id]);

            return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al guardar el producto.');
        }
    }



    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        try {
            $categories = Category::all();
            $providers = Provider::all();
            return view('admin.product.agregarEditar', compact('product', 'categories', 'providers'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al cargar la vista de editar producto.');
        }
    }


    public function update(UpdateRequest $request, Product $product)
    {
        try {
            $image_name = $product->image;
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $image_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/image"), $image_name);
            }


           
            $data = $request->all();
            $data['image'] = $image_name;

           
            $product->update($data);

            return redirect()->route('products.index', $product->id)->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al actualizar el producto.');
        }
    }



    public function destroy(Product $product)
    {
        try {
            
            $saleDetails = SaleDetail::where('product_id', $product->id)
                ->whereHas('sale', function ($query) {
                    $query->where('status', 'VALID');
                })
                ->get();
            $purchaseDetails = PurchaseDetails::where('product_id', $product->id)
                ->whereHas('purchase', function ($query) {
                    $query->where('status', 'VALID');
                })
                ->get();

            if ($saleDetails->isNotEmpty() || $purchaseDetails->isNotEmpty()) {
                return redirect()->route('products.index')->with('error', 'No se puede eliminar el producto porque está asociado a una venta o compra activa.');
            }

            $product->delete();
            return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el producto.');
        }
    }

    public function change_status(Product $product)
    {
        try {
            if ($product->status == 'ACTIVE') {
                
                $saleDetails = SaleDetail::where('product_id', $product->id)
                    ->whereHas('sale', function ($query) {
                        $query->where('status', 'VALID');
                    })
                    ->get();
                $purchaseDetails = PurchaseDetails::where('product_id', $product->id)
                    ->whereHas('purchase', function ($query) {
                        $query->where('status', 'VALID');
                    })
                    ->get();

                if ($saleDetails->isNotEmpty() || $purchaseDetails->isNotEmpty()) {
                    return redirect()->back()->with('error', 'No se puede desactivar el producto porque está asociado a una venta o compra activa.');
                }

                $product->update(['status' => 'DEACTIVATED']);
            } else {
                $product->update(['status' => 'ACTIVE']);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cambiar el estado del producto.');
        }
    }
}
