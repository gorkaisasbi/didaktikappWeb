
$(".anadirALista").click(abrirOpcionesListas);
$("#blockElecListas").click(cerrarOpcionesListas);
$(".elecLista").click(anadirALista);



function anadirALista(e){

    if($idGrupoAdd>-1){
        $idLista = e.target.id.substr("elecLista".length);
  
        $.ajax({
            url:"/main/anadirALista/"+$idLista+"/"+$idGrupoAdd,
            type:"GET",
            success:(xhr)=>{
                if(typeof($grupo) !== "undefined"){
                    $listas.find(lista=>lista.idlista==$idLista).grupos.push($grupo);
                }else{
                    $listas.find(lista=>lista.idlista==$idLista).grupos.push($gruposBusqueda.find(g=>g.idgrupo == $idGrupoAdd));
                    $("#lista"+$idLista+" #listaGrupos").append('<div class="col-12 col-sm-12 col-md-6 col-lg-3"><div id="grupo'+$idGrupoAdd+'" class="card m-3 divGrupo animated flipInY delay-1" ><i class="fas fa-users card-img-top"></i><div class="card-body"><h5 class="card-title">'+$gruposBusqueda.find(g=>g.idgrupo == $idGrupoAdd).nombreGrupo+'</h5><p class="card-text"><small class="text-muted">'+$gruposBusqueda.find(g=>g.idgrupo == $idGrupoAdd).fechaInicio+'</small></p><a href="main/verGrupo/'+$idGrupoAdd+'" class="btn btn-block btn-outline-success border-0">Ver</a><a href="main/eliminarDeLista/'+$idLista+'/'+$idGrupoAdd+'" class="btn btn-block btn-outline-danger border-0 eliminarDeLista">Eliminar</a></div></div></div>');
                    $(".eliminarDeLista").click(eliminarDeLista);
                }

                
                $("#lista"+$idLista+" #listaGrupos .infoNoHayGrupos").remove();
                abrirFeedback("Grupo añadido a la lista");
            },
            error:(xhr)=>{
                console.log(xhr);
                abrirFeedback("Error al añadir grupo a la lista" ,"error");
            },
            complete:()=>{
                cerrarOpcionesListas(); 
                if(typeof($grupo) === "undefined")updateCharts();
            }
        });
  
    }
  
  }
  
  function abrirOpcionesListas(e){
    e.preventDefault();
    $idGrupoAdd = e.target.id.substr("anadirALista".length);
    
    if($listas.length>0)$(".infoNoHayListaAnadir").remove();
  
    $result = $listas.filter(lista=> lista.grupos.filter(g=>g.idgrupo == $idGrupoAdd).length > 0);
    for(i=0;i<$result.length;i++){
        $("#elecLista"+$result[i].idlista).css("display","none");
    }
    if($result.length==$listas.length){
        $("#elecListas").append('<p class="infoNoHayListaAnadir text-center m-0">No tienes listas a las que añadir</p>');
    }
  
    $("#elecListas").css("display","block");
    $("#blockElecListas").css("display","block");
    setTimeout(()=>{
        $("#elecListas").css({
            "opacity":"1",
            "transform":"translate(-50%,-50%) scale(1)"
        });
        $("#blockElecListas").css("opacity","1");
    });
  
  }
  
  function cerrarOpcionesListas(){
    $idGrupoAdd = -1;
    $("#elecListas").css({
        "opacity":"0",
        "transform":"translate(-50%,-50%) scale(.1)"
    });
    $("#blockElecListas").css("opacity","0");
  
    setTimeout(()=>{
        $("#elecListas").css("display","none");
        $("#blockElecListas").css("display","none");
        $(".elecLista").css("display","block");
    },300);
  
  }