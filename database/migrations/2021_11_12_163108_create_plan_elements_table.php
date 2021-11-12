<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanElementsTable extends Migration
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
            $table->unsignedTinyInteger('type')->comment('0 => blank, 1 => spot, 2 => transportation');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('child_id')->nullable();
            $table->integer('duration_min');
            $table->text('memo')->nullable();
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
        Schema::dropIfExists('plan_elements');
    }
}
