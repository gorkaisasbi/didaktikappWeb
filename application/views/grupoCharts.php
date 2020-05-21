<div id="chartSide">
    <?php
        if(strlen($grupo->idAct1)>0){
    ?>
    <div id="chart1" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
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
        <div class="union i"><span><img width="40px" class="invert" src="../../img/tower.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php
        }
        if(strlen($grupo->idAct2)>0){
    ?>    
    <div id="chart2" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
                            <h2 class="text-center ">San miguel parrokia<div class="linea"></div></h2>
                            <p><?=explode(" ",$grupo->actividades->act2->fecha)[0]?></p>
                            <p><?=explode(" ",$grupo->actividades->act2->fecha)[1]?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 row mt-3 mb-5">
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress2" class="progreso p1 mt-3">
                            <h4><?=(substr($grupo->actividades->act2->test,0,1) / substr($grupo->actividades->act2->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <?php
                        if(strlen($grupo->actividades->act2->fotos)>0){
                    ?>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Fotos</h4>
                        <div id="progress2" class="progreso p2 mt-3">
                            <h4><?=substr((substr($grupo->actividades->act2->fotos,0,1) / substr($grupo->actividades->act2->fotos,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-12 col-md-6 row mt-3 ml-2">
                    <canvas id="canvasGrupoAct2_1"></canvas>
                </div>
                <?php
                    if(strlen($grupo->actividades->act2->fotos)>0){
                ?>
                <div class="col-12 col-md-6 row mt-3 ml-2">
                    <canvas id="canvasGrupoAct2_2"></canvas>
                </div>
                <?php
                    }
                ?>
                
            </div>
            <script>
                var bar = new ProgressBar.Circle(".chart #progress2", {
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

                

                var $mediaAct2Test = 0;
                $.ajax({
                    url:"/main/mediaAct2Test",
                    type:"GET",
                    async: false,
                    success:(xhr)=>{
                        $mediaAct2Test = xhr;
                    },
                    error:(xhr)=>{
                        console.log(xhr);
                    }
                });
                var ctx = document.getElementById('canvasGrupoAct2_1').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Preguntas","Media Actividad"],
                        datasets: [
                        {
                            label: 'Aciertos Preguntas',
                            backgroundColor: 'rgba(0,255,0,.7)',
                            borderWidth:0,
                            data: [<?=substr($grupo->actividades->act2->test,0,1)?>,0]
                        },
                        {
                            label: 'Media Actividad',
                            backgroundColor: 'rgba(0,0,255,.7)',
                            borderWidth:0,
                            data: [0,$mediaAct2Test]
                        }
                    
                    ]},
                    options: {
                        legend: {
                            labels: {
                                fontColor: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Aciertos Preguntas',
                            fontColor:"rgb(255,255,255)"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    precision:0,
                                    max: 4,
                                    fontColor:"rgb(255,255,255)"
                                },
                                gridLines:{
                                    display: true,
                                    color:"rgba(255,255,255,.5)"
                                }
                            }],
                            xAxes: [{
                                color:"rgb(255,255,255)",
                                stacked: true,
                                gridLines:{
                                    display: false
                                },
                                ticks:{
                                    fontColor:"rgb(255,255,255)"
                                }
                            }]
                        }
                    }
                    
                });

            
            </script>
            <?php
                if(strlen($grupo->actividades->act2->fotos)>0){
            ?>
            <script>

                var bar = new ProgressBar.Circle(".chart .col-md-6:nth-of-type(2) #progress2", {
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


                var $mediaAct2Fotos = 0;
                $.ajax({
                    url:"/main/mediaAct2Fotos",
                    type:"GET",
                    async: false,
                    success:(xhr)=>{
                        $mediaAct2Fotos = xhr;
                    },
                    error:(xhr)=>{
                        console.log(xhr);
                    }
                });

                var ctx2 = document.getElementById('canvasGrupoAct2_2').getContext('2d');
                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: ["Fotos","Media Actividad"],
                        datasets: [
                        {
                            label: 'Aciertos Preguntas',
                            backgroundColor: 'rgba(0,255,0,.7)',
                            borderWidth:0,
                            data: [<?=substr($grupo->actividades->act2->fotos,0,1)?>,0]
                        },
                        {
                            label: 'Media Actividad',
                            backgroundColor: 'rgba(0,0,255,.7)',
                            borderWidth:0,
                            data: [0,$mediaAct2Fotos]
                        }
                    
                    ]},
                    options: {
                        legend: {
                            labels: {
                                fontColor: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Aciertos Fotos',
                            fontColor:"rgb(255,255,255)"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    precision:0,
                                    max: 6,
                                    fontColor:"rgb(255,255,255)"
                                },
                                gridLines:{
                                    display: true,
                                    color:"rgba(255,255,255,.5)"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines:{
                                    display: false,
                                    color:"rgb(255,255,255)"
                                },
                                ticks:{
                                    fontColor:"rgb(255,255,255)"
                                }
                            }]
                        }
                    }
                    
                });

            </script>
            <?php
                }
            ?>
        </div>
        <div class="union"><span><img width="40px" class="invert" src="../../img/church.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php
        }
        if(strlen($grupo->idAct3)>0){
    ?>
    <div id="chart3" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
                            <h2 class="text-center ">Unibertsitatea <div class="linea"></div></h2>
                            <p><?=explode(" ",$grupo->actividades->act3->fecha)[0]?></p>
                            <p><?=explode(" ",$grupo->actividades->act3->fecha)[1]?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12"></div>
                <div class="col-12 col-sm-12 col-md-6 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress3" class="progreso mt-3 w-75">
                            <h4><?=(substr($grupo->actividades->act3->test,0,1) / substr($grupo->actividades->act3->test,2,1)) *100?>%<p class="text-muted">acertado</p></h4>
                        </div>
                    </div>
                    <div class="col col-md-3"></div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mt-3">
                    <canvas id="canvasGrupoAct3_1"></canvas>         
                </div>
                <script>
                    var bar = new ProgressBar.Circle(".chart #progress3", {
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

                    var $mediaAct3 = 0;
                    $.ajax({
                        url:"/main/mediaAct3",
                        type:"GET",
                        async: false,
                        success:(xhr)=>{
                            $mediaAct3 = xhr;
                        },
                        error:(xhr)=>{
                            console.log(xhr);
                        }
                    });

                    var ctx3 = document.getElementById('canvasGrupoAct3_1').getContext('2d');

                    new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: ["Preguntas","Media Actividad"],
                            datasets: [
                            {
                                label: 'Aciertos Preguntas',
                                backgroundColor: 'rgba(0,255,0,.7)',
                                borderWidth:0,
                                data: [<?=substr($grupo->actividades->act3->test,0,1)?>,0]
                            },
                            {
                                label: 'Media Actividad',
                                backgroundColor: 'rgba(0,0,255,.7)',
                                borderWidth:0,
                                data: [0,$mediaAct3]
                            }
                        
                        ]},
                        options: {
                            legend: {
                                labels: {
                                    fontColor: 'white'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Aciertos Actividad',
                                fontColor:"rgb(255,255,255)"
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        precision:0,
                                        max: 2,
                                        fontColor:"rgb(255,255,255)"
                                    },
                                    gridLines:{
                                        display: true,
                                        color: "rgb(255,255,255)"
                                    }
                                }],
                                xAxes: [{
                                    stacked: true,
                                    gridLines:{
                                        display: false,
                                        color: "rgb(255,255,255)"
                                    },
                                    ticks:{
                                        fontColor: "rgb(255,255,255)"
                                    }
                                }]
                            }
                        }
                        
                    });
                        
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
        <div class="union"><span><img width="40px" class="invert" src="../../img/school.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php
        }
        if(strlen($grupo->idAct4)>0){
    ?>
    <div id="chart4" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
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
                        var bar = new ProgressBar.Circle(".chart #progress6", {
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
        <div class="union"><span><img width="40px" class="invert" src="../../img/train.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php
        }
        if(strlen($grupo->idAct5)>0){
    ?>
    <div id="chart5" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
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
                        var bar = new ProgressBar.Circle(".chart #progress4", {
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
        <div class="union"><span><img width="40px" class="invert" src="../../img/hydro.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php
        }
        if(strlen($grupo->idAct6)>0){
    ?>
    <div id="chart6" class="chart">
        <div class="infoAct">
            <div class="row">
                <div class="col-10 col-md-4 card" style="height:fit-content">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        <div class="time text-center text-dark">
                            <h2 class="text-center ">Gernika<div class="linea"></div></h2>
                            <p><?=explode(" ",$grupo->actividades->act6->fecha)[0]?></p>
                            <p><?=explode(" ",$grupo->actividades->act6->fecha)[1]?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12"></div>
                <div class="col-12 col-sm-12 col-md-6 row mt-3">
                    <div class="col col-md-3"></div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center mt-5 mt-md-0">
                        <h4>Preguntas</h4>
                        <div id="progress5" class="progreso mt-3 w-75">
                        <h4><?=substr((substr($grupo->actividades->act6->test,0,1) / substr($grupo->actividades->act6->test,2,1)) *100,0,5)?>%<p class="text-muted">acertado</p></h4>
                        </div>

                    </div>
                    <div class="col col-md-3"></div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mt-3">
                    <canvas id="canvasGrupoAct6_1"></canvas>  
                </div>
                <script>
                    var bar = new ProgressBar.Circle(".chart #progress5", {
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

                    var $mediaAct6 = 0;
                    $.ajax({
                        url:"/main/mediaAct6",
                        type:"GET",
                        async: false,
                        success:(xhr)=>{
                            $mediaAct6 = xhr;
                        },
                        error:(xhr)=>{
                            console.log(xhr);
                        }
                    });

                    var ctx4 = document.getElementById('canvasGrupoAct6_1').getContext('2d');

                    new Chart(ctx4, {
                        type: 'bar',
                        data: {
                            labels: ["Preguntas","Media Actividad"],
                            datasets: [
                            {
                                label: 'Aciertos Preguntas',
                                backgroundColor: 'rgba(0,255,0,.7)',
                                borderWidth:0,
                                data: [<?=substr($grupo->actividades->act6->test,0,1)?>,0]
                            },
                            {
                                label: 'Media Actividad',
                                backgroundColor: 'rgba(0,0,255,.7)',
                                borderWidth:0,
                                data: [0,$mediaAct6]
                            }
                        
                        ]},
                        options: {
                            legend: {
                                labels: {
                                    fontColor: 'white'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Aciertos Actividad',
                                fontColor: "rgb(255,255,255)"
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        precision:0,
                                        max: 3,
                                        fontColor:"rgb(255,255,255)"
                                    },
                                    gridLines:{
                                        display: true,
                                        color: "rgb(255,255,255)"
                                    }
                                }],
                                xAxes: [{
                                    stacked: true,
                                    gridLines:{
                                        display: false
                                    },
                                    ticks:{
                                        fontColor:"rgb(255,255,255)"
                                    }
                                }]
                            }
                        }
                        
                    });
                </script>
            </div>

        </div>
        <div class="union f"><span><img width="40px" class="invert" src="../../img/tree.svg"/></span> </div>
        <div class="downInfo"></div>
    </div>
    <?php 
        }
    ?>
</div>
<link rel="stylesheet" property="stylesheet" href="../../css/grupoCharts.css">