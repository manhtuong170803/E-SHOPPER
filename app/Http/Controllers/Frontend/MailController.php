<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
//use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Illuminate\Support\Facades\Session;


class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $data = [
    //         'subject'=> 'Cambo Tutorial Mail',
    //         'body' => 'Hello this is my email delivery'
    //     ];
    //     try {
    //         Mail::to('manhtuong170803@gmail.com')->send(new MailNotify($data));
    //         return response()->json(['Great check your mail box']);
    //     }catch(Exception $th){
    //         return response()->json(['sorry']);
    //     }
    // }

    public function sendOrderEmail(Request $request)
    {
        if (Auth::check()) {
            $cart = session('cart', []);
            $user = Auth::user();
            $freeship = 2;
            $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $subtotal = $totalPrice + $freeship;


            $orderData = [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? 'N/A',
                    'price' => $user->price
                ],
                'cart' => $cart,
                'total' => $subtotal,
                'ship' => $freeship
            ];


            Mail::to('manhtuong170803@gmail.com')->send(new MailNotify($orderData));

            History::create([
                'email' => $user->email,
                'phone' => $user->phone ?? 'N/A',
                'name' => $user->name,
                'id_user' => $user->id,
                'price' => $subtotal,
            ]);
            Session::forget(['cart', 'totalQty']); 

            return redirect()->route('frontend.home')->with('success', 'Đã mua hàng thành công!');
            // return response()->json(['message' => 'Đơn hàng đã được xử lý và lưu lại thành công.']);
        } else {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện chức năng này.'], 403);
        }
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
