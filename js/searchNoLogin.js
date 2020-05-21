$(document).ready(()=>{
    setTimeout(()=>{
        $("#inSearchNoLogin").css({
            "opacity":"1",
            "width":"100%"
         });
         $("#inSearchNoLogin").focus();
         filtrar();
    },1000);

    $('#inDates .date').datepicker({
        format: "yyyy-mm-dd",
        orientation: "bottom left",
        autoclose:true,
        language: "es"
    });
    $('#fechaHasta').datepicker("setDate",new Date());
    
    $("#btnFechaDesde").click(()=>{
        $('#fechaDesde').datepicker("show");
    });
    
    $("#btnFechaHasta").click(()=>{
        $('#fechaHasta').datepicker("show");
    });
    
    
    
    $('#inDates .time').timepicker({
        'timeFormat': 'H:i:s' 
    });
    
    $('#horaHasta').timepicker('setTime', new Date());
    
    $('#btnHoraDesde').on('click', function(){
        $('#horaDesde').timepicker('show');
    });
    $('#btnHoraHasta').on('click', function(){
        $('#horaHasta').timepicker('show');
    });
    
    $('#inDates').datepair({
        anchor:"end"
    });


    $("#inSearchNoLogin").keyup(filtrar);

    $("#fechaHasta").change(filtrar);
    $("#horaHasta").change(filtrar);

    $("#fechaDesde").change(filtrar);
    $("#horaDesde").change(filtrar);

    
    
});


function filtrar(){

    $("#gruposSearch").html("");
    $(".time").removeAttr("disabled");
    $.ajax({
        url:"/main/buscarGrupos/"+$("#horaDesde").val()+"/"+$("#horaHasta").val(),
        type:"POST",
        data:$("#formBuscar").serialize(),
        success:(xhr)=>{
            console.log(xhr);
            $grupos = JSON.parse(xhr);
            $("#gruposSearch").html("");
               
            for(i=0;i<$grupos.length;i++){
                $("#gruposSearch").append('<div class="col-12 col-sm-6 col-md-6 col-lg-3"><div id="cardGrupo'+$grupos[i].idgrupo+'" class="card m-3  animated flipInY delay-'+(i+1)+'" ><i class="fas fa-users card-img-top"></i><div class="card-body"><h5 class="card-title">'+$grupos[i].nombreGrupo+'</h5><p class="card-text"><small class="text-muted">'+$grupos[i].fechaInicio+'</small></p><div id="'+$grupos[i].idgrupo+'" class="btn btn-outline-success btn-block border-0">Ver</div></div></div></div> ');
            }

            if(AOS != undefined){
                AOS.init();
            }

            $("#gruposSearch .card").click((e)=>{
                idGrupo = e.currentTarget.id;
                idGrupo = idGrupo.substr("cardGrupo".length);
                window.location = "/main/verGrupo/"+idGrupo;
            }); 

            $("#gruposSearch .card btn").click((e)=>{
                idGrupo = e.currentTarget.id;
                window.location = "/main/verGrupo/"+idGrupo;
            }); 

            limite = document.body.clientHeight - window.innerHeight;

        },
        error:(xhr)=>{
            console.log(xhr);
        }
    });
    $(".time").attr("disabled","");

}