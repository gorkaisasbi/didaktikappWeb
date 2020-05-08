
$("#divListas > info").css("clip-path"," polygon(0 0%, 97% 0%, 100% 80px, 100% "+(80+$("#slapListas").height())+"px , 97% 100%, 0 100%)");


$abiertoListas = false;

$("#btnListas").click(()=>{
    if(!$abiertoListas)
        abrirListas();
    else
        cerrarListas()
});
$("#backListas").click(cerrarListas);

$lW = 0;
$lH = 0;
$lT = 0;
$lL = 0;
$(".lista").click(abrirLista);

$("#blockListas").click(cerrarLista);

$("#btnCrearLista").click(()=>{
    if($("#divCrearLista").css("height")=="0px"){
        $("#divCrearLista").css("height","100px");
        $("#btnCrearLista").text("Cerrar");
        $("#btnCrearLista").addClass("btn-outline-danger");
        $("#divCrearLista input").focus();
    }else{
        $("#divCrearLista").css("height","0px");
        $("#btnCrearLista").text("Crear nueva lista");
        $("#btnCrearLista").removeClass("btn-outline-danger");
        $("#divCrearLista input").val("");
    }
});

$("#btnBuscarListas").click(()=>{
    if($("#inBuscarLista").css("width")=="4px"){
        $("#btnBuscarListas").removeClass("fas");
        $("#btnBuscarListas").addClass("far fa-times-circle");
        $("#inBuscarLista").css("width","50%");
        $("#inBuscarLista").css("borderColor","#0072ff");
        $("#inBuscarLista").focus();
    }else{
        $("#inBuscarLista").val("");
        $("#inBuscarLista").removeAttr("style");   
        $("#btnBuscarListas").removeClass("far fa-times-circle"); 
        $("#btnBuscarListas").addClass("fas");
        $(".contLista").removeAttr("style");
    }
    
});

$("#inBuscarLista").keyup(()=>{
    $(".contLista").css("display","none");
    $result = $listas.filter(lista => lista.nombreLista.toLowerCase().indexOf($("#inBuscarLista").val().toLowerCase())>=0);
    for(i=0;i<$result.length;i++){
        $("#lista"+$result[i].idlista+".contLista").css("display","block");
    }

});


$(".buscarGrupo").keyup(buscarGrupo);

$(".eliminarDeLista").click(eliminarDeLista);


$("#btnCrearListaSubmit").click(()=>{
    if($("#divCrearLista input").val()==""){
        abrirFeedback("Rellena todos los campos","error");
    }else{
        $.ajax({
            url:"/main/crearLista",
            type:"POST",
            data:$("#formCrearLista").serialize(),
            success:(xhr)=>{

                $nLista = JSON.parse(xhr);
                $listas.push($nLista);
                $("#elecListas ul").append('<li id="elecLista'+$nLista.idlista+'" class="list-group-item elecLista">'+$nLista.nombreLista+'</li>');
                $('#listListas').append('<div id="lista'+$nLista.idlista+'" class="col-12 col-md-4 p-3 contLista"><div class="lista card text-center p-5"><i class="fas fa-list-ul"></i><div class="card-body"><h5 class="card-title">'+$nLista.nombreLista+'</h5><input type="text" name="nombreGrupo" class="buscarGrupo" id="inBuscaGrupo,'+$nLista.idlista+'" placeholder="Nombre de grupo"/></div> <div id="listaGrupos" class="mt-5"><p class="mt-3 infoNoHayGrupos">No hay grupos en esta lista todavía</p></div><div id="'+$nLista.idlista+'" class="btn btn-outline-danger eliminarLista">Eliminar</div> </div></div>'); 
                $("#listListas").append('<div id="lista'+$nLista.idlista+'" class="col-12 col-md-4 backup d-none"></div>');
                $(".lista").click(abrirLista);
                $(".eliminarLista").click(eliminarLista);
                $(".elecLista").click(anadirALista);
                $(".buscarGrupo").keyup(buscarGrupo);
                
                $("#divCrearLista").css("height","0px");
                $("#btnCrearLista").text("Crear nueva lista");
                $("#btnCrearLista").removeClass("btn-outline-danger");
                abrirFeedback("Lista <b>"+$("#divCrearLista input").val()+"</b> creada correctamente");
                $("#divCrearLista input").val("");
                updateCharts();
            },
            error:(xhr)=>{
                $("#divCrearLista").css("height","0px");
                $("#btnCrearLista").text("Crear nueva lista");
                $("#btnCrearLista").removeClass("btn-outline-danger");
                $("#divCrearLista input").val("");
                abrirFeedback("Error al crear la lista: "+xhr.responseText,"error");
            }
        });
    }
});

$btnEliminar = false;
$(".eliminarLista").click(eliminarLista);

$abiertoLista = false;
function abrirLista(e){
    target = e.currentTarget;
    pTarget = target.parentElement;
    if(!$abiertoLista&& !$btnEliminar){
        $abiertoLista = true;
        $(".buscarGrupo").val("");
        $lW = $(pTarget)[0].getBoundingClientRect().width;
        $lH = $(pTarget)[0].getBoundingClientRect().height;
        $lT = $(pTarget)[0].getBoundingClientRect().top;
        $lL = $(pTarget)[0].getBoundingClientRect().left;

        $(pTarget).css("width",$(pTarget).width());
        $(pTarget).css("height",$(pTarget).height());
        $(pTarget).css("top",$(pTarget).position().top);
        $(pTarget).css("left",$(pTarget).position().left);
        $(pTarget).removeClass("col-12");
        $(pTarget).removeClass("col-md-4");
        $("#"+pTarget.id+".backup").removeClass("d-none");
        $(pTarget).css("position","fixed");
        $("#blockListas").css("display","block");
        $("#div_boton").addClass("d-none");
        setTimeout(()=>{
            $(pTarget).addClass("trans");
            $(pTarget).css({
                "z-index":"2",
                "width":"90%",
                "top":"50%",
                "left":"50%",
                "transform":"translate(-50%,-50%)" 
            });
            $("#blockListas").css("opacity","1");
            
            setTimeout(()=>{
                $(pTarget).css("height","90%");
                $(target).css("height","100%"); 
                $("#"+pTarget.id+" input").css("display","block");
                $(target).find("#listaGrupos").css("display","block");
                $("#"+pTarget.id+" input").focus();
                setTimeout(()=>{
                    $("#"+pTarget.id+" input").css("width","50%");
                    $("#"+pTarget.id+" input").css("borderColor","#0072ff");
                },500);
            },500);
        },0);
    }
}

function cerrarLista(){
    if($abiertoLista){

        $abiertoLista = false;
        $btnEliminar = false;
        $(target).find("#listaGrupos").css("display","none");
        $(".divGrupo").css("display","flex");
        $("#"+pTarget.id+" input").css("width","0%");
        $("#"+pTarget.id+" input").css("borderColor","transparent");
        $(pTarget).css({
            "z-index":"1",
            "height":"0"
        });
        $(target).css("height","auto");

        setTimeout(()=>{
            $("#"+pTarget.id+" input").css("display","none");
            $(pTarget).css({
                "top":$lT,
                "left":$lL,
                "width":$lW,
                "transform":"none"
            });
            $("#blockListas").css("opacity","0");
            $("#div_boton").removeClass("d-none");
            setTimeout(()=>{
                $(pTarget).removeAttr("style");
                $("#"+pTarget.id+".backup").addClass("d-none");
                $(pTarget).addClass("col-12");
                $(pTarget).addClass("col-md-4");
                $(pTarget).removeClass("trans");
                $("#blockListas").css("display","none");
            
            },500); 

        },500);
    }
}


function eliminarLista(e){

    $btnEliminar = true;
    cerrarLista();
    $id = e.target.id;
    $.ajax({
        url:"/main/eliminarLista/"+$id,
        type:"GET",
        success:(xhr)=>{
            $("#lista"+$id).remove();
            $("#lista"+$id).remove();
            $listas.splice($listas.indexOf($listas.find(l=>l.idlista==$id)),1);
            $("#elecLista"+$id).remove();
            abrirFeedback("Lista eliminada correctamente");
            $btnEliminar = false;
            $abiertoLista = false;
            updateCharts();
        },
        error:(xhr)=>{
            abrirFeedback("Error al eliminar la lista" ,"error");
            $btnEliminar = false;
            $abiertoLista = false;
        }
    });

}

function abrirListas(){
    t = window.pageYOffset;
    $("#dash").css("transition","0s");
    $("#dash").css("top",-t);
    $("#dash").css("position","fixed");
    $("#addCard").addClass("outAddCard");
    setTimeout(()=>{
        $("#dash").css("transition",".5s");
        $("#divListas").css("left",0);
        $("#dash").css("left","85%");
        $("#divBuscar").css("left","85%");
        $("#divPerfil").css("right","-100%");
        $("#confPerfil").css("left","200%");
        $("#barra").css("left","150%");
        $("#fecha").css("left","175%");
        $("#hora").css("left","125%");
        $("#backListas").css("display","block");
        setTimeout(()=>{if($abiertoListas)$("#backListas").css("opacity",.8);},500);
        $abiertoListas = true;
    },0);
}

function cerrarListas(){
    $("#divListas").css("left","-85%");
    $("#dash").css("left","0%");
    if(!$abiertoSearch)$("#addCard").removeClass("outAddCard");
    $("#divBuscar").css("left","0%");
    $("#divPerfil").css("right","0%");
    $("#confPerfil").css("left","100%");
    $("#barra").css("left","50%");
    $("#fecha").css("left","75%");
    $("#hora").css("left","25%");
    $("#backListas").css("display","block");
    setTimeout(()=>{$("#backListas").css("opacity",0);},100);
    setTimeout(()=>{
        if(!$abiertoListas){
            $("#dash").css("position","absolute");
            $("#dash").css("top",($abiertoSearch) ? "100%" : "0");
            if(typeof(t) != "undefined")window.scrollTo(0, t);
        }
    },500);
    $abiertoListas = false;
}

function eliminarDeLista(e){

    e.preventDefault();
    $sp = e.target.href.split("/");
    $idlista = $sp[$sp.length-2];
    $idgrupo = $sp[$sp.length-1];
    $.ajax({
        url:e.target.href,
        type:"GET",
        success:(xhr)=>{
            $("#lista"+$idlista+" #grupo"+$idgrupo).remove();
            if($("#lista"+$idlista+" #listaGrupos").children().length==0){
                $("#lista"+$idlista+" #listaGrupos").append('<p class="mt-3 infoNoHayGrupos">No hay grupos en esta lista</p>');
            }

            var gs = $listas.find(lista=>lista.idlista==$idlista).grupos;
            gs.splice(gs.indexOf(gs.find(g=>g.idgrupo==$idgrupo)),1);
            abrirFeedback("Grupo eliminado de la lista");
            updateCharts();
        },
        error:(xhr)=>{
            abrirFeedback("Error al eliminar grupo de la lista","error");
        }
    });

}

function buscarGrupo(e){
    
    $(".divGrupo").css("display","none");
    $id = e.target.id;
    $idlista = $id.split(",")[1];
    $grupos = $listas.filter(lista => lista.idlista == $idlista)[0].grupos;
    $result = $grupos.filter(grupo => grupo.nombreGrupo.toLowerCase().indexOf($("#lista"+$idlista+" .buscarGrupo").val().toLowerCase())>=0);
    for(i=0;i<$result.length;i++){
        $("#grupo"+$result[i].idgrupo+".divGrupo").css("display","flex");
    }
    
}