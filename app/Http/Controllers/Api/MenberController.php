<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\User;
use App\Models\Country;
use App\http\Requests\Frontend\MemberLoginRequest;
use App\http\Requests\Frontend\MemberRegisterRequest;
use App\http\Requests\Frontend\AccountRequest;

class MenberController extends Controller
{
    public $successStatus = 200;
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
    public function postlogin(Request $request)
    {
        
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            // 'level'=> 0

        ];

        $remember = false;


        if($request->remember_me){
            $remember = true;
        }

        if (Auth::attempt($login)) {
            if (Auth::user()->level == 0) {
                $user = Auth::user(); 
                $token = $user->createToken('authToken')->plainTextToken;
                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                return response()->json([
                        'success' => 'success',
                        'token' => $token, 
                        'Auth' => Auth::user()
                    ], 
                    $this->successStatus
                ); 
                // return response()->json([
                //     'status' => 'success',
                //     'message' => 'Đăng nhập thành công.',
                //     'data' => Auth::user()
                // ]);
            } else {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn không có quyền truy cập vào trang này.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email hoặc mật khẩu không đúng.'
            ]);
        }
    }

    public function postregister(Request $request)
    {
        // if (User::where('email', $request->email)->exists()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Email này đã được đăng ký. Vui lòng sử dụng email khác.'
        //     ]);
        // }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->id_country = $request->id_country;
        $user->level = 0; 

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Đăng ký thành công. Vui lòng đăng nhập.'
            ]); 
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Đăng ký thất bại. Vui lòng thử lại sau.'
            ]); 
        }
        //return redirect('member/login')->with('success', 'Registration successful. Please login.');
    }






    public function account()
    {
        if (!Auth::check()) {
            return redirect('/member/login')->withErrors([
                'loginError' => 'Vui lòng đăng nhập để truy cập tài khoản của bạn.',
            ]);
            
        }
        $userss = Auth::user();
        $countries = Country::all();
        return response()->json([
            'status' => 'success',
        ]); 
        //return view('frontend.member.account', compact('userss','countries'));
        // dd($userss);
        
    }
    
    public function update(AccountRequest $request)
    {
        $userId = Auth::id();
        
        // $user = Auth::user();
       $user = User::findOrFail($userId);


        $data = $request->all();
        $data['id_country'] = $request->input('id_country');
        
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['phone'] = $request->input('phone');
        $data['address'] = $request->input('address');
        
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        // dd($data);

       
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
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
    // public function update(Request $request, $id)
    // {
    //     //
    // }

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
