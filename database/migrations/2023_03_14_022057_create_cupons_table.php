<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title') -> nullable();
            $table->enum('tipo', ['porcentual', 'monto']) -> default('monto');
            $table->decimal('descuento','10',2) -> nullable();
            $table->date('fecha_inicio') -> nullable();
            $table->date('fecha_finalizacion') -> nullable();
            $table->integer('limite_usos') -> nullable() -> default(0);
            $table->integer('usos') -> nullable() -> default(0);
            $table->tinyInteger('status') -> default(1);
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
        Schema::dropIfExists('cupon');
    }
}
