<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_elements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['spot', 'transportation']);
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('spot_id')->nullable();
            $table->unsignedBigInteger('transportation_id')->nullable();
            $table->integer('duration_min');
            $table->string('memo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinations');
        Schema::dropIfExists('plan_elements');
    }
}
