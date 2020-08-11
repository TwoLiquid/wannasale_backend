<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vendor_id');
            $table->uuid('rate_id');
            $table->uuid('card_id')->nullable();

            $table->integer('price')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('active')->nullable();

            $table->boolean('trial')->default(true);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finish_at')->nullable();
            $table->timestamp('next_transaction_at')->nullable();

            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('cascade');

            $table->foreign('rate_id')
                ->references('id')->on('rates')
                ->onDelete('cascade');

            $table->foreign('card_id')
                ->references('id')->on('cards')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
