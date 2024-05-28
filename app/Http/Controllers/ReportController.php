<?php

namespace App\Http\Controllers;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:reports.day')->only(['reports.day']);
        $this->middleware('can:reports.date')->only(['reports.date']);
        $this->middleware('can:reports.results')->only(['reports.results']);
        
    }

  


    public function reports_day(){
        $sales=Sale::whereDate('sale_date',Carbon::today('Europe/Madrid'))->get();
        $total=$sales->sum('total');
        return view('admin.report.reports_day',compact('sales','total'));
    }

    public function reports_date(){
        $sales=Sale::whereDate('sale_date',Carbon::today('Europe/Madrid'))->get();
        $total=$sales->sum('total');
        return view('admin.report.reports_date',compact('sales','total'));
    }

    public function report_results(Request $request)
{
    
    if ($request->fecha_ini && $request->fecha_fin) {
       
        $fi = $request->fecha_ini . ' 00:00:00';
        $ff = $request->fecha_fin . ' 23:59:59';
        
        
        $sales = Sale::whereBetween('sale_date', [$fi, $ff])->get();
        $total = $sales->sum('total');
        
        
        return view('admin.report.reports_date', compact('sales', 'total'));
    } else {
        
        return redirect()->back()->withErrors('Por favor, ingrese ambas fechas.');
    }
}

}
