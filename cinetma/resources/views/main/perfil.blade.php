@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/perfil.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
	user = "{{Auth::id()}}";
	_token = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/perfil.js') }}"></script>
@endsection

@section('content')

<div class="container" style="padding-top: 5rem">
	<div class="row flex-lg-nowrap">
		{{-- Primera Columna: Enlaces --}}
		<div class="col-12 col-lg-auto mb-3" style="width: 200px;">
			<div class="card p-3 border-0">
				<div class="e-navlist e-navlist--active-bg">
					<ul class="nav d-flex justify-content-center d-lg-inline-block ">
						@if(Auth::User()->colab)
						<li class="nav-item"><a class="nav-link underlineHover px-2" href="{{ route('mispeliculas') }}" id="misPeliculas"><i class="fa fa-fw fa-film mr-1"></i><span>Mis películas</span></a></li>
						<li class="nav-item"><a class="nav-link underlineHover px-2" href="{{ route('nuevapelicula') }}" id="subirPelicula"><i class="fa fa-fw fa-film mr-1"></i><span>Subir película</span></a></li>
						@endif
						<li class="nav-item"><a class="nav-link underlineHover px-2" href="" id="editarPerfil"><i class="fa fa-fw fa-user-edit mr-1"></i><span>Editar perfil</span></a></li>
						<li class="nav-item"><a class="nav-link underlineHover px-2" href="" id="eliminarPerfil"><i class="fa fa-fw fa-user-times mr-1"></i><span>Eliminar perfil</span></a></li>
					</ul>
				</div>
			</div>
		</div>
		{{-- Segunda columna: Perfil --}}
		<div class="col">
			<div class="row">
				<div class="col mb-3">
					<div class="card border-0">
						<div class="card-body">
							<div class="e-profile">
								<form method="post" action="https://cinetma.myftp.org/api/editarusuario" enctype="multipart/form-data" id="form" name="form">
									@csrf
									<div class="row">
										<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
											<div class="text-center mb-2 mb-sm-0 w-100">
												<h3 class="pt-sm-2 pb-1 mb-0">{{ Auth::user()['nombre'].' '.Auth::user()['apellidos'] }}</h3>
												<p class="mb-0">{{ Auth::user()['nick'] }}</p>
												@if (Auth::user()['admin'])
												<div class="text-muted"><small>Administrador</small></div>
												@endif
											</div>
										</div>
									</div>
									<div class="tab-content pt-3">
										<div class="tab-pane active">
											<div class="row">
												<div class="col">
													<div class="form-group  text-center text-sm-left">
														<label for="nombre" class="col-sm-3">Nombre</label>
														<input id="nombre" name="nombre" class="col-8 input-estilo dato rounded-0 mx-auto @error('nombre') is-invalid @enderror" type="text" value="{{ Auth::user()['nombre'] }}" autocomplete="off" disabled>
													</div>
													@error('nombre')
													<div class="text-center">
														<span class="text-muted" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													</div>
													@enderror
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group text-center text-sm-left">
														<label for="apellidos" class="col-sm-3">Apellidos</label>
														<input id="apellidos" name="apellidos" class="col-8 input-estilo dato rounded-0 @error('apellidos') is-invalid @enderror" type="text"  value="{{ Auth::user()['apellidos'] }}" autocomplete="off" disabled>
													</div>
													@error('apellidos')
													<div class="text-center">
														<span class="text-muted" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													</div>
													@enderror
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group text-center text-sm-left">
														<label for="nick" class="col-sm-3">Nick</label>
														<input id="nick" name="nick" class="col-8 input-estilo dato rounded-0 @error('nick') is-invalid @enderror" type="text"  value="{{ Auth::user()['nick'] }}" autocomplete="off" placeholder="-" disabled>
													</div>
													@error('nick')
													<div class="text-center">
														<span class="text-muted" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													</div>
													@enderror
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group text-center text-sm-left">
														<label for="email" class="col-sm-3">Email</label>
														<input id="email" name="email" class="col-8 input-estilo dato rounded-0 @error('email') is-invalid @enderror" type="email"  value="{{ Auth::user()['email'] }}"  placeholder="-" autocomplete="off" disabled>
													</div>
													@error('email')
													<div class="text-center">
														<span class="text-muted" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													</div>
													@enderror
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 offset-sm-1 mb-3 mt-5">
											<label class="text-center text-md-left w-100">Notificaciones por E-mail</label>
											<div class="custom-controls-stacked px-2">
												<div class="custom-control custom-checkbox">
													<input type="hidden" name="notificaciones" value="0" />
													<input type="checkbox" class="custom-control-input dato @error('notificaciones') is-invalid @enderror" id="notificaciones" name="notificaciones" value="1" disabled @if (Auth::user()['notificaciones']==1) checked @endif/>
													<label class="custom-control-label small text-dark" for="notificaciones">Deseo recibir notificaciones sobre publicaciones e interacciones en las que he participado.</label>
													@error('notificaciones')
													<div class="text-center">
														<span class="text-muted" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													</div>
													@enderror
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 offset-sm-1 mt-2 text-center" id="divGuardar">
										<input type="submit" value="Guardar" id="guardar" name="guardar">
										<input type="hidden" name="user" value="{{ Auth::id() }}">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				{{-- Tercera columna: Ayuda --}}
				<div class="col-12 col-md-3 mb-3">
					<div class="card border-0">
						<div class="card-body">
							<h6 class="card-title font-weight-bold text-center"><b>Discord</b></h6>
							<p class="card-text">¡Puedes unirte a nuestro <a href="https://discord.gg/XE9w2gZ" target="_blank">servidor de Discord</a> o añadir nuestro <a href="https://discord.com/oauth2/authorize?client_id=720013995100078081&permissions=51200&scope=bot" target="_blank">Bot de Discord</a> al tuyo tan solo con un click!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection