<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCart()
    {
        //
        $cart = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cart'));
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
    public function addToCart(Request $request)
    {
        //
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()) {
            $product_check = Products::where('id',$product_id)->first();
            if($product_check) {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {
                    return response()->json(['add' => 'Product already exists']);
                }
                else {
                    $cart = new Cart();
                    $cart->user_id = Auth::id();
                    $cart->product_id = $product_id;
                    $cart->product_qty = $product_qty;
                    $cart->save();
                    return response()->json(['add' => 'Added to cart successfully']);
                }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_qty(Request $request)
    {
        //
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {
            $updateCart = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
            $updateCart->product_qty = $product_qty;
            $updateCart->update();
            return response()->json(['add'=>'Quantity updated successfully']);
        } 
        else {
            return response()->json(['add'=>'Something went wrong']);
        }
        
    }

    public function delete_cart_item(Request $request)
    {
        //
        $product_id = $request->input('product_id');
        if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {
            $cartItems = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
            $cartItems->delete();
            return response()->json(['add'=>'Item deleted successfully']);
        } 
        else {
            return response()->json(['add'=>'Item does not exists']);
        }
        
    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count' => $cartCount]);
    }
}
