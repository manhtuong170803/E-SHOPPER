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

class SearchAdvancedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$products = Products::all();
        $categories = Category::all();
        $brandies = Brand::all();

        $query = Products::query();

        if ($request->input('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
    
        if ($request->input('price')) {
            [$minPrice, $maxPrice] = explode('-', $request->price);
            $query->whereBetween('price', [(int)$minPrice, (int)$maxPrice]);
        }

    
        if ($request->input('id_category')) {
            $query->where('id_category', $request->id_category);
        }
    
        if ($request->input('id_brand')) {
            $query->where('id_brand', $request->id_brand);
        }

        if ($request->input('status')) {
            $query->where('status', $request->status);
        }

    
        $products = $query->paginate(6); 
    
        return view('frontend.search.advanced', compact('products', 'categories', 'brandies'));
        
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
    public function store(Request $request)
    {
        //
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
