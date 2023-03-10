<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Slides;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        Visitor::create([
            'ip' => $request->ip(),
        ]);
        $title = 'Trang chủ';
        $count = 4;
        $per_page = 8;
        $s = $request->get('search');
        $slides = Slides::query()->where('display', '=', '1')->get()->take(3);
        $newProducts = Product::query()->orderBy('id', 'desc')->get()->take($count);
        $products = Product::query()->where('name', 'like', "%$s%")
        ->simplePaginate($per_page)->appends('search', $s);
        $topSaleProducts = OrderDetail::query()->whereHas('order', function ($q){
            $q->where('status', '=', OrderStatus::Shipped);
        })->groupBy('product_id')->selectRaw('sum(amount) as sum, product_id')->orderByDesc('sum')->with('product')->get([
            'sum', 'product_id'
        ])->take($count);
        return view('client.index', [
            'title' => $title,
            'newProducts' => $newProducts,
            'products' => $products,
            'topSaleProducts' => $topSaleProducts,
            'slides' => $slides,
        ]);
    }

    public function cart()
    {
        $title = 'Giỏ hàng';
        $coupon = Coupon::find(session()->get('coupon_id'));
        $sumCart = 0;
        if(Auth::check()){
            //nếu người dùng đã có giỏ hàng thì reset session và tạo session dựa trên CartDetail
            $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->first();
            if($cart){
                session()->forget('cart');

                $cartDetail = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
                $scart = [];
                foreach($cartDetail as $item)
                {
                    $scart[$item->product_id] = [
                        'id' => $item->product_id,
                        'image' => $item->product->image,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'count' => $item->amount,
                        'cart_detail_id' => $item->id,
                    ];
                }
                $sumCart = arrSumCart($scart);
                session()->put('cart', $scart);
            }
            //nếu người dùng chưa có giỏ hàng thì thêm Cart và CartDetail vào dựa trên session
            else if(session()->has('cart')){
                $cart = Cart::create([
                    'user_id' => auth()->user()->id,
                ]);

                foreach(session()->get('cart') as $item)
                {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $item['id'],
                        'amount' => $item['count'],
                    ]);
                }
            }
            
        }
        $arrData = [
            'title' => $title,
            'discount' => 0,
            'sumCart' => $sumCart,
        ];
        if($coupon){
            if($sumCart * ($coupon->discount / 100) > $coupon->max){
                $arrData['discount'] = $coupon->max;
            }
            else
            {
                $arrData['discount'] = arrSumCart($scart) * $coupon->discount / 100;
            }
        }
        return view('client.cart', $arrData);
    }

    public function profile()
    {
        $title = 'Hồ sơ';
        $user = auth()->user();
        return view('client.profile', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function checkout()
    {
        $title = 'Thủ tục thanh toán';
        $coupon = Coupon::find(session()->get('coupon_id'));
        $cart = Cart::query()->where('user_id', '=', auth()->user()->id)->first();
        $cartDetails = CartDetail::query()->where('cart_id', '=', $cart->id)->get();
        $scart = session()->get('cart');
        $arrData = [
            'title' => $title,
            'cart' => $cart,
            'cartDetails' => $cartDetails,
            'discount' => 0,
        ];
        if($coupon){
            if($cart->sumCart() * ($coupon->discount / 100) > $coupon->max){
                $arrData['discount'] = $coupon->max;
            }
            else
            {
                $arrData['discount'] = $cart->sumCart() * $coupon->discount / 100;
            }
        }
        return view('client.checkout', $arrData);
    }

    public function myOrder()
    {
        $title = 'Yêu cầu';
        $orders = Order::query()->where('user_id', '=', auth()->user()->id)->orderByDesc('id')->get();
        return view('client.myOrder', [
            'title' => $title,
            'orders' => $orders,
        ]);
    }
}
