<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\http\Requests\Frontend\CommentRequest;
use App\Models\Cmt;
use App\Models\Blog;


class ReplayController extends Controller
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
   
     public function ajaxReply(Request $request)
     {
        
            $cmts = Cmt::create([
                 'id_blog' => $request->input('id_blog'),
                 'id_user' => auth()->id(),
                 'cmt' => $request->input('cmt'),
                 'avatar' => auth()->user()->avatar, 
                 'name' => auth()->user()->name,
                 'level' => 1,
                 
             ]);
             //dd(auth()->user()->name);
         
         $getData = $cmts->toArray();
        
         return response()->json(['reply' => $getData]);
 
          //return view('frontend.blog.detial', compact('cmts'));
         
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $blog = Blog::findOrFail($id);
        // $userRating = Cmt::where('id_blog', $id)
        //                     ->where('id_user', auth()->id())
        //                     ->value('rate'); 

        // return view('frontend.blog.detail', compact('blog', 'userRating'));
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
