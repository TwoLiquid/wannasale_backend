<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vendor_id')->nullable();
            $table->uuid('site_id')->nullable();
            $table->uuid('widget_id')->nullable();
            $table->uuid('item_id')->nullable();
            $table->uuid('client_id')->nullable();
            $table->string('name')->nullable();
            $table->string('item_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('url')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->text('cookies')->nullable();
            $table->text('user_agent')->nullable();
            $table->tinyInteger('status')->default(0)->index();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('offered_price')->unsigned()->nullable();
            $table->integer('total_price')->unsigned()->nullable();
            $table->char('currency', 3)->nullable();

            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('set null');

            $table->foreign('site_id')
                ->references('id')->on('sites')
                ->onDelete('set null');

            $table->foreign('widget_id')
                ->references('id')->on('widgets')
                ->onDelete('set null');

            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('set null');

            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
