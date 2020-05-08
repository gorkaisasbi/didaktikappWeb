var hPerfil = $("#divPerfil").height();
$("#confPerfil").css("clip-path","polygon(0 80px, 10% 0%,100% 0, 100% 100%, 10% 100%,0 "+(hPerfil + 80)+"px)");

$(window).resize(function(){
    var hPerfil = $("#divPerfil").height();
    $("#confPerfil").css("clip-path","polygon(0 80px, 10% 0%,100% 0, 100% 100%, 10% 100%,0 "+(hPerfil + 80)+"px)");
});

$abiertoPerfil = false;
$(".btnConfPerfil").click(()=>{$abiertoPerfil ? cerrarPerfil() : abrirPerfil();});
$("#backPerfil").click(cerrarPerfil);



function abrirPerfil(){
    $("#dash").css("left","-85%");
    $("#addCard").addClass("outAddCard");
    $("#divBuscar").css("left","-85%");
    $("#divListas").css("left","-200%");
    $("#barra").css("left","-35%");
    $("#fecha").css("left","-25%");
    $("#hora").css("left","-75%");
    $("#divPerfil").css("right","85%");
    $("#confPerfil").css("left","15%");
    $("#backPerfil").css("display","block");
    setTimeout(()=>{if($abiertoPerfil)$("#backPerfil").css("opacity",.8);},500);
    $abiertoPerfil = true;
}

function cerrarPerfil(){
    $("#dash").css("left","0%");
    $("#divBuscar").css("left","0%");
    $("#divListas").css("left","-85%");
    $("#barra").css("left","50%");
    $("#fecha").css("left","75%");
    $("#hora").css("left","25%");
    $("#divPerfil").css("right","0%");
    $("#confPerfil").css("left","100%");
    $("#backPerfil").css("display","block");
    setTimeout(()=>{$("#backPerfil").css("opacity",0);},100);
    if(!$abiertoSearch)$("#addCard").removeClass("outAddCard");
    $abiertoPerfil = false;
}

$("#btnEditFoto").click(()=>{
    if($("#dropFoto").height()==0){
        $("#dropFoto").css("height",($("#dropFoto").width()/4)*3);
        $("#dropFoto").css("border-width","2px");
        setTimeout(()=>{$("#dropFoto > i").css("opacity","1")},300);
        $("#btnEditFoto").addClass("fa-window-close");
    }else{
        $("#dropFoto > i").css("opacity","0");
        setTimeout(()=>{
            $("#dropFoto").css("border-width","0px");
            $("#dropFoto").css("height",0);
            $("#btnEditFoto").removeClass("fa-window-close");
        },200);
    }

});

$("#tooglePass").click(()=>{
    if($("#inPass")[0].type === "password"){
        $("#inPass")[0].type = "text";
        $("#tooglePass").removeClass("fa-eye-slash");
        $("#tooglePass").addClass("fa-eye");
    }else{
        $("#inPass")[0].type = "password";
        $("#tooglePass").removeClass("fa-eye");
        $("#tooglePass").addClass("fa-eye-slash");
    }
});

$("#btnEditUser").click(()=>{
    if(!$("#btnEditUser").hasClass("fa-window-close")){
        txt = $("#inUser").val();
        $("#btnEditUser").addClass("fa-window-close");
        $("#saveUser").css("display","inline-block");
        setTimeout(()=>{
            $("#saveUser").css("opacity","1");
        },100);
        $("#inUser")[0].disabled = false;
        $("#inUser").addClass("editIn");
    }else{
        $("#btnEditUser").removeClass("fa-window-close");
        $("#saveUser").css("opacity","0");
        setTimeout(()=>{
            $("#saveUser").css("display","none");
        },100);
        $("#inUser")[0].disabled = true;
        $("#inUser").val(txt);
        $("#inUser").removeClass("editIn");
    }
});



$("#saveUser").click((e)=>{


    e.preventDefault();
        if($("#inUser").val()==""){
            //vacio
            abrirFeedback("Rellena todos los campos","error");
        }else{
            $.ajax({
                url:"/main/editUsername",
                type:"POST",
                data:$("#userForm").serialize(),
                success:(xhr)=>{
                    $("#btnEditUser").removeClass("fa-window-close");
                    $("#saveUser").css("opacity","0");
                    setTimeout(()=>{
                        $("#saveUser").css("display","none");
                    },100);
                    $("#inUser")[0].disabled = true;
                    $("#inUser")[0].size = xhr.length;
                    $("#inUser").val(xhr);
                    $("#inUser").removeClass("editIn");
                    $(".user").text(xhr);
                    abrirFeedback("Nombre de usuario actualizado correctamente");
                },
                error:(xhr)=>{
                    $("#btnEditUser").removeClass("fa-window-close");
                    $("#saveUser").css("opacity","0");
                    setTimeout(()=>{
                        $("#saveUser").css("display","none");
                    },100);
                    $("#inUser")[0].disabled = true;
                    $("#inUser").val(txt);
                    $("#inUser").removeClass("editIn");
                    abrirFeedback("Error al actualizar nombre de usuario: "+xhr.responseText,"error");
                }
            });

        }

});

$("form").submit((e)=>{e.preventDefault()});

$("#dropFoto").on("drop", function(e) {
    e.preventDefault();

    var files = e.originalEvent.dataTransfer.files;
    subirFoto(files);
});

$("#dropFoto").on("dragover", function(e) {
    e.preventDefault();
});

$("#dropFoto").click(()=>{
    $("#inFile").click();
});

$("#btnEditFotoMovil").click(()=>{
    $("#inFile").click();
});

$("#inFile").change((e)=>{
    var files = e.target.files;
    subirFoto(files);
});

$("#btnEditPass").click(()=>{
    if(!$("#btnEditPass").hasClass("fa-window-close")){
        $("#btnEditPass").addClass("fa-window-close");
        $("#tableCont > tbody").css("transform","none");

    }else{
        $("#btnEditPass").removeClass("fa-window-close");
        $("#tableCont > tbody").css("transform","translateY(-110%)");
    }
});

$("#btnGuardarPass").click((e)=>{
    e.preventDefault();
        if($("#pass1").val()==""||$("#pass2").val()==""){
            //vacio
            abrirFeedback("Rellena todos los campos","error");
        }else{
            if($("#pass1").val()!= $("#pass2").val()){
            //no igual
            abrirFeedback("Las contraseñas no coinciden","error");
            }else{
                $.ajax({
                    url:"/main/editPass",
                    type:"POST",
                    data:$("#formPass").serialize(),
                    success:(xhr)=>{
                        $("#inPass").val(xhr);
                        $("#btnEditPass").removeClass("fa-window-close");
                        $("#tableCont > tbody").css("transform","translateY(-110%)");
                        abrirFeedback("Contraseña actulizada correctamente");
                    },
                    error:(xhr)=>{
                        $("#btnEditPass").removeClass("fa-window-close");
                        $("#tableCont > tbody").css("transform","translateY(-110%)");
                        abrirFeedback("Error al actulizar contraseña: "+xhr.responseText,"error");
                    }
                });
            }

        }

});

$("#checkEstilo").change((e)=>{
    $.ajax({
        url:"/main/editEstilo/"+e.target.checked,
        type:"GET",
        success:(xhr)=>{
            $estiloAuto = e.target.checked;
            cambiarEstilo();
        },
        error:(xhr)=>{
            console.log(xhr);
            abrirFeedback("Error al actualizar el estilo automático","error");
        }
    });
});

function cambiarEstilo(){
    var d = new Date();
    var mapStyle = "dark";
    if($estiloAuto){
        if(d.getHours()<19){
            mapStyle = "light";
        } 
    }
    map.setStyle('mapbox://styles/mapbox/'+mapStyle+'-v10');
    
    map.on('sourcedata', function(e) {
        var layers = map.getStyle().layers;
        for (var i = 0; i < layers.length; i++) {
            if (layers[i].type === 'symbol') {
                // remove text labels
                map.removeLayer(layers[i].id);
            }
        }

    });

    if(mapStyle == "dark"){
        $("#backBuscar").css("display","none");
        $("#divBuscar .divGrupo").addClass("lightGrupo");
    }else{
        $("#backBuscar").css("display","block");
        $("#divBuscar .divGrupo").removeClass("lightGrupo");
    }


}

    

function subirFoto(files){

    if(files.length==1){
        var fd = new FormData();
        fd.append('file',files[0]);
        $.ajax({
            url:"/main/editFoto",
            type:"POST",
            data:fd,
            contentType: false,
            processData: false,
            success:(xhr)=>{

                var reader  = new FileReader();
                reader.onload = function(e)  {
                    $(".imgPerfil").attr("src",e.target.result);
                    setTimeout(()=>{
                        var hPerfil = $("#divPerfil").height();
                        $("#confPerfil").css("clip-path","polygon(0 80px, 10% 0%,100% 0, 100% 100%, 10% 100%,0 "+(hPerfil + 80)+"px)");
                    },100);
                }
                reader.readAsDataURL(files[0]);
                

                $("#dropFoto > i").css("opacity","0");
                setTimeout(()=>{
                    $("#dropFoto").css("border-width","0px");
                    $("#dropFoto").css("height",0);
                    $("#btnEditFoto").removeClass("fa-window-close");
                },200);
                abrirFeedback("Foto de perfil actualizada");


            },
            error:(xhr)=>{
                console.log(xhr);
                $("#dropFoto > i").css("opacity","0");
                setTimeout(()=>{
                    $("#dropFoto").css("border-width","0px");
                    $("#dropFoto").css("height",0);
                    $("#btnEditFoto").removeClass("fa-window-close");
                },200);
                abrirFeedback("Error al actualizar la foto","error");
            }
        });

    }else{
        abrirFeedback("Demasiados archivos arrastrados","error");
    }

}

