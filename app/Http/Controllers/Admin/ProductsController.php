<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Products::all();
        return view('admin.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Categories::all();
        return view('admin.product.create',compact('category'));
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
        $product = new Products();
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            // unique name
            $fileName = time().'.'.$ext;
            $file->move('uploads/product/',$fileName);
            $product->photo = $fileName;

            // $photoName = $file->getClientOriginalName();
            // $ext = $file->getClientOriginalExtension();
            // $fullpath = time().'.'.$photoName.'.'.$ext;
        }
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->save();
        return redirect('products')->with('status','Ürün Başarılı Bir Şekilde Eklendi');
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
        $product = Products::findorfail($id);
        $category = Categories::all();
        return view('admin.product.edit',compact('product','category'));
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
        $product = Products::findorfail($id);
        if($request->hasFile('photo')) {
            $path = 'uploads/products/'.$product->photo;
            if(File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            // unique name
            $fileName = time().'.'.$ext;
            $file->move('uploads/product/',$fileName);
            $product->photo = $fileName;
        }
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->update();
        return redirect('products')->with('status','Product updated successfully');
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
        $product = Products::findorfail($id);
        if($product->photo) {
            $path = "uploads/product/".$product->photo;
            if(File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect("products")->with("status","Ürün Başarılı Bir Şekilde Silindi");
    }
}
