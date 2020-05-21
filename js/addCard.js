if(window.mobileCheck()){
    $("#addCard").removeClass("addActivo");
}

$("#btnAddCard").click(()=>{
    $("#addCard").css("clip-path","circle(200% at 0% 100%)");
    $("#addCard").css("backgroundColor","rgba(30, 30, 30, 0.9)");
    $("#addCard").css("color","white");
    if(window.mobileCheck())$("#addCard").css("paddingTop","100px");
    $("#div_boton").css("display","none");
});

$tBoton = null;
$("#addCard").hover(()=>{
    $("#div_boton").css("display","none");
    clearTimeout($tBoton);
    },()=>{
    $tBoton = setTimeout(()=>{
        $("#div_boton").removeAttr("style");
    },300);
});

$tAddActivo = null;
function cerrarAdd(){
    clearTimeout($tAddActivo);
    $("#addCard").removeClass("addActivo");
    $("#addCard").removeAttr("style");
    $("#div_boton").removeAttr("style");
    $("#addBuscarGrupo").removeAttr("style");
    $("#blockAddBuscar").removeAttr("style");
    $tAddActivo = setTimeout(()=>{
        if(!window.mobileCheck())$("#addCard").addClass("addActivo");
    },1000); 

}


$("#addCardListas").click(()=>{
    $.ajax({
        url:"/main/updateCardListas/1",
        type:"GET",
        success:(xhr)=>{
            $('#dash').append(xhr);
            $("#divAddCardListas").parent().css("display","none");
            cargarCards();
            updateCharts();
            cerrarAdd();
            abrirFeedback("Ventana añadida correctamente");
        },
        error:(xhr)=>{
            console.log(xhr);
            cerrarAdd();
            abrirFeedback("Error al eliminar la ventana" ,"error");
        }
    });
});

$("#addCardGrupo").click(()=>{

    $("#addBuscarGrupo").css("display","block");
    $("#blockAddBuscar").css("display","block");
    setTimeout(()=>{
        $("#addBuscarGrupo").css({
            "opacity":"1",
            "transform":"translate(-50%,-50%) scale(1)"
        });
        $("#blockAddBuscar").css({
            "opacity":"1"
        });
    });
    $("#inBuscarAdd").focus();

    filtrarGruposAdd();

});

$("#inBuscarAdd").keyup(filtrarGruposAdd);



$("#btnCerrarAdd").click(cerrarAdd);
$("#blockAddBuscar").click(cerrarSearchAdds);


function cerrarSearchAdds(){

    $("#addBuscarGrupo").css({
        "opacity":"0",
        "transform":"translate(-50%,-50%) scale(.1)"
    });
    $("#blockAddBuscar").css({
        "opacity":"0"
    });
    setTimeout(()=>{
        $("#addBuscarGrupo").css("display","none");
        $("#blockAddBuscar").css("display","none");
    },200);
}


function filtrarGruposAdd(){


    $.ajax({
        url:"/main/buscarGruposAdd/"+$("#inBuscarAdd").val(),
        type:"GET",
        success:(xhr)=>{
            $gruposBusquedaAdd = JSON.parse(xhr);
            $("#addBuscarGrupo #listaGruposAdd").html("");
            for(i=0;i<$gruposBusquedaAdd.length;i++){
                var $listasGrupo = $listas.filter(l=>l.grupos.filter(g=>g.idgrupo == $gruposBusquedaAdd[i].idgrupo).length>0);
                var $txtlistas = "";
                for(j=0;j<$listasGrupo.length;j++){
                    $txtlistas += $listasGrupo[j].nombreLista+" / ";
                }
                $txtlistas = $txtlistas.substr(0,$txtlistas.length-3);
                $("#addBuscarGrupo #listaGruposAdd").append('<div class="col-12 col-sm-12 col-md-6 col-lg-3"><div id="addGrupo'+$gruposBusquedaAdd[i].idgrupo+'" class="card m-3 divGrupoAdd animated flipInY delay-'+(i+1)+'" ><i class="fas fa-users card-img-top"></i><div class="card-body"><h5 class="card-title">'+$gruposBusquedaAdd[i].nombreGrupo+'</h5><p class="card-text"><small class="text-muted">['+$txtlistas+']</small><br><small class="text-muted">'+$gruposBusquedaAdd[i].fechaInicio+'</small></p><div id="'+$gruposBusquedaAdd[i].idgrupo+'" class="btn btn-outline-success btn-block border-0">Añadir</div></div></div></div> ');
            }
            $(".divGrupoAdd").click(addGrupo);
    
        },
        error:(xhr)=>{
            console.log(xhr);
            abrirFeedback("Error al buscar grupos a añadir" ,"error");
        }
    });

}


function addGrupo(e){
    var $idGrupo = e.currentTarget.id.substr("addGrupo".length);

    $.ajax({
        url:"/main/addCardGrupo/"+$idGrupo,
        type:"GET",
        success:(xhr)=>{
            $('#dash').append(xhr);
            updateCharts();
            cargarCards();
            cerrarAdd();
            abrirFeedback("Ventana añadida correctamente");
        },
        error:(xhr)=>{
            console.log(xhr);
            cerrarAdd();
            abrirFeedback("Error al añadir la ventana" ,"error");
        }
    });

}