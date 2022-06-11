<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('administrator')->with('subsidiary')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $employees->total(),
                'current_page' => $employees->currentPage(),
                'per_page' => $employees->perPage(),
                'last_page' => $employees->lastPage(),
                'from' => $employees->firstItem(),
                'to' => $employees->lastPage(),
            ],
            'employees' => $employees
        ];
    }

    public function list()
    {
        return Employee::with('administrator')->with('subsidiary')->OrderBy('id', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->employee_name = $request->employee["employee_name"];
        $employee->age = $request->employee["age"];
        $employee->base_salary = $request->employee["base_salary"];
        $employee->address = $request->employee["address"];
        $employee->photo = $request->employee["photo"];
        $employee->administrator_id = $request->employee["administrator_id"];
        $employee->subsidiary_id = $request->employee["subsidiary_id"];
        $employee->save();
        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->employee_name = $request->employee["employee_name"];
            $employee->age = $request->employee["age"];
            $employee->base_salary = $request->employee["base_salary"];
            $employee->address = $request->employee["address"];
            $employee->photo = $request->employee["photo"];
            $employee->administrator_id = $request->employee["administrator_id"];
            $employee->subsidiary_id = $request->employee["subsidiary_id"];
            $employee->save();
            $employee->save();

            return $employee;
        }
        return "Vendedor no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);
        if ($employees) {
            $employees->delete();
            return "Empleado eliminado";
        }
        return "Empleado no encontrado";
    }
}
