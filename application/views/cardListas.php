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
    </div>
    <div class="rightNav">
        <div class="latPos"></div>
        <p id="sec0"><i class="fas fa-caret-right"></i></p>
        <p id="sec1"><i class="fas fa-caret-right"></i></p>
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
                    label: 'Número de grupos',
                    backgroundColor: 'rgb(0,114,255,.7)',
                    borderWidth:0,
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
                    text: 'Listas'
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


        /***********************CHART DE ACT2**************************/
        $nomsListas = [];
        $sumAciertosTest = [];
        $mediaAciertosTest = [];
        $sumAciertosFotos = [];
        $mediaAciertosFotos = [];
        for(i=0;i<$listas.length;i++){
            $nomsListas.push($listas[i].nombreLista);

            $.ajax({
                url:"/main/sumListaTest/"+$listas[i].idlista,
                type:"GET",
                async: false,
                success:(xhr)=>{
                    $sumAciertosTest.push(xhr);
                },
                error:(xhr)=>{
                    console.log(xhr);
                }
            });

            $.ajax({
                url:"/main/sumListaFotos/"+$listas[i].idlista,
                type:"GET",
                async: false,
                success:(xhr)=>{
                    $sumAciertosFotos.push(xhr);
                },
                error:(xhr)=>{
                    console.log(xhr);
                }
            });

            $.ajax({
                url:"/main/mediaListaTest/"+$listas[i].idlista,
                type:"GET",
                async: false,
                success:(xhr)=>{
                    $mediaAciertosTest.push(xhr);
                },
                error:(xhr)=>{
                    console.log(xhr);
                }
            });


            $.ajax({
                url:"/main/mediaListaFotos/"+$listas[i].idlista,
                type:"GET",
                async: false,
                success:(xhr)=>{
                    $mediaAciertosFotos.push(xhr);
                },
                error:(xhr)=>{
                    console.log(xhr);
                }
            });

        }
        

        $data2 = {
                labels: $nomsListas,
                datasets: [
                    {
                    label: 'Media aciertos test',
                    borderColor: 'rgba(0,205,0,.8)',
                    backgroundColor:'rgba(0,0,0,0)',
                    borderWidth:3,
                    data: $mediaAciertosTest,
                    type: "line"
                },
                {
                    label: 'Media aciertos fotos',
                    borderColor: 'rgba(0,114,255,.8)',
                    backgroundColor:'rgba(0,0,0,0)',
                    borderWidth:3,
                    data: $mediaAciertosFotos,
                    type: "line"
                },
                {
                    label: 'Aciertos test',
                    backgroundColor: 'rgba(0,255,0,.7)',
                    borderWidth:0,
                    data: $sumAciertosTest
                },
                {
                    label: 'Aciertos Fotos',
                    backgroundColor: 'rgba(0,114,255,.7)',
                    borderWidth:0,
                    data: $sumAciertosFotos
                }
            
            ]};
        var ctx2 = document.getElementById('canvasCantListas2').getContext('2d');
        setTimeout(() => {
            chartCantListas2 = new Chart(ctx2, {
            type: 'bar',
            data: $data2,
            options: {
                title: {
                    display: true,
                    text: 'Aciertos Actividad San Miguel'
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