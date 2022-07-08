@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    {{-- {{dd($web -> json_informacion -> titulo )}} --}}

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.website.update')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Editar website </h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="portada">Fondo</label>
                                        <input type="file" name="portada" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($web -> json_informacion -> portada)}}" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="telefono">Telefono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="telefono" value="{{old('telefono') == '' ? $web -> json_informacion -> telefono : old('telefono')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="correo">Correo <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="correo" value="{{old('correo') == '' ? $web -> json_informacion -> email : old('correo')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="titulo">Texto informativo <span class="text-danger">*</span></label>
                                            <br>
                                            <small>Para realizar un <span class="text-default font-weight-bold">salto de linea</span> en el texto debera incluir textualmente <span class="font-weight-bold"><code>&lt;br&gt;</code></span> <br>
                                            </small>
                                            <input type="text" class="form-control" name="titulo" value="{{old('titulo') == '' ? $web -> json_informacion -> titulo : old('titulo')}}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection
