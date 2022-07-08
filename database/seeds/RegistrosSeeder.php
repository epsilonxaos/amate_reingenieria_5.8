<?php

use Illuminate\Database\Seeder;

class RegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Registros', 5000) -> create() -> each(
            function($user) {
                factory('App\Registros')->create([
                    'nombre' => $user -> nombre,
                    'celular' => $user -> celular,
                    'correo' => $user -> correo,
                    'linea_fletera' => $user -> linea_fletera]);
            }
        );
    }
}
