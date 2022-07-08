<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AppController extends Controller
{
    public function index()
    {
        $info = Website::find(1);
        $info -> json_informacion = json_decode($info -> informacion);

        return view('pages.index', ["web" => $info]);
    }

    public function serviciosArtisan()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        Artisan::call('storage:link');
    }
}
