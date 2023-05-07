<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function add($product_slug)
    {
        $check_product = Products::where('slug',$product_slug)->first();
        if($check_product) {
            $product_id = $check_product->id;
            $review = Review::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if($review) {
                return view('frontend.reviews.edit',compact('review'));
            }
            else {
                
            $verified_purchase = Order::where('orders.user_id',Auth::id())
                                ->join('order_items','orders.id','order_items.order_id')
                                ->where('order_items.product_id',$product_id)->get();
            return view('frontend.reviews.index',compact('check_product','verified_purchase'));
            }
        }
        else {
            return redirect()->back()->with('status','The link you followed was broken');
        }
    }

    public function add_review(Request $request) {
        $product_id = $request->input('product_id');
        $product = Products::where('id',$product_id)->first(); 
        if($product) {
            $review = $request->input('review');
            $insert_review = Review::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'review' => $review,
            ]);
            $category_slug = $product->category->slug;
            $product_slug = $product->slug;
            if($insert_review) {
                return redirect('details/'.$category_slug.'/'.$product_slug)->with('status','Product reviewed successfully');
            } 
            else {

            }
        }
        else {
            return redirect()->back()->with('status','The link you followed was broken');
        }
    }

    public function edit_review($product_slug)
    {
        $check_product = Products::where('slug',$product_slug)->first();
        if($check_product) {
            $product_id = $check_product->id;
            $review = Review::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if($review) {
                return view('frontend.reviews.edit',compact('review'));
            }
            else {
                return redirect()->back()->with('status','The link you followed was broken');
            }
        }  
        else {
            return redirect()->back()->with('status','The link you followed was broken');
        }
    }

    public function update_review(Request $request) {
        $review_id = $request->input('review_id');
        $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
        if($review) {
            $review->review = $request->input('review');
            $review->update();
            return redirect('details/'.$review->product->category->slug.'/'.$review->product->slug)->with('status','Review updated successfully');

        }
        else {
            return redirect()->back()->with('status','The link you followed was broken');
        }
    }
}
