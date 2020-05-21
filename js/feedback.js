function abrirFeedback(msg,tipo,long){
    long = typeof long != 'undefined' ? true : false;

    if(tipo ==="error"){
        $("#feedback").css("backgroundColor","rgba(200,0,0,.7)");
    }
    $("#feedback").css("top",0);
    $("#feedback").css("opacity",1);
    $("#feedback > p").html(msg);
    setTimeout(()=>{
        cerrarFeedback();
    },(long)? 7000:2500);

}

function cerrarFeedback(){
    $("#feedback").removeAttr("style");
}