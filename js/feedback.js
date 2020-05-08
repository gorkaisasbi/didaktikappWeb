function abrirFeedback(msg,tipo){
    if(tipo ==="error"){
        $("#feedback").css("backgroundColor","rgba(200,0,0,.7)");
    }
    $("#feedback").css("top",0);
    $("#feedback").css("opacity",1);
    $("#feedback > p").html(msg);
    setTimeout(()=>{
        cerrarFeedback();
    },2500);
}

function cerrarFeedback(){
    $("#feedback").removeAttr("style");
}