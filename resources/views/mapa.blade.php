<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa Creando Vonculos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    
</head>
<body>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <style>
        img{
            
            padding-top: 5px;
            padding-left: 10px;
            padding-bottom: 5px;

        }
        #test3{
            padding-left: 0px;
            padding-right: 0px;
        }
        #test2{
            padding-left: 0px;
            padding-right: 0px;
        }

        #map { height: 100vh;
        
    }
    body {
        font-family: "Poppins";
       
    max-width: 100%;
    overflow-x: hidden;

    }


    </style>


<div class="row ">
    <div id="test2" class="col-sm-4">
        <div class="row bg-light justify-content-center">
            <div class="col-sm-12">
                <img src="{{ asset('img/logo4.png') }}" class="mx-auto d-block" alt="" width="150" height="120" >
            </div>

        </div>
       
        <h5 style="color: #023047;" class="mt-5 text-center">SELECCIONE QUE DESEA VER</h5>

        <div class = "row">
            @foreach($categorias as $categoria)     
                    <div class="d-flex justify-content-center mt-2" data-aos="fade-down">
                        <button class="categorias_btn btn btn-danger btn-lg" id="{{$categoria->id}}" data-id="{{$categoria->id}}" style='margin-bottom: 8px; min-height:100px; width:90%;'>{{$categoria->nombre}}</button>
                    </div>         
            @endforeach
        </div>

    </div>
    
    <div id="test3" class="col-sm-8">
        <div data-aos="fade-up" id="map"></div>
    </div>
</div>








    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>
    
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    


    <script>

        AOS.init();
        var map = L.map('map').setView([-33.044664, -71.584614], 14);
       
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        
        let layerGroup = L.layerGroup().addTo(map);


        map.on('resize', function () {
    map.invalidateSize();
});

   

        $(".categorias_btn").on("click", function(e){
            layerGroup.clearLayers();

             let id= $(this).attr('data-id');

                console.log('ID: ' + id);

                let url = "{{route('mapa.getCentros','')}}" + '/' + id.toString();
            $.getJSON(url, function(data){
              
                let arrayJS= data;
                              
                for(var i=0;i<arrayJS.length;i++)
                {                  
                   
                    var representante;
                    var correo;
                    var sector;
                    var nombre;

                  

                    //HORARIO
                    if (arrayJS[i].horario == null){
                         horario = 'SIN INFORMACIÓN';
                     }else{
                         horario = arrayJS[i].horario;
                     };
                     //REPRESENTANTE
                     if (arrayJS[i].representante == null){
                        representante = 'SIN INFORMACIÓN';
                     }else{
                        representante = arrayJS[i].representante;
                     };

                     //CORREO
                     if (arrayJS[i].correo == null){
                        correo = 'SIN INFORMACIÓN';
                     }else{
                        correo = arrayJS[i].correo;
                     };

                     //SECTOR
                     if (arrayJS[i].sector == null){
                        sector = 'SIN INFORMACIÓN';
                     }else{
                        sector = arrayJS[i].sector;
                     };

                     //NOMBRE
                     if (arrayJS[i].nombre == null){
                        nombre = 'SIN INFORMACIÓN';
                     }else{
                        nombre = arrayJS[i].nombre;
                     };



                     var greenIcon = new L.Icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                    });


                    L.marker([arrayJS[i].latitud, arrayJS[i].longitud], {icon: greenIcon}).addTo(layerGroup)

                    
                    .bindPopup('<p>' + ' <b> Nombre: </b> ' +  nombre + '<br /> ' + '<b>  Dirección: </b> ' +arrayJS[i].direccion + '<br /> ' + ' <b> Sector: </b> ' +  sector + '<br /> ' +  ' <b> Correo: </b> ' + correo + '<br /> ' + ' <b>  Representante: </b> ' +  representante + '<br /> ' +  ' <b> Horario: </b>   '  + horario  + '</p>')
                   
                    

                    layerGroup.addTo(map);           
                };              
            }); 
        })
          


        

    </script>
    
    
    
</body>
</html>