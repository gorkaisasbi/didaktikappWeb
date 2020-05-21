$abiertoSearch = false;
$idGrupoAdd = -1;

var tOffLista = $("#listaGrupos")[0].getBoundingClientRect().top - $("#divBuscar")[0].getBoundingClientRect().top;
$("#listaGrupos").css("height",window.innerHeight - (tOffLista + 30));

$(window).resize(()=>{
    var tOffLista = $("#listaGrupos")[0].getBoundingClientRect().top - $("#divBuscar")[0].getBoundingClientRect().top;
$("#listaGrupos").css("height",window.innerHeight - (tOffLista + 30));
});

function abrirSearch(){
    $("#inBuscar").trigger("keyup");
    $("#dash").css("top","100%");
    $("#addCard").addClass("outAddCard");
    $("#divBuscar").css("top",window.mobileCheck() ? -100 : 0);
    $("#inBuscar").focus();
    $("body").css("overflowY","hidden");
    $(".dashCard").css("transition",".3s");
    $(".dashCard").css("opacity","0");
    $("#divTiempo").css("opacity","0");
    setTimeout(()=>{

        if($abiertoSearch){
            $(".dashCard").css("display","none");
            $("#inBuscar").css("opacity","1");
            $("#inBuscar").css("width","100%");
        }
    
    },500);

    $abiertoSearch = true;
}

function cerrarSearch(){
    $("#dash").css("top","0%");
    $("#divBuscar").css("top",-window.innerHeight-100);
    $("#inBuscar").blur();
    $("body").css("overflowY","auto");
    $(".dashCard").css("opacity","0");
    $(".dashCard").css("transition",".3s");
    $(".dashCard").css("display","block");
    $("#inBuscar").css("width","0%");
    $("#inBuscar").css("opacity","0");
    setTimeout(()=>{
        if(!$abiertoSearch){
            $(".dashCard").css("opacity","1");
            $("#divTiempo").css("opacity","1");
            if(!$abiertoPerfil && !$abiertoListas)$("#addCard").removeClass("outAddCard");
        }
        setTimeout(()=>{
            if(!$abiertoSearch)$(".dashCard").css("transition","0s");
        },300);
    },500);
    $abiertoSearch = false;
}

$("#blockElecListas").click(cerrarOpcionesListas);




$('#inDates .date').datepicker({
    format: "yyyy-mm-dd",
    orientation: "bottom left",
    autoclose:true,
    language: "es"
});
$('#fechaHasta').datepicker("setDate",new Date());

$("#btnFechaDesde").click(()=>{
    $('#fechaDesde').datepicker("show");
});

$("#btnFechaHasta").click(()=>{
    $('#fechaHasta').datepicker("show");
});



$('#inDates .time').timepicker({
    'timeFormat': 'H:i:s' 
});

$('#horaHasta').timepicker('setTime', new Date());

$('#btnHoraDesde').on('click', function(){
    $('#horaDesde').timepicker('show');
});
$('#btnHoraHasta').on('click', function(){
    $('#horaHasta').timepicker('show');
});

$('#inDates').datepair({
    anchor:"end"
});


$("#inBuscar").keyup(filtrar);

$("#fechaHasta").change(filtrar);
$("#horaHasta").change(filtrar);

$("#fechaDesde").change(filtrar);
$("#horaDesde").change(filtrar);

$("#checkBuscar").change(filtrar);


function filtrar(){

    $("#divBuscar #listaGrupos").html("");
    $(".time").removeAttr("disabled");
    $.ajax({
        url:"/main/buscarGrupos/"+$("#horaDesde").val()+"/"+$("#horaHasta").val(),
        type:"POST",
        data:$("#formBuscar").serialize(),
        success:(xhr)=>{
            $gruposBusqueda = JSON.parse(xhr);
            $("#divBuscar #listaGrupos").html("");
            var classLight = "";
            if($estiloAuto && new Date().getHours()>=19)
                classLight = "lightGrupo";
            else
                if(!$estiloAuto)classLight = "lightGrupo";
             
            for(i=0;i<$gruposBusqueda.length;i++){
                
                $("#divBuscar #listaGrupos").append('<div class="col-6 col-sm-6 col-md-6 col-lg-3"><div id="cardGrupo'+$gruposBusqueda[i].idgrupo+'" class="card m-3  animated flipInY delay-'+(i+1)+'" ><i class="fas fa-users card-img-top"></i><div class="card-body"><h5 class="card-title">'+$gruposBusqueda[i].nombreGrupo+'</h5><p class="card-text"><small class="text-muted">'+$gruposBusqueda[i].fechaInicio+'</small></p><a href="main/verGrupo/'+$gruposBusqueda[i].idgrupo+'" class="btn btn-block btn-outline-success border-0">Ver</a><a href="#" id="anadirALista'+$gruposBusqueda[i].idgrupo+'" class="btn btn-block btn-outline-warning anadirALista border-0">Añadir</a></div></div></div>');
                
            }
            $(".anadirALista").click(abrirOpcionesListas);
        },
        error:(xhr)=>{
            console.log(xhr);
            abrirFeedback("Error al buscar grupos" ,"error");
        }
    });
    $(".time").attr("disabled","");

}