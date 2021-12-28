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
                                <h3 class="mb-0 mr-4">Listado de portafolios</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                <a href="{{route('panel.portafolio.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
                                {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                @endcan --}}
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="no-sort" data-sort="portada" width="200px">Portada</th>
									<th scope="col" class="no-sort" data-sort="titulo">Titulo</th>
									<th scope="col" class="no-sort text-center" data-sort="fecha">Fecha publicación</th>
									<th scope="col" class="no-sort text-center" width="200px">Visualizar</th>
									<th scope="col" class="no-sort text-center" width="150px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td>
                                                <div class="bg" style="background-image: url({{asset($row -> portada)}});"></div>
                                            </td>
                                            <td class="font-weight-bold">
                                                {{ $row -> titulo }}
                                            </td>
                                            <td class="text-center">
                                                {{ \App\Helpers::dateSpanishComplete($row -> created_at) }}
                                            </td>
                                            <td>
                                                <div class="wp">
                                                    <input class="tgl tgl-light chkbx-toggle" id="toggle_{{$num}}" type="checkbox" value="{{$row -> id}}" {{($row -> status == 1) ? 'checked="checked"' : ''}}"/>
                                                    <label class="tgl-btn toggle_{{$num}}" for="toggle_{{$num}}" onclick="cambiar_status('toggle_{{$num}}', {{$row -> id}}, {{($row -> status == 1) ? 0 : 1}})"></label>
                                                </div>
                                                {{-- @can(PermissionKey::Portafolio['permissions']['status']['name'])
                                                @elsecan(PermissionKey::Portafolio['permissions']['index']['name'])
                                                    <div class="wp">
                                                        <input class="tgl tgl-light chkbx-toggle" type="checkbox" disabled/>
                                                        <label class="tgl-btn toggle_{{$num}}" for="toggle_{{$num}}"></label>
                                                    </div>
                                                @endcan --}}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('panel.portafolio.edit', ["id" => $row -> id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</a>
                                                {{-- @can(PermissionKey::Portafolio['permissions']['edit']['name'])
                                                @endcan --}}
                                                <form action="{{route('panel.portafolio.destroy', ["id" => $row -> id])}}" method="post" class="d-inline delete-form-{{$row -> id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="deleteSubmitForm({{$row -> id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                                {{-- @can(PermissionKey::Portafolio['permissions']['destroy']['name'])
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
