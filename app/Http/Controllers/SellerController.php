<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::with('user')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $sellers->total(),
                'current_page' => $sellers->currentPage(),
                'per_page' => $sellers->perPage(),
                'last_page' => $sellers->lastPage(),
                'from' => $sellers->firstItem(),
                'to' => $sellers->lastPage(),
            ],
            'sellers' => $sellers
        ];
    }
    
    public function list()
    {
        return Seller::with('user')->orderBy('id', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = new Seller();
        $seller->dui = $request->seller["dui"];
        $seller->address = $request->seller["address"];
        $seller->nit = $request->seller["nit"];
        $seller->user_id = $request->seller["user_id"];
        $seller->save();
        return $seller;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);
        if ($seller) {
            $seller->dui = $request->seller["dui"];
            $seller->address = $request->seller["address"];
            $seller->nit = $request->seller["nit"];
            $seller->user_id = $request->seller["user_id"];
            $seller->save();

            return $seller;
        }
        return "Vendedor no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sellers = Seller::find($id);
        if ($sellers) {
            $sellers->delete();
            return "Vendedor eliminado";
        }
        return "Vendedor no encontrado";
    }
}
