<div id="divBuscar" class="row">
    <div class="col-1 col-md-2 p-0"></div>
    <div class="col-10 col-md-8">
        <form id="formBuscar">
        <div id="divInput" class="text-center">
            <input type="text" id="inBuscar" name="txtBuscar"/>
            <div class="d-flex align-items-end justify-content-center flex-column flex-md-row mt-2">
                <div id="inDates">
                    <fieldset class="border-0">
                        <legend>Fecha inicio</legend>
                        <fieldset class="float-md-left m-auto mx-md-1 p-2 p-md-0">
                            <legend>Desde</legend>
                            <input type="text" id="fechaDesde" name="fechaDesde" size="10" class="date start inDate"/><i id="btnFechaDesde" class="far fa-calendar invert"></i>
                            <input type="text" id="horaDesde" name="horaDesde" disabled size="8" class="time start inDate"/><i id="btnHoraDesde" class="far fa-clock invert"></i>
                        </fieldset>
                        <fieldset class="m-auto mx-md-1 p-2 p-md-0">
                            <legend>Hasta</legend>
                            <input type="text" id="fechaHasta" name="fechaHasta" size="10" class="date end inDate"/><i id="btnFechaHasta" class="far fa-calendar invert"></i>
                            <input type="text" id="horaHasta" name="horaHasta" disabled size="8" class="time end inDate"/><i id="btnHoraHasta" class="far fa-clock invert"></i>
                        </fieldset>
                    </fieldset>
                </div>
                <div class="align-self-center align-self-md-end mt-3 mt-md-0">
                    <input type="checkbox" id="checkBuscar" name="checkListas" data-on="Listas" data-off="General" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small"/>
                </div>    
            </div>
        </div>
        </form>
        <div id="listaGrupos" class="mt-2">
        </div>  
    </div>
    <div class="col-1 col-md-2 p"></div>
    <div id="backBuscar"></div>
</div>
<?$this->load->view("elecListas");?>
<link rel="stylesheet" href="css/jquery.timepicker.min.css"/>
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css"/>
<link rel="stylesheet" property="stylesheet" href="css/search.css">
<script src="js/jquery.datepair.min.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/search.js"></script>