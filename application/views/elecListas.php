<script>
        $listas = <?=json_encode($this->session->listas)?>;
</script>
<div id="elecListas">
    <ul class="list-group list-group-flush">
    <?php
        if(count($this->session->listas)==0){
    ?>
        <p class="infoNoHayListaAnadir text-center m-0">No tienes listas a las que añadir</p>
    <?php
        }else{
        for($i=0;$i<count($this->session->listas);$i++){
    ?>
        <li id="elecLista<?=$this->session->listas[$i]->idlista?>" class="list-group-item elecLista"><?=$this->session->listas[$i]->nombreLista?></li>
                    
    <?php }} ?>
    </ul>
</div>
<div id="blockElecListas"></div>
<?php
    if(isset($grupo) && is_object($grupo)){
?>
    <link rel="stylesheet" property="stylesheet" href="../../css/elecListas.css">
    <script src="../../js/elecListas.js"></script>
<?php
    }else{
?>
    <link rel="stylesheet" property="stylesheet" href="css/elecListas.css">
    <script src="js/elecListas.js"></script>

<?php
    }
?>
