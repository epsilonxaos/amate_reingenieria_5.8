<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\Helpers;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.cupon.index', [
            'title' => 'Cupones',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.cupon.index',
                    'active' => true
                ]
            ],
            'lista' => Cupon::orderBy('id', 'desc') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.cupon.create', [
            'title' => 'Cupones',
            'breadcrumb' => [
                [
                    'title' => 'Listado de cupones',
                    'route' => 'panel.cupon.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo cupon',
                    'route' => 'panel.cupon.create',
                    'active' => true
                ]
            ]
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
        $add = new Cupon();

        $add -> title = $request -> title;
        $add -> tipo = $request -> tipo;
        $add -> descuento = $request -> descuento;
        $add -> fecha_inicio = $request -> fecha_inicio;
        $add -> fecha_finalizacion = $request -> fecha_finalizacion;
        $add -> limite_usos = $request -> limite_usos;
        $add -> usos = 0;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        return view('panel.cupon.edit', [
            'title' => 'Cupones',
            'breadcrumb' => [
                [
                    'title' => 'Listado de cupones',
                    'route' => 'panel.cupon.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar cupon',
                    'route' => 'panel.cupon.edit',
                    'params' => [
                        "id" => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => Cupon::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, Request $request)
    {
        $upd = Cupon::find($id);

        $upd -> title = $request -> title;
        $upd -> tipo = $request -> tipo;
        $upd -> descuento = $request -> descuento;
        $upd -> fecha_inicio = $request -> fecha_inicio;
        $upd -> fecha_finalizacion = $request -> fecha_finalizacion;
        $upd -> limite_usos = $request -> limite_usos;
        $upd -> save();

        return redirect() -> back() -> with('success', 'Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Cupon::find($id) -> delete();

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
        Helpers::changeStatus('cupon', $request -> id, $request -> status);
        return 'true';
    }
}
