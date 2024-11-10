<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\http\Requests\Frontend\ProductRequest;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand;

class PriceRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxPriceRange(Request $request)
    {
       
       //dd($request->has('price_range'));

       if ($request->has('price_range')) {
            [$minPrice, $maxPrice] = explode(':', $request->input('price_range'));
            $minPrice = (int) trim($minPrice);
            $maxPrice = (int) trim($maxPrice);

            $products = Products::whereBetween('price', [$minPrice, $maxPrice])->get(); 
            $categories = Category::all();
            $brandies = Brand::all();
            //dd($products);      
            return response()->json([
                'products' => $products
            ]);
            //return response()->json($products);
          
        }


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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
