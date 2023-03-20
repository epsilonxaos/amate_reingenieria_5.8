<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\Evento;
use App\EventoPrecio;
use App\Orden;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now() -> format('Y-m-d');

        return view('panel.orden.index', [
            'title' => 'Ventas experiencias',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.orden.index',
                    'active' => true
                ]
            ],
            'lista' => Orden::orderBy('id', 'desc') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now() -> format('Y-m-d');

        return view('panel.orden.create', [
            'title' => 'Ventas experiencias',
            'breadcrumb' => [
                [
                    'title' => 'Listado de ventas',
                    'route' => 'panel.orden.index',
                    'active' => false
                ],
                [
                    'title' => 'Nueva venta',
                    'route' => 'panel.orden.create',
                    'active' => true
                ]
            ],
            'eventos' => Evento::where('status', 1) -> orderBy('title', 'asc') -> get(),
            'cupones' => Cupon::where('status', 1) -> whereDate('fecha_finalizacion', '>=', $now) -> orderBy('title', 'asc') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListPrecios(Int $id)
    {
        $precios = EventoPrecio::where('evento_id', $id) -> get();
        return response($precios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Orden();

        $add -> evento_id = $request -> evento_id;
        $add -> cupon_id = $request -> cupon_id;
        $add -> nombre_completo = $request -> nombre_completo;
        $add -> correo = $request -> correo;
        $add -> telefono = $request -> telefono;
        $add -> personas = $request -> personas;
        $add -> precio = $request -> precio;
        $add -> descuento = $request -> descuento;
        $add -> pago_metodo = $request -> pago_metodo;
        $add -> pago_realizado = $request -> pago_realizado;
        $add -> pago_referencia = $request -> pago_referencia;
        $add -> status = $request -> status;
        $add -> save();
        
        $add -> folio = $request -> folio;
        $add -> save();
        return redirect() -> back() -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        $orden = Orden::find($id);
        return view('panel.orden.show', [
            'title' => 'Ventas experiencias',
            'breadcrumb' => [
                [
                    'title' => 'Listado de ventas',
                    'route' => 'panel.orden.index',
                    'active' => false
                ],
                [
                    'title' => 'Venta '.$orden -> folio,
                    'route' => 'panel.orden.show',
                    'params' => [
                        "id" => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => $orden
        ]);
    }
}
