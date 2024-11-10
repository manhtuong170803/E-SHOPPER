<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Blog;
use App\http\Requests\BlogRequest;
use App\Models\Cmt;

class FrontendBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$bloglist = DB::table('blog')->get();
        $bloglist = Blog::orderBy('created_at', 'desc')->paginate(3);
        return view('frontend.blog.list', compact('bloglist'));
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
        $blog = Blog::findOrFail($id);
        //return view('frontend.blog.detail', compact('blog'));
        
        $previous = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $cmtt = Cmt::where('id_blog', $id)->where('level', 0)->get();
        $reylys = Cmt::where('id_blog', $id)->where('level', 1)->get();
        return view('frontend/blog/detail', compact('blog', 'previous', 'next','cmtt', 'reylys'));
        
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
