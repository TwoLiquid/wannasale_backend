<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('widget_id')->nullable()->index();
            $table->uuid('request_id')->nullable()->index();
            $table->string('session_key')->nullable();
            $table->boolean('opened')->nullable()->default(false);
            $table->timestamps();

            $table->foreign('request_id')
                ->references('id')->on('requests')
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
        Schema::dropIfExists('widget_events');
    }
}
