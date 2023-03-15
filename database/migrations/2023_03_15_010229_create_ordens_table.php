<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('cupon_id');
            $table->string('folio');
            $table->string('nombre_completo');
            // $table->string('nombre');
            // $table->string('apllido_p') -> nullable();
            // $table->string('apllido_m') -> nullable();
            $table->string('correo') -> nullable();
            $table->string('telefono') -> nullable();
            $table->integer('personas');
            $table->decimal('precio','10',2) -> nullable();
            $table->decimal('descuento','10',2) -> nullable();
            $table->enum('pago_metodo', ['free', 'paypal', 'oxxo', 'tarjeta', 'efectivo']);
            $table->enum('pago_realizado', ['website', 'agencia']) -> default('agencia');
            $table->string('pago_referencia') -> nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('orden');
    }
}
