<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
	<!-- Brand -->
	<div class="sidenav-header bg-white align-items-center">
		<a class="navbar-brand" href="javascript:void(0)" style="padding: 15px">
			<img src="{{asset('img/logo-agrans.png')}}" class="navbar-brand-img" alt="..." style="max-width: 100%; max-height: auto">
		</a>
	</div>
	<div class="navbar-inner">
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Nav items -->
			<ul class="navbar-nav">
				{{-- <li class="nav-item">
					<a class="nav-link {{request() -> is('admin/evento*') ? 'active' : ''}}" href="{{route('panel.evento.index')}}">
						<i class="ni ni-bullet-list-67 text-default"></i>
						<span class="nav-link-text">Experiencias</span>
					</a>
				</li> --}}
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/evento*') ? 'active' : ''}}" href="#navbar-evento" data-toggle="collapse" role="button" aria-expanded="{{request() -> is('admin/evento*') ? 'true' : 'false'}}" aria-controls="navbar-tables">
						<i class="ni ni-books text-default"></i>
						<span class="nav-link-text">Experiencias</span>
					</a>
					<div class="collapse {{request() -> is('admin/evento*') ? 'show' : ''}}" id="navbar-evento">
						<ul class="nav nav-sm flex-column">
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/categorias/evento*') ? 'active' : ''}}" href="{{route('panel.categorias.index', ['seccion' => 'experiencias'])}}">
									<i class="ni ni-tag text-default"></i>
									<span class="nav-link-text">Categorías</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/evento*') ? 'active' : ''}}" href="{{route('panel.evento.index')}}">
									<i class="ni ni-bullet-list-67 text-default"></i>
									<span class="nav-link-text">Experiencias</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				{{-- <li class="nav-item d-none">
					<a class="nav-link {{request() -> is('admin/noticias*') ? 'active' : ''}}" href="#navbar-noticias" data-toggle="collapse" role="button" aria-expanded="{{request() -> is('admin/noticias*') ? 'true' : 'false'}}" aria-controls="navbar-tables">
						<i class="ni ni-books text-default"></i>
						<span class="nav-link-text">Noticias</span>
					</a>
					<div class="collapse {{request() -> is('admin/noticias*') ? 'show' : ''}}" id="navbar-noticias">
						<ul class="nav nav-sm flex-column">
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/categorias/blog*') ? 'active' : ''}}" href="{{route('panel.categorias.index', ['seccion' => 'blog'])}}">
									<i class="ni ni-tag text-default"></i>
									<span class="nav-link-text">Categorías</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/noticias*') ? 'active' : ''}}" href="{{route('panel.noticias.index')}}">
									<i class="ni ni-bullet-list-67 text-default"></i>
									<span class="nav-link-text">Noticias</span>
								</a>
							</li>
						</ul>
					</div>
				</li> --}}
                {{-- <li class="nav-item d-none">
					<a class="nav-link {{request() -> is('admin/portafolio*') ? 'active' : ''}}" href="#navbar-portafolio" data-toggle="collapse" role="button" aria-expanded="{{request() -> is('admin/portafolio*') ? 'true' : 'false'}}" aria-controls="navbar-tables">
						<i class="ni ni-briefcase-24 text-default"></i>
						<span class="nav-link-text">Portafolio</span>
					</a>
					<div class="collapse {{request() -> is('admin/portafolio*') ? 'show' : ''}}" id="navbar-portafolio">
						<ul class="nav nav-sm flex-column">
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/categorias/portafolio*') ? 'active' : ''}}" href="{{route('panel.categorias.index', ['seccion' => 'portafolio'])}}">
									<i class="ni ni-tag text-default"></i>
									<span class="nav-link-text">Categorías</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/portafolio*') ? 'active' : ''}}" href="{{route('panel.portafolio.index')}}">
									<i class="ni ni-bullet-list-67 text-default"></i>
									<span class="nav-link-text">Portafolio</span>
								</a>
							</li>
						</ul>
					</div>
				</li> --}}
				{{-- @can(PermissionKey::Noticias['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/noticias*') ? 'active' : ''}}" href="{{route('panel.noticias.index')}}">
							<i class="ni ni-bullet-list-67 text-default"></i>
							<span class="nav-link-text">Noticias</span>
						</a>
					</li>
				@endcan --}}
				{{-- @can(PermissionKey::Website['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/website*') ? 'active' : '' }}" href="{{ route('panel.website.edit') }}">
							<i class="ni ni-world-2 text-default"></i>
							<span class="nav-link-text">Website</span>
						</a>
					</li>
				@endcan --}}
				{{-- @can(PermissionKey::Registros['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/registros*') ? 'active' : '' }}" href="{{ route('panel.reg.index') }}">
							<i class="ni ni-archive-2 text-default"></i>
							<span class="nav-link-text">Registros</span>
						</a>
					</li>
				@endcan --}}
				@can(PermissionKey::Admin['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/cuentas/usuarios*') ? 'active' : '' }}" href="{{ route('panel.admins.index') }}">
							<i class="ni ni-single-02 text-default"></i>
							<span class="nav-link-text">Usuarios Panel</span>
						</a>
					</li>
				@endcan
			</ul>
		</div>
	</div>
	</div>
</nav>
