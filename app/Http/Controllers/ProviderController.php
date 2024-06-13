<?php

namespace App\Http\Controllers;

use App\Category;
use App\Provider;
use Illuminate\Http\Request;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
class ProviderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:providers.create')->only(['create','store']);
        $this->middleware('can:providers.index')->only(['index']);
        $this->middleware('can:providers.edit')->only(['edit','update']);
        $this->middleware('can:providers.show')->only(['show']);
        $this->middleware('can:providers.destroy')->only(['destroy']);
    }


    public function index()
    {
        $providers=Provider::get();
        return view('admin.provider.index',compact('providers'));
    }

  
    public function create()
    {
        return view('admin.provider.agregarEditar');
    }

   
    public function store(StoreRequest $request)
    {
        try {
            Provider::create($request->validated());
            return redirect()->route('providers.index')->with('success', 'Proveedor agregado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al agregar el proveedor: ' . $e->getMessage());
        }
        
     
    }

   
    public function show($id)
{
    $provider = Provider::findOrFail($id);
    $categories = Category::all(); 
    return view('admin.provider.show', compact('provider', 'categories'));
}


  
    public function edit(Provider $provider)
    {
        return view('admin.provider.agregarEditar',compact('provider'));
    }

  
    public function update(UpdateRequest $request, Provider $provider)
    {
        try {
            $provider->update($request->all());
            return redirect()->route('providers.index', $provider->id)->with('success', 'Proveedor actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al actualizar el proveedor: ' . $e->getMessage());
        }
    }

  
    public function destroy(Provider $provider)
    {
        try {
            $provider->delete();
            return redirect()->route('providers.index')->with('success', 'Proveedor eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('providers.index')->with('error', 'No se puede eliminar el proveedor porque tiene productos y compras asociadas.');
        }
       
        
    }
}
