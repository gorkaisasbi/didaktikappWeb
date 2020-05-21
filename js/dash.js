$(document).ready(()=>{

    

    $("form").submit((e)=>{e.preventDefault();});

    /**************100 VH NO FUNCIONA BIEN EN MOVIL*****************/
    if(window.mobileCheck()){
        $("#divBuscar").css("height",window.innerHeight);
        $("#divBuscar").css("top",-window.innerHeight-100);
        $("#divBuscar").css("padding-top",200);
    }

    $("#deleteCard").css("top",window.innerHeight + window.pageYOffset);
    $(document).scroll(()=>{
        $("#deleteCard").css("top",window.innerHeight + window.pageYOffset);
    });
    $(window).resize(()=>{
        $("#deleteCard").css("top",window.innerHeight + window.pageYOffset);
    });

    

    currentMousePos = { x: -1, y: -1 };
    

    reloj();

    /*************LLAMADA DATOS TIEMPO******************/
    fetch("http://api.openweathermap.org/data/2.5/weather?q=O%C3%B1ati&units=metric&appid=88e9c3ff9e73edbb69e293e243e03db9").
    then(response=> response.json()).
    then(data=>{
        var temp = data.main.temp;
        var weather = data.weather[0];
        $("#divTiempo img").attr("src","http://openweathermap.org/img/wn/"+weather.icon+".png");
        $("#divTiempo p").text(temp+"ºC");

    });

    cargarCards();



      /********************MOVERSE POR APP CON TECLADO************************/ 
      $mayus = false;
      this.document.onkeydown = (e)=>{
        if(e.keyCode==39 && $mayus){
            if(!$abiertoListas){
                feedMover("feedPerfil");
                abrirPerfil();
            }else{
                cerrarListas();
                feedMover(($("#divBuscar").css("top") ==="0px")? "feedBuscar" : "feedDash");
            }
            
        }
        if(e.keyCode==37 && $mayus){
            if($abiertoPerfil){
                cerrarPerfil();
                feedMover(($("#divBuscar").css("top") ==="0px")? "feedBuscar" : "feedDash");
            }else{ 
                feedMover("feedListas");
                abrirListas();
            }
            
        }
        if(e.keyCode==38 && $mayus){
            abrirSearch();
            feedMover("feedBuscar");
        }
        if(e.keyCode==40 && $mayus){
            cerrarSearch();
            feedMover("feedDash");
        }
        if(e.keyCode == 16)$mayus = true;
    };

    this.document.onkeyup = (e)=>{
        if(e.keyCode == 16)$mayus = false;
        
    };

   /***************************MOVERSE POR APP EN EL MOVIL*********************************/
    $touchActivo =false;
    $activado = false;
    $("body").on('touchstart', handleTouchStart); 
    $("body").on('touchmove', handleTouchMove);
    $("body").on('touchend', ()=>{
        $touchActivo = false;
        $activado=false;
        cerrarNavegacion();
        clearTimeout(timeTouch);
    });

    var xDown = null;                                                        
    var yDown = null;

    function getTouches(evt) {
    return evt.touches ||             // browser API
            evt.originalEvent.touches; // jQuery
    }                                                     

    function handleTouchStart(evt) {
        $touchActivo = true;
        $activado=false;

        const firstTouch = getTouches(evt)[0];                                      
        xDown = firstTouch.clientX;                                      
        yDown = firstTouch.clientY; 
        timeTouch = setTimeout(() => {
            if($touchActivo){
                $activado = true;
                abrirNavegacionTouch(window.innerHeight - yDown,xDown);
            }   
        }, 500);                                   
    };                                                

    function handleTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;                                    
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;
        if($activado){
            if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
                if ( xDiff > 10 ) {
                    /* left swipe */ 
                    if(!$abiertoListas)abrirPerfil();
                    else cerrarListas();
                } else {
                    /* right swipe */
                    if($abiertoPerfil)cerrarPerfil();
                    else abrirListas();
                }                       
            } else {
                if ( yDiff > 10 ) {
                    /* up swipe */
                    cerrarSearch();
                } else { 
                    /* down swipe */
                    abrirSearch();
                }                                                                 
            }
        }else{
            $touchActivo = false;
            $activado=false;
        }
        
        cerrarNavegacion();
        /* reset values */
        xDown = null;
        yDown = null;                                             
    };

    cargarChartsGrupos();

});



function feedMover(idMover){
    $("#infoMove").css("display","block");
    $(".feedActivo").removeClass("feedActivo");
    $("#"+idMover).addClass("feedActivo");

    if($abiertoPerfil)$("#feedPerfil").addClass("feedActivo");
    if($abiertoListas)$("#feedListas").addClass("feedActivo");
    if($abiertoSearch)$("#feedBuscar").addClass("feedActivo");
    else $("#feedDash").addClass("feedActivo");

    setTimeout(()=>{
        $("#infoMove").css("display","none");
    },300);
}


function reloj(){
    
    $dia = new Date();
    var dia = $dia.getDate();
    var mes = $dia.getMonth()+1;
    if(dia<10){
        dia="0"+dia;
    }
    if(mes<10){
        mes="0"+mes;
    }
    $("#fecha").text(dia+"/"+mes+"/"+$dia.getFullYear());
    $auxS= "";
    $auxM= "";
    $auxH= "";
    if($dia.getSeconds()<10)
        $auxS = "0";
    if($dia.getMinutes()<10)
        $auxM = "0";

    if($dia.getHours()<10)
        $auxH = "0";

    $("#hora").text($auxH+$dia.getHours()+":"+$auxM+$dia.getMinutes()+":"+$auxS+$dia.getSeconds());
    
    setInterval(()=>{
        $dia = new Date();
        var dia = $dia.getDate();
        var mes = $dia.getMonth()+1;
        if(dia<10){
            dia="0"+dia;
        }
        if(mes<10){
            mes="0"+mes;
        }
        $("#fecha").text(dia+"/"+mes+"/"+$dia.getFullYear());
        $auxS= "";
        $auxM= "";
        $auxH= "";
        if($dia.getSeconds()<10)
            $auxS = "0";
        if($dia.getMinutes()<10)
            $auxM = "0";
       
        if($dia.getHours()<10)
            $auxH = "0";
       
        $("#hora").text($auxH+$dia.getHours()+":"+$auxM+$dia.getMinutes()+":"+$auxS+$dia.getSeconds());
    },1000);
    
}

function guardarDash(){
    dashB = [];
    for(i=0;i<$(".dashCard").length;i++){
        pos = $(".dashCard")[i].getBoundingClientRect();
        nTop= pos.top - document.body.getBoundingClientRect().top + "";
        nPos = {
            top: nTop,
            left: pos.left,
            width: pos.width,
            height: pos.height
        };

        if(i>0){
            var insert = -1;
            for(j=0;j<dashB.length;j++){
                var pos = dashB[j].posicion;
                if(pos.top > parseInt(nPos.top)){
                    insert= j;
                    break;
                }
            }
            if(insert != -1){
                dashB.splice(j,0,{
                    id:$(".dashCard")[i].id,
                    posicion:nPos
                });
            }else{
                dashB.push({
                    id:$(".dashCard")[i].id,
                    posicion:nPos
                });
            }

        }else{
            dashB.push({
                id:$(".dashCard")[i].id,
                posicion:nPos
            });
        }

            

    }
    dash = dashB;
    localStorage.setItem($idUsuario,JSON.stringify(dash));

    $.ajax({
        url:"/main/updateDash",
        type:"POST",
        data:{
            "dash": JSON.stringify(dash)
        },
        error:(xhr)=>{
            console.log(xhr);
            abrirFeedback("Error al guardar el dash" ,"error");
        }
    });
}



function updateCharts(){
    for(i=0;i<$charts.length;i++){
        $charts[i].destroy();
    }
    cargarChartsListas();
    cargarChartsGrupos();
    

}

function ratonDrop(e){
    currentMousePos.x = e.pageX;
    currentMousePos.y = e.pageY;
    if(currentMousePos.x > (window.innerWidth-$("#deleteCard").width()) && currentMousePos.y > ($("#deleteCard").css("top").substr(0,$("#deleteCard").css("top").length-2) - $("#deleteCard").height())){
        $("#deleteCard").addClass("dropActivo");
    }else{
        $("#deleteCard").removeClass("dropActivo");
    }
}

function cargarCards(){
    /***************SACAR LOS DASH CARDS*******************/

    dash = localStorage.getItem($idUsuario);
    dash = JSON.parse(dash);

    if(dash != null && dash != undefined || $usuarioDash != null && $usuarioDash != undefined){
        if(dash == null && dash == undefined)dash = $usuarioDash;
        arrDash = [];
        for(i=0;i<dash.length;i++){
            var l = dash[i].posicion.left;
            var w = dash[i].posicion.width;
            var t = parseInt(dash[i].posicion.top);
            var h = dash[i].posicion.height;
            arrDash.push($("#"+dash[i].id));

            $("#"+dash[i].id).css({
                top: t,
                left: l,
                width: w,
                height: h
            });
        }

        var lastT = parseInt($("#limite").css("padding-top").substr(0,2));
        var lastH = 0;
        var lastL = 0;
        var lastW = 0;

        var lw = $("#limite")[0].getBoundingClientRect().width;
        var topLimite = Math.abs($("#limite")[0].getBoundingClientRect().top);
        for(j=0;j<arrDash.length;j++){ 
            if(typeof arrDash[j][0] == "undefined"){
                continue;
            }
            var pos = arrDash[j][0].getBoundingClientRect();

            var l = pos.left;
            var w = pos.width;
            var t = pos.top;
            var h = pos.height;

            if((l+w)>lw){
                t = (lastT + lastH) + 20;
                l = ($("#limite")[0].getBoundingClientRect().width / 2) - (w/2);
                if((l+w)>lw){
                    w = $("#limite")[0].getBoundingClientRect().width -20;
                    l = ($("#limite")[0].getBoundingClientRect().width / 2) - (w/2);
                }
            }else{
                t+=topLimite;
            }

            if((t-(lastT + lastH))<0){
                if((lastL < l && l < (lastL + lastW)) || (l < lastL && lastL < (l + w)) )
                        t = (lastT + lastH) + 20;
            }
            
            

            $("#"+arrDash[j][0].id).css({
                top: t,
                left: l,
                width: w,
                height: h
            });
            lastT = t;
            lastH = h;
            lastL = l;
            lastW = w;
        }
    }

    
    if(window.mobileCheck()){
        $(".dashCard").css({
            "width":"90%",
            "left":"50%",
            "transform":"translateX(-50%)"
        });
    }

    /***************DASHBOARD CARDS******************/
    var axis = (window.mobileCheck()) ? "y":"";
    $(".dashCard").draggable({ 
        containment: "parent",
        stack: "#dash .dashCard",
        cursor: "move",
        axis:axis,
        start: function(e) {
            if(window.mobileCheck()){
                $(e.target).css("transform","none");
            }
            $("#deleteCard").css({
                "opacity":"1",
                "clip-path":"circle(100% at 100% 100%)"
            });
            $(document).mousemove(ratonDrop);
            
        },
        stop: function(e) {
            guardarDash();
            $("#deleteCard").css({
                "opacity":"0",
                "clip-path":"circle(0% at 100% 100%)"
            });
            $(document).unbind("mousemove");
            if($("#deleteCard").hasClass("dropActivo")){
                deleteCard(e.target);
            }
        }
    });
    $(".dashCard").resizable({
        animate: true,
        animateDuration: 500,
        ghost: true,
        stop: function(e) {
            setTimeout(()=>{
                guardarDash();
                $("#"+e.target.id+" .latPos").css("height",$("#"+e.target.id+" .rightNav").height()/$("#"+e.target.id+" .sec").length);
                
            },500);
        },
        resize: function(event, ui) {
            if(window.mobileCheck())ui.size.width = ui.originalSize.width;
        }
    });
    

    $(".rightNav p").on("click touchstart",(e)=>{
        $id = e.currentTarget.id.substr("sec".length);
        $("#"+e.currentTarget.parentElement.parentElement.id+" .cardInfo").css("top","-"+$id+"00%");
        var nTop = ($(e.currentTarget)[0].getBoundingClientRect().top + $(e.currentTarget)[0].getBoundingClientRect().height/2) - $(e.currentTarget.parentElement)[0].getBoundingClientRect().top 

        var hpost = $("#"+e.currentTarget.parentElement.parentElement.id+" .latPos").css("height");
        hpost = hpost.substr(0,hpost.length-2);

        $("#"+e.currentTarget.parentElement.parentElement.id+" .latPos").css("top",$id>0? nTop-(hpost/2)+"px": 0);
    });

    for(i=0;i<$(".dashCard .cardInfo").length;i++){
        var element = $($(".dashCard .cardInfo")[i]);
        var childs = $($(".dashCard .cardInfo")[i]).children().length;
        element.css("height",childs+"00%");
        $($(".dashCard .cardInfo")[i]).children().css("height", 100/childs+"%" );
        var $idPadre = element.parent()[0].id;
        $("#"+$idPadre+" .latPos").css("height",$("#"+$idPadre+" .rightNav").height()/$("#"+$idPadre+" .sec").length);

    }

    $(window).resize(function(e){
        if(e.target != window)
            return;
        var lastT = parseInt($("#limite").css("padding-top").substr(0,2));
        var lastH = 0;
        var lastL = 0;
        var lastW = 0;
        var lw = $("#limite")[0].getBoundingClientRect().width;
        for(j=0;j<arrDash.length;j++){ 

            var l = dash[j].posicion.left;
            var w = dash[j].posicion.width;
            var t = parseInt(dash[j].posicion.top);
            var h = dash[j].posicion.height;

            if((l+w)>lw){
                t = (lastT + lastH) + 20;
                l = ($("#limite")[0].getBoundingClientRect().width / 2) - (w/2);
                if((l+w)>lw){
                    w = $("#limite")[0].getBoundingClientRect().width -20;
                    l = ($("#limite")[0].getBoundingClientRect().width / 2) - (w/2);
                }
            }

            if((t-(lastT + lastH))<0){
                if((lastL < l && l < (lastL + lastW)) || (l < lastL && lastL < (l + w)) )
                        t = (lastT + lastH) + 20;
            }
            var transf = "none";
            if(window.mobileCheck()){
                w="90%";
                l="50%";
                transf="translateX(-50%)";
            }

            $("#"+arrDash[j][0].id).css({
                top: t,
                left: l,
                width: w,
                height: h,
                "transform":transf
            });

            lastT = t;
            lastH = h;
            lastL = l;
            lastW = w;
        }
    });

    $(".dashCard span").click((e)=>{
        deleteCard(e.target.parentElement.parentElement.parentElement);
    });
}


function deleteCard($target){

    if($target.id == 1){
        $.ajax({
            url:"/main/updateCardListas/0",
            type:"GET",
            success:(xhr)=>{
                $($target).remove();
                $("#divAddCardListas").parent().css("display","block");
                guardarDash();
                abrirFeedback("Ventana eliminada correctamente");
            },
            error:(xhr)=>{
                console.log(xhr);
                abrirFeedback("Error al eliminar la ventana" ,"error");
            }
        });
    }else{
        var $id = $target.id;
        if($id.indexOf("cardGrupo")>-1){
            //ELIMINAR CARD GRUPO
            var $idGrupo = $id.substr(("cardGrupo"+$idUsuario).length);
            $.ajax({
                url:"/main/deleteCardGrupo/"+$idGrupo,
                type:"GET",
                success:(xhr)=>{
                    $($target).remove();
                    guardarDash();
                    abrirFeedback("Ventana eliminada correctamente");
                },
                error:(xhr)=>{
                    console.log(xhr);
                    abrirFeedback("Error al eliminar la ventana" ,"error");
                }
            });

        }


    }

}