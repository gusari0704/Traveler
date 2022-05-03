<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* 新しくユーザーの住所などの情報を保存するカラム */
        Schema::table('users', function (Blueprint $table) {
             $table->string('postal_code')->default(''); //郵便番号
             $table->text('address')->default(''); //住所
             $table->string('phone')->default(''); //電話番号
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
