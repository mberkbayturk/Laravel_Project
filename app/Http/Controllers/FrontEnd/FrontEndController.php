<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Products::all();
        // $product_ratings = Products::with('ratings')->get()->toArray();
        $categories = Categories::where('popular','1')->get();
        // dd($product_ratings);
        return view("frontend.index",compact('products','categories'));
    }

    public function categories()
    {
        //
        $categories = Categories::all();
        return view("frontend.categories",compact('categories'));
    }

    public function products()
    {
        //
        $products = Products::paginate(4);
        return view("frontend.products",compact('products'));
    }

    public function viewCategory($slug)
    {
        //
        if(Categories::where('slug',$slug)->exists()) {
            $categories = Categories::where('slug',$slug)->first();
            $products = Products::where('category_id',$categories->id)->paginate(4);
            return view("frontend.relatedProducts",compact('categories','products'));
        } else {
            return redirect('/');
        }
    }

    public function viewProduct($category_slug,$product_slug)
    {
        //
        if(Categories::where('slug',$category_slug)->exists()) {
            if(Products::where('slug',$product_slug)->exists()) {
                $product = Products::where('slug',$product_slug)->first();
                $related_products = Products::where('category_id',$product->category->id)->where('id','<>',$product->id)->paginate(4);
                $ratings = Rating::where('product_id',$product->id)->get();
                $ratings_sum = Rating::where('product_id',$product->id)->sum('stars_rated');
                $user_ratings = Rating::where('product_id',$product->id)->where('user_id',Auth::id())->first();
                $reviews = Review::where('product_id',$product->id)->get();
                if($ratings->count() > 0) {
                    $ratings_value = $ratings_sum / $ratings->count();
                }
                else {$ratings_value = 0;}
                return view("frontend.details",compact('product','ratings','ratings_value','user_ratings','reviews','related_products'));
            }
            else {
                return redirect('/');
            }
        } 
        else {
            return redirect('/');
        }
    }
    

    public function productsListAjax()
    {
        //
        $products = Products::select('name')->get();
        $data = [];

        foreach($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }

    public function search_product(Request $request)
    {
        //
        $search_value = $request->input('search');
        $product = Products::where("name","LIKE","%$search_value%")->first();
        if($product) {
            return redirect('details/'.$product->category->slug.'/'.$product->slug);
        }
        else {
            return redirect()->back()->with('status','No products matched your search');
        }
        
    }

    public function services()
    {
        return view("frontend.services");
    }
    public function about()
    {
        return view("frontend.about");
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
