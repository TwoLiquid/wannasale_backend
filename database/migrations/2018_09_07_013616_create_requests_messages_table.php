<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('request_id')->index();
            $table->boolean('author')->default(false);
            $table->string('title');
            $table->longText('text');
            $table->integer('offered_price')->nullable();
            $table->boolean('seen')->default(false);
            $table->timestamps();

            $table->foreign('request_id')
                ->references('id')->on('requests')
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
        Schema::dropIfExists('requests_messages');
    }
}
