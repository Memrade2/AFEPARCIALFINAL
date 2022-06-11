<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use PDF;

class ReportController extends Controller
{
    public function generateRepAdmin(){

        $administrador = Administrator::select('*');

        $pdf = PDF::loadView('PDF.summary', compact('administrador'));

        return $pdf->stream('Reporte.pdf');
    }
}
