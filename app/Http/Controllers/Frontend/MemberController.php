<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\User;
use App\Models\Country;
use App\http\Requests\Frontend\MemberLoginRequest;
use App\http\Requests\Frontend\MemberRegisterRequest;
use App\http\Requests\Frontend\AccountRequest;
//use App\Models\Brand;

class MemberController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showregister()
    {
        $countries = Country::all();
        $userss = Auth::user();
        return view('frontend.member.register', compact('countries','userss'));
    }


    public function postregister(MemberRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->id_country = $request->id_country;
        $user->level = 0; 
        $user->save();
    
        return redirect('member/login')->with('success', 'Registration successful. Please login.');
    }

    

    public function showlogin()
    {
        if(Auth::check())
            return redirect('frontend/home');
        return view('frontend.member.login');
    }


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
        
        if (Auth::attempt($login, $remember)) {
            if (Auth::user()->level == 0) {
                // $token = $user->createToken('authToken')->plainTextToken;
                // $success['token'] =  $user->createToken('MyApp')->accessToken; 
                // return response()->json([
                //         'success' => 'success',
                //         'token' => 123, 
                //         'Auth' => Auth::user()
                //     ], 
                //     $this->successStatus
                // ); 
            

                return redirect('/member/account');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'loginError' => 'Bạn không có quyền truy cập vào trang này.',
                ]);
            }
        } else {
            return back()->withErrors([
                'loginError' => 'Email hoặc mật khẩu không đúng.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('frontend.member.login');
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
    public function account()
    {
        if (!Auth::check()) {
            return redirect('/member/login')->withErrors([
                'loginError' => 'Vui lòng đăng nhập để truy cập tài khoản của bạn.',
            ]);
            
        }
        $userss = Auth::user();
        $countries = Country::all();
        return view('frontend.member.account', compact('userss','countries'));
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
