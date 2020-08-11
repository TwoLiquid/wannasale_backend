<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscription_id')->index();
            $table->string('ext_id')->nullable()->index();
            $table->unsignedInteger('amount')->nullable();
            $table->string('currency', 5)->nullable();
            $table->string('card_type', 50)->nullable();
            $table->string('card_last_digits', 4)->nullable();
            $table->unsignedTinyInteger('card_exp_month')->nullable();
            $table->unsignedSmallInteger('card_exp_year')->nullable();
            $table->string('card_token')->nullable();
            $table->smallInteger('status_code')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();

            $table->foreign('subscription_id')
                ->references('id')->on('subscriptions')
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
        Schema::dropIfExists('transactions');
    }
}
