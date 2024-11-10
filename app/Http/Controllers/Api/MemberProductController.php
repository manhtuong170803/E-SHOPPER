<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\http\Requests\Frontend\ProductRequest;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand;


//use Intervention\Image\Laravel\Facades\Image;

use Image;

class MemberProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $products = Products::where('id_user', $userId)->get();
        
        return response()->json([
            'status' => 'success',
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        // $getProducts = Products::find(1)->toArray();
    	// $getArrImage = json_decode($getProducts['filename'], true);

        $categories = Category::all();
        $brandies = Brand::all();
        return response()->json([
            'status' => 'success',
            'categories' => $categories,
            'brandies' => $brandies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(ProductRequest $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            $product = new Products();
            $product->id_user = auth()->id();
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->id_category = $request->input('id_category');
            $product->id_brand = $request->input('id_brand');
            $product->status = $request->input('status');
            $product->sale = $request->input('sale');
            $product->company = $request->input('company');
            $product->detail = $request->input('detail');

            $data = [];
            if($request->hasFile('img'))
            {
    
                foreach($request->file('img') as $image)
                {
    
                    $name = $image->getClientOriginalName();
                    $name_2 = "hinh50_".$image->getClientOriginalName();
                    $name_3 = "hinh200_".$image->getClientOriginalName();
    
                    //$image->move('upload/product/', $name);
                    
                    $path = public_path('upload/products/' . $name);
                    $path2 = public_path('upload/products/' . $name_2);
                    $path3 = public_path('upload/products/' . $name_3);
    
                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                    Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                    
                    $data[] = $name;
                }
            }
            $product->image=json_encode($data);
            //dd($product);
            $product->save();
            
    
            return back()->with('success', 'Add product successfully');
        }else {
            return back()->with('error', 'You need to be logged in to add a product.');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editproduct = Products::find($id);
        $categories = Category::all();
        $brandies = Brand::all();
        return response()->json([
            'status' => 'success',
            'editproduct' => $editproduct,
            'categories' => $categories,
            'brandies' => $brandies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if (Auth::check()) {
            $product = Products::find($id);
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->id_category = $request->input('id_category');
            $product->id_brand = $request->input('id_brand');
            $product->status = $request->input('status');
            $product->sale = $request->input('sale');
            $product->company = $request->input('company');
            $product->detail = $request->input('detail');

            $deleteImages = $request->input('delete_images', []);

            // Giải mã JSON chứa các hình ảnh cũ
            $oldImages = json_decode($product->image) ?? [];

            // Lấy danh sách hình ảnh còn lại sau khi xóa
            $remainingImages = array_diff($oldImages, $deleteImages);

            // Xử lý hình ảnh mới được upload
            $newImages = [];
            if ($request->hasFile('img')) {
                foreach ($request->file('img') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('upload/products'), $filename);
                    $newImages[] = $filename;
                }
            }

            $totalImages = count($remainingImages) + count($newImages);
            if ($totalImages > 3) {
                return response()->json(['success' => false, 'message' => 'Total images cannot exceed 3']);
            }

            //dd($remainingImages); 

            $updatedImages = array_merge($remainingImages, $newImages);

            $product->image = json_encode($updatedImages);
            $product->save();

            return response()->json(['success' => true, 'message' => 'Product updated successfully']);




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
        Products::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }
}
