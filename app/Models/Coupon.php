<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by_id',
        'name',
        'discount',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
