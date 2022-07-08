@extends('layouts.app')

@section('content')
    <section
        style="min-height: 100vh; background-image: linear-gradient(270deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.2) 100%),url({{ asset('img/bg.jpg') }})">
        <div class="container pt-md-4 pb-md-4 pr-md-4 pl-md-4 h-100 pt-4 pb-4" style="min-height: 100vh;">

            <div class="row justify-content-center align-items-center" style=" height: 100%; min-height: 90vh">

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-left mb-3 mb-sm-5">
                            <img src="{{ asset('img/logo-agrans.png') }}" alt="Logo" class="logo">
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-right info mb-5 mb-sm-5">
                            <p class="mb-0 color-text"><span class="font-weight-bold">Contáctanos:</span> 999 260 4788</p>
                            <p class="mb-0 color-text">logistica@agrans.com</p>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="row align-items-end">
                        <div class="col-12 col-lg-6">
                            <h2 class="text-center text-lg-left tlo mb-4">¡Contáctanos, carga y viaja con nosotros!</h2>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card ">
                                <div class="card-header">
                                    <h3 class="mb-0">¡Regístrate!</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('app.save.reg') }}" method="POST" class="needs-validation" novalidate>
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group row mb-2">
                                            <label for="nombre" class="col-lg-4 col-form-label">Nombre *</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="celular" class="col-lg-4 col-form-label">Celular *</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="celular" name="celular" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="correo" class="col-lg-4 col-form-label">Correo *</label>
                                            <div class="col-lg-8">
                                                <input type="email" class="form-control" id="correo" name="correo" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="linea" class="col-lg-4 col-form-label">Línea fletera *</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="linea" name="linea" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="correo" class="col-sm-8 col-form-label">¿Cuentas con GPS
                                                vigente?</label>
                                            <div class="col-sm-4 justify-content-center d-flex align-items-end">
                                                <input class="checkbox-tools" type="radio" name="gps" id="gps-1"
                                                    checked="">
                                                <label class="for-checkbox-tools" for="gps-1">
                                                    Si
                                                </label>

                                                <input class="checkbox-tools" type="radio" name="gps" id="gps-2">
                                                <label class="for-checkbox-tools" for="gps-2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="correo" class="col-sm-8 col-form-label">¿Facturas?</label>
                                            <div class="col-sm-4 justify-content-center d-flex align-items-end">
                                                <input class="checkbox-tools" type="radio" name="factura" id="factura-1"
                                                    checked="">
                                                <label class="for-checkbox-tools" for="factura-1">
                                                    Si
                                                </label>

                                                <input class="checkbox-tools" type="radio" name="factura" id="factura-2">
                                                <label class="for-checkbox-tools" for="factura-2">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit"
                                                class="btn btn-white font-weight-bold pl-md-4 pr-md-4">Enviar
                                                información</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('js')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Completado',
                text: '¡El registro se realizo con éxito!',
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Algo fallo, intenta más tarde',
            });
        </script>
    @endif
@endpush
