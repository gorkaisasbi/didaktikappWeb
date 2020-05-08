<script>
    $idUsuario = <?=$this->session->usuario->idusuario?>;
    $usuarioDash = <?=$this->session->usuario->dash?>;
</script>
<div id="divPerfil">
    <img class="imgPerfil" src="data:image/png;base64,<?=base64_encode($this->session->usuario->imagen)?>"/>
    <div id="perfil">
        <p><b class="user"><?=$this->session->usuario->username;?></b></p>
        <i class="fas fa-cogs btnConfPerfil"></i>
        <i  class="fas fa-user movil btnConfPerfil"></i>
        <a href="login/logout"><i class="fas fa-sign-out-alt logout"></i></a> 
    </div>
</div>
<link rel="stylesheet" property="stylesheet" href="css/divPerfil.css">