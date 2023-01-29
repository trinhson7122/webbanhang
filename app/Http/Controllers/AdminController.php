<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $title;
    public function index()
    {
        $this->title = 'Dashboard';
        //visitor
        $visitors = Visitor::all();
        $visitorInThisMonth = getCountDiffInMonth($visitors);
        $allvisitor = $visitors->count();
        $visitorPercent = percent($visitorInThisMonth, getCountDiffInMonth($visitors, 1));
        //order details
        $orderDetails = OrderDetail::query()->whereHas('order', function($q){
            $q->where('status', '=', OrderStatus::Shipped);
        })->get();
        $productInThisMonth = getCountDiffInMonth($orderDetails);
        $productPercent = percent($productInThisMonth, getCountDiffInMonth($orderDetails, 1));
        //Doanh thu
        $orders = Order::query()->where('status', '=', OrderStatus::Shipped)->get();
        $tongDoanhThuThang = sumWithDateTime($orders, 0, 'sum_price');
        $tongDoanhThuThangTruoc = sumWithDateTime($orders, 1, 'sum_price');
        $percentDoanhThu = percent($tongDoanhThuThang, $tongDoanhThuThangTruoc);
        //dd($percentDoanhThu);
        return view('admin.dashboard.index', [
            'title' => $this->title,
            'visitorInThisMonth' => $visitorInThisMonth,
            'allvisitor' => $allvisitor,
            'visitorPercent' => $visitorPercent,
            'productInThisMonth' => $productInThisMonth,
            'productPercent' => $productPercent,
            'tongDoanhThuThang' => printMoney($tongDoanhThuThang),
            'percentDoanhThu' => $percentDoanhThu,
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
        $orders = Order::query()->where('id', 'like', "%$s%")->orderByDesc('id')
        ->paginate($per_page)->appends('search', $s);
        return view('admin.order.index', [
            'title' => $this->title,
            'orders' => $orders,
        ]);
    }
}
