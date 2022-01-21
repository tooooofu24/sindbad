<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->bigInteger('user_id');
            $table->string('title')->default('');
            $table->longText('thumbnail_url')->nullable();
            $table->dateTime('start_date_time');
            $table->boolean('public_flag')->default(false);
            $table->boolean('is_editing')->default(false);
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
        Schema::dropIfExists('plans');
    }
}
