<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('seller')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $products->total(),
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastPage(),
            ],
            'products' => $products
        ];
    }

    public function list()
    {
        return Product::with('seller')->orderBy('id', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->product["product_name"];
        $product->description = $request->product["description"];
        $product->unitary_price = $request->product["unitary_price"];
        $product->stocks = $request->product["stocks"];
        $product->garanty = $request->product["garanty"];
        $product->seller_id = $request->product["seller_id"];
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->product_name = $request->product["product_name"];
            $product->description = $request->product["description"];
            $product->unitary_price = $request->product["unitary_price"];
            $product->stocks = $request->product["stocks"];
            $product->garanty = $request->product["garanty"];
            $product->seller_id = $request->product["seller_id"];
            $product->save();

            return $product;
        }
        return "Producto no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        if ($products) {
            $products->delete();
            return "Producto eliminado";
        }
        return "Producto no encontrado";
    }
}
