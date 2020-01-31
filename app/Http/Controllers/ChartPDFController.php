<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
use PDFChart;

class ChartPDFController extends Controller
{
    public function index()
    {
        $pdf = PDFChart::loadView('pdf.chart');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 1000);
        $pdf->setOption('no-stop-slow-scripts', true);
        $pdf->setOption('enable-smart-shrinking', true);
        return $pdf->stream();
    }
}
