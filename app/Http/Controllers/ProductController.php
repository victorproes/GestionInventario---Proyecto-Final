<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Provider;

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
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('admin.product.agregarEditar', compact('categories', 'providers'));
    }


    public function store(StoreRequest $request)
    {
        

       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        } else {
            $image_name = null; // Asignar null si no se proporciona una imagen
        }

        // Crear el producto y asignar el nombre de la imagen
        $product = Product::create($request->all() + ['image' => $image_name]);

        // Actualizar el código del producto
        $product->update(['code' => $product->id]);

        return redirect()->route('products.create')->with('success', 'Producto creado correctamente.')->with('delay', 3000);
    }



    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('admin.product.agregarEditar', compact('product', 'categories', 'providers'));
    }


    public function update(UpdateRequest $request, Product $product)
    {
        $image_name = $product->image;
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("/image"), $image_name);
        }


        // Crear un array de datos de actualización
        $data = $request->all();
        $data['image'] = $image_name;

        // Actualizar el producto con los datos
        $product->update($data);

        return redirect()->route('products.index');
    }



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } else {
            $product->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }
    }
}
