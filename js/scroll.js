var limite = document.body.clientHeight - window.innerHeight;
var hTotal = $("#scroll").height();
$("#scroll").height("20");
$(window).scroll(()=>{
    var nHeight = (hTotal * scrollY) / limite;
    if(nHeight<20){
        nHeight = 20;
    }
    $("#scroll").height(nHeight);

});