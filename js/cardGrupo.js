$("#btnVerGrupo").on("touchstart",(e)=>{
    window.location = e.target.href;
});
function cargarChartsGrupos(){

    for(i=0;i<$cardGrupos.length;i++){
        $listasGrupo = $listas.filter(l=> l.grupos.filter(g=>g.idgrupo==$cardGrupos[i].idgrupo).length>0);
        $nomsListasGrupo= [];
        $dataListasGrupo = [];
        for(j=0;j<$listasGrupo.length;j++){
            $nomsListasGrupo.push($listasGrupo[j].nombreLista);
            $dataListasGrupo.push(1);
        }
        if($nomsListasGrupo.length==0){
            deleteCard($("#cardGrupo"+$idUsuario+$cardGrupos[i].idgrupo)[0]);
        }else{
            chartCantListas = new Chart(document.getElementById('canvasGrupoCantListas'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d'), {
                type: 'pie',
                data: {
                labels: $nomsListasGrupo,
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#0072ffB3", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: $dataListasGrupo
                }]
                },
                options: {
                    title: {
                        display: true,
                        text: $cardGrupos[i].nombregrupo
                    }
                }
                
            });
            $charts.push(chartCantListas);

            

            if(Object.keys($cardGrupos[i].actividades).length>0 && typeof($cardGrupos[i].actividades.act2) != "undefined"){

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


                var ctx = document.getElementById('canvasGrupoAct2_1'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Preguntas","Media Actividad"],
                        datasets: [
                        {
                            label: 'Aciertos Preguntas',
                            backgroundColor: 'rgba(0,255,0,.7)',
                            borderWidth:0,
                            data: [$cardGrupos[i].actividades.act2.test.charAt(0),0]
                        },
                        {
                            label: 'Media Actividad',
                            backgroundColor: 'rgba(0,0,255,.7)',
                            borderWidth:0,
                            data: [0,$mediaAct2Test]
                        }
                    
                    ]},
                    options: {
                        title: {
                            display: true,
                            text: 'Aciertos Preguntas'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    precision:0,
                                    max: 4
                                },
                                gridLines:{
                                    display: true
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines:{
                                    display: false
                                }
                            }]
                        }
                    }
                    
                });

                if(typeof($cardGrupos[i].actividades.act2.fotos) != "undefined"){
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

                    var ctx2 = document.getElementById('canvasGrupoAct2_2'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d');
                    new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: ["Fotos","Media Actividad"],
                            datasets: [
                            {
                                label: 'Aciertos Preguntas',
                                backgroundColor: 'rgba(0,255,0,.7)',
                                borderWidth:0,
                                data: [$cardGrupos[i].actividades.act2.fotos.charAt(0),0]
                            },
                            {
                                label: 'Media Actividad',
                                backgroundColor: 'rgba(0,0,255,.7)',
                                borderWidth:0,
                                data: [0,$mediaAct2Fotos]
                            }
                        
                        ]},
                        options: {
                            title: {
                                display: true,
                                text: 'Aciertos Fotos'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        precision:0,
                                        max: 6
                                    },
                                    gridLines:{
                                        display: true
                                    }
                                }],
                                xAxes: [{
                                    stacked: true,
                                    gridLines:{
                                        display: false
                                    }
                                }]
                            }
                        }
                        
                    });
                }

            }

            if(Object.keys($cardGrupos[i].actividades).length>0 && typeof($cardGrupos[i].actividades.act3) != "undefined"){

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

                var ctx3 = document.getElementById('canvasGrupoAct3_1'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d');

                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: ["Preguntas","Media Actividad"],
                        datasets: [
                        {
                            label: 'Aciertos Preguntas',
                            backgroundColor: 'rgba(0,255,0,.7)',
                            borderWidth:0,
                            data: [$cardGrupos[i].actividades.act3.test.charAt(0),0]
                        },
                        {
                            label: 'Media Actividad',
                            backgroundColor: 'rgba(0,0,255,.7)',
                            borderWidth:0,
                            data: [0,$mediaAct3]
                        }
                    
                    ]},
                    options: {
                        title: {
                            display: true,
                            text: 'Aciertos Actividad'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    precision:0,
                                    max: 2
                                },
                                gridLines:{
                                    display: true
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines:{
                                    display: false
                                }
                            }]
                        }
                    }
                    
                });
            }

            if(Object.keys($cardGrupos[i].actividades).length>0 && typeof($cardGrupos[i].actividades.act6) != "undefined"){

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

                var ctx4 = document.getElementById('canvasGrupoAct6_1'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d');

                new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: ["Preguntas","Media Actividad"],
                        datasets: [
                        {
                            label: 'Aciertos Preguntas',
                            backgroundColor: 'rgba(0,255,0,.7)',
                            borderWidth:0,
                            data: [$cardGrupos[i].actividades.act6.test.charAt(0),0]
                        },
                        {
                            label: 'Media Actividad',
                            backgroundColor: 'rgba(0,0,255,.7)',
                            borderWidth:0,
                            data: [0,$mediaAct6]
                        }
                    
                    ]},
                    options: {
                        title: {
                            display: true,
                            text: 'Aciertos Actividad'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    precision:0,
                                    max: 3
                                },
                                gridLines:{
                                    display: true
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines:{
                                    display: false
                                }
                            }]
                        }
                    }
                    
                });
            }

        }
    }

}