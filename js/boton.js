$medio = ((window.innerHeight/2)-$("#div_boton").height())*100/window.innerHeight;
$("#btn").click(()=>{
    if($("#div_boton").css("transform")=="matrix(1, 0, 0, 1, -37.5, -37.5)")
        abrirNavegacion();
    else
        cerrarNavegacion();
    
});

$("#btn-1").click(()=>{
    abrirPerfil();
    cerrarNavegacion();
});
$("#btn-2").click(()=>{
    abrirSearch();
    cerrarPerfil();
    cerrarListas();
    cerrarNavegacion();
});
$("#btn-3").click(()=>{
    cerrarPerfil();
    abrirListas();
    cerrarNavegacion();
});
$("#btn-4").click(()=>{
    cerrarSearch();
    cerrarPerfil();
    cerrarListas();
    cerrarNavegacion();
});
/************MOVIL****************/
$("#btn-1").on('touchstart',()=>{
    abrirPerfil();
});
$("#btn-2").on('touchstart',()=>{
    abrirSearch();
    cerrarPerfil();
    cerrarListas();
});
$("#btn-3").on('touchstart',()=>{
    cerrarPerfil();
    abrirListas();
});
$("#btn-4").on('touchstart',()=>{
    cerrarSearch();
    cerrarPerfil();
    cerrarListas();
});

function abrirNavegacion(){
    //DIV DEL BOTON
    $("#div_boton").css("transform","matrix(2, 0, 0, 2, -37.5, -37.5)");
    $("#div_boton").css("bottom",$medio+"%");
    $("#div_boton").css("left","50%");
    $("#div_boton").css("z-index","1001");
    $("#btn span").css("display","none");

   //BOTONES HIDDEN
    $("#btn-1").css("transform","rotate(360deg)  translateX(-120%)");
    $("#btn-2").css("transform","rotate(360deg) translateY(120%)");
    $("#btn-3").css("transform","rotate(360deg) translateX(120%)");
    $("#btn-4").css("transform","rotate(360deg) translateY(-120%)");


    //BOTON PRINCIPAL
    $("#btn img").attr("src","img/closeFino.svg");
    $("#btn").css("transform","rotate(360deg)");
    $("#btn").removeClass("bg-gradient1");
    $("#btn").addClass("bg-gradient2");

    //CAPA INTERMEDIA
    $("#block").css("z-index","1001");
    $("#block").css("opacity","1");

    $("#menu").addClass("blur");
    
}

function abrirNavegacionTouch(b,l){
    //DIV DEL BOTON
    $("#div_boton").css("transform","matrix(1.3, 0, 0, 1.3, -37.5, 37.5)");
    $("#div_boton").css("bottom",b);
    $("#div_boton").css("left",l);
    $("#div_boton").css("z-index","1001");
    $("#btn span").css("display","none");

   //BOTONES HIDDEN
    $("#btn-1").css("transform","rotate(360deg)  translateX(-120%)");
    $("#btn-2").css("transform","rotate(360deg) translateY(120%)");
    $("#btn-3").css("transform","rotate(360deg) translateX(120%)");
    $("#btn-4").css("transform","rotate(360deg) translateY(-120%)");


    //BOTON PRINCIPAL
    $("#btn img").attr("src","img/closeFino.svg");
    $("#btn").css("transform","rotate(360deg)");
    $("#btn").removeClass("bg-gradient1");
    $("#btn").addClass("bg-gradient2");

    //CAPA INTERMEDIA
    $("#block").css("z-index","1001");
    $("#block").css("opacity","1");

    $("#menu").addClass("blur");
    
}

function cerrarNavegacion(){
     $("#div_boton").css("transform","matrix(1, 0, 0, 1, -37.5, -37.5)");
       $("#div_boton").css("z-index","1000");
       $("#div_boton").css("bottom","0%");
       $("#div_boton").css("left","50%");
        $("#btn span").css("display","block");

       $("#btn-1").css("transform","rotate(0deg) translateX(0%)");
        $("#btn-2").css("transform","rotate(0deg) translateY(0%)");
        $("#btn-3").css("transform","rotate(0deg) translateX(0%)");
        $("#btn-4").css("transform","rotate(0deg) translateY(0%)");

       $("#btn img").attr("src","img/menu.svg");
       $("#btn").css("transform","rotate(0deg)");
        $("#btn").removeClass("bg-gradient2");
        $("#btn").addClass("bg-gradient1");

       $("#block").css("z-index","-1");
       $("#block").css("opacity","0");



       $("#menu").removeClass("blur");

}

