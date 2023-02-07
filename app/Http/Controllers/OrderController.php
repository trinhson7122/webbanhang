<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
        $discount = session()->get('coupon_id', 0);
        $coupon = Coupon::query()->find($discount);
        $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->get()->first();
        $cartDetails = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
        $sumCart = $cart->sumCart();
        if($coupon && $coupon->amount > 0){
            $coupon->amount -= 1;
            $coupon->save();
            if($sumCart * ($coupon->discount / 100) > $coupon->max){
                $sumCart -= (float)$coupon->max;
            }
            else{
                $sumCart -= $sumCart * ($coupon->discount / 100);
            }
        }
        //dd($sumCart);
        $arrNewOrder = [
            'user_id' => auth()->user()->id,
            'sum_price' => $sumCart,
            'note' => $validated['note'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'coupon_id' => $discount,
        ];
        $order = Order::create($arrNewOrder);
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
        session()->forget('coupon_id');
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
        $order = Order::find($id);
        $request->validate([
            'status' => 'required|numeric',
        ]);
        $order->status = $request->get('status');
        $order->save();
        return redirect()->back()->with('message', 'Cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('is-super-admin', auth()->user())){
            $order = Order::find($id);
            $orderDetails = OrderDetail::query()->where('order_id', '=', $order->id)->get();
            foreach($orderDetails as $item)
            {
                $item->delete();
            }
            $order->delete();
            return to_route('admin.order_manager')->with('message', 'Xóa yêu cầu thành công');
        }
        abort(403);
    }

    public function showOrderDetails(Request $request, $id)
    {
        $order = Order::find($id);
        $coupon = Coupon::find($order->coupon_id);
        $orderDetails = OrderDetail::query()->where('order_id', '=', $order->id)->with('product')->get();
        $arrData = [
            'orderDetails' => $orderDetails,
            'order' => $order,
        ];
        if($coupon){
            $arrData['coupon'] = $coupon;
        }
        return Response($arrData);
    }

    public function orderDetailPerMonth()
    {
        $orderDetails = OrderDetail::query()->whereHas('order', function($q){
            $q->where('status', '=', OrderStatus::Shipped);
        })->get();
        $arr = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];
        foreach($orderDetails as $item){
            $arr[$item->created_at->month] += $item->amount;
        }
        return Response($arr);
    }
    public function orderPerMonth()
    {
        $now = Carbon::now();
        $orderDetails = Order::all();
        $arrShipped = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];
        $arrCancelled = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];
        foreach($orderDetails as $item){
            if($now->year == $item->created_at->year){
                if($item->status == OrderStatus::Shipped){
                    $arrShipped[$item->created_at->month]++;
                }
                if($item->status == OrderStatus::Cancelled){
                    $arrCancelled[$item->created_at->month]++;
                }
            }
        }
        return Response([
            'shipped' => $arrShipped,
            'cancelled' => $arrCancelled,
        ]);
    }
}
