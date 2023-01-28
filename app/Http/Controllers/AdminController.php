<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $title;
    public function index()
    {
        $this->title = 'Dashboard';
        return view('admin.dashboard.index', [
            'title' => $this->title,
        ]);
    }

    public function productManager(Request $search)
    {
        $this->title = 'Product Manager';
        $per_page = 10;
        $s = $search->get('search', '');
        $type = $search->get('type', 'id');
        $by = $search->get('by', 'asc');
        if($search->has('by')){
            session()->flash('type', $type);
            session()->flash('by', $by);
        }
        if($search->has('search')){
            session()->flash('search', $s);
        }

        if($search->has('type')){
            if($by == 'asc'){
                $products = Product::query()->orderBy($type, 'asc')
                    ->with('user')
                    ->where('name', 'like', "%$s%")
                    ->paginate($per_page)
                    ->appends('search', $s)
                    ->appends('type', $type)
                    ->appends('by', $by);
            }
            else{
                $products = Product::query()->orderBy($type, 'desc')
                    ->with('user')
                    ->where('name', 'like', "%$s%")
                    ->paginate($per_page)
                    ->appends('search', $s)
                    ->appends('type', $type)
                    ->appends('by', $by);
            }
        }
        else{
            $products = Product::query()->with('user')
            ->where('name', 'like', "%$s%")
            ->paginate($per_page)->appends('search', $s);
        }
        
        return view('admin.product.index', [
            'title' => $this->title,
            'products' => $products,
        ]);
    }

    public function userManager(Request $search)
    {
        $this->title = 'User Manager';
        $per_page = 10;
        $s = $search->get('search');
        $users = User::query()->where('name', 'like', "%$s%")
        ->paginate($per_page)->appends('search', $s);
        return view('admin.user.index', [
            'title' => $this->title,
            'users' => $users,
        ]);
    }

    public function couponManager(Request $search)
    {
        $this->title = 'Coupon Manager';
        $per_page = 10;
        $s = $search->get('search');
        $coupons = Coupon::query()->where('name', 'like', "%$s%")
        ->paginate($per_page)->appends('search', $s);
        return view('admin.coupon.index', [
            'title' => $this->title,
            'coupons' => $coupons,
        ]);
    }

    public function orderManager(Request $search)
    {
        $this->title = 'Order Manager';
        $per_page = 10;
        $s = $search->get('search');
        $orders = Order::query()->where('phone', 'like', "%$s%")->orderByDesc('id')
        ->paginate($per_page)->appends('search', $s);
        return view('admin.order.index', [
            'title' => $this->title,
            'orders' => $orders,
        ]);
    }
}
