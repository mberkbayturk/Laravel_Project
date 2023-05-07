<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch data
        $category = Categories::all();
        return view("admin.category.index",compact("category"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.create");
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
        $category = new Categories();
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            // unique name
            $fileName = time().'.'.$ext;
            $file->move("uploads/category/",$fileName);
            $category->photo = $fileName;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->meta_title = $request->input('meta_title');
        $category->meta_description = $request->input('meta_description');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? "1" : "0";
        $category->popular = $request->input('popular') == TRUE ? "1" : "0";
        $category->save();
        return redirect("categories")->with("status","Kategori Başarılı Bir Şekilde Eklendi");
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
        $category = Categories::findorfail($id);
        return view("admin.category.edit",compact("category"));
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
        $category = Categories::findorfail($id);
        if($request->hasFile('photo')) {
            $path = "uploads/category/".$category->photo;
            if(File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move("uploads/category/",$fileName);
            $category->photo = $fileName;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->meta_title = $request->input('meta_title');
        $category->meta_description = $request->input('meta_description');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? "1" : "0";
        $category->popular = $request->input('popular') == TRUE ? "1" : "0";
        $category->update();
        return redirect("categories")->with("status","Kategori Başarılı Bir Şekilde Güncellendi");
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
        $category = Categories::findorfail($id);
        if($category->photo) {
            $path = "uploads/category/".$category->photo;
            if(File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect("categories")->with("status","Kategori Başarılı Bir Şekilde Silindi");
    }
}
