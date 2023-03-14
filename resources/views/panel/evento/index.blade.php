@extends('layouts.panel.app')

@push('link')
    <style>
        .bg {
            width: 170px;
            height: 100px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
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
				<div class="card">
				<!-- Card header -->
					<div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6">
                                <h3 class="mb-0 mr-4">Listado de experiencias</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                <a href="{{route('panel.evento.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
                                {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                                @endcan --}}
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="sort" data-sort="portada" width="200px">Portada</th>
                                    <th scope="col" class="sort" data-sort="titulo">Titulo</th>
                                    {{-- <th scope="col" class="sort" data-sort="categoria">Categoria</th> --}}
									<th scope="col" class="sort text-center" width="200px" data-sort="fecha">Fecha publicación</th>
									<th scope="col" class="no-sort text-center" width="200px">Visualizar</th>
									<th scope="col" class="no-sort text-center" width="200px">Destacar</th>
									<th scope="col" class="no-sort text-center" width="150px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td>
                                                <div class="bg" style="background-image: url({{asset($row -> cover)}});"></div>
                                            </td>
                                            <td class="font-weight-bold">
                                                {{ $row -> title }}
                                            </td>
                                            {{-- <td>
                                                {{ $row -> categoriaTitulo }}
                                            </td> --}}
                                            <td class="text-center">
                                                {{ \App\Helpers::dateSpanishComplete($row -> created_at) }}
                                            </td>
                                            <td>
                                                <div class="wp">
                                                    <input class="tgl tgl-light chkbx-toggle" id="toggle_{{$num}}" type="checkbox" value="{{$row -> id}}" {{($row -> status == 1) ? 'checked="checked"' : ''}}"/>
                                                    <label class="tgl-btn toggle_{{$num}}" data-url="{{route('panel.evento.status')}}" for="toggle_{{$num}}" onclick="cambiar_status('toggle_{{$num}}', {{$row -> id}}, {{($row -> status == 1) ? 0 : 1}})"></label>
                                                </div>
                                                {{-- @can(PermissionKey::Noticias['permissions']['status']['name'])
                                                @elsecan(PermissionKey::Noticias['permissions']['index']['name'])
                                                    <div class="wp">
                                                        <input class="tgl tgl-light chkbx-toggle" type="checkbox" disabled/>
                                                        <label class="tgl-btn toggle_{{$num}}" for="toggle_{{$num}}"></label>
                                                    </div>
                                                @endcan --}}
                                            </td>
                                            <td>
                                                <div class="wp">
                                                    <input class="tgl tgl-light chkbx-toggle" id="toggle_destacar_{{$num}}" type="checkbox" value="{{$row -> id}}" {{($row -> destacar == 1) ? 'checked="checked"' : ''}}"/>
                                                    <label class="tgl-btn toggle_destacar_{{$num}}" data-url="{{route('panel.evento.destacar')}}" for="toggle_destacar_{{$num}}" onclick="cambiar_status('toggle_destacar_{{$num}}', {{$row -> id}}, {{($row -> destacar == 1) ? 0 : 1}})"></label>
                                                </div>
                                                {{-- @can(PermissionKey::Noticias['permissions']['status']['name'])
                                                @elsecan(PermissionKey::Noticias['permissions']['index']['name'])
                                                    <div class="wp">
                                                        <input class="tgl tgl-light chkbx-toggle" type="checkbox" disabled/>
                                                        <label class="tgl-btn toggle_{{$num}}" for="toggle_{{$num}}"></label>
                                                    </div>
                                                @endcan --}}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('panel.evento.edit', ['id' => $row -> id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</a>
                                                <a href="{{route('panel.evento.galeria.acciones', ['accion' => 'edit', 'id' => $row -> id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i> Galeria</a>
                                                <form action="{{route('panel.evento.destroy', ["id" => $row -> id])}}" method="post" class="d-inline delete-form-{{$row -> id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="deleteSubmitForm({{$row -> id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @endcan --}}
                                                {{-- @can(PermissionKey::Noticias['permissions']['destroy']['name'])
                                                @endcan --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script type="text/javascript">
        alertify.set('notifier','position', 'top-right');

        function cambiar_status(el, id, status){
            axios.post(PATH + 'admin/noticias/change/status', {
                id: id,
                status: status
            })
            .then(function (response) {
                console.log(response);
                document.querySelector('label.'+el).removeAttribute('onclick');
                let n = status == 1 ? 0 : 1;
                document.querySelector('label.'+el).setAttribute('onclick', 'cambiar_status(\''+el+'\', '+id+', '+n+')');
                alertify.notify('Hecho!', 'success', 2);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    </script>
@endpush --}}
