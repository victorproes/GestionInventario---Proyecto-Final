<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
class CategoryController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:categories.create')->only(['create','store']);
        $this->middleware('can:categories.index')->only(['index']);
        $this->middleware('can:categories.edit')->only(['edit','update']);
        $this->middleware('can:categories.show')->only(['show']);
        $this->middleware('can:categories.destroy')->only(['destroy']);
    }


    public function index()
    {
        $categories=Category::get();
        return view('admin.category.index',compact('categories'));
    }

  
    public function create()
    {
        return view('admin.category.agregarEditar');
    }

   
    public function store (StoreRequest $request)
    {
        Category::create($request->all());
        
        return redirect()->route('categories.index');
    }

   
    public function show(Category $category)
    {
        return view('admin.category.show',compact('category'));

    }

  
    public function edit(Category $category)
    {
        return view('admin.category.agregarEditar',compact('category'));
    }

  
    public function update (UpdateRequest $request, Category $category)
    {

        
            $category->update($request->all());
            return redirect()->route('categories.edit',$category->id)->with('success', 'Categoría actualizada correctamente.');
     

    }

  
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            
            return redirect()->route('categories.index')->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }
    }
    
}
