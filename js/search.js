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

$(".elecLista").click(anadirALista);



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


function abrirOpcionesListas(e){
    e.preventDefault();
    $idGrupoAdd = e.target.id.substr("anadirALista".length);
    
    if($listas.length>0)$(".infoNoHayListaAnadir").remove();

    $result = $listas.filter(lista=> lista.grupos.filter(g=>g.idgrupo == $idGrupoAdd).length > 0);
    for(i=0;i<$result.length;i++){
        $("#elecLista"+$result[i].idlista).css("display","none");
    }
    if($result.length==$listas.length){
        $("#elecListas").append('<p class="infoNoHayListaAnadir text-center m-0">No tienes listas a las que añadir</p>');
    }

    $("#elecListas").css("display","block");
    $("#blockElecListas").css("display","block");
    setTimeout(()=>{
        $("#elecListas").css({
            "opacity":"1",
            "transform":"translate(-50%,-50%) scale(1)"
        });
        $("#blockElecListas").css("opacity","1");
    });

}

function cerrarOpcionesListas(){
    $idGrupoAdd = -1;
    $("#elecListas").css({
        "opacity":"0",
        "transform":"translate(-50%,-50%) scale(.1)"
    });
    $("#blockElecListas").css("opacity","0");

    setTimeout(()=>{
        $("#elecListas").css("display","none");
        $("#blockElecListas").css("display","none");
        $(".elecLista").css("display","block");
    },300);

}

function anadirALista(e){

    if($idGrupoAdd>-1){
        $idLista = e.target.id.substr("elecLista".length);

        $.ajax({
            url:"/main/anadirALista/"+$idLista+"/"+$idGrupoAdd,
            type:"GET",
            success:(xhr)=>{
                $listas.find(lista=>lista.idlista==$idLista).grupos.push($gruposBusqueda.find(g=>g.idgrupo == $idGrupoAdd))
                $("#lista"+$idLista+" #listaGrupos").append('<div id="grupo'+$idGrupoAdd+'" class="divGrupo"><i class="fas fa-users"></i><p>'+$gruposBusqueda.find(g=>g.idgrupo == $idGrupoAdd).nombreGrupo+'</p><div class="btnsLista"><a href="main/verGrupo/'+$idGrupoAdd+'" class="btn btn-outline-success border-0">Ver</a><a href="main/eliminarDeLista/'+$idLista+'/'+$idGrupoAdd+'" class="btn btn-outline-danger border-0 eliminarDeLista">Eliminar</a></div></div>');
                $("#lista"+$idLista+" #listaGrupos .infoNoHayGrupos").remove();
                $(".eliminarDeLista").click(eliminarDeLista);
                abrirFeedback("Grupo añadido a la lista");
            },
            error:(xhr)=>{
                console.log(xhr);
                abrirFeedback("Error al añadir grupo a la lista" ,"error");
            },
            complete:()=>{
                cerrarOpcionesListas(); 
                updateCharts();
            }
        });

    }

}

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
                $("#divBuscar #listaGrupos").append('<div class="divGrupo '+classLight+'"><i class="fas fa-users"></i><p>'+$gruposBusqueda[i].nombreGrupo+'</p><div class="btnsLista"><a href="main/verGrupo/'+$gruposBusqueda[i].idgrupo+'" class="btn btn-outline-success">Ver</a><a href="#" id="anadirALista'+$gruposBusqueda[i].idgrupo+'" class="btn btn-outline-warning anadirALista">Añadir</a></div></div>');
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