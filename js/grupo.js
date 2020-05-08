$(document).ready(()=>{
  /************100VH NO FINCIONA BIEN EN MOVIL************/
  $("#chartSide").css("height",window.innerHeight);
  $("#mapSide").css("height",window.innerHeight);

 

    $zoom = 17.5;
    if(window.innerWidth<700){
      $zoom=16.5;
    }
    clearTimeout($tFade);
    $center = [-2.414270, 43.033371];
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ29ya2Fpc2FzYmkiLCJhIjoiY2pwczA1eXhzMHJ2dDN4bXo3aW1yZzlnOCJ9.FK1iEuF4xGYwUOFeQDghlA';
    map = new mapboxgl.Map({
        container: 'mapaGrupo',
        style: 'mapbox://styles/mapbox/dark-v10',
        center: $center,
        zoom: $zoom,
        minZoom: 16.6,
        maxZoom: 18.5,
        interactive:false,
        attributionControl: false,
        pitch: 65
    });;
    var coords =[];
    if($grupo.idAct1 != null){
      coords = coords.concat([
        [
          -2.410351037979126,
          43.02873740844629
        ],
        [
          -2.4104905128479004,
          43.029419737216735
        ],
        [
          -2.410447597503662,
          43.02960012171592
        ],
        [
          -2.4104583263397217,
          43.02967854959371
        ],
        [
          -2.410597801208496,
          43.0298275622854
        ],
        [
          -2.410672903060913,
          43.02993736087937
        ],
        [
          -2.4107587337493896,
          43.03005500201208
        ],
        [
          -2.410780191421509,
          43.03020401378983
        ],
        [
          -2.410780191421509,
          43.03028244089599
        ],
        [
          -2.410769462585449,
          43.03039223867622
        ],
        [
          -2.4106943607330322,
          43.03063536163346
        ],
        [
          -2.410672903060913,
          43.030847113101885
        ],
        [
          -2.4106836318969727,
          43.03092553938626
        ],
        [
          -2.41074800491333,
          43.030980437725724
        ],
        [
          -2.4110805988311768,
          43.031278456425895
        ],
        [
          -2.4110376834869385,
          43.03132551187785
        ],
        [
          -2.410919666290283,
          43.031435307792094
        ],
        [
          -2.410844564437866,
          43.03163137143618
        ],
        [
          -2.41074800491333,
          43.031866646982294
        ],
        [
          -2.4106836318969727,
          43.032062709248436
        ],
        [
          -2.410705089569092,
          43.032258770888234
        ],
        [
          -2.410705089569092,
          43.032392092445534
        ],
        [
          -2.4107372760772705,
          43.032423462181626
        ],
        [
          -2.410823106765747,
          43.032439147043654
        ],
        [
          -2.410801649093628,
          43.03248620160572
        ],
        [
          -2.4108338356018066,
          43.032517571293695
        ],
        [
          -2.4112308025360107,
          43.0327842129943
        ],
        [
          -2.4113595485687256,
          43.03294890287767
        ],
        [
          -2.411724328994751,
          43.033254754345755
        ],
        [
          -2.4118745326995845,
          43.03334101986885
        ],
        [
          -2.411971092224121,
          43.033380231430186
        ],
        [
          -2.412368059158325,
          43.03385076821189
        ],
        [
          -2.412443161010742,
          43.03410171968699
        ],
        [
          -2.4125397205352783,
          43.03441540758775
        ],
        [
          -2.4126577377319336,
          43.03465851460801
        ],
        [
          -2.412722110748291,
          43.03478398882229
        ],
        [
          -2.412818670272827,
          43.03489377854936
        ]
      ]);
    }
    if($grupo.idAct2 != null){
      coords = coords.concat([
        [
          -2.412797212600708,
          43.034909462780035
        ],
        [
          -2.4126791954040527,
          43.03475262029277
        ],
        [
          -2.4126148223876953,
          43.034533040137184
        ],
        [
          -2.4125289916992188,
          43.03432914357488
        ],
        [
          -2.4124538898468018,
          43.034172299604464
        ],
        [
          -2.412421703338623,
          43.033999770773974
        ],
        [
          -2.4123895168304443,
          43.03390566393475
        ],
        [
          -2.412400245666504,
          43.03385861046102
        ],
        [
          -2.412443161010742,
          43.03382724145849
        ],
        [
          -2.4125075340270996,
          43.03385861046102
        ],
        [
          -2.4127650260925293,
          43.03399192854289
        ],
        [
          -2.4128615856170654,
          43.03401545523317
        ],
        [
          -2.412947416305542,
          43.0339527173724
        ],
        [
          -2.4130761623382564,
          43.03387429495626
        ],
        [
          -2.4132370948791504,
          43.03374097661886
        ],
        [
          -2.4133872985839844,
          43.03367039620531
        ],
        [
          -2.4134302139282227,
          43.033615500272006
        ],
        [
          -2.413398027420044,
          43.03355276200237
        ],
        [
          -2.4133658409118652,
          43.03345865447765
        ],
        [
          -2.413376569747925,
          43.033395916047695
        ],
        [
          -2.413945198059082,
          43.03338807373944
        ]
      ]);
    }
    if($grupo.idAct3 != null){
      coords = coords.concat([
        [
          -2.4139773845672607,
          43.033395916047695
        ],
        [
          -2.414020299911499,
          43.03380371469605
        ],
        [
          -2.4141061305999756,
          43.03412524633515
        ],
        [
          -2.4141061305999756,
          43.0342585638378
        ],
        [
          -2.4141275882720947,
          43.034289932619856
        ],
        [
          -2.414224147796631,
          43.03428209042585
        ],
        [
          -2.414342164993286,
          43.034274248230815
        ],
        [
          -2.4145460128784175,
          43.03425072163977
        ],
        [
          -2.4147284030914307,
          43.03424287944075
        ],
        [
          -2.41499662399292,
          43.0342271950397
        ],
        [
          -2.4152326583862305,
          43.0342271950397
        ],
        [
          -2.4154794216156006,
          43.03425072163977
        ]
      ]);
    }
    if($grupo.idAct4 != null){
      coords = coords.concat([
        [
          -2.4155008792877197,
          43.0342546427389
        ],
        [
          -2.415270209312439,
          43.03424287944075
        ],
        [
          -2.4150609970092773,
          43.03423895834086
        ],
        [
          -2.4148571491241455,
          43.0342271950397
        ],
        [
          -2.414696216583252,
          43.034235037240734
        ],
        [
          -2.4146103858947754,
          43.03424680054039
        ],
        [
          -2.414535284042358,
          43.03425072163977
        ],
        [
          -2.414519190788269,
          43.034172299604464
        ],
        [
          -2.4145084619522095,
          43.034070350808726
        ],
        [
          -2.4144816398620605,
          43.03394879625399
        ],
        [
          -2.41449236869812,
          43.03383508371061
        ],
        [
          -2.4145084619522095,
          43.03368215961321
        ],
        [
          -2.4145138263702393,
          43.033584131145204
        ],
        [
          -2.414519190788269,
          43.033509629404776
        ],
        [
          -2.414524555206299,
          43.03348218137238
        ],
        [
          -2.415173649787903,
          43.03356060428959
        ],
        [
          -2.4154257774353027,
          43.0335998157106
        ],
        [
          -2.4156779050827026,
          43.03363902710658
        ],
        [
          -2.4157851934432983,
          43.033693923018845
        ],
        [
          -2.415817379951477,
          43.03377626679517
        ],
        [
          -2.4158924818038936,
          43.03380371469605
        ],
        [
          -2.4159353971481323,
          43.03382724145849
        ],
        [
          -2.416042685508728,
          43.03397232296078
        ]
      ]);
    }
    if($grupo.idAct5 != null){
      coords = coords.concat( [
        [
          -2.4160587787628174,
          43.0339605596085
        ],
        [
          -2.415940761566162,
          43.03383900483631
        ],
        [
          -2.4159353971481323,
          43.033807635823756
        ],
        [
          -2.4160104990005493,
          43.03377234566548
        ],
        [
          -2.4160319566726685,
          43.033717449823364
        ],
        [
          -2.4160158634185787,
          43.03367039620531
        ],
        [
          -2.416005134582519,
          43.03364294824479
        ],
        [
          -2.416021227836609,
          43.0335919734284
        ],
        [
          -2.4160534143447876,
          43.033513550551284
        ],
        [
          -2.416042685508728,
          43.03341160066121
        ],
        [
          -2.4160104990005493,
          43.03332925639558
        ],
        [
          -2.4159622192382812,
          43.033270438995345
        ],
        [
          -2.415881752967834,
          43.03323514852815
        ],
        [
          -2.4157798290252686,
          43.03318025220549
        ],
        [
          -2.4157047271728516,
          43.0331410405164
        ],
        [
          -2.415640354156494,
          43.033101828802266
        ],
        [
          -2.4156081676483154,
          43.03307830176174
        ],
        [
          -2.4155813455581665,
          43.033050853536395
        ],
        [
          -2.4155813455581665,
          43.03301948412098
        ],
        [
          -2.4155867099761963,
          43.032952824060004
        ],
        [
          -2.415592074394226,
          43.03290576985571
        ],
        [
          -2.4156028032302856,
          43.03288616392661
        ],
        [
          -2.415790557861328,
          43.03290184867037
        ]
      ]);
    }
    if($grupo.idAct6 != null){
      coords = coords.concat([
        [
          -2.415790557861328,
          43.03290576985571
        ],
        [
          -2.4152112007141113,
          43.032854794426996
        ],
        [
          -2.4148839712142944,
          43.0328391096712
        ],
        [
          -2.4147284030914307,
          43.0328195037208
        ],
        [
          -2.414599657058716,
          43.03279989776415
        ],
        [
          -2.4144279956817627,
          43.0327842129943
        ],
        [
          -2.4142858386039734,
          43.03277637060788
        ],
        [
          -2.4142134189605713,
          43.032772449414274
        ],
        [
          -2.4141651391983032,
          43.03277048881739
        ],
        [
          -2.4141061305999756,
          43.03277048881739
        ],
        [
          -2.414047122001648,
          43.03277048881739
        ],
        [
          -2.4140390753746033,
          43.032695986089266
        ],
        [
          -2.4140310287475586,
          43.032637168082104
        ],
        [
          -2.414025664329529,
          43.03258031062159
        ],
        [
          -2.4140390753746033,
          43.0325038470572
        ]
      ]);
    }
    map.on('load', function() {
    
        // Add 3d buildings and remove label layers to enhance the map
        var layers = map.getStyle().layers;
        for (var i = 0; i < layers.length; i++) {
            if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
                // remove text labels
                map.removeLayer(layers[i].id);
            }
        }
        map.addSource('ruta', {
            'type': 'geojson',
            'data': {
                "type": "Feature",
                "properties": {},
                "geometry": {
                  "type": "LineString",
                  "coordinates": coords
                }
            }
            });
            map.addLayer({
            'id': 'ruta',
            'type': 'line',
            'source': 'ruta',
            'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': '#0072ff',
                    'line-width': 5
                }
            });

            $("#fade").css("opacity","0");
        
            setTimeout(()=>{
                $("#fade").css("display","none");
            },1000);
        

    });


    /*******************AÑADIR MARKERS*********************/
    arrMarkers =[];
    var marker1 = new mapboxgl.Marker({
        "element":$("div.1")[0]
    })
    .setLngLat([
        -2.412889,
        43.035
    ])
    .addTo(map);
    arrMarkers.push(marker1);
      
    var marker2 = new mapboxgl.Marker({
        "element":$("div.2")[0]
    })
    .setLngLat([
        -2.4139773845672607,
        43.03337631027518
    ])
    .addTo(map);
    arrMarkers.push(marker2);
  

    var marker3 = new mapboxgl.Marker({
        "element":$("div.3")[0]
    })
    .setLngLat([
        -2.415447235107422,
        43.0342585638378
    ])
    .addTo(map);
    arrMarkers.push(marker3);
  

    var marker4 = new mapboxgl.Marker({
        "element":$("div.4")[0]
    })
    .setLngLat([
        -2.416069507598877,
        43.0339684018436
    ])
    .addTo(map);
    arrMarkers.push(marker4);
  


    var marker5 = new mapboxgl.Marker({
        "element":$("div.5")[0]
    })
    .setLngLat([
        -2.4158066511154175,
        43.03292145459449
    ])
    .addTo(map);
    arrMarkers.push(marker5);
  

    var marker6 = new mapboxgl.Marker({
        "element":$("div.6")[0]
    })
    .setLngLat([
        -2.4140900373458862,
        43.03238032879034
    ])
    .addTo(map);
    arrMarkers.push(marker6);
  


    
    $(".marker.markerInactivo").click((e)=>{
        e.preventDefault();
        e.stopPropagation();
    });
    $(".marker > div").click((e)=>{
        abrirActividad(parseInt(e.currentTarget.offsetParent.id));
    });

    $("ul > li").click((e)=>{
        abrirActividad(parseInt(e.currentTarget.id));
    });

    $("#btnChart").click(abrirCharts);

    $("#btnMap").click(cerrarCharts);

    $(".closeModalMap").click(cerrarActs);


    /********************MOVERSE POR APP CON TECLADO************************/ 
    $chartsAbierto = false;
    $mayus = false;
    $n = 0;
    $nAnt = 0;
    this.document.onkeydown = (e)=>{ 
      if(e.keyCode==37 && $mayus && $chartsAbierto){
        $nAnt = $n;
        $n -=1;
        if($n<1)$n = 1;
          abrirActividad($n);
      }
      if(e.keyCode==38 && $mayus){
        cerrarCharts();
      }
      if(e.keyCode==39 && $mayus && $chartsAbierto){
        $nAnt = $n;
        $n +=1;
        if($n>6)$n =6;
          abrirActividad($n);
    }
      if(e.keyCode==40 && $mayus){
        abrirCharts();
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
       cerrarNav();
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
       setTimeout(() => {
           if($touchActivo){
               $activado = true;
               abrirNav(yDown,xDown);
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
                  $nAnt = $n;
                  $n +=1;
                  if($n>6)$n =6;
                    abrirActividad($n);
               } else {
                   /* right swipe */
                  $nAnt = $n;
                  $n -=1;
                  if($n<1)$n = 1;
                    abrirActividad($n);
               }                       
           } else {
               if ( yDiff > 10 ) {
                   /* up swipe */
                   abrirCharts();
               } else { 
                   /* down swipe */
                   cerrarCharts();
               }                                                                 
           }
       }else{
           $touchActivo = false;
           $activado=false;
       }
       
       cerrarNav();
       /* reset values */
       xDown = null;
       yDown = null;                                             
   };




});

function abrirNav(t,l){
  $("#r img").removeAttr("style");
  $("#l img").removeAttr("style");
  if(!$chartsAbierto){
    $("#r img").css("display","none");
    $("#l img").css("display","none");
  }

  var Limg = $("#"+($n-1)+" img").attr("src");
  var Rimg = $("#"+($n+1)+" img").attr("src");

  if(Limg == undefined){
    $("#r img").css("display","none");
  }else{
    $("#r img").attr("src",Limg);
  }

  if(Rimg == undefined){
    $("#l img").css("display","none");
  }else{
    $("#l img").attr("src",Rimg);
  }

  $("#blockMovil").css("display","block");
  $("#navMovil").css("display","block");
  $("#navMovil").css({
    "top":t,
    "left":l
  });
  setTimeout(()=>{
    $("#navMovil").css({
      "width":250,
      "height":250,
      "opacity":1
    });
    $("#blockMovil").css("opacity",1);
  },100);

}

function cerrarNav(){
  $("#navMovil").css({
    "width":0,
    "height":0,
    "opacity":0
  });
  $("#blockMovil").css("opacity",0);
  setTimeout(()=>{
    $("#navMovil").css("display","none");
    $("#blockMovil").css("display","none");
  },300);

}

function abrirCharts(){
  $chartsAbierto = true;
  $("#mapSide").css("top",-window.innerHeight-100);
  $("#chartSide").css("top",-100 );
  $("#indicador").css("top","50%");
  if($n<1)$n=1;
  abrirActividad($n);

}

function cerrarCharts(){
  $("#mapSide").css("top","0");
  $("#chartSide").css("top","100%");
  $("#indicador").css("top","0%");
  $chartsAbierto = false;
}


function abrirActividad(n){
  if($grupo.actividades != undefined && Object.keys($grupo.actividades).length>=n){
      coords = arrMarkers[n-1].getLngLat();
      $("ul > li").removeClass("actActivo");
      if(n!=$n  || $chartsAbierto){
        map.flyTo({ 
            center: coords,
            zoom: 18,
        });
        $n = n;
        $("#chartSide").css("left",-($n-1)+"00%");
        $("ul > li:nth-child("+$n+")").addClass("actActivo");
      }else{
        cerrarActs(); 
      }
      
      $(".modalMapa").removeAttr("style");
      $("#"+$n+".modalMapa").css("display","block");
      if($n>0)$("#blockModalAct").css("display","block");
      $tAbrirAct  = setTimeout(()=>{
        $("#"+$n+".modalMapa").css("opacity","1");
        $("#"+$n+".modalMapa").css("transform","translate(-50%,-50%) scale(1)");
        if($n>0){
          $("#titAct").css("opacity",0);
          $("#blockModalAct").css("opacity","1");
        }
      },500);
  }else{
    $n = $nAnt;
  }
}

function cerrarActs(){
  $("ul > li").removeClass("actActivo");
  $(".modalMapa").removeAttr("style");
  $("#blockModalAct").removeAttr("style");
  $("#titAct").css("opacity",1);
  map.flyTo({
    center:$center,
    zoom:$zoom
  });
  $n=0;
  $("#chartSide").css("left","0%");  
}

