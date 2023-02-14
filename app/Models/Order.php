<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sum_price',
        'coupon_id',
        'note',
        'phone',
        'address',
    ];
    public function printStatus()
    {
        switch($this->status){
            case OrderStatus::Cancelled:
                return 'Đã hủy';
            case OrderStatus::Shipped:
                return 'Đã giao hàng';
            case OrderStatus::Shipping:
                return 'Đang giao hàng';
            case OrderStatus::Processing:
                return 'Đang xử lý';
        }
    }
    public function displayStatus()
    {
        switch($this->status){
            case OrderStatus::Cancelled:
                return 'text-danger';
            case OrderStatus::Shipped:
                return 'text-success';
            case OrderStatus::Shipping:
                return 'text-info';
            case OrderStatus::Processing:
                return 'text-warning';
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
