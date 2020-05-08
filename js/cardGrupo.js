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

            
        chartCantListas = new Chart(document.getElementById('canvasGrupoCantListas'+$idUsuario+$cardGrupos[i].idgrupo).getContext('2d'), {
            type: 'pie',
            data: {
            labels: $nomsListasGrupo,
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
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
    }

}