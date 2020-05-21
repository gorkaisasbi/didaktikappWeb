<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <title>Didaktikapp - Inicio</title>
    <link rel="icon" href="img/logo.webp">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css"/>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/inicio.js"></script>
    <script src="js/Chart.bundle.min.js"></script>
    <script src="js/aos.js"></script>
    <link rel="stylesheet" href="css/Chart.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <link rel="stylesheet" href="css/aos.css"/>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://kit.fontawesome.com/ceb06c1ab7.js" crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>
    <body>
       <div id="fondo_titulo">
            <div id="titDiv" class="container animated fadeInLeft delay-2s">
                <div class="d-flex">
                    <h1>Didaktik<span class="azul">app</span></h1>
                    <lottie-player class="align-self-end" src="https://assets4.lottiefiles.com/packages/lf20_JRUtDZ.json"  background="transparent"  speed="1"  
                    style="width: 50px; height: 50px;"  loop  autoplay></lottie-player>
                </div>
                <p class="lead">Descubre todo lo que ofrece nuestra app</p>
            </div>
            <img alt="imagen" src="img/arrow.svg">
            <img alt="imagen" src="img/arrow.svg">
        </div>
        <div class="fadeBajo"></div>
        <div class="container mt-5 position-relative">
            <div class="row py-3" data-aos="fade-in" data-aos-anchor-placement="bottom-bottom">
                <div class="col-12 col-md-6 mt-3" >
                    <p>Aplicación creada por alumnos del centro CIFP Ciudad Jardin (Vitoria) en colaboración con los alumnos de magisterio de la UPV en Leioa. La finalidad de la app es que sea usada por niños para hacer una excursión y conocer mejor Oñate. Esta app consta de varias actividades diferentes que se podrán realizar cuando el dispositivo esté a una distancia pequeña de los monumentos/ lugares a los que se refieren.</p>
                </div>
                <div class="col-12 col-md-6 mt-3 mb-5 text-center">
                    <i id="compass" class="fas fa-compass"></i>
                </div>
            </div>
        </div>

        <div id="divLoginInicio" class="bg-dark text-center" data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom">
            <div id="barraTop">
                <div></div><div></div><div></div>
            </div>
            <div>
                <p class="text-light">¿Ya tienes cuenta?</p>
                <a class="btn btn-outline-success btn-block" href="login">Iniciar sesion</a>
            </div>
        </div>

        <div id="divGraficas" class="container text-justify position-relative" >
            <h2 class=" " data-aos="fade-in">Información detallada</h2>
            <div class="linea"></div>
            <div class="row">
                <div class="col-12 row row-eq-height my-5" style="align-items: center;" data-aos="fade-in" data-aos-anchor-placement="center-bottom">
                    <div class="col-12 col-md-6 pb-3">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="col-12 col-md-6 pb-5">
                        <p>Tendrás acceso a información detallada sobre todos los grupos de estudiantes que disfruten de la aplicación. 
                        Tendrás disponibles todos los datos recogidos en la aplicación android en la web de inmediato, es casi como si estuvieras con ellos. 
                        </p>    
                        <p>Te proporcionamos la información de diferentes formas para mayor aclaración y seguimiento de tus estudiantes. </p>
                    </div>
                </div>
                <div class="col-12 mt-5" data-aos="fade-in" data-aos-anchor-placement="center-bottom">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
        <div id="divUltimosGrupos" class="container">
            <h2 class=" " data-aos="fade-in">Grupos recientes</h2>
            <div class="linea"></div>
            <div id="ultimosGruposLista" class="row py-5 deckGrupos">
            </div>
            <a href="inicio/search" data-aos="fade-in" class="btn btn-block btn-outline-info w-50 m-auto">Buscar más</a>
        </div>
        <div class="borderCurvo"></div>
        <div id="divCreadores" class="container-fluid">
            <div class="container">
                <h2 class="mt-5 text-light" data-aos="fade-in">Creadores del proyecto</h2>
                <hr>
                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 row-eq-height">
                    <div class="col mb-4">
                        <div class="divCreador text-center text-light" data-aos="flip-left">
                            <div class="position-relative">
                                <img src="img/user.svg"/>
                                <div class="pathBorder"></div>
                            </div>
                            <p><b>RODRIGO ALONSO SOLAGUREN-BEASCOA</b></p>
                            <p>Desarrollo Android</p>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="divCreador text-center text-light" data-aos="flip-left" data-aos-delay="200">
                            <div class="position-relative">
                                <img src="img/user.svg"/>
                                <div class="pathBorder"></div>
                            </div>
                            <p><b>JOSE CARLOS LANCHO MARTIN</b></p>
                            <p>Desarrollo Android</p>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="divCreador text-center text-light" data-aos="flip-left" data-aos-delay="400">
                            <div class="position-relative">
                                <img src="img/user.svg"/>
                                <div class="pathBorder"></div>
                            </div>
                            <p><b>ASIER SUÁREZ UBIERNA</b></p>
                            <p>Desarrollo Android</p>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="divCreador text-center text-light" data-aos="flip-left" data-aos-delay="600">
                            <div class="position-relative">
                                <img src="img/user.svg"/>
                                <div class="pathBorder"></div>
                            </div>
                            <p><b>GORKA ISASBIRIBIL DELGADO</b></p>
                            <p>Desarrollo Web</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="borderCurvo bgAzul position-relative"></div>

        <div id="divDescarga" class="bg-success w-100">
            <div class="container">
                <h2 class="mt-5 text-light" data-aos="fade-in">Descargar APP</h2>
                <hr>
                <div class="row mt-5">
                    <div class="col-8 col-md-6" >
                        <p class="text-light" data-aos="fade-in">Descarga la app en Google play store, disfruta de la cultura de la ciudad y vuelve para ver los datos de tu grupo.</p>
                    </div>
                    <div class="col-4 col-md-6 text-center mb-5">
                        <i style="font-size:9em" class="fab fa-google-play invert" data-aos="fade-in"></i>
                    </div>
                    <div class="col-0 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <a class="btn btn-block btn-dark noFade" data-aos="fade-in" data-aos-anchor-placement="top" href="https://play.google.com/store/apps/details?id=com.app.didaktikapp">Descargar aplicación</a> 
                    </div>
                    <div class="col-0 col-md-3"></div>
                </div>
            </div>
            <div id="botInicio" class="bg-success"></div>
        </div>
        
        
        

           
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', ''],
                        datasets: [{
                            label: '',
                            data: [12, 19, 3, 5, 2, 56],
                            backgroundColor: [
                                'rgba(0,114,255,.7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)'
                            ],
                            borderColor: [
                                'rgba(0,0,0,0)',
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    display: false
                                },
                                gridLines:{
                                    display: false
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    display: false
                                },
                                gridLines:{
                                    display: false
                                }
                            }]
                        },
                        animation: {
                                duration:10000
                            }
                    }
                });
                var ctx2 = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx2, {
                    type: 'radar',
                    data: {
                        labels: ['', '', '', '', '', ''],
                        datasets: [{
                            label: '',
                            data: [12, 19, 3, 5, 2, 56],
                            backgroundColor: [
                                'rgba(0,114,255,.7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)',
                                'rgba(0,114,255, .7)'
                            ],
                            borderColor: [
                                'rgba(0,114,255,1)',
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    display: false
                                },
                                gridLines:{
                                    display: false
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    display: false
                                },
                                gridLines:{
                                    display: false
                                }
                            }]
                        },
                        animation: {
                                duration:10000
                            }
                    }
                });
            </script> 
        <?$this->load->view("fade");?>
        <?$this->load->view("scroll");?>
        <script>
            clearTimeout($tFade);
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ29ya2Fpc2FzYmkiLCJhIjoiY2pwczA1eXhzMHJ2dDN4bXo3aW1yZzlnOCJ9.FK1iEuF4xGYwUOFeQDghlA';
    map = new mapboxgl.Map({
    container: 'fondo_titulo',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [-2.411270, 43.032871],
    zoom: 16,
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
    
   
    map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 2 });

    $("#fade").css("opacity","0");
        
            setTimeout(()=>{
                $("#fade").css("display","none");
            },1000);
 

    

    });
    $coords = [
            {'coordinates': [-2.412889,43.035]},
            {'coordinates': [-2.4139773845672607,43.03337631027518]},
            {'coordinates': [-2.415447235107422,43.0342585638378]},
            {'coordinates': [-2.416069507598877,43.0339684018436]},
            {'coordinates': [-2.4158066511154175,43.03292145459449]},
            {'coordinates': [-2.4140900373458862,43.03238032879034]}
        ];
		
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