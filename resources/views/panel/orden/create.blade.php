@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.orden.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="pago_realizado" value="agencia">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Nueva venta</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Completar Venta</button>
                                    {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">

                                <div class="row">
                                    <div class="col-12 col-lg-7">
                                        <h3>Datos de la experiencias</h3>
                                        <div class="row mb-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="evento_id">Experiencia <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="evento_id" id="evento_id" required>
                                                        <option value="">Selecciona una opción</option>
                                                        @foreach ($eventos as $item)
                                                            <option value="{{$item -> id}}">{{$item -> title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="personas">Personas <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="personas" id="personas" required>
                                                        <option value="">Selecciona una opción</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="personas">Precio <span class="text-danger">*</span></label>
                                                    <input type="number" name="precio" id="precio" class="form-control pointer-events-none">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group d-none" id="personasCustom">
                                                    <label for="personas_custom">Numero de Personas <span class="text-danger">*</span></label>
                                                    <input type="number" name="personas_custom" id="personas_custom" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-12"></div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha <span class="text-danger">*</span></label>
                                                    <input type="number" name="fecha" id="fecha" class="form-control fechasPicker48">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="horario" class="form-control-label">Horario</label>
                                                    <input class="form-control pointer-events-none" type="time" name="horario" value="07:00:00" id="horario">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h3>Datos del comprador</h3>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-1">
                                                <div class="form-group">
                                                    <label for="nombre_completo">Nombre completo <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nombre_completo" value="{{old('nombre_completo')}}" required>
                                                    @if($errors -> has('nombre_completo'))
                                                        <small class="text-danger pt-1">{{ $errors -> first('nombre_completo') }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <div class="form-group">
                                                    <label for="correo">Correo electronico <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="correo" value="{{old('correo')}}" required>
                                                    @if($errors -> has('correo'))
                                                        <small class="text-danger pt-1">{{ $errors -> first('correo') }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <div class="form-group">
                                                    <label for="telefono">Telefono <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="telefono" value="{{old('telefono')}}" required>
                                                    @if($errors -> has('telefono'))
                                                        <small class="text-danger pt-1">{{ $errors -> first('telefono') }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <h3>Pago</h3>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-4">
                                                <div class="form-group">
                                                    <label for="cupon_id">Cupon</label>
                                                    <select class="form-control" name="cupon_id" id="cupon_id" required>
                                                        <option value="">Selecciona una opción</option>
                                                        @foreach ($cupones as $item)
                                                            <option value="{{$item -> id}}">{{$item -> title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-4">
                                                <div class="form-group">
                                                    <label for="pago_metodo">Metodo de pago</label>
                                                    <select class="form-control" name="pago_metodo" id="pago_metodo" required>
                                                        <option value="">Selecciona una opción</option>
                                                        <option value="paypal">Paypal</option>
                                                        <option value="tarjeta">Tarjeta</option>
                                                        <option value="efectivo">Efectivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <h3>Resumen de venta</h3>
                                        <table class="table table-borderless text-uppercase">
                                            <thead>
                                                <tr>
                                                    <th scope="col text-center" colspan="2" id="resumen_title">Nombre de la experiencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Personas</th>
                                                    <td id="resumen_personas">--</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Precio</th>
                                                    <td>$ <span id="resumen_precio">0.00</span> MXN</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha</th>
                                                    <th id="resumen_fecha">--</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Hora</th>
                                                    <th id="resumen_horario">--</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="row">Descuento</th>
                                                    <td id="resumen_descuento">$0.00 MXN</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total</th>
                                                    <td>$ <span id="resumen_total">0.00</span> MXN</td>
                                                </tr>
                                            </tfoot>
                                        </table>
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

@push('js')
    <script> const EVENTOS = @json($eventos); const CUPONES = @json($cupones) </script>
    <script src="{{mix('panel/js/orden.js')}}"></script>
@endpush

{{-- 
@push('js')
    <script type="text/javascript">
        $('.dropify').dropify();

        function limitText(limitField, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
            }
        }
    </script>
@endpush --}}
