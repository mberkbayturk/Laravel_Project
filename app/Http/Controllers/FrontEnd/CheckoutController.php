<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $old_cartItems = Cart::where('user_id',Auth::id())->get();
        foreach($old_cartItems as $item) {
            if(!Products::where('id',$item->product_id)->where('qty','>=',$item->product_qty)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view("frontend.checkout",compact('cartItems'));
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
    public function place_order(Request $request)
    {
        // checkout fields
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fName = $request->input('fName');
        $order->lName = $request->input('lName');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');

        // to calculate order total price
        $total = 0;
        $cartItems_total = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems_total as $prod) {
            $total += $prod->products->selling_price * $prod->product_qty;
        }

        $order->total_price = $total;
        $order->trackingNumber = 'Shopia'.rand(1111,9999);
        $order->save();

        $cartItems = Cart::where('user_id',Auth::id())->get();

        foreach($cartItems as $item) {
            OrderItem::create([
                'order_id' =>  $order->id,
                'product_id' =>  $item->product_id,
                'product_qty' =>  $item->product_qty,
                'product_price' =>  $item->products->selling_price,
            ]);

            $prod = Products::where('id',$item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if(Auth::user()->address1 == Null) {
            $user = User::where('id',Auth::id())->first();
            $user->name = $request->input('fName');
            $user->lName = $request->input('lName');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartItems);

        if($request->input('payment_mode') == "Paid by PayPal") {
            return response()->json(["status" => "Order placed successfully"]);
        }

        return redirect('/')->with('status','Order placed successfully');
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
