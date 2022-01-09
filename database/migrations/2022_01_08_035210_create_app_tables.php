<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//マイグレーション実行時に呼ばれる
    {
        Schema::create('primary_categories', function (Blueprint $table) {
            $table->id();

            // ここにカラムを追加していく

            $table->timestamps();
        });

        Schema::create('secondary_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_category_id');
            //primary_categoriesテーブルとsecondary_categoriesテーブルの間の１対多のリレーション

            // ここにカラムを追加していく

            $table->timestamps();

            $table->foreign('primary_category_id')->references('id')->on('primary_categories');
            //primary_categoriesテーブルとsecondary_categoriesテーブルの間の１対多のリレーション
        });

        Schema::create('item_conditions', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('sort_no');

            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('secondary_category_id');
            $table->unsignedBigInteger('item_condition_id');

            // ここにカラムを追加していく

            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('secondary_category_id')->references('id')->on('secondary_categories');
            $table->foreign('item_condition_id')->references('id')->on('item_conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()//ロールバック時に呼ばれる
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_conditions');
        Schema::dropIfExists('secondary_categories');
        Schema::dropIfExists('primary_categories');//primary_categoriesテーブルが存在している場合、削除
    }
}
