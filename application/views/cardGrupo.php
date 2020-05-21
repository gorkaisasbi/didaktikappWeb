<?php
    $id =$this->session->usuario->idusuario . $grupo->idgrupo;
?>
<script>
    $cardGrupos.push(<?=json_encode($grupo)?>);

</script>
<div id="cardGrupo<?=$id?>" class="dashCard cardGrupo">
    <a href="main/verGrupo/<?=$grupo->idgrupo?>" class="btn btn-outline-success border-0 btnVerGrupo">Ver</a>
    <div id="btnDeleteCardGrupo"><span><img src="img/closeFeed.svg"/></span></div>
    <div class="cardInfo">
        <div class="sec">
            <canvas id="canvasGrupoCantListas<?=$id?>"></canvas>
        </div>
        <div class="sec">
            <?php
                if(isset($grupo->actividades->act1)){
            ?>
            <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">Zumeltzegi dorrea</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12 mb-4">
                        <h2>Preguntas</h2>
                        <div class="linea"></div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <h4>¿Para que se construyó la torre?</h4>
                        <p style="word-wrap: break-word; color:#0072ff;text-indent: 20px;"><?=$grupo->actividades->act1->foto1?></p>
                    </div>
                    <div class="col-12 col-lg-6">
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
            <?php
                }else echo "<p class='sinAct'>No tiene actividad 1</p>";
            ?>
        </div>
        <div class="sec">
        <?php
                if(isset($grupo->actividades->act2)){
            ?>
             <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">San miguel parrokia</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress<?=$id?>" class="progreso mt-3">
                            <h4><?=(substr($grupo->actividades->act2->test,0,1) / substr($grupo->actividades->act2->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <?php
                        if(strlen($grupo->actividades->act2->fotos)>0){
                    ?>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Fotos</h4>
                        <div id="progress<?=$id?>" class="progreso mt-3">
                            <h4><?=substr((substr($grupo->actividades->act2->fotos,0,1) / substr($grupo->actividades->act2->fotos,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-12 row mt-3">
                    <canvas id="canvasGrupoAct2_1<?=$id?>"></canvas>
                </div>
                <?php
                    if(strlen($grupo->actividades->act2->fotos)>0){
                ?>
                <div class="col-12 row mt-3">
                    <canvas id="canvasGrupoAct2_2<?=$id?>"></canvas>
                </div>
                <?php
                    }
                ?>
            </div>
            <script>
                var bar = new ProgressBar.Circle("#progress<?=$id?>", {
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
            </script>
                <?php
                if(strlen($grupo->actividades->act2->fotos)>0){
            ?>
            <script>
                var bar = new ProgressBar.Circle(".sec .col-md-6:nth-of-type(2) #progress<?=$id?>", {
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

            </script>
            <?php
                }
            ?>

            <?php
                }else echo "<p class='sinAct'>No tiene actividad 2</p>";
            ?>

                
        </div>
        <div class="sec">
        <?php
                if(isset($grupo->actividades->act3)){
            ?>
            <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">Unibertsitatea</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress2<?=$id?>" class="progreso mt-3">
                            <h4><?=(substr($grupo->actividades->act3->test,0,1) / substr($grupo->actividades->act3->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <div class="col col-md-3"></div>
                </div>
                <script>
                    var bar = new ProgressBar.Circle(".sec #progress2<?=$id?>", {
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
                        
                </script>
                <div class="col-12 row mt-5">
                    <canvas id="canvasGrupoAct3_1<?=$id?>"></canvas>            
                </div>
            </div>

            <?php
                }else echo "<p class='sinAct'>No tiene actividad 3</p>";
            ?>

                
        </div>

        <div class="sec">
        <?php
                if(isset($grupo->actividades->act4)){
            ?>
            <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">Trena</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Palabras</h4>
                        <div id="progress3<?=$id?>" class="progreso mt-3">
                            <h4>100%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <div class="col col-md-3"></div>
                    <script>
                        var bar = new ProgressBar.Circle(".sec #progress3<?=$id?>", {
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
                            
                    </script>
                </div>
            </div>

            <?php
                }else echo "<p class='sinAct'>No tiene actividad 4</p>";
            ?>  
        </div>
        <div class="sec">
        <?php
                if(isset($grupo->actividades->act5)){
            ?>
             <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">San miguel errota</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Frases</h4>
                        <div id="progress4<?=$id?>" class="progreso mt-3">
                            <h4>100%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <div class="col col-md-3"></div>
                    <script>
                        var bar = new ProgressBar.Circle(".sec #progress4<?=$id?>", {
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
                            
                    </script>
                </div>
            </div>
            <?php
                }else echo "<p class='sinAct'>No tiene actividad 5</p>";
            ?>  
        </div>

        <div class="sec">
        <?php
                if(isset($grupo->actividades->act6)){
            ?>
            <div class="row p-5 w-100">
                <div class="col-6 card bg-dark" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center p-1">
                        <div class="time text-center">
                            <p class="text-center text-light m-0" style="font-size:1.5em">Gernika</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress5<?=$id?>" class="progreso mt-3">
                        <h4><?=substr((substr($grupo->actividades->act6->test,0,1) / substr($grupo->actividades->act6->test,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <div class="col col-md-3"></div>
                </div>
                <script>
                    var bar = new ProgressBar.Circle(".sec #progress5<?=$id?>", {
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
                </script>
                <div class="col-12 row mt-3">
                    <canvas id="canvasGrupoAct6_1<?=$id?>"></canvas>  
                </div>
            </div>
            <?php
                }else echo "<p class='sinAct'>No tiene actividad 6</p>";
            ?>  
        </div>
        
    </div>
    <div class="rightNav">
        <div class="latPos"></div>
        <p id="sec0"><i class="fas fa-caret-right"></i></p>
        <p id="sec1"><i class="fas fa-caret-right"></i></p>
        <p id="sec2"><i class="fas fa-caret-right"></i></p>
        <p id="sec3"><i class="fas fa-caret-right"></i></p>
        <p id="sec4"><i class="fas fa-caret-right"></i></p>
        <p id="sec5"><i class="fas fa-caret-right"></i></p>
        <p id="sec6"><i class="fas fa-caret-right"></i></p>
    </div>
</div>

<link rel="stylesheet" property="stylesheet" href="css/cardGrupo.css">
<script src="js/cardGrupo.js"></script>