<?php

use App\Consts\Consts;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('converted_name')->nullable();
            $table->longText('thumbnail_url')->nullable();
            $table->enum('pref', Consts::PREF_LIST);
            $table->timestamps();
            $table->unique(['name', 'pref'], 'spots_name_pref_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spots');
    }
}
