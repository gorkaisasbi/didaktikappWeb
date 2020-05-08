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
        
    </div>
    <div class="rightNav">
        <div class="latPos"></div>
        <p id="sec0"><i class="fas fa-caret-right"></i></p>
    </div>
</div>

<link rel="stylesheet" property="stylesheet" href="css/cardGrupo.css">
<script src="js/cardGrupo.js"></script>