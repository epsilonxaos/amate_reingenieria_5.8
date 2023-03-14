@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.evento.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Agregar nueva experiencia</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="informacion-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Experiencia</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="precios-tab" data-toggle="tab" href="#precios" role="tab" aria-controls="precios" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Lista de precios</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            {{-- Informacion del eventos --}}
                                            <div class="tab-pane fade show active" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
                                                <div class="row">
                                                    <div class="col-12 mb-4">
                                                        <label for="cover">Cover <span class="text-danger">*</span></label>
                                                        <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" required />
                                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                                    </div>
                
                                                    <div class="col-12 col-sm-6 col-md-2 mb-4">
                                                        <p class="mb-2">Hora fija</p>
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" checked value="true"  id="horario_fijo" name="horario_fijo" onchange="toggle()">
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                                                        </label>
                                                    </div>
                
                                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                                        <label for="example-time-input" class="form-control-label">Horario experiencia</label>
                                                        <input class="form-control" type="time" name="horario" value="07:00:00" id="example-time-input">
                                                    </div>
                
                                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                                        <p class="mb-2">Tiempo de espera para reservación</p>
                                                        <div class="d-flex items-align-start justify-content-start">
                                                            <article class="card-radio" style="height: 80px; justify-content: flex-end; padding-bottom: 15px;">
                                                                <input type="radio" name="tiempo_espera" value="24" {{old('tiempo_espera') == '24' ? 'checked="checked"' : ''}} />
                                                                <span class="checkmark"></span>
                                                                <span class="label"> 24 hrs</span>
                                                                <section class="decoration-card" style="height: 80px;"></section>
                                                            </article>
                                                            <article class="card-radio" style="height: 80px; justify-content: flex-end; padding-bottom: 15px;">
                                                                <input type="radio" name="tiempo_espera" value="48" {{old('tiempo_espera') == '48' ? 'checked="checked"' : ''}} />
                                                                <span class="checkmark"></span>
                                                                <span class="label"> 48 hrs</span>
                                                                <section class="decoration-card" style="height: 80px;"></section>
                                                            </article>
                                                        </div>
                                                    </div>
                
                                                    {{-- Categoria --}}
                                                    <div class="col-12 mb-4">
                                                        <h3>Categoria</h3>
                                                        <div class="card card-body shadow">
                                                            <div class="d-flex items-align-start justify-content-start">
                                                                @foreach ($categorias as $item)
                                                                    <article class="card-radio">
                                                                        <input type="radio" name="categorias_id" value="{{$item -> id}}" {{old('categorias_id') == $item -> id ? 'checked="checked"' : ''}} />
                                                                        <span class="checkmark"></span>
                                                                        <span class="price">
                                                                            <img src="{{asset($item -> cover)}}" alt="{{$item -> title}}" style="width: 100px; height: 100px; object-fit: contain;">
                                                                        </span>
                                                                        {{-- <span class="label"> {{$item -> title}}</span> --}}
                                                                        <section class="decoration-card"></section>
                                                                    </article>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    {{-- Textos Idiomas --}}
                                                    <div class="col-12">
                                                        <h3>Información</h3>
                                                        <div class="nav-wrapper">
                                                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="es-tab" data-toggle="tab" href="#es" role="tab" aria-controls="es" aria-selected="true"><i class="ni ni-caps-small mr-2"></i>Español</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link mb-sm-3 mb-md-0" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false"><i class="ni ni-caps-small mr-2"></i>Ingles</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card shadow">
                                                            <div class="card-body">
                                                                <div class="tab-content" id="myTabContent">
                                                                    {{-- Español --}}
                                                                    <div class="tab-pane fade show active" id="es" role="tabpanel" aria-labelledby="es-tab">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-4">
                                                                                <div class="form-group">
                                                                                    <label for="title">Titulo <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
                                                                                    @if($errors -> has('title'))
                                                                                        <small class="text-danger pt-1">{{ $errors -> first('title') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 mb-4">
                                                                                <div class="form-group">
                                                                                    <label for="short_description">Descripción corta</label>
                                                                                    <small class="pb-2 d-block">Breve descripción o introducción sobre la experiencia</small>
                                                                                    <textarea class="form-control" name="short_description" rows="6" style="resize: none" onKeyDown="limitText(this.form.short_description, 150, '.limitText_short_description');" onKeyUp="limitText(this.form.short_description, 150, '.limitText_short_description');" maxlength="150"></textarea>
                                                                                    <small>Caracteres disponibles: <span class="limitText_short_description text-primary font-weight-bold">150</span></small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 mb-4">
                                                                                <label for="">Contenido</label>
                                                                                <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                                                                <textarea name="content" class="trumbowyg-panel" cols="30" rows="10"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Ingles --}}
                                                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-4">
                                                                                <div class="form-group">
                                                                                    <label for="title_en">Titulo <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control" name="title_en" value="{{old('title_en')}}" required>
                                                                                    @if($errors -> has('title_en'))
                                                                                        <small class="text-danger pt-1">{{ $errors -> first('title_en') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 mb-4">
                                                                                <div class="form-group">
                                                                                    <label for="short_description_en">Descripción corta</label>
                                                                                    <small class="pb-2 d-block">Breve descripción o introducción sobre la experiencia</small>
                                                                                    <textarea class="form-control" name="short_description_en" rows="6" style="resize: none" onKeyDown="limitText(this.form.short_description_en, 150, '.limitText_short_description_en');" onKeyUp="limitText(this.form.short_description_en, 150, '.limitText_short_description_en');" maxlength="150"></textarea>
                                                                                    <small>Caracteres disponibles: <span class="limitText_short_description_en text-primary font-weight-bold">150</span></small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 mb-4">
                                                                                <label for="">Contenido</label>
                                                                                <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                                                                <textarea name="content_en" class="trumbowyg-panel" cols="30" rows="10"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    {{-- Imaganes laterales --}}
                                                    <div class="col-12">
                                                        <h3>Imagenes Laterales</h3>
                                                        <div class="card card-body shadow">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4 mb-4">
                                                                    <label for="img_lateral_1">Imagen lateral #1 <span class="text-danger">*</span></label>
                                                                    <input type="file" name="img_lateral_1" class="dropify" data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" />
                                                                    <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                                                </div>
                                                                <div class="col-12 col-md-4 mb-4">
                                                                    <label for="img_lateral_2">Imagen lateral #2 <span class="text-danger">*</span></label>
                                                                    <input type="file" name="img_lateral_2" class="dropify" data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" />
                                                                    <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                                                </div>
                                                                <div class="col-12 col-md-4 mb-4">
                                                                    <label for="img_lateral_3">Imagen lateral #3 <span class="text-danger">*</span></label>
                                                                    <input type="file" name="img_lateral_3" class="dropify" data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" />
                                                                    <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            {{-- Lista de precios --}}
                                            <div class="tab-pane fade" id="precios" role="tabpanel" aria-labelledby="precios-tab">
                                                <button type="button" class="btn btn-primary mb-4" onclick="addPrecio()">Agregar precio</button>
                                                
                                                <div id="listadoPrecios">
                                                    {{-- <div class="row card-precio">
                                                        <div class="col-12 col-sm-1">
                                                            <button class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                        <div class="form-group col-12 col-sm-5">
                                                            <label for="new_personas[]" class="form-control-label"># Personas</label>
                                                            <input class="form-control" type="number" value="1" min="1" id="new_personas[]">
                                                        </div>
                                                        <div class="form-group col-12 col-sm-6">
                                                            <label for="new_precio[]" class="form-control-label">Precio</label>
                                                            <input class="form-control" type="text" placeholder="Ejemplo: 12000.00" id="new_precio[]">
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>    <link rel="stylesheet" href="/path/to/select2.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css" integrity="sha512-Ujn3LMQ8mHWqy7EPP32eqGKBhBU8v39JRIfCer4nTZqlsSZIwy5g3Wz9SaZrd6pp3vmjI34yyzguZ2KQ66CLSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js" integrity="sha512-sM9DpZQXHGs+rFjJYXE1OcuCviEgaXoQIvgsH7nejZB64A09lKeTU4nrs/K6YxFs6f+9FF2awNeJTkaLuplBhg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <script type="text/javascript">
        function addPrecio() {
            let idx = document.querySelectorAll("#listadoPrecios .row").length || 0 ;
            
            let row = document.createElement('div');
            row.classList.add('row', `new_personas_${idx}`);
            row.innerHTML = `
            <div class="col-12 col-sm-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removePrecio('.new_personas_${idx}')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="form-group col-12 col-sm-5">
                    <label for="new_personas_${idx}" class="form-control-label"># Personas</label>
                    <input class="form-control" type="number" value="1" min="1" name="new_personas[]" id="new_personas_${idx}" required>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="new_precio_${idx}" class="form-control-label">Precio</label>
                    <input class="form-control" type="text" placeholder="Ejemplo: 12000.00" name="new_precio[]" id="new_precio_${idx}" required>
                </div>`;
                console.log(row);
            document.getElementById("listadoPrecios").appendChild(row);
        }

        function removePrecio(indice){
            document.querySelector(indice).remove();
        }

        function toggle() {
            let val = document.getElementById("horario_fijo")

            if(val.checked) {
                val.value = true
            } else {
                val.value = false
            }
        }
    </script>
@endpush
