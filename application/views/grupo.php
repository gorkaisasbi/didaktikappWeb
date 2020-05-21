<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <title>Didaktikapp - <?=$grupo->nombregrupo?></title>
    <link rel="icon" href="../../img/logo.webp">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/jquery.ui.touch-punch.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../../css/estilo.css"/>
    <link rel="stylesheet" href="../../css/estiloGrupo.css"/>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/app.js"></script>
    <script src="../../js/grupo.js"></script>
    <script src="../../js/Chart.bundle.min.js"></script>
    <script src="../../js/aos.js"></script>
    <script src="../../js/progressbar.min.js"></script>
    <link rel="stylesheet" href="../../css/Chart.min.css"/>
    <link rel="stylesheet" href="../../css/animate.css"/>
    <link rel="stylesheet" href="../../css/aos.css"/>
    <script src="https://kit.fontawesome.com/ceb06c1ab7.js" crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>
    <body style="background-color: rgb(40,40,40);">
        <script>
            $grupo = <?=json_encode($grupo);?>;
        </script>
        <?$this->load->view("fade");?>
        <?$this->load->view("feedback");?>

        <?php
            if(is_object($this->session->usuario)){
        ?>
            <div id="divSession">
                <div id="anadirALista<?=$grupo->idgrupo?>" class="btn btn-outline-warning anadirALista">Añadir</div>
                <a id="backDash" href="../../main" class="btn btn-outline-danger">Ir al Dashboard</a>
            </div>
        <?php
            }
         ?>       
        <div id="barraLateral">
            <div id="indicador"></div>
            <i id="btnMap" class="fas fa-map-marked-alt"></i>
            <i id="btnChart" class="fas fa-chart-pie"></i>
        </div>
        <div id="titAct">
            <h1><?=$grupo->nombregrupo?><span class="d-block linea"></span></h1>
            <div>
                <p class="m-0"><b>Fecha Inicio</b></p>
                <p class="m-0"><?=$grupo->fechainicio?></p>

                <p class="m-0 mt-2"><b>Fecha Fin</b> </p>
                <p class="m-0"><?=($grupo->fechafin == "") ? "<span class='text-success'>En curso</span>": $grupo->fechafin ?></p>

            </div>
        </div>
        <div id="barraActs" class="row perspective">
                <div class="col-1 col-md-2"></div>
                <ul class="col-10 col-md-8">
                    <li id="1" class="<?=(strlen($grupo->idAct1)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>Zumeltzegi dorrea</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/tower.svg"/>
                    </li>
                    <li id="2" class="<?=(strlen($grupo->idAct2)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>San miguel parrokia</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/church.svg"/>
                    </li>
                    <li id="3" class="<?=(strlen($grupo->idAct3)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>Unibertsitatea</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/school.svg"/>
                    </li>
                    <li id="4" class="<?=(strlen($grupo->idAct4)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>Trena</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/train.svg"/>
                    </li>
                    <li id="5" class="<?=(strlen($grupo->idAct5)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>San miguel errota</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/hydro.svg"/>
                    </li>
                    <li id="6" class="<?=(strlen($grupo->idAct6)>0) ? "":"liInactivo"?>">
                        <div class="descAct">
                            <p>Gernika</p>
                            <div class="rabillo"></div>
                        </div>
                        <img width="40px" class="invert" src="../../img/tree.svg"/>
                    </li>
                </ul>
                <div class="col-1 col-md-2"></div>
            </div>
        <div id="mapSide">
            <script>progressArr = [];progressVals = [];clearTimeout($tFade);</script>
            <?php
                if(strlen($grupo->idAct1)>0){
            ?>
            <div id="1" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>
                <div class="infoAct m-0">
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                    <h2 class="text-center ">Zumeltzegi dorrea<div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act1->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act1->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-5">
                            <div class="col-12 mb-4">
                                <h2>Preguntas</h2>
                                <div class="linea"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <h4>¿Para que se construyó la torre?</h4>
                                <p style="word-wrap: break-word; color:#0072ff;text-indent: 20px;"><?=$grupo->actividades->act1->foto1?></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <h4>¿Qué familia vivió en la casa torre desde el siglo XV?</h4>
                                <p style="word-wrap: break-word; color:#0072ff;text-indent: 20px;"><?=$grupo->actividades->act1->foto2?></p>
                            </div>

                        </div>
                        <?php
                            if(strlen($grupo->actividades->act1->sopa)>0){
                        ?>
                        <div class="col-12 row mt-5">
                            <div class="col-12 mb-4">
                                <h2>Sopa de letras</h2>
                                <div class="linea"></div>
                            </div>
                            <div class="col-12">
                                <p style="font-size:1.5em">Ejercicio acabado en <?=$grupo->actividades->act1->sopa?></p>
                            </div>
                        </div>
                        <?php
                            }   
                        ?>
                    </div>

                </div>
            </div>
            

            <?php
                }
                if(strlen($grupo->idAct2)>0){
            ?>
            <div id="2" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>
                <div class="infoAct m-0">
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                    <h2 class="text-center ">San miguel parrokia<div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act2->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act2->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Preguntas</h4>
                                <div id="progress2" class="progreso mt-3">
                                    <h4><?=(substr($grupo->actividades->act2->test,0,1) / substr($grupo->actividades->act2->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <?php
                                if(strlen($grupo->actividades->act2->fotos)>0){
                            ?>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Fotos</h4>
                                <div id="progress2" class="progreso mt-3">
                                    <h4><?=substr((substr($grupo->actividades->act2->fotos,0,1) / substr($grupo->actividades->act2->fotos,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                        
                    <script>
                        var bar = new ProgressBar.Circle(".modalMapa #progress2", {
                                color: '#A9FF2C',
                                trailColor: '#eee',
                                trailWidth: 1,
                                duration: 2400,
                                easing: 'easeInOut',
                                strokeWidth: 4,
                                from: {color: '#A9FF2C', a:0},
                                to: {color: '#2FD84E', a:1},
                                // Set default step function for all animate calls
                                step: function(state, circle) {
                                    circle.path.setAttribute('stroke', state.color);
                                }
                                });
                            var valor = <?=substr($grupo->actividades->act2->test,0,1) / substr($grupo->actividades->act2->test,2,1)?>;
                            bar.set(valor);
                            progressVals.push(valor);  
                            progressArr.push(bar);
                    </script>
                    <?php
                        if(strlen($grupo->actividades->act2->fotos)>0){
                    ?>
                    <script>
                        var bar = new ProgressBar.Circle(".modalMapa .col-md-6:nth-of-type(2) #progress2", {
                                color: '#A9FF2C',
                                trailColor: '#eee',
                                trailWidth: 1,
                                duration: 2400,
                                easing: 'easeInOut',
                                strokeWidth: 4,
                                from: {color: '#A9FF2C', a:0},
                                to: {color: '#2FD84E', a:1},
                                // Set default step function for all animate calls
                                step: function(state, circle) {
                                    circle.path.setAttribute('stroke', state.color);
                                }
                                });
                            var valor = <?=substr($grupo->actividades->act2->fotos,0,1) / substr($grupo->actividades->act2->fotos,2,1)?>;
                            bar.set(valor);
                            progressVals.push(valor);     
                            progressArr.push(bar);

                    </script>
                    <?php
                        }
                    ?>
                </div>
            </div>
            

            <?php
                }
                if(strlen($grupo->idAct3)>0){
            ?>
            <div id="3" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>  
                <div class="infoAct"> 
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                    <h2 class="text-center ">Unibertsitatea <div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act3->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act3->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col col-md-3"></div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Preguntas</h4>
                                <div id="progress3" class="progreso mt-3">
                                    <h4><?=(substr($grupo->actividades->act3->test,0,1) / substr($grupo->actividades->act3->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <div class="col col-md-3"></div>
                        </div>
                        <script>
                            var bar = new ProgressBar.Circle(".modalMapa #progress3", {
                                    color: '#A9FF2C',
                                    trailColor: '#eee',
                                    trailWidth: 1,
                                    duration: 2400,
                                    easing: 'easeInOut',
                                    strokeWidth: 4,
                                    from: {color: '#A9FF2C', a:0},
                                    to: {color: '#2FD84E', a:1},
                                    // Set default step function for all animate calls
                                    step: function(state, circle) {
                                        circle.path.setAttribute('stroke', state.color);
                                    }
                                    });
                            var valor = <?=substr($grupo->actividades->act3->test,0,1) / substr($grupo->actividades->act3->test,2,1)?>;
                            bar.set(valor);
                            progressVals.push(valor);     
                            progressArr.push(bar);
                                
                        </script>
                        <?php
                            if(strlen($grupo->actividades->act3->foto1) > 0){
                        ?>
                        <div class="col-12 row mt-5">
                            <h4 class="col-12">Fotos <div class="linea"></div></h4>

                            <div class="col-12 col-md-4 text-center p-2">
                                <img width="60%" src="data:image/png;base64,<?=$grupo->actividades->act3->foto1?>"/>
                            </div>
                            <div class="col-12 col-md-4 text-center p-2">
                                <img width="60%" src="data:image/png;base64,<?=$grupo->actividades->act3->foto2?>"/>
                            </div>
                            <div class="col-12 col-md-4 text-center p-2">
                                <img width="60%" src="data:image/png;base64,<?=$grupo->actividades->act3->foto3?>"/>
                            </div>
                                    
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                
                </div>
            </div>
            

            <?php
                }
                if(strlen($grupo->idAct4)>0){
            ?>
            <div id="4" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>
                <div class="infoAct">
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                <h2 class="text-center ">Trena <div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act4->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act4->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col col-md-3"></div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Palabras</h4>
                                <div id="progress6" class="progreso mt-3">
                                    <h4>100%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <div class="col col-md-3"></div>
                            <script>
                                var bar = new ProgressBar.Circle(".modalMapa #progress6", {
                                        color: '#A9FF2C',
                                        trailColor: '#eee',
                                        trailWidth: 1,
                                        duration: 2400,
                                        easing: 'easeInOut',
                                        strokeWidth: 4,
                                        from: {color: '#A9FF2C', a:0},
                                        to: {color: '#2FD84E', a:1},
                                        // Set default step function for all animate calls
                                        step: function(state, circle) {
                                            circle.path.setAttribute('stroke', state.color);
                                        }
                                        });
                                bar.set(1);
                                progressVals.push(1);     
                                progressArr.push(bar);
                                    
                            </script>
                        </div>
                    </div>
                
                </div>
            </div>
            

            <?php
                }
                if(strlen($grupo->idAct5)>0){
            ?>

            <div id="5" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>
                <div class="infoAct">
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                    <h2 class="text-center ">San miguel errota<div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act5->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act5->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col col-md-3"></div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Frases</h4>
                                <div id="progress4" class="progreso mt-3">
                                    <h4>100%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <div class="col col-md-3"></div>
                            <script>
                                var bar = new ProgressBar.Circle(".modalMapa #progress4", {
                                        color: '#A9FF2C',
                                        trailColor: '#eee',
                                        trailWidth: 1,
                                        duration: 2400,
                                        easing: 'easeInOut',
                                        strokeWidth: 4,
                                        from: {color: '#A9FF2C', a:0},
                                        to: {color: '#2FD84E', a:1},
                                        // Set default step function for all animate calls
                                        step: function(state, circle) {
                                            circle.path.setAttribute('stroke', state.color);
                                        }
                                        });
                                bar.set(1);
                                progressVals.push(1);     
                                progressArr.push(bar);
                                    
                            </script>
                        </div>
                        <?php
                            if(strlen($grupo->actividades->act5->foto1) > 0){
                        ?>
                        <div class="col-12 row mt-5">
                            <h4 class="col-12">Fotos <div class="linea"></div></h4>

                            <div class="col-12 col-md-6 text-center p-2">
                                <img width="60%" src="data:image/png;base64,<?=$grupo->actividades->act5->foto1?>"/>
                            </div>
                            <div class="col-12 col-md-6 text-center p-2">
                                <img width="60%" src="data:image/png;base64,<?=$grupo->actividades->act5->foto2?>"/>
                            </div>
                                    
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                
                </div>
            </div>

            <?php
                }
                if(strlen($grupo->idAct6)>0){
            ?>
            <div id="6" class="modalMapa">
                <div class="closeModalMap"><img class="invert" src="../../img/closeFeed.svg"/></div>
                <div class="infoAct">
                    <div class="row">
                        <div class="col-10 col-md-4 card" style="height:fit-content">
                            <div class="d-flex justify-content-center align-items-center pt-3">
                                <div class="time text-center">
                                    <h2 class="text-center ">Gernika<div class="linea"></div></h2>
                                    <p><?=explode(" ",$grupo->actividades->act6->fecha)[0]?></p>
                                    <p><?=explode(" ",$grupo->actividades->act6->fecha)[1]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col col-md-3"></div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                                <h4>Preguntas</h4>
                                <div id="progress5" class="progreso mt-3">
                                <h4><?=substr((substr($grupo->actividades->act6->test,0,1) / substr($grupo->actividades->act6->test,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                                </div>

                            </div>
                            <div class="col col-md-3"></div>
                        </div>
                        <script>
                            var bar = new ProgressBar.Circle(".modalMapa #progress5", {
                                    color: '#A9FF2C',
                                    trailColor: '#eee',
                                    trailWidth: 1,
                                    duration: 2400,
                                    easing: 'easeInOut',
                                    strokeWidth: 4,
                                    from: {color: '#A9FF2C', a:0},
                                    to: {color: '#2FD84E', a:1},
                                    // Set default step function for all animate calls
                                    step: function(state, circle) {
                                        circle.path.setAttribute('stroke', state.color);
                                    }
                                    });
                                var valor = <?=substr($grupo->actividades->act6->test,0,1) / substr($grupo->actividades->act6->test,2,1)?>;
                                bar.set(valor);
                                progressVals.push(valor);  
                                progressArr.push(bar);
                        </script>
                    </div>
                
                </div>
            </div>
            
            <?php
                }
            ?>

            <div id="1" class="marker 1 <?=(strlen($grupo->idAct1)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/tower.svg"/>
                    </div>
                </div>
            </div>
            <div id="2" class="marker 2 <?=(strlen($grupo->idAct2)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/church.svg"/>
                    </div>
                </div>
            </div>
            <div id="3" class="marker 3 <?=(strlen($grupo->idAct3)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/school.svg"/>
                    </div>
                </div>
            </div>
            <div id="4" class="marker 4 <?=(strlen($grupo->idAct4)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/train.svg"/>
                    </div>
                </div>
            </div>
            <div id="5" class="marker 5 <?=(strlen($grupo->idAct5)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/hydro.svg"/>
                    </div>
                </div>
            </div>
            <div id="6" class="marker 6 <?=(strlen($grupo->idAct6)>0) ? "":"markerInactivo"?>">
                <div>
                    <div class="backMarker"></div>
                    <div class="infoMarker">
                        <img width="40px" class="invert" src="../../img/tree.svg"/>
                    </div>
                </div>
            </div>

           <div id="blockModalAct"></div>
            <div id="mapaGrupo"></div>
        </div>
        
        <?$this->load->view("grupoCharts");?>
        <?$this->load->view("elecListas");?>
        <div id="navMovil">
            <i id="btnChart" class="fas fa-chart-pie"></i>
            <i id="btnMap" class="fas fa-map-marked-alt"></i>
            <div id="l"><img width="30%" class="invert" src="../../img/tree.svg"/></div>
            <div id="r"><img width="30%" class="invert" src="../../img/tree.svg"/></div>
        </div>
        <div id="blockMovil"></div>
    </body>
</html>