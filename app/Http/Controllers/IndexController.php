<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';
        $count = 4;
        $per_page = 8;
        $newProducts = Product::query()->orderBy('id', 'desc')->get()->take($count);
        $products = Product::query()->simplePaginate($per_page);
        return view('client.index', [
            'title' => $title,
            'newProducts' => $newProducts,
            'products' => $products,
        ]);
    }

    public function cart()
    {
        $title = 'Giỏ hàng';
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
        return view('client.cart', [
            'title' => $title,
        ]);
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
        return view('client.checkout', [
            'title' => $title,
        ]);
    }
}
