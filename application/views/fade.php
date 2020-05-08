<div id="fade">
     <!-- <div id="carga">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>  -->
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
        <div class="bar6"></div>
    </div>
</div>

<?php
    if(isset($grupo) && is_object($grupo)){
?>
    <link rel="stylesheet" property="stylesheet" href="../../css/fade.css">
    <script src="../../js/fade.js"></script>
<?php
    }else{
?>
    <link rel="stylesheet" property="stylesheet" href="css/fade.css">
    <script src="js/fade.js"></script>

<?php
    }
?>