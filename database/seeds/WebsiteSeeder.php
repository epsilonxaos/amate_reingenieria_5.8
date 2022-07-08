<?php

use App\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            "titulo"   => "¡Contáctanos, carga <br> y viaja con nosotros!",
            "portada"  => 'img/bg.jpg',
            "telefono" => '999 260 4788',
            "email"    => 'logistica@agrans.com'
        );

        Website::create([
            "informacion" => json_encode($data)
        ]);
    }
}
