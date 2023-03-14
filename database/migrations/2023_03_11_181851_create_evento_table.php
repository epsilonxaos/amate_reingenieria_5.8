<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categorias_id');
            $table->string('cover') -> nullable();
            $table->string('title');
            $table->string('title_en');
            $table->text('short_description') -> nullable();
            $table->text('short_description_en') -> nullable();
            $table->longText('content') -> nullable();
            $table->longText('content_en') -> nullable();
            $table->string('img_lateral_1') -> nullable();
            $table->string('img_lateral_2') -> nullable();
            $table->string('img_lateral_3') -> nullable();
            $table->boolean('horario_fijo') -> default(false);
            $table->time('horario') -> nullable();
            $table->enum('tiempo_espera', [24, 48]) -> default(48);
            $table->tinyInteger('status') -> default(0);
            $table->timestamps();
            
            $table->foreign('categorias_id')->references('id')->on('categorias');
        });

        Schema::create('evento_precios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->integer('personas');
            $table->decimal('precio','10',2);

            $table->timestamps();
            $table->foreign('evento_id') -> references('id') -> on('evento') -> onDelete('cascade');
        });

        Schema::create('evento_galeria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->string('img');
            $table->string('url') -> nullable();
            $table->integer('order') -> default(0);

            $table->foreign('evento_id') -> references('id') -> on('evento') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_precios');
        Schema::dropIfExists('evento_galeria');
        Schema::dropIfExists('evento');
    }
}
