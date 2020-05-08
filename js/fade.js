const $tFade = setTimeout(()=>{
    $("#fade").css("opacity","0");

    setTimeout(()=>{
        $("#fade").css("display","none");
    },1000);

},500);

$("a[href!='#']").click((e)=>{
    var element = e.currentTarget;
    if(!element.classList.contains("noFade")){
        e.preventDefault();
        $("#fade").css("display","block");
        var newloc = element.href;
        setTimeout(()=>{
            $("#fade").css("opacity","1");

            setTimeout(()=>{
                window.location=newloc;
            },500);

        },100);
    }

});

