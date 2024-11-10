<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\User;


class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        // if (Auth::check()) {
            $userss = Auth::user();
            //return view('admin.profile.user', compact('userss'));
            //$countries = Country::all();
            $countries = DB::table('country')->get();
            return view('admin.profile.user', compact('userss', 'countries'));
        
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
    public function insert(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {

        // $user = Auth::user();

        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // if ($request->filled('password')) {
        //     $user->password = bcrypt($request->input('password'));
        // } else {
        //     $user->password = $user->password;
        // }
        
        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $avatarName = time().'.'.$avatar->getClientOriginalExtension();
        //     $avatar->move(public_path('avatars'), $avatarName);
        //     $user->avatar = $avatarName;
        // }
    
        // $user->save();
    
        // return redirect()->back()->with('success', 'Profile updated successfully!');
        

        $userId = Auth::id();
        
        // $user = Auth::user();
       $user = User::findOrFail($userId);


        $data = $request->all();
        $data['id_country'] = $request->input('id_country');
        
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        
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
    public function destroy()
    {
        //
        Auth::logout();
        return redirect("/login");
        // echo "da logout";
        // exit;s
    }
}
