@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.cupon.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Agregar nuevo cupon</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="title">Cupon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Nombre del cupon para usar, ejemplo: AMATE20OFF" name="title" value="{{old('title')}}" required>
                                            @if($errors -> has('title'))
                                                <small class="text-danger pt-1">{{ $errors -> first('title') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="tipo">Tipo de descuento <span class="text-danger">*</span></label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option value="monto" selected>Monto</option>
                                                <option value="porcentual">Porcentual</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="descuento">Descuento <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Cantidad a descontar" name="descuento" value="{{old('descuento')}}" required>
                                            @if($errors -> has('descuento'))
                                                <small class="text-danger pt-1">{{ $errors -> first('descuento') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="fecha_inicio">Fecha de Inicio <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control fechasPicker" name="fecha_inicio" value="{{old('fecha_inicio')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="fecha_finalizacion">Fecha de finalizacion <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control fechasPicker" name="fecha_finalizacion" value="{{old('fecha_finalizacion')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="limite_usos">Limite de usos</label>
                                            <input type="number" class="form-control" name="limite_usos" value="{{old('limite_usos')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection