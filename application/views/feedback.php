<div id="feedback">
    <p id="msgFeed" class="m-0"></p>
</div>

<?php
    if(isset($grupo) && is_object($grupo)){
?>
    <link rel="stylesheet" property="stylesheet" href="../../css/feedback.css">
<script src="../../js/feedback.js"></script>
<?php
    }else{
?>
    <link rel="stylesheet" property="stylesheet" href="css/feedback.css">
<script src="js/feedback.js"></script>

<?php
    }
?>