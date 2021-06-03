<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_details', function (Blueprint $table) {
            $table->increments('card_master_id');
            $table->string('card_name'); //カード名を保存するカラム
            $table->string('ruby'); //読み方を保存するカラム
            $table->string('card_class'); //カード分類を保存するカラム
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム
            $table->text('card_text');//カードテキストを保存するカラム
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
        Schema::dropIfExists('card_details');
    }
}
