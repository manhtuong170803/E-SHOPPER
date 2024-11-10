<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmts', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('cmt');
            $table -> string('id_blog');
            $table -> string('id_user');
            $table -> string('avatar');
            $table -> string('name');
            $table -> string('level');
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
        Schema::dropIfExists('cmts');
    }
};
