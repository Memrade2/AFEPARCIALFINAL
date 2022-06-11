<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Administrator::with('user')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $administrators->total(),
                'current_page' => $administrators->currentPage(),
                'per_page' => $administrators->perPage(),
                'last_page' => $administrators->lastPage(),
                'from' => $administrators->firstItem(),
                'to' => $administrators->lastPage(),
            ],
            'administrators' => $administrators
        ];
    }

    public function list()
    {
        return Administrator::with('user')->orderBy('id', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $administrator = new Administrator();
        $administrator->administrator_name = $request->administrator["administrator_name"];
        $administrator->dui = $request->administrator["dui"];
        $administrator->phone = $request->administrator["phone"];
        $administrator->save();
        return $administrator;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
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
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $administrators = Administrator::find($id);
        if ($administrators) {
            $administrators->delete();
            return "Administrador eliminado";
        }
        return "Administrador no encontrado";
    }
}
