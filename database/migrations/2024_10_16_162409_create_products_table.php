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
        Schema::create('products', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('id_user');
            $table -> string('name');
            $table -> string('price');
            $table -> string('id_category');
            $table -> string('id_brand');
            $table->tinyInteger('status')->default(0);
            $table -> string('sale')->nullable();
            $table -> string('company');
            $table ->text('image');
            $table -> text('detail');
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
        Schema::dropIfExists('products');
    }
};
