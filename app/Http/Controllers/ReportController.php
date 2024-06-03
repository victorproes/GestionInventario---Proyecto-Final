<?php

namespace App\Http\Controllers;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:reports.day')->only(['reports_day']);
        $this->middleware('can:reports.date')->only(['reports_date']);
        $this->middleware('can:reports.results')->only(['report_results']);
    }

    public function reports_day()
    {
        try {
            $sales = Sale::whereDate('sale_date', Carbon::today('Europe/Madrid'))->get();
            $total = $sales->sum('total');
            return view('admin.report.reports_day', compact('sales', 'total'));
        } catch (\Exception $e) {
            Log::error('Error fetching daily reports: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los informes diarios.');
        }
    }

    public function reports_date()
    {
        try {
            $sales = Sale::whereDate('sale_date', Carbon::today('Europe/Madrid'))->get();
            $total = $sales->sum('total');
            return view('admin.report.reports_date', compact('sales', 'total'));
        } catch (\Exception $e) {
            Log::error('Error fetching reports by date: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los informes por fecha.');
        }
    }

    public function report_results(Request $request)
    {
        try {
            if ($request->fecha_ini && $request->fecha_fin) {
                $fi = $request->fecha_ini . ' 00:00:00';
                $ff = $request->fecha_fin . ' 23:59:59';
                $sales = Sale::whereBetween('sale_date', [$fi, $ff])->get();
                $total = $sales->sum('total');
                return view('admin.report.reports_date', compact('sales', 'total'));
            } else {
                return redirect()->back()->withErrors('Por favor, ingrese ambas fechas.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching report results: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los resultados del informe.');
        }
    }
}
