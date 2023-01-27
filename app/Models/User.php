<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthAuthenticatable;
    protected $fillable = [
        'email',
        'image',
        'name',
        'password',
        'phone',
        'address',
        'provide_id',
        'role',
        'remember_token',
        'access_token'
    ];
    public function printRole()
    {
        return array_search($this->role, UserRole::asArray());
    }
}
