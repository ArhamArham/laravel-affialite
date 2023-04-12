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
        Schema::create('tbl_coupons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('tbl_users');
            $table->foreignId('store_id')->constrained('tbl_stores');

            $table->string('offer_box');
            $table->longText('offer_details');
            $table->string('tracking_link');
            $table->date('expiry_date');

            $table->enum('type', [
                'deal', 'code'
            ]);

            $table->string('code')->nullable();
            $table->tinyInteger('featured_for_home')->default(1);
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('tbl_coupons');
    }
};
