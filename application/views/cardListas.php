<script>
    $chartsListas=[];
</script>
<div id="1" class="dashCard cardListas">
    <div id="btnDeleteCardListas"><span><img src="img/closeFeed.svg"/></span></div>
    <div class="cardInfo">
        <div class="sec">
            <canvas id="canvasCantListas"></canvas>
        </div>
        <div class="sec">
            <canvas id="canvasCantListas2"></canvas>
        </div>
        <div class="sec">
        </div>
        <div class="sec">
        </div>
    </div>
    <div class="rightNav">
        <div class="latPos"></div>
        <p id="sec0"><i class="fas fa-caret-right"></i></p>
        <p id="sec1"><i class="fas fa-caret-right"></i></p>
        <p id="sec2"><i class="fas fa-caret-right"></i></p>
        <p id="sec3"><i class="fas fa-caret-right"></i></p>
    </div>
</div>
<script>
    function cargarChartsListas(){

        $nomsListas = [];
        $contListas = [];
        for(i=0;i<$listas.length;i++){
            $nomsListas.push($listas[i].nombreLista);
            $contListas.push($listas[i].grupos.length);
        }
        $data = {
                labels: $nomsListas,
                datasets: [{
                    label: 'Grupos',
                    borderColor: 'rgb(0,114,255)',
                    borderWidth:5,
                    data: $contListas
                }]
        };
        var ctx = document.getElementById('canvasCantListas').getContext('2d');
        setTimeout(() => {
            chartCantListas = new Chart(ctx, {
            type: 'bar',
            data: $data,
            options: {
                title: {
                    display: true,
                    text: 'Numero de grupos'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            precision:0
                        },
                        gridLines:{
                            display: true
                        }
                    }],
                    xAxes: [{
                        gridLines:{
                            display: false
                        }
                    }]
                }
            }
            
        });
        $charts.push(chartCantListas);
        }, 1000);

        $nomsListas = [];
        $contListas = [];
        for(i=0;i<$listas.length;i++){
            $nomsListas.push($listas[i].nombreLista);
            $contListas.push($listas[i].grupos.length);
        }
        $data2 = {
                labels: $nomsListas,
                datasets: [{
                    label: 'Grupos',
                    borderColor: 'rgb(255,255,255)',
                    borderWidth:5,
                    data: $contListas
                }]
        };
        var ctx2 = document.getElementById('canvasCantListas2').getContext('2d');
        setTimeout(() => {
            chartCantListas2 = new Chart(ctx2, {
            type: 'bar',
            data: $data2,
            options: {
                title: {
                    display: true,
                    text: 'Numero de grupos'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            precision:0
                        },
                        gridLines:{
                            display: true
                        }
                    }],
                    xAxes: [{
                        gridLines:{
                            display: false
                        }
                    }]
                }
            }
            
        });
        $charts.push(chartCantListas2);
        }, 1000);

    }
    cargarChartsListas();

</script>
<link rel="stylesheet" property="stylesheet" href="css/cardListas.css">
<script src="js/cardListas.js"></script>