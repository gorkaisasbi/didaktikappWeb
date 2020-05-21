<i id="backListas" class="fas fa-arrow-left"></i>
<div id="divListas">
    <div id="slapListas">
        <i id="btnListas" class="fas fa-list-ul"></i>
    </div>
    <div class="info pt-5">
        <div id="backInfo"></div>
        <div class="container">
            <div class="d-flex mb-1" style="justify-content:space-between;">
                <h2 class="m-0">Tus listas</h2>
                <div id="btnCrearLista" class="btn btn-outline-success">Crear nueva lista</div>
            </div>
            <div id="divCrearLista">
                <form id="formCrearLista">
                    <input type="text" name="nombreLista" id="nombreLista" placeholder="Nombre de la nueva lista"/><br>
                </form>
                <div id="btnCrearListaSubmit" class="btn btn-outline-success border-0">Crear</div>
            </div>
            <div class="linea mt-3"></div>
            <div class="mt-5 text-center d-flex justify-content-center align-items-center">
                <input type="text" name="nomListaBuscar" id="inBuscarLista" />
                <i id="btnBuscarListas" class="ml-3 fas fa-search"></i>
            </div>
            <div id="listListas" class="row my-5">
            <div id="blockListas"></div>
            <?php
                for($i=0;$i<count($this->session->listas);$i++){
            ?>
                <div id="lista<?=$this->session->listas[$i]->idlista?>" class="col-12 col-md-4 p-3 contLista">
                    <div class="lista card text-center p-5">
                        <i class="fas fa-list-ul"></i>
                        <div class="card-body">
                            <h5 class="card-title"><?=$this->session->listas[$i]->nombreLista?></h5>
                            <input type="text" name="nombreGrupo" class="buscarGrupo" id="inBuscaGrupo,<?=$this->session->listas[$i]->idlista?>" placeholder="Nombre de grupo"/>
                        </div>
                        <div id="listaGrupos" class="mt-5 row deckGrupos">
                            <?php
                                if(count($this->session->listas[$i]->grupos)==0){
                            ?>
                                <p class="mt-3 col-12 text-center infoNoHayGrupos">No hay grupos</p>
                            <?php
                                }else{
                                    for($j = 0;$j<count($this->session->listas[$i]->grupos);$j++){
                            ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                <div id="grupo<?=$this->session->listas[$i]->grupos[$j]->idgrupo?>" class="card m-3 divGrupo animated flipInY delay-<?=($j+1)?>" >
                                    <i class="fas fa-users card-img-top"></i>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$this->session->listas[$i]->grupos[$j]->nombreGrupo?></h5>
                                        <p class="card-text"><small class="text-muted"><?=$this->session->listas[$i]->grupos[$j]->fechaInicio?></small></p>
                                        <a href="main/verGrupo/<?=$this->session->listas[$i]->grupos[$j]->idgrupo?>" class="btn btn-block btn-outline-success border-0">Ver</a>
                                        <a href="main/eliminarDeLista/<?=$this->session->listas[$i]->idlista?>/<?=$this->session->listas[$i]->grupos[$j]->idgrupo?>" class="btn btn-block btn-outline-danger border-0 eliminarDeLista">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            <!--//<a href="#" id="anadirALista'+$gruposBusqueda[i].idgrupo+'" class="btn btn-block btn-outline-warning anadirALista">Añadir</a></div></div></div>-->
                            <?php
                                }}
                            ?>
                        </div> 
                        <div id="<?=$this->session->listas[$i]->idlista?>" class="btn btn-outline-danger eliminarLista">Eliminar</div>
                    </div>
                </div>
                <div id="lista<?=$this->session->listas[$i]->idlista?>" class="col-12 col-md-4 backup d-none"></div>
                           
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" property="stylesheet" href="css/listas.css">
<script src="js/listas.js"></script>