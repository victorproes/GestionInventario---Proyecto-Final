<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Business\UpdateRequest;
use App\Printer;
use Illuminate\Support\Facades\Log;

class PrinterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:printers.index')->only(['index']);
        $this->middleware('can:printers.edit')->only(['update']);
    }

    public function index()
    {
        try {
            $printer = Printer::where('id', 1)->firstOrFail();
            return view('admin.printer.index', compact('printer'));
        } catch (\Exception $e) {
            Log::error('Error fetching printer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener la información de la impresora.');
        }
    }

    public function update(UpdateRequest $request, Printer $printer)
    {
        try {
            $printer->update($request->all());
            return redirect()->route('printers.index');
        } catch (\Exception $e) {
            Log::error('Error updating printer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la información de la impresora.');
        }
    }
}
