<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Employee;
use PDF;

class ReportController extends Controller
{
    
    public function generateRepAdmin(){

        $administrador = Administrator::all();

        $pdf = PDF::loadView('PDF.administrador', compact('administrador'));

        return $pdf->stream('Reporte.pdf');
    }

    public function generateRepByAdmin($id){

        $administrador = Administrator::where(['id'=>$id])->first();

        $pdf = PDF::loadView('PDF.admin', compact('administrador'));

        return $pdf->stream('ReporteById.pdf');
    }

    public function generateRepEmpl(){

        $employee = Employee::all();

        $pdf = PDF::loadView('PDF.employee', compact('employee'));

        return $pdf->stream('Reporte.pdf');
    }

    public function generateRepbyEmpl($id){

        $employee = Employee::where(['id'=>$id])->first();

        $pdf = PDF::loadView('PDF.empl', compact('employee'));

        return $pdf->stream('Reporte.pdf');
    }

}
