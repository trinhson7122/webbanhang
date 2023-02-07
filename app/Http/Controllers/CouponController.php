<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponController extends Controller
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
    public function store(StoreCouponRequest $request)
    {
        $validated = $request->validated();
        Coupon::create([
            'created_by_id' => auth()->user()->id,
            'name' => strtoupper($validated['name']),
            'discount' => $validated['discount'],
            'amount' => $validated['amount'],
            'max' => $validated['max'],
        ]);
        return to_route('admin.coupon_manager')->with('message', 'Thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::find($id);
        return $coupon;
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
    public function update(StoreCouponRequest $request, $id)
    {
        if(Gate::allows('is-super-admin', auth()->user())){
            $coupon = Coupon::find($id);
            $validated = $request->validated();
            $coupon->update([
                'name' => $validated['name'],
                'discount' => $validated['discount'],
                'amount' => $validated['amount'],
                'max' => $validated['max'],
            ]);
            return to_route('admin.coupon_manager')->with('message', 'Cập nhật mã giảm giá thành công');
        }
        abort(403);
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
            $coupon = Coupon::find($id);
            $coupon->delete();
            return redirect()->back()->with('message', 'Xóa mã giảm giá thành công');
        }
        abort(403);
    }

    public function find(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string',
        ]);
        $coupon = Coupon::query()->where('name', '=', $validated['name'])->get()->first();
        //dd($coupon);
        if($coupon != null && $coupon->amount > 0){
            session()->put('coupon_id', $coupon->id);
        }
        else{
            session()->put('coupon_id', 0);
        }
        return to_route('cart');
    }
}
