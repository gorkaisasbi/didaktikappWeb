<div id="addCard" class="addActivo">
    <i id="btnAddCard" class="fas fa-plus"></i>
    <div class="container contTemplates">
        <div class="row">
            <div class="col-12">
                <div id="btnCerrarAdd" class="btn btn-block btn-outline-danger border-0">Cerrar</div>
            </div>
            <div class="col-12 col-md-4" style="display:<?=$this->session->usuario->indCardListas ? "none":"block"?>">
                <div id="divAddCardListas" class="cardAdd">
                    <p class="m-0">Listas</p>
                    <i class="fas fa-chart-area templateChart"></i>
                    <div id="addCardListas" class="btn btn-block btn-outline-success border-0">Añadir</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div id="divAddCardListas" class="cardAdd">
                    <p class="m-0">Grupo</p>
                    <i class="fas fa-chart-area templateChart"></i>
                    <div id="addCardGrupo" class="btn btn-block btn-outline-success border-0">Añadir</div>
                </div>
            </div>
        </div>
    </div>
    <div id="addBuscarGrupo" class="row">
        <div class="col-12 mt-3 h-100">
            <form id="formBuscar">
            <div id="divInput" class="text-center">
                <input type="text" id="inBuscarAdd" name="txtBuscar"/>  
            </div>
            </form>
            <div id="listaGruposAdd" class="mt-2 row deckGrupos">
            </div>  
        </div>
    </div>
    <div id="blockAddBuscar"></div>

</div>
<link rel="stylesheet" property="stylesheet" href="css/addCard.css">
<script src="js/addCard.js"></script>