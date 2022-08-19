@extends("layouts.master")
@section("contenido")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<style>

	h1 { 
		font-family: 'Poppins', sans-serif;
		font-weight: bold;
		padding-left: 10px;
		font-size: 35px;
		color: #023047;
}
</style>
<div class="main-ver-concesion container my-5 mb-5">
	<div class="card shadow-sm p-3 mb-5 bg-white rounde">
		<div class="col">
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>
						<h6>{{ $error }}</h6>
					</li>
					@endforeach
				</ul>
			</div>
			@endif
			<form action="{{route('centros.guardar')}} " method="POST" enctype="multipart/form-data" id="form">
				@csrf
				
				<style>
					#map { height: 600px}
					body {
						font-family: "Poppins";
					}
					
				</style>
				
				<div class="row">
					<div class="col-sm-12">
						@if ( @isset($centro->id)  )
							<h1>EDITAR CENTRO</h1>                               
						@else
							<h1>AGREGAR CENTRO</h1>
						@endif
												
						<hr class="mb-2 w-100">
												
						
						<div class="row  mt-3 mb-3">
							<div class="col-sm-6">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" required name="nombre" value="{{$centro->nombre}}" id="nombre" class="form-control">
							</div>

							<div class="col-sm-6">
								<label for="nombre" class="form-label">Categoría</label>
								<select class="select form-control " style="width: 100%" name="id_categoria" required id="categorias_select">
									<option selected value="">--SELECCIONAR--</option>
									@foreach ($categorias as $categoria)                            
									<option @if(old('centro.id_categoria',$centro->id_categoria)==$categoria->id) selected @endif value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
									@endforeach
								</select>    
							</div>
							

						</div> 
						
						
						<div class="row mb-3">
							<div class="col-sm-6">
								<label for="nombre" class="form-label">Representante</label>
								<input type="text" name="representante"  value="{{$centro->representante}}" id="representante" class="form-control">
							</div>
							
							<div class="col-sm-6">
								<label for="nombre" class="form-label">Correo</label>
								<input type="email" name="correo" value="{{$centro->correo}}" id="sector" class="form-control">
							</div>
						</div> 
						
						<div class="row mb-5">
							<div class="col-sm-6">
								<label for="nombre" class="form-label">Horario de Atención</label>
								<input type="text" name="horario" value="{{$centro->horario}}" id="representante" class="form-control">
							</div>

							<div class="col-sm-6">
								<label for="nombre" class="form-label">Sector</label>
								<input type="text" name="sector" value="{{$centro->sector}}" id="sector" class="form-control">
							</div>
							
						</div> 
						
						
						<div class=" row d-flex justify-content-center">
							
							<div class="col-sm-10">
								<div class="input-group">
									<label for="nombre" class="form-label">Dirección: </label>
									<input type="text" required id="direccion"value="{{$centro->direccion}}" name="direccion" class="form-control ms-2">
									<button class="btn btn-success text-light btn-outline-secondary" id="buscar" type="button">Buscar</button>
								</div>
							</div>							
						</div>
										
						<div class="row">
							<div class="col-sm-12">
								<div class="mt-3">
									<div data-aos="fade-up" id="map"></div>

									<input type="hidden" name="latitud" value="{{$centro->latitud}}" id="latitud">
									<input type="hidden" name="longitud" value="{{$centro->longitud}}" id="longitud">
								</div>
							</div>
						</div>												
					</div>					
				</div>				
				
				<hr class="mb-3 mt-3 w-100">
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 mx-auto mr-auto">
						<input type="hidden"  id="id" name="id" value="{{$centro->id ?? ''}}">
						<a class="btn btn-dark" href="{{url()->previous()}}" name="aceptarBtn">Volver</a>
						<button class="btn btn-primary float-right" type="button" name="aceptarBtn" id="aceptarBtn" style="float: right">Guardar</button>
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section("javascript")

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
crossorigin=""></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@include('sweetalert::alert') 



<script>
	
	document.addEventListener('DOMContentLoaded', function(){  				
		$("#aceptarBtn").click(function(event) {   		

				if($('#latitud').val()==''){  
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Debe ingresar una ubicación en el mapa',
					})
				} else if($('#longitud').val()==''){
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Debe ingresar una ubicación en el mapa',
					})
				}else if($('#nombre').val()==''){
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Debe ingresar un nombre',
					})
				}
				else if($('#categorias_select').val()==''){
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Debe ingresar una categoría',
					})
				}

				else{
					$('#form').submit();
				}		     
        }); 

		var map = L.map('map').setView([-33.053654, -71.580150], 13);
		
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '© OpenStreetMap'
		}).addTo(map);
		
		let layerGroup = L.layerGroup().addTo(map);


		if($('#id').val()!=''){
			
			L.marker([{{$centro->latitud}}, {{$centro->longitud}}]).addTo(layerGroup)
				.bindPopup('Esta es la ubicación mostrada')
				.openPopup();

    			layerGroup.addTo(map);
		}

		$('#buscar').on('click',function(e){
			layerGroup.clearLayers();
			var data = {
				"format": "json",
				"addressdetails": 1,
				"q": $('#direccion').val(),
				"limit": 1
			};
			$.ajax({
				method: "GET",
				url: "https://nominatim.openstreetmap.org",
				data: data
			})
			.done(function( msg ) {
				console.log( msg );
				$('#latitud').val((msg[0]['lat']));
				$('#longitud').val((msg[0]['lon']));
				
				
				L.marker([msg[0]['lat'], msg[0]['lon']]).addTo(layerGroup)
				.bindPopup('Esta será la ubicación mostrada')
				.openPopup();

    			layerGroup.addTo(map);			
			});
			
		});
		
		function onMapClick(e) {

			layerGroup.clearLayers();
			L.marker([e.latlng['lat'], e.latlng['lng']]).addTo(layerGroup)
			.bindPopup('Esta será la ubicación mostrada')
			.openPopup();
    		layerGroup.addTo(map);

			$('#latitud').val(e.latlng['lat']);
			$('#longitud').val(e.latlng['lng']);

		}

		map.on('click', onMapClick);
		
	});
	
</script>

@endsection