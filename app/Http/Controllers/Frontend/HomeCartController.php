<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\http\Requests\Frontend\ProductRequest;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeCartController extends Controller
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

    public function ajaxCart(Request $request)
    {
        // echo"123";
        $productId = $request->input('id');
        $product = Products::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found!'], 404);
        }
        
        $productImages = json_decode($product->image, true);  
        $firstImage = isset($productImages[0]) ? $productImages[0] : 'lỗi';

        $cart = Session::get('cart', []);
        
        
        // if (isset($cart[$productId])) {
        //     $cart[$productId]['quantity'] += 1;
        // } else {
        //     $cart[$productId] = [
        //         'name' => $product->name, 
        //         'price' => $product->price,
        //         'quantity' => 1,
        //         'image' => $firstImage,
        //     ];
        // }
        
        if(count($cart)){
            $addToCart = true;
            foreach ($cart as &$item) {
                if (isset($item['id']) && $item['id'] == $productId) {
                    $item['quantity'] += 1; 
                    $addToCart = false;
                    break;
                }
            }
            if($addToCart){
                $cart[] = [
                    'id' => $productId, 
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $firstImage,
                ];
            }
        }else{
            $cart[] = [
                'id' => $productId, 
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $firstImage,
            ];
        }

        Session::put('cart', $cart); 

        $totalQty = 0;
        foreach ($cart as $value) {
            $totalQty += $value['quantity'];
        } 
        Session::put('totalQty', $totalQty);

        //Session::forget(['cart', 'totalQty']);
        if ($request->ajax()) {
            return response()->json([
                'cart' => $cart,
                'totalQty' => $totalQty
            ]);
        }
        //dd($cart);
        //return response()->json(['cart' => $cart]);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name = $request->input('name');

        $products = Products::where('name', 'LIKE', '%' . $name . '%')->get();

        return view('frontend.search.list', compact('products'));
    }



    public function ajaxWishlist(Request $request)
    {
        //  echo"123";
        $productId = $request->input('id');
        $product = Products::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found!']);
        }
        
        $productImages = json_decode($product->image, true);  
        $firstImage = isset($productImages[0]) ? $productImages[0] : 'lỗi';

        $wishlist = Session::get('wishlist', []);

        
        $productExistsInWishlist = collect($wishlist)->contains('id', $productId);

        if ($productExistsInWishlist) {
            return response()->json(['status' => 'error', 'message' => 'Sản phẩm đã có trong mục yêu thích']);
        } else {
            $wishlist[] = [
                'id' => $productId, 
                'name' => $product->name,
                'price' => $product->price,
                'image' => $firstImage,
            ];

            Session::put('wishlist', $wishlist);

            return response()->json([
            'status' => 'success',
            'message' => 'Sản phẩm đã được thêm vào mục yêu thích thành công!',
            'wishlist' => $wishlist]);
        }

       
    }



    public function remove(Request $request)
    {
        $productId = $request->input('id');
        
        $wishlist = session('wishlist', []);

        if(array_key_exists($productId, $wishlist)) {
            unset($wishlist[$productId]);  
            session(['wishlist' => $wishlist]);  

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }



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
