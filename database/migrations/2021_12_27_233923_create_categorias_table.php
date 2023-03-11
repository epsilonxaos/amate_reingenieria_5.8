<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover') -> nullable();
            $table->string('cover_en') -> nullable();
            $table->string('title') -> nullable();
            $table->string('title_en') -> nullable();
            $table->text('description') -> nullable();
            $table->text('description_en') -> nullable();
            $table->string('seccion') -> default('blog');
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
        Schema::dropIfExists('categorias');
    }
}
