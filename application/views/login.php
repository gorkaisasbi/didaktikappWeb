<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Didaktikapp - Login</title>
    <link rel="icon" href="img/logo.webp">
    <link rel="stylesheet" href="css/estilo.css"/>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>
</head>
    <body>
        <div class="continer-fluid">
            <div class="row">
                <div class="col-1 col-sm-3 col-lg-5"></div>
                <div id="divLogin" class="col-10 col-sm-6 col-lg-3 p-0 rounded">
                    <div class="container-fluid p-0">
                        <form id="loginForm" action="main" method="POST">
                        <div class="row p-4 py-4 pb-2 m-0 formLogin">
                            <div class="feedback error">
                                <p class="m-0">Contraseña incorrecta</p>
                                <img class="closeFeed" width="15" src="img/closeFeed.svg"/>
                            </div>
                            <h2 class="text-center w-100 py-2">Didaktik<span class="azul">app</span></h2>
                            <input class="col-12 in p-0 mt-4"  type="text" placeholder="Nombre" name="username"/>
                            <div class="linea"></div>
                            <input class="col-12 in p-0 mt-4" type="password" placeholder="Contraseña" name="password"/>
                            <div class="linea mb-3"></div>
                        </div>
                        <input id="inLogin" class="btn btn-block text-light gradient btnLogin" type="submit" name="subLogin" value="Login"/>
                        </form>
                    </div>
                    
                </div> 
                <div class="col-1 col-sm-3 col-lg-5"></div>
            </div>
        </div>
        <div id="map"></div>
        <?$this->load->view("fade");?>
    <script>
        clearTimeout($tFade);
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ29ya2Fpc2FzYmkiLCJhIjoiY2pwczA1eXhzMHJ2dDN4bXo3aW1yZzlnOCJ9.FK1iEuF4xGYwUOFeQDghlA';
    map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [-2.411270, 43.032871],
    zoom: 17.5,
    pitch: 65,
    interactive:false,
    attributionControl: false
    });
    
    function rotateCamera(timestamp) {
    // clamp the rotation between 0 -360 degrees
    // Divide timestamp by 100 to slow rotation to ~10 degrees / sec
    map.rotateTo((timestamp / 400) % 360, { duration: 0 });
    // Request the next frame of the animation.
    requestAnimationFrame(rotateCamera);
    }
    var size = 150;
	 
	// implementation of CustomLayerInterface to draw a pulsing dot icon on the map
	// see https://docs.mapbox.com/mapbox-gl-js/api/#customlayerinterface for more info
	var pulsingDot = {
	width: size,
	height: size,
	data: new Uint8Array(size * size * 4),
	 
	// get rendering context for the map canvas when layer is added to the map
	onAdd: function() {
	var canvas = document.createElement('canvas');
	canvas.width = this.width;
	canvas.height = this.height;
	this.context = canvas.getContext('2d');
	},
	 
	// called once before every frame where the icon will be used
	render: function() {
	var duration = 1000;
	var t = (performance.now() % duration) / duration;
	 
	var radius = (size / 2) * 0.3;
	var outerRadius = (size / 2) * 0.7 * t + radius;
	var context = this.context;
	 
	// draw outer circle
	context.clearRect(0, 0, this.width, this.height);
	context.beginPath();
	context.arc(
	this.width / 2,
	this.height / 2,
	outerRadius,
	0,
	Math.PI * 2
	);
	context.fillStyle = 'rgba(0, 200, 0,0)';
	context.fill();
	 
	// draw inner circle
	context.beginPath();
	context.arc(
	this.width / 2,
	this.height / 2,
	radius,
	0,
	Math.PI * 2
	);
	context.fillStyle = 'rgba(0, 255, 0, 1)';
	context.strokeStyle = 'white';
	context.lineWidth = 2 + 4 * (1 - t);
	context.fill();
	context.stroke();
	 
	// update this image's data with data from the canvas
	this.data = context.getImageData(
	0,
	0,
	this.width,
	this.height
	).data;
	 
	// continuously repaint the map, resulting in the smooth animation of the dot
	map.triggerRepaint();
	 
	// return `true` to let the map know that the image was updated
	return true;
	}
	};
    
    map.on('load', function() {
    // Start the animation.
    rotateCamera(0);
    
    // Add 3d buildings and remove label layers to enhance the map
    var layers = map.getStyle().layers;
    for (var i = 0; i < layers.length; i++) {
        if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
            // remove text labels
            map.removeLayer(layers[i].id);
        }
    }
    
    map.addLayer({
    'id': '3d-buildings',
    'source': 'composite',
    'source-layer': 'building',
    'filter': ['==', 'extrude', 'true'],
    'type': 'fill-extrusion',
    'minzoom': 15,
    'paint': {
    'fill-extrusion-color': '#aaa',
    
    // use an 'interpolate' expression to add a smooth transition effect to the
    // buildings as the user zooms in
    'fill-extrusion-height': [
    'interpolate',
    ['linear'],
    ['zoom'],
    15,
    0,
    15.05,
    ['get', 'height']
    ],
    'fill-extrusion-base': [
    'interpolate',
    ['linear'],
    ['zoom'],
    15,
    0,
    15.05,
    ['get', 'min_height']
    ],
    'fill-extrusion-opacity': 0.8
    }
    });
    map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 2 });

    $("#fade").css("opacity","0");
        
    setTimeout(()=>{
        $("#fade").css("display","none");
    },1000);

    

    });
    $coords = [{
            'coordinates': [-2.411270, 43.032871]
        },
        {
            'coordinates': [-2.411270, 43.033871]
        },{
            'coordinates': [-2.411270, 43.031871]
        },{
            'coordinates': [-2.411270, 43.032971]
        },{
            'coordinates': [-2.412270, 43.032871]
        }];
		
    $reverse=false;
    $numLayer = 1;
    setInterval(()=>{
        if($reverse){
            map.removeLayer("points"+$numLayer);
            map.removeSource("points"+$numLayer);

            $numLayer++;
            if($numLayer==6){
                $reverse=false;
                $numLayer=1;
            }
        }else{
            map.addLayer({
            'id': 'points'+$numLayer,
            'type': 'symbol',
            'source': {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': $coords[$numLayer-1].coordinates
            }
            }
            ]
            }
            },
            'layout': {
            'icon-image': 'pulsing-dot'
            }
            });

            $numLayer++;

            if($numLayer==6){
                $reverse=true;
                $numLayer=1;
            }
        }

        
    },3000);
    </script>
        
    </body>
</html>