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
            $table->text('converted_name');
            $table->longText('thumbnail_url')->nullable();
            $table->enum('pref', Consts::PREF_LIST);
            $table->tinyInteger('status')->default(0)->comment('-10: NGワード有, 0: 未認証, 10: 認証済み');
            $table->unsignedInteger('count')->default(0)->comment('プランで使われている数');
            $table->timestamps();
            // 名前と都道府県の複合ユニーク
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
