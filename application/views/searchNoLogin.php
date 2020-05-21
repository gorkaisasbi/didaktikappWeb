<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <title>Didaktikapp - Inicio</title>
    <link rel="icon" href="../img/logo.webp">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css"/>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/inicio.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/searchNoLogin.js"></script>
    <link rel="stylesheet" href="../css/animate.css"/>
    <link rel="stylesheet" href="../css/aos.css"/>
    <link rel="stylesheet" href="../css/searchNoLogin.css"/>
    <link rel="stylesheet" href="../css/jquery.timepicker.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap-datepicker.min.css"/>
    <script src="../js/jquery.datepair.min.js"></script>
    <script src="../js/jquery.timepicker.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="https://kit.fontawesome.com/ceb06c1ab7.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
    <body>
        <div id="divSearchNoLoginTit">
            <div id="titDiv">
                <div class="d-flex">
                    <a href="../"><h1>Didaktik<span class="azul">app</span></h1></a>
                    <lottie-player class="align-self-center" src="../img/runBlanco.json"  speed="1"  
                    style="width: 50px; height: 50px;"  loop  autoplay></lottie-player>
                </div>
            </div>
        </div>
        
        <div id="divSearchNoLogin" class="container text-center">
            <h1 class="text-left display-3 mt-5">Búsqueda</h1>
            <form id="formBuscar">
            <input type="text" name="txtBuscar" placeholder="Nombre del grupo" class="mt-3" id="inSearchNoLogin"/>
            <div class="d-flex align-items-end justify-content-center flex-column flex-md-row mt-2">
                <div id="inDates" class="m-auto">
                    <fieldset class="border-0 mt-3">
                        <legend>Fecha inicio</legend>
                        <fieldset class="float-md-left m-auto mx-md-5">
                            <legend>Desde</legend>
                            <input type="text" id="fechaDesde" name="fechaDesde" size="10" class="date start inDate"/><i id="btnFechaDesde" class="far fa-calendar invert"></i>
                            <input type="text" id="horaDesde" name="horaDesde" disabled size="8" class="time start inDate"/><i id="btnHoraDesde" class="far fa-clock invert"></i>
                        </fieldset>
                        <fieldset class="m-auto mx-md-1">
                            <legend>Hasta</legend>
                            <input type="text" id="fechaHasta" name="fechaHasta" size="10" class="date end inDate"/><i id="btnFechaHasta" class="far fa-calendar invert"></i>
                            <input type="text" id="horaHasta" name="horaHasta" disabled size="8" class="time end inDate"/><i id="btnHoraHasta" class="far fa-clock invert"></i>
                        </fieldset>
                    </fieldset>
                </div>  
            </div>
        </form>
        </div>
        <div class="container">
            <div id="gruposSearch" class="row py-5 deckGrupos mb-5">
            </div>
        </div>

        <div id="fade">
            <div class="loader">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <div class="bar4"></div>
                <div class="bar5"></div>
                <div class="bar6"></div>
            </div>
        </div>
        <link rel="stylesheet" property="stylesheet" href="../css/fade.css">
        <script src="../js/fade.js"></script>

        <div id="scroll"></div>
        <link rel="stylesheet" property="stylesheet" href="../css/scroll.css">
        <script src="../js/scroll.js"></script>
        

    </body>
</html>