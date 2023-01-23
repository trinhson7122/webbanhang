<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id'
    ];

    public function sumCart()
    {
        $sum = 0;
        $cd = CartDetail::query()->where('cart_id', '=', $this->id)->get();
        foreach($cd as $item)
        {
            $sum += $item->amount * $item->product->price;
        }
        return $sum;
    }
}
