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
			<form action="{{route('categorias.guardar')}} " method="POST" enctype="multipart/form-data" id="form">
				@csrf
				
				<style>
					#map { height: 600px}
					body {
						font-family: "Poppins";
					}
					
				</style>
				
				<div class="row">
					<div class="col-sm-12">
						@if ( @isset($categoria->id)  )
							<h1>EDITAR CATEGORIA</h1>                               
						@else
							<h1>AGREGAR CATEGORIA</h1>
						@endif
												
						<hr class="mb-2 w-100">
												
						

						
						
						<div class="row mb-3">
							<div class="col-sm-12">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" name="nombre"  value="{{$categoria->nombre}}" id="nombre" class="form-control">
							</div>
							
							
						</div> 
						
						
						
						
					</div>					
				</div>				
				
				<hr class="mb-3 mt-3 w-100">
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 mx-auto mr-auto">
						<input type="hidden"  id="id" name="id" value="{{$categoria->id ?? ''}}">
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


				 if($('#nombre').val()==''){
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Debe ingresar un nombre',
					})
				}
				
				else{
					$('#form').submit();
				}		     
        }); 
		
	});
	
</script>

@endsection