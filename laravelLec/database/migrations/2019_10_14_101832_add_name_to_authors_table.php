<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'authors', 
            function (Blueprint $table) {
                $table->string('name')->nullable(); // null 처리를 하면 안되도록 설정
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'authors', 
            function (Blueprint $table) {
                $table->dropColumn('name');
        });
    }
}
