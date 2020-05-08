<i id="backPerfil" class="fas fa-arrow-left"></i>
<div id="confPerfil">
    <div class="container-fluid">
        <div id="infoPerfil" class="row">
            <div class="col-12 col-md-4">
                <img class="imgPerfil" width="100%" src="data:image/png;base64,<?=base64_encode($this->session->usuario->imagen)?>"/>
                <div id="editFotoMovil" class="text-center">
                    <i id="btnEditFotoMovil" class="far fa-edit"></i>
                </div>
                <input type="file" id="inFile" name="file" accept="image/*"/>
            </div>
            <div id="info" class="col-12 col-md-8 p-0">
                <p class="display-3 ml-4 user"><?=$this->session->usuario->username?></p>
                <a href="login/logout" class="btn btn-outline-danger border-0">Logout</a>
                <div class="linea"></div>
            </div>
            <div class="col-12 col-md-4">
                <div id="editFoto">
                    <div id="dropFoto" class="braro">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                        <i class="fas fa-images"></i>
                    </div>
                    <i id="btnEditFoto" class="far fa-edit"></i>
                </div>
            </div>
            <div class="col-12 col-md-8">
                    <table class="w-100">
                        <tr class="row">
                            <td class="col-12 col-md-3"><p class="m-0"><b class="v-center">Nombre de usuario</b></p></td>
                            <td class="col-5 col-md-5"><form id="userForm" class="m-0"><input class="ml-3" id="inUser" type="text" disabled name="user" value="<?=$this->session->usuario->username?>" size="<?=strlen($this->session->usuario->username);?>"/><i id="btnEditUser" class="far fa-edit"></i></form></td>
                            <td class="col-3 col-md-3"><div id="saveUser" class="btn btn-success ml-3">Guardar</div></td>
                        </tr>
                        <tr class="row mt-3">
                            <td class="col-12 ">
                                <b class="mr-3">Estilo de mapa automático</b>
                                <input type="checkbox" id="checkEstilo" data-on=" " data-off=" " data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small" <?= ($this->session->usuario->estiloAuto) ? "checked":""?> />
                            </td>
                        </tr>
                    </table>
                    <table class="mt-3 w-100">
                        <tr class="row"> 
                            <td class="col-12 col-md-3"><p class="m-0"><b>Contraseña</b></p></td>
                            <td class="col-12 col-md-9"><input class="ml-3" id="inPass" type="password" disabled name="pass" value="<?=$this->session->usuario->password?>" size="<?=strlen($this->session->usuario->password);?>" /><i id="tooglePass" class="far fa-eye-slash"></i><i id="btnEditPass" class="far fa-edit ml-3"></td>
                        </tr>
                    </table>
                    <table id="tableCont" class="mt-3 w-100">
                        <form id="formPass">
                        <tr>
                            <td><b>Contraseña nueva</b></td>
                            <td class="pl-3"><input type="password" id="pass1" name="pass1" /></td>
                        </tr>
                        <tr>
                            <td class="pt-3"><b>Repetir contraseña</b></td>
                            <td class="pl-3"><input type="password" id="pass2" name="pass2" /></td>
                        </tr>
                        </form>
                        <tr>
                            <td colspan="2" class="text-center py-3">
                                <div id="btnGuardarPass" class="btn btn-outline-success border-0">Guardar</div>
                            </td>
                        </tr>
                    </table>

            
            </div>

        </div>
    </div>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" property="stylesheet" href="css/confPerfil.css">
<script src="js/confPerfil.js"></script>