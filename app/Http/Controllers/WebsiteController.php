<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteController extends Controller
{

    protected $directorio = "public/website";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        $info = Website::find(1);
        $info -> json_informacion = json_decode($info -> informacion);

        return view('panel.website.edit',  [
            'title' => 'Website',
            'breadcrumb' => [
                [
                    'title' => 'Website',
                    'route' => 'panel.website.edit',
                    'active' => true
                ]
            ],
            'web' => $info
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $portada = '';
        $info = Website::find(1);
        $info -> json_informacion = json_decode($info -> informacion);

        if($request -> hasFile('portada')) {
            if(File::exists($info -> json_informacion -> portada)) {
                File::delete($info -> json_informacion -> portada);
            }
            $portada = Helpers::addFileStorage($request -> file('portada'), $this -> directorio);
        }
        
        $data = array(
            "titulo"   => $request -> titulo,
            "portada"  => $portada,
            "telefono" => $request -> telefono,
            "email"    => $request -> correo
        );

        $web = Website::find(1);
        $web -> informacion = json_encode($data);
        $web -> save();

        return redirect() -> back() -> with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }
}
