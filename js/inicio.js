$(document).ready(()=>{

    $.ajax({
        url:"/main/buscarGrupos",
        type:"POST",
        success:(xhr)=>{
            var $grupos = JSON.parse(xhr);
            for(i=0;i<$grupos.length;i++){
                $("#ultimosGruposLista").append('<div class="col-12 col-sm-6 col-md-6 col-lg-3"><div id="cardGrupo'+$grupos[i].idgrupo+'" class="card m-3" data-aos="flip-left" data-aos-anchor-placement="center-bottom" data-aos-delay="100" ><i class="fas fa-users card-img-top"></i><div class="card-body"><h5 class="card-title">'+$grupos[i].nombreGrupo+'</h5><p class="card-text"><small class="text-muted">'+$grupos[i].fechaInicio+'</small></p><div id="'+$grupos[i].idgrupo+'" class="btn btn-outline-success btn-block border-0">Ver</div></div></div></div> ');
            }
            if(AOS != undefined){
                AOS.init();
            }
            $("#divUltimosGrupos .card").click((e)=>{
                idGrupo = e.currentTarget.id;
                idGrupo = idGrupo.substr("cardGrupo".length);
                window.location = "/main/verGrupo/"+idGrupo;
            }); 

            $("#divUltimosGrupos .card btn").click((e)=>{
                idGrupo = e.currentTarget.id;
                window.location = "/main/verGrupo/"+idGrupo;
            }); 
        },
        error:(xhr)=>{
            console.log(xhr);
        }
    });


    


});