<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Provide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        //Product::factory(100)->create();
        Provide::create([
            'name' => 'facebook',
        ]);
        Provide::create([
            'name' => 'google',
        ]);
        Provide::create([
            'name' => 'github',
        ]);
        $user = User::create([
            'name' => 'trinh xuan son',
            'email' => 'son07012002@gmail.com',
            'password' => Hash::make('admin'),
            'role' => UserRole::SuperAdmin,
        ]);
        Coupon::create([
            'created_by_id' => $user->id,
            'discount' => 10,
            'amount' => 100,
            'name' => 'KMCUASON1',
        ]);
    }
}
