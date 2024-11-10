<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Products;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Session::get('cart'); 
        return view('frontend.cart.detail', ['cart' => $cart]);
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
    public function ajaxUpdateCart(Request $request)
    {
        $productId = $request->input('id');
        $action = (int) $request->input('x');

        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
    
        $cart = session()->get('cart');
        $updated = false;
        if ($action == 1) {
            if(isset($cart[$productId])){
                $cart[$productId]['quantity'] += 1;
                $updated = true; 
            }
    
        } 
        elseif ($action === 2) {
            if(isset($cart[$productId])){
                if($cart[$productId]['quantity'] > 1){
                    $cart[$productId]['quantity'] -= 1;
                }else{
                    return response()->json(['message' => 'Số lượng không thể nhỏ hơn 1']);
                }
                $updated = true; 
            }
        } 
        elseif ($action === 3) { 
            if(isset($cart[$productId])){
                unset($cart[$productId]);
            }
            $updated = true; 
        }

        $total_price = 0;  
        $sub_total = 0;  
        $eco_tax = 2;  
        $grand_total = 0;  

        foreach ($cart as $value) {
            $total_price = $value['quantity'] * $value['price'];  
            $sub_total += $total_price; 
        }
        $grand_total = $sub_total + $eco_tax;
       
        session()->put('cart', $cart);
        //Session::forget(['cart']);

        $totalQty = 0;        
        foreach ($cart as $value) {
            $totalQty += $value['quantity'];
        } 
        Session::put('totalQty', $totalQty);

        if($request->ajax()) {
            return response()->json([
                'message' => 'cập nhật thành công',
                'totalQty' => $totalQty,
                'sub_total' => $sub_total,
                'grand_total' => $grand_total,

            ]);
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
