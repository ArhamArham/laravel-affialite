<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('network_id')->nullable()->constrained('tbl_networks');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('mobile_no')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->enum('user_type', ['admin', 'user']);
            $table->timestamps();
        });

        \App\Models\User::create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'username'   => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => '123456',
            'user_type'  => 'admin'
        ]);
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
