<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'amount',
        'created_by_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
