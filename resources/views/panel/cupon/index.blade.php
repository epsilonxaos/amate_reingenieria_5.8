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
                                <h3 class="mb-0 mr-4">Listado de cupones</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                <a href="{{route('panel.cupon.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
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
									{{-- <th scope="col" class="sort" data-sort="portada" width="200px">Portada</th> --}}
                                    <th scope="col" class="sort" data-sort="cupn">Cupon</th>
                                    <th scope="col" class="sort" data-sort="limite_usos">Max. usos</th>
                                    <th scope="col" class="sort" data-sort="usos">Usos realizados</th>
									<th scope="col" class="sort text-center" data-sort="fecha_inicio">Inicia</th>
									<th scope="col" class="sort text-center" data-sort="fecha_finalizacion">Finaliza</th>
									<th scope="col" class="sort text-center" data-sort="fecha">Estado</th>
									<th scope="col" class="no-sort text-center" width="200px">Activo</th>
									<th scope="col" class="no-sort text-center" width="150px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td>
                                                {{ $row -> title }}
                                            </td>
                                            <td class="text-center">
                                                {{ $row -> limite_usos ? $row -> limite_usos : 'Ilimitado' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $row -> usos }}
                                            </td>
                                            <td class="text-center">
                                                {{ \App\Helpers::dateSpanishComplete($row -> fecha_inicio) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \App\Helpers::dateSpanishComplete($row -> fecha_finalizacion) }}
                                            </td>
                                            <td class="text-center">
                                                {!! (\App\Helpers::inTime($row -> fecha_finalizacion)) ? '<span class="badge badge-danger">Finalizado</span>' : '<span class="badge badge-success">Valido</span>' !!}
                                            </td>
                                            <td>
                                                <div class="wp">
                                                    <input class="tgl tgl-light chkbx-toggle" id="toggle_{{$num}}" type="checkbox" value="{{$row -> id}}" {{($row -> status == 1) ? 'checked="checked"' : ''}}/>
                                                    <label class="tgl-btn toggle_{{$num}}" data-url="{{route('panel.cupon.status')}}" for="toggle_{{$num}}" onclick="cambiar_status('toggle_{{$num}}', {{$row -> id}}, {{($row -> status == 1) ? 0 : 1}})"></label>
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
                                                <a href="{{route('panel.cupon.edit', ['id' => $row -> id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</a>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @endcan --}}
                                                <form action="{{route('panel.cupon.destroy', ["id" => $row -> id])}}" method="post" class="d-inline delete-form-{{$row -> id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="deleteSubmitForm({{$row -> id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </form>
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