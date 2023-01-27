<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $discount = session()->get('discount', 0);
        $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->get()->first();
        $cartDetails = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'sum_price' => $cart->sumCart(),
            'discount' => $discount,
            'note' => $validated['note'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);
        foreach($cartDetails as $item)
        {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'amount' => $item->amount,
                'price' => $item->product->price,
            ]);
            $item->delete();
        }
        $cart->delete();
        session()->forget('discount');
        session()->forget('cart');
        return to_route('order.success');
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
