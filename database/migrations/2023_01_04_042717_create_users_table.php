<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->string('image')->nullable()->default('images/default_user.png');
            $table->string('password')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('address')->nullable();
            $table->string('access_token')->nullable()->unique();
            $table->integer('provide_id')->nullable();
            $table->integer('role')->default(UserRole::Client);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
