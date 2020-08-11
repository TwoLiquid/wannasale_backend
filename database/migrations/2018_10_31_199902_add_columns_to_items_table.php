<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('initial_price')->after('urls')->nullable();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->integer('min_acceptable_price')->after('initial_price')->nullable();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->integer('min_unacceptable_price')->after('min_acceptable_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('initial_price');
            $table->dropColumn('min_acceptable_price');
            $table->dropColumn('min_unacceptable_price');
        });
    }
}
