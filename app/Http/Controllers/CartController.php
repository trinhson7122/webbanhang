<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
    public function store(Request $request)
    {
        $rq = $request->all();
        $product_id = $rq['product_id'];
        $product = Product::query()->findOrFail($product_id);
        $arrCart = session()->get('cart');
        $discount = session()->get('coupon_id', 0);
        $cart_detail_id = $arrCart[$product_id]['cart_detail_id'] ?? 0;
        if(Auth::check()){
            $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->get()->first();
        }
        $cartDetail = CartDetail::query()->find($cart_detail_id);
        //session
        //nếu chưa có giỏ hàng thì tạo giỏ hàng
        if(!$arrCart || $arrCart == []){
            $arrCart = [];
            //kiểm tra nếu đã đăng nhập thì thêm Cart
            if(Auth::check()){
                //dd(1);
                //dd(auth()->user()->id);
                $cart = Cart::create([
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        //nếu có giỏ hàng và chưa có sản phẩm thì thêm vào giỏ hàng
        if(!isset($arrCart[$product->id])){
            $arrCart[$product->id] = [
                'id' => $product->id,
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'count' => 1,
                'cart_detail_id' => 0,
            ];
            if(Auth::check()){
                $cartDetail = CartDetail::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'amount' => 1,
                ]);
                $arrCart[$product->id]['cart_detail_id'] = $cartDetail->id;
            }
        }
        //nếu có rồi thì cập nhật số lượng
        else{
            $amount = $request->get('amount');
            if($amount){
                $arrCart[$product->id]['count'] = $amount;
                if(Auth::check()){
                    $cartDetail = CartDetail::query()->find($cartDetail->id);
                    $cartDetail->amount = $amount;
                    $cartDetail->save();
                }
            }
            else{
                $arrCart[$product->id]['count']++;
                if(Auth::check()){  
                    $cartDetail = CartDetail::query()->find($cartDetail->id);
                    $cartDetail->amount++;
                    $cartDetail->save();
                }
                  
            }
        }
        session()->put('cart', $arrCart);
        session()->put('coupon_id', $discount);
        //return to_route('index');
        return response()->json([
            'data' => $arrCart,
         ]);
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
        //nếu amount <= 0 thì xóa sản phẩm đấy
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        //session
        $arrcart = session()->get('cart');
        if($arrcart != null)
        {
            unset($arrcart[$product_id]);

            if(Auth::check()){
                $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->get()->first();
                $cartDetails = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
                //dd($cartDetails->count());
                foreach($cartDetails as $item){
                    if($item->product_id == $product_id){
                        $item->delete();
                    }
                }
                $cartDetails = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
                if($cartDetails->isEmpty()){
                    $cart->delete();
                }
            }
        }
        session()->put('cart', $arrcart);
        //
        //nếu hết sạch CartDetails thì xóa Cart
        if(count($arrcart) <= 0){
            unset($arrcart);
            session()->forget('cart');
        }
        return to_route('cart');
    }
}
