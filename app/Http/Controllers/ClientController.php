<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;

use App\Sale;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:clients.create')->only(['create','store']);
        $this->middleware('can:clients.index')->only(['index']);
        $this->middleware('can:clients.edit')->only(['edit','update']);
        $this->middleware('can:clients.show')->only(['show']);
        $this->middleware('can:clients.destroy')->only(['destroy']);
    }

    public function index()
    {
        $clients = Client::get();
        return view('admin.client.index', compact('clients'));
    }


    public function create()
    {
        return view('admin.client.agregarEditar');
    }


    public function store(StoreRequest $request)
    {

        try {
            Client::create($request->all());
            return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al crear el cliente: ' . $e->getMessage());
        }
    }
       
        
    


    public function show(Client $client)
    {
        $sales = Sale::with('saleDetails.product')->where('client_id', $client->id)->get();
        return view('admin.client.show', compact('client', 'sales'));
    }
    


    public function edit(Client $client)
    {
        return view('admin.client.agregarEditar', compact('client'));
    }


    public function update(UpdateRequest $request, Client $client)
    {

        try {
            $client->update($request->all());
            return redirect()->route('clients.index', $client->id)->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al actualizar al cliente: ' . $e->getMessage());
        }
        
       
    }


    public function destroy(Client $client)
    {

        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('clients.index')->with('error', 'No se puede eliminar al cliente porque tiene ventas asociadas.');
        }
        
        
    }
}
