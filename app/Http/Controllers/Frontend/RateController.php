<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\Frontend\RateRequest;
use App\Models\Rate;
use App\Models\Blog;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //  return view('frontend.blog.list');
        // echo"abc";
       
        
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
    public function store(RateRequest $request)
    {
        //var_dump($request['rate']);
        //return response()->json(['message' => 'abc']);
        $rate = Rate::where('id_blog', $request['id_blog'])
        ->where('id_user', auth()->id())
        ->first();

        if ($rate) {
            $rate->rate = $request['rate'];
            $rate->save();
        }else {
            Rate::create([
                'id_blog' => $request['id_blog'],
                'id_user' => auth()->id(),
                'rate' => $request['rate']
            ]);
        }

         return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rateid = Blog::findOrFail($id);
        $Ratedemo = Rate::where('id_blog', $id)->avg('rate');
        $Ratedemo = round($Ratedemo ?? 0); 
        //$Ratedemo = round($averageRate); // Làm tròn điểm

        //dd($Ratedemo);

        return view('frontend.blog.detail', compact('rateid', 'Ratedemo'));
        // return view('frontend.blog.detail', [
        //     'rateid' => $rateid,
        //     'Ratedemo' => $Ratedemo,
        // ]);

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
