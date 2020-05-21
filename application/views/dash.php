<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <title>Didaktikapp - Dashboard</title>
    <link rel="icon" href="img/logo.webp">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/estilo.css"/>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/dash.js"></script>
    <script src="js/Chart.bundle.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/progressbar.min.js"></script>
    <link rel="stylesheet" href="css/Chart.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <link rel="stylesheet" href="css/aos.css"/>
    <script src="https://kit.fontawesome.com/ceb06c1ab7.js" crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>
<body>
<script>
        $listas = <?=json_encode($this->session->listas)?>;
</script>
<?$this->load->view("fade");?>
<script>
    clearTimeout($tFade);
</script>
<?$this->load->view("barra");?>
<?$this->load->view("divPerfil");?>
<?$this->load->view("search");?>
<?$this->load->view("feedback");?>
    
    <div id="infoMove">
        <table>
            <tr>
                <td rowspan="2">
                    <div id="feedListas" class="feed"><i class="fas fa-list-ul"></i></div>
                </td>
                <td>
                    <div id="feedBuscar" class="feed"><i class="fas fa-search"></i></div>
                </td>
                <td rowspan="2">
                    <div id="feedPerfil" class="feed"><i  class="fas fa-user"></i></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="feedDash" class="feed feedActivo"><i class="fas fa-th"></i></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="dash">
        <div id="divTiempo" class="text-center">
            <img src=""/>
            <p></p>
        </div>
        <div id="fecha"></div>
        <div id="hora"></div>
        <div id="limite">
            <script>$charts = [];</script>
            <?php
                if($this->session->usuario->indCardListas)$this->load->view("cardListas");
            ?>
            <script> $cardGrupos = [];</script>
            <?php
                for($i=0;$i<count($this->session->usuario->cardGrupos);$i++){
                    $data['grupo']= $this->session->usuario->cardGrupos[$i];
                    $this->load->view("cardGrupo",$data);
                }
            ?>
        </div>
        <div id="deleteCard">
            <i class="fas fa-trash-alt invert"></i>
        </div>
        <?$this->load->view("addCard");?>
    </div>
    <div id="coverMapa"></div>
    <div id="mapa"></div>
    <?$this->load->view("confPerfil");?>
    <?$this->load->view("listas");?>
    <?$this->load->view("boton");?>
    <script>
        var d = new Date();
        $estiloAuto = <?=$this->session->usuario->estiloAuto?>;
        var mapStyle = "dark";
            if($estiloAuto){
                if(d.getHours()<19){
                    mapStyle = "light";
            } 
        }
        
        if(mapStyle == "dark"){
            $("#backBuscar").css("display","none");
            $("#divBuscar .divGrupo").addClass("lightGrupo");
        }
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ29ya2Fpc2FzYmkiLCJhIjoiY2pwczA1eXhzMHJ2dDN4bXo3aW1yZzlnOCJ9.FK1iEuF4xGYwUOFeQDghlA';
            map = new mapboxgl.Map({
            container: 'mapa',
            style: 'mapbox://styles/mapbox/'+mapStyle+'-v10',
            center: [-2.411270, 43.032871],
            zoom: 15.5,
            pitch: 65,
            interactive:false,
            attributionControl: false
        });
    
        map.on('load', function() {
        
            // Add 3d buildings and remove label layers to enhance the map
            var layers = map.getStyle().layers;
            for (var i = 0; i < layers.length; i++) {
                if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
                    // remove text labels
                    map.removeLayer(layers[i].id);
                }
            }
            $("#fade").css("opacity","0");
        
            setTimeout(()=>{
                $("#fade").css("display","none");
            },1000);
          

        });
   
    </script>
</body>
</html>