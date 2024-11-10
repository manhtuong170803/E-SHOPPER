<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\http\Requests\CountryRequest;
use App\Models\Country;
use App\http\Requests\ProfileRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  DB::table('country')->insert([
        //     [ "name" => "Đà Nẵng" ]
        // ]);
        //  echo "thành công";

        $countries = Country::all();
          //$countries = DB::table('country')->get();
        return view('admin.country.list', compact('countries'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.country.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        // $addcountry = Country::create([n
        //     'name' => $request->input('name')
        // ]);
    
        // if ($addcountry) {
        //     return redirect()->route('country.add')->with('success', 'Thêm name thành công');
        // } else {
        //     return redirect()->back()->with('error', 'Thêm name thất bại');
        // }

         DB::table('country')->insert([
            'name' => $request->input('name')
            
        ]);

        return redirect()->route('country.add')->with('success', 'Thêm name thành công');
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
    public function delete($id)
    {
        Country::where('id', $id)->delete();
        return redirect()->route('country.list')->with('success', 'Name đã được xóa thành công.');

    }
}
