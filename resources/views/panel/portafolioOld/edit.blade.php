@extends('layouts.panel.app')

@push('link')
    <style>
        img.img-resp {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.portafolio.update', ["id" => $portafolio -> id])}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <input type="hidden" name="id_categoria" value="1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Actuliazar portafolio - <span class="text-primary">{{$portafolio -> titulo}}</span></h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <label for="portada">Portada</label>
                                        <input type="file" name="portada" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($portafolio -> portada)}}" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                        @if($errors -> has('portada'))
                                            <br>
                                            <small class="text-danger pt-1">{{ $errors -> first('portada') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <label for="cover">Cover</label>
                                        <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($portafolio -> cover)}}" />
                                        <small>Las medidas recomendadas son 1500 x 750 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                        @if($errors -> has('cover'))
                                            <br>
                                            <small class="text-danger pt-1">{{ $errors -> first('cover') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="titulo" value="{{$portafolio -> titulo}}">
                                            @if($errors -> has('titulo'))
                                                <small class="text-danger pt-1">{{ $errors -> first('titulo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria <span class="text-danger">*</span></label>
                                            <select class="form-control" name="categoria_id">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($categorias as $item)
                                                    <option {{$portafolio -> categoria_id == $item -> id ? 'selected' : ''}} value="{{$item -> id}}">{{$item -> title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors -> has('categoria_id'))
                                                <small class="text-danger pt-1">{{ $errors -> first('categoria_id') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="descripcion_corta">Descripción corta</label>
                                            <textarea class="form-control" name="descripcion_corta" rows="6" style="resize: none" onKeyDown="limitText(this.form.descripcion_corta, 150);" onKeyUp="limitText(this.form.descripcion_corta, 150);" maxlength="150"></textarea>
                                            <small>Caracteres disponibles: <span class="limitText text-primary font-weight-bold">150</span></small>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Descripción</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="descripcion" class="trumbowyg-panel" cols="30" rows="10">{{$portafolio -> descripcion != '' ? $portafolio -> descripcion : old('descripcion')}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="portada">Galeria</label>
                                        <input type="file" name="galeria[]" class="dropify" data-height="300" data-max-file-size="6M"  data-allowed-file-extensions="jpg jpeg png" multiple />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                </div>
                                @if (count($galeria) > 0)
                                    <div class="row" id="sortable-items" data-url="{{route('panel.portafolio.ordenamiento')}}">
                                        <div class="col-12">
                                            <p class="mb-0">*<b class="text-primary">Subir nuevas imagenes</b> a la galeria requieren de presionar el boton de <b class="text-primary">guardar.</b></p>
                                            <p class="mb-0">*Las imaganes de la galeria pueden ser <b class="text-primary">reordenadas</b> y guardadas en el orden indicado <b class="text-primary">sin necesidad</b> de presionar el boton guardar.</p>
                                            <p>*<b class="text-primary">Eliminar</b> imagenes de la galeria <b class="text-primary">no requieren</b> presionar el boton guardar.</p>
                                        </div>
                                        @foreach ($galeria as $num => $item)
                                            <div class="col-12 col-md-4 col-lg-3 mb-4 position-relative sort" data-orden="{{$item -> orden}}" data-idx="{{$item -> id}}">
                                                <div class="options-flotting d-flex align-items-center justify-content-end pr-3">
                                                    <div class="item drag" title="Mover"><i class="fas fa-arrows-alt fa-lg text-default"></i></div>
                                                    <div class="item delete delete-axios" data-url="{{route('panel.portafolio.destroy.galeria')}}" data-idx="{{$item -> id}}" title="Eliminar"><i class="fas fa-trash fa-lg text-white"></i></div>
                                                </div>
                                                <img src="{{asset($item -> cover)}}" alt="{{$portafolio -> titulo}} - imagen {{$num + 1}}" class="img-resp">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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
