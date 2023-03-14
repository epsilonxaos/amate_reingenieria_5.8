<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Evento;
use App\EventoGaleria;
use App\EventoPrecio;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    private $directorio = 'public/eventos';
    private $directorioGalerias = 'public/eventos/galeria';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.evento.index', [
            'title' => 'Evento',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.evento.index',
                    'active' => true
                ]
            ],
            'lista' => Evento::orderBy('id', 'desc') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.evento.create', [
            'title' => 'Experiencias',
            'breadcrumb' => [
                [
                    'title' => 'Listado experiencias',
                    'route' => 'panel.evento.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo',
                    'route' => 'panel.evento.create',
                    'active' => true
                ]
            ],
            'categorias' => Categorias::where([['seccion', '=', 'experiencias'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Evento();
        $cover = null;
        $imagen_lateral_1 = null;
        $imagen_lateral_2 = null;
        $imagen_lateral_3 = null;

        if($request -> hasFile('cover')){
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
        }
        if($request -> hasFile('imagen_lateral_1')){
            $imagen_lateral_1 = Helpers::addFileStorage($request -> file('imagen_lateral_1'), $this -> directorio);
        }
        if($request -> hasFile('imagen_lateral_2')){
            $imagen_lateral_2 = Helpers::addFileStorage($request -> file('imagen_lateral_2'), $this -> directorio);
        }
        if($request -> hasFile('imagen_lateral_3')){
            $imagen_lateral_3 = Helpers::addFileStorage($request -> file('imagen_lateral_3'), $this -> directorio);
        }
        
        $add -> cover = $cover;
        $add -> categorias_id = $request -> categorias_id;
        $add -> title = $request -> title;
        $add -> title_en = $request -> title_en;
        $add -> short_description = $request -> short_description;
        $add -> short_description_en = $request -> short_description_en;
        $add -> content = $request -> content;
        $add -> content_en = $request -> content_en;
        $add -> horario_fijo = $request -> horario_fijo == 'true' ? true : false;
        $add -> horario = $request -> horario;
        $add -> tiempo_espera = $request -> tiempo_espera;
        $add -> img_lateral_1 = $imagen_lateral_1;
        $add -> img_lateral_2 = $imagen_lateral_2;
        $add -> img_lateral_3 = $imagen_lateral_3;
        $add -> status = 0;

        $add -> save();

        // Agregar Precios
        if($request -> has('new_personas')) {
            $listaPrecios = $request -> new_precio;
            $listaPersonas = $request -> new_personas;
            foreach ($listaPrecios as $key => $precio) {
                $add_precio = new EventoPrecio();

                $add_precio -> evento_id = $add -> id;
                $add_precio -> personas = $listaPersonas[$key];
                $add_precio -> precio = $precio;
                $add_precio -> save();
            }
        }

        return redirect() -> route('panel.evento.galeria.acciones', ['accion' => 'create', 'id' => $add -> id]) -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGaleria(String $accion, Int $id)
    {
        if($accion === 'edit')
        {
            $nameProduct = Evento::select('title') -> where('id', $id) -> first();
        }

        $info = [
            'title' => 'Galeria',
            'breadcrumb' => [
                [
                    'title' => 'Listado experiencias',
                    'route' => 'panel.evento.index',
                    'active' => false
                ],
                [
                    'title' => ($accion === 'edit') ? 'Editar evento - '.$nameProduct -> nombre : 'Nueva experiencia',
                    'route' => ($accion === 'edit') ? 'panel.evento.edit' : 'panel.evento.create',
                    'active' => false,
                    'params' => ($accion === 'edit') ? ['id' => $id] : ''
                ],
                [
                    'title' => 'Galeria',
                    'route' => 'panel.evento.galeria.acciones',
                    'active' => true,
                    'params' => [
                        'accion' => $accion,
                        'id' => $id
                    ]
                ]
            ],
            'galeria' => EventoGaleria::where('evento_id', $id) -> orderBy('order', 'asc') -> get(),
            'id' => $id,
            'accion' => $accion
        ];
        return view('panel.evento.galeria.index', $info);
    }

    public function storeGaleria(Request $request) {
        $input = $request -> all();
        $rules = [
            'file' => 'mimes:jpeg,jpg,png|max:2048'
        ];

        $validation = Validator::make($input, $rules);

        if($validation -> fails())
        {
            return Response::json('Limite de peso excedido', 400);
        }

        $file = $request -> file('file');
        $cover = Helpers::addFileStorage($file, $this -> directorioGalerias);
        $add = new EventoGaleria();
        $add -> img = $cover;
        $add -> evento_id = $request -> id;
        $add -> save();
        $add -> order = $add -> id;
        $add -> save();

        return Response::json('success', 200);
    }

    /**
     * Reording files gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ordenamiento(Request $request)
    {
        $orden = $request -> toArray();
        foreach ($orden as $key => $val) {
            $gal = EventoGaleria::find($val['id']);
            $gal -> order = $val['orden'];
            $gal -> save();
        }

        return 'true';
    }

    /**
     * Delete image gallery
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyImageGallery(Request $request)
    {
        Helpers::deleteFileStorage('evento_galeria', 'img', $request -> id);
        EventoGaleria::where('id', $request -> id) -> delete();

        return 'true';
    }

    /**
     * Update url gallery
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUrlGallery(Request $request)
    {
        // Agregar Precios
        if($request -> has('id_img')) {
            $listId = $request -> id_img;
            $listUrl = $request -> url_video;
            foreach ($listId as $key => $id) {
                $upd = EventoGaleria::find($id);

                $upd -> url = $listUrl[$key];
                $upd -> save();
            }
        }

        return redirect() -> back() -> with('success', 'Galeria actualizada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        return view('panel.evento.edit', [
            'title' => 'Experiencias',
            'breadcrumb' => [
                [
                    'title' => 'Listado experiencias',
                    'route' => 'panel.evento.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar experiencias',
                    'route' => 'panel.evento.edit',
                    'params' => [
                        'id' => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => Evento::find($id),
            'categorias' => Categorias::where([['seccion', '=', 'experiencias'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get(),
            'precios' => EventoPrecio::where("evento_id", $id) -> orderBy('id', 'asc') -> get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, Request $request)
    {
        $upd = Evento::find($id);

        if($request -> hasFile('cover')) {
            Helpers::deleteFileStorage('evento', 'cover', $id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $upd -> cover = $cover;
            $upd -> save();
        }
        if($request -> hasFile('imagen_lateral_1')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_1', $id);
            $imagen_lateral_1 = Helpers::addFileStorage($request -> file('imagen_lateral_1'), $this -> directorio);
            $upd -> img_lateral_1 = $imagen_lateral_1;
            $upd -> save();
        }
        if($request -> hasFile('imagen_lateral_2')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_2', $id);
            $imagen_lateral_2 = Helpers::addFileStorage($request -> file('imagen_lateral_2'), $this -> directorio);
            $upd -> img_lateral_2 = $imagen_lateral_2;
            $upd -> save();
        }
        if($request -> hasFile('imagen_lateral_3')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_3', $id);
            $imagen_lateral_3 = Helpers::addFileStorage($request -> file('imagen_lateral_3'), $this -> directorio);
            $upd -> img_lateral_1 = $imagen_lateral_3;
            $upd -> save();
        }
        
        $upd -> categorias_id = $request -> categorias_id;
        $upd -> title = $request -> title;
        $upd -> title_en = $request -> title_en;
        $upd -> short_description = $request -> short_description;
        $upd -> short_description_en = $request -> short_description_en;
        $upd -> content = $request -> content;
        $upd -> content_en = $request -> content_en;
        $upd -> horario_fijo = $request -> horario_fijo == 'true' ? true : false;
        $upd -> horario = $request -> horario;
        $upd -> tiempo_espera = $request -> tiempo_espera;

        $upd -> save();

        // Editar precios actuales
        if($request -> has('personas')) {
            EventoPrecio::where('evento_id', $id) -> delete();
            $listaPrecios = $request -> precio;
            $listaPersonas = $request -> personas;
            foreach ($listaPrecios as $key => $precio) {
                $add_precio = new EventoPrecio();

                $add_precio -> evento_id = $id;
                $add_precio -> personas = $listaPersonas[$key];
                $add_precio -> precio = $precio;
                $add_precio -> save();
            }
        }
        // Agregar Precios
        if($request -> has('new_personas')) {
            $listaPrecios = $request -> new_precio;
            $listaPersonas = $request -> new_personas;
            foreach ($listaPrecios as $key => $precio) {
                $add_precio = new EventoPrecio();

                $add_precio -> evento_id = $id;
                $add_precio -> personas = $listaPersonas[$key];
                $add_precio -> precio = $precio;
                $add_precio -> save();
            }
        }

        return redirect() -> back() -> with('success', 'Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('evento', 'cover', $id);
        Helpers::deleteFileStorage('evento', 'img_lateral_1', $id);
        Helpers::deleteFileStorage('evento', 'img_lateral_2', $id);
        Helpers::deleteFileStorage('evento', 'img_lateral_3', $id);

        $galeria = EventoGaleria::where('evento_id', $id) -> get();
        foreach ($galeria as $val) {
            Helpers::deleteFileStorage('evento_galeria', 'img', $val -> id);
        }

        Evento::where('id', $id) -> delete();
        return redirect() -> back() -> with('success', 'Registro eliminado correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('evento', $request -> id, $request -> status);
        return 'true';
    }
}
