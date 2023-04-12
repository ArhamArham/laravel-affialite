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
        Schema::table('tbl_stores', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('tbl_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_stores', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_id');
        });
    }
};
