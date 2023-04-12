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
        Schema::create('tbl_stores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('tbl_users');

            $table->string('name');
            $table->string('heading');
            $table->longText('short_description');
            $table->longText('long_description');
            $table->string('image');
            $table->string('image_alt')->nullable();
            $table->string('direct_url');
            $table->string('tracking_url');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->string('wikipedia_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('google_plus_link')->nullable();
            $table->string('android_app_link')->nullable();
            $table->string('ios_app_link')->nullable();
            $table->tinyInteger('top_store')->default(1);
            $table->tinyInteger('editor_choice')->default(1);
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
        Schema::dropIfExists('tbl_stores');
    }
};
