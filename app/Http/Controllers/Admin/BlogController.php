<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Blog;
use App\http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index()
// {
//     DB::table('blog')->insert([
//         [ 
//             "title" => "Nóng bảng xếp hạng Ngoại hạng Anh", 
//             "image" => "waileahorsebackadventure-hilo-horseback-riding-tours-umauma-sup.jpg", 
//             "description" => "MU vừa hòa 0-0 trên sân của Aston Villa trong trận đấu tâm điểm vòng 7 Ngoại hạng Anh.",
//             "content" => "Lần gần nhất MU giành được ít hơn 8 điểm sau 7 vòng đấu đầu tiên ở hạng đấu cao nhất xứ sư"
//         ]
//     ]);
//     echo"thành công";

//     //return redirect()->route('admin.blog.list')->with('success', 'Bài viết đã được thêm thành công.');
// }
    public function index()
    {
      // $bloglist = Blog::all();
        $bloglist = DB::table('blog')->get();
        return view('admin.blog.list', compact('bloglist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(BLogRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
    
        $blogadd = Blog::create([
            'title' => $request->input('title'),
            'image' => $imageName, 
            'Description' => $request->input('description'),
            'content' => $request->input('content')
        ]);
    
        if ($blogadd) {
            return redirect()->route('blog.add')->with('success', 'Bài viết đã được thêm thành công.');
        } else {
            return redirect()->back()->with('error', 'Thêm bài viết thất bại.');
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
        $editblog = Blog::find($id);
        if (!$editblog) {
            return redirect()->route('admin.blog.list')->with('error', ' không blog tồn tại.');
        }
        //dd($editblog);
        return view('admin.blog.edit', compact('editblog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BLogRequest $request, $id)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $updateblog = BLog::where('id', $id)->update([
           'title' => $request->input('title'),
            'image' => $imageName, 
            'Description' => $request->input('description'),
            'content' => $request->input('content')
        ]);

        if ($updateblog) {
            return redirect()->route('blog.edit', $id)->with('success', 'BLog đã được sửa thành công');
        } else {
            return redirect()->back()->with('error', 'Sửa blog thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Blog::where('id', $id)->delete();

        return redirect()->route('admin.blog.list')->with('success', 'Blog đã được xóa thành công.');
    }
}
