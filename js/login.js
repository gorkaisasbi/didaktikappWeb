$(document).ready(()=>{

    setTimeout(()=>{
        $(".formLogin").css("transform","none");
        setTimeout(()=>{
            $("#divLogin").addClass("shadow");
            $("#divLogin").css("overflow","visible");
        },500);
    },700);

    $(".closeFeed").click(cerrarError);

    $("#inLogin").click((e)=>{
        e.preventDefault();
        if($("[name='usuario']").val()==""|| $("[name='password']").val()==""){
            $(".feedback p").text("Rellena todos los campos");
            abrirError();
        }else{
            $.ajax({
                url:"/login/login",
                type:"POST",
                data:$("#loginForm").serialize(),
                success:(xhr)=>{
                    $("#fade").css("display","block");
                    setTimeout(()=>{
                        $("#fade").css("opacity","1");
                        setTimeout(()=>{$("#loginForm").submit();},1400);
                    },100);
                },
                error:(xhr)=>{
                    console.log(xhr);
                    msg = xhr.responseText.split("||");
                    $(".feedback p").text(msg[0]);
                    abrirError();
                }
            });

        }
    });



});

function abrirError(){
    $(".feedback").css("display","block");
    setTimeout(() => {
            $(".feedback").css({"transform":"translateY(-110%)","opacity":"1"});
        }, 50);

    t = setTimeout(cerrarError,3000);
}

function cerrarError(){
    clearTimeout(t);
    $(".feedback").css({"transform":"none","opacity":"0"});
    setTimeout(()=>{
        $(".feedback").css({"display":"none"});
    },300);

}