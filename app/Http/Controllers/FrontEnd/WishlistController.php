<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view("frontend.wishlist",compact('wishlist'));
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
    public function addToWishlist(Request $request)
    {
        //
        if(Auth::check()) {
            $product_id = $request->input('product_id');
            $product_check = Products::where('id',$product_id)->first();
            if($product_check) {
                if (Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {
                    return response()->json(['add' => 'Product already exists']);
                }
                else {
                    $wish = new Wishlist();
                    $wish->product_id = $product_id;
                    $wish->user_id = Auth::id();
                    $wish->save();
                    return response()->json(['add' => 'Added to wishlist successfully']);
                }
            }
            else {
                return response()->json(['add' => 'Product does not exists']);
            }
        }
        else {
            return response()->json(['add' => 'Login to continue']);
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

    public function delete_wishlist_item(Request $request)
    {
        //
        if(Auth::check()) {
            $product_id = $request->input('product_id');
            if(Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {
                $wish = Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['add'=>'Item deleted successfully']);
            } 
            else {
                return response()->json(['add'=>'Item does not exists']);
            }
        }
        else {
            return response()->json(['add'=>'Login to continue']);
        }
        
    }

    public function wishlistCount()
    {
        $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count' => $wishlistCount]);
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
