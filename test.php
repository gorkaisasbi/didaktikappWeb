<?php
    sleep(1);
    echo "Script ejecutado\n";
    $files = scandir("/opt/lampp/proftpd/didaktikapp");
    for($i=0;$i<count($files);$i++){
        $nombre = $files[$i];
        if(count(explode(".",$nombre))>0){
            $extension =  isset(explode(".",$nombre)[1]) ? explode(".",$nombre)[1]: null;
            if($extension == "json"){
                $json = file_get_contents("/opt/lampp/proftpd/didaktikapp/".$nombre);
                $json = json_decode($json);
                $jsonObj = $json[0];
                if(isset($jsonObj->grupo)){
                    $grupo = $jsonObj->grupo;
                    guardarGrupo($grupo);
                    if(isset($jsonObj->actividad)){
                        $actividad = $jsonObj->actividad;
                        switch($actividad->tipo){
                            case 8:
                                guardarAct1($actividad, $grupo);
                                break;
                            case 5:
                                guardarAct2($actividad, $grupo);
                                break;
                            case 7:
                                guardarAct3($actividad, $grupo);
                                break;
                            case 6:
                                guardarAct4($actividad, $grupo);
                                break;
                            case 1:
                                guardarAct5($actividad, $grupo);
                                break;
                            case 2:
                                guardarAct6($actividad, $grupo);
                                break;

                            
                        }
                    
                    }
                    rename("/opt/lampp/proftpd/didaktikapp/".$nombre,"/opt/lampp/proftpd/didaktikapp/backup/".explode(".",$nombre)[0].date('Y-m-d-H:i:s').'.'.$extension);
                }else{
                    rename("/opt/lampp/proftpd/didaktikapp/".$nombre,"/opt/lampp/proftpd/didaktikapp/backup/MIERDA".explode(".",$nombre)[0].date('Y-m-d-H:i:s').'.'.$extension);
                    
                }
               
            }
        }
    }

    function guardarGrupo($grupo){
        $date = strtotime($grupo->fecha);
        $strDate = date('Y-m-d H:i:s', $date);

        // Create connection
        $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $deviceId = $grupo->deviceId . $grupo->id;
        $sql = "SELECT idgrupo FROM grupos WHERE deviceId = '$deviceId'";
        $result = $conn->query($sql);
        while ($result->num_rows == 0) {
            //No hay grupo con ese deviceId, insertar
            $sqlIn = "INSERT INTO grupos (nombreGrupo, fechaInicio, deviceId) VALUES ('$grupo->nombre', '$strDate','$deviceId')";
            $conn->query($sqlIn);
            echo "grupo insertado\n";
            $sql = "SELECT idgrupo FROM grupos WHERE deviceId = '$deviceId'";
            $result = $conn->query($sql);
        }
        echo "acabado guardar grupo\n";
        mysqli_close($conn);


    }


    function guardarAct1($actividad,$grupo){

        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"foto1")){
            $actividad->foto1 = null;
        }
        if(!property_exists($actividad,"foto2")){
            $actividad->foto2 = null;
        }
        if(!property_exists($actividad,"sopa")){
            $actividad->sopa = null;
        }


         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct1 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();
         if($idgrupo->idAct1 == null){
            $sqlIn = "INSERT INTO actividadZumeltzegi (estado, fragment, foto1, foto2, sopa) VALUES ($actividad->estado, $actividad->fragment,'$actividad->foto1','$actividad->foto2','$actividad->sopa')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct1 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 1 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadZumeltzegi SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->foto1 !=null){
                $sqlUpdate.= " foto1 = '". $actividad->foto1 ."',";
            }
            if($actividad->foto2 !=null){
                $sqlUpdate.= " foto2 = '". $actividad->foto2 ."',";
            }
            if($actividad->sopa !=null){
                $sqlUpdate.= " sopa = '". $actividad->sopa."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct1;
            $conn->query($sqlUpdate);
            echo "actividad 1 updateada\n";


         }
         mysqli_close($conn);


    }

    function guardarAct2($actividad,$grupo){

        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"fotos")){
            $actividad->fotos = null;
        }
        if(!property_exists($actividad,"test")){
            $actividad->test = null;
        }


         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct2 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();
         if($idgrupo->idAct2 == null && $actividad->estado == 2){
            $sqlIn = "INSERT INTO actividadSanMiguel (estado, fragment, fotos, test) VALUES ($actividad->estado, $actividad->fragment,'$actividad->fotos','$actividad->test')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct2 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 2 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadSanMiguel SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->fotos !=null){
                $sqlUpdate.= " fotos = '". $actividad->fotos ."',";
            }
            if($actividad->test !=null){
                $sqlUpdate.= " test = '". $actividad->test."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct2;
            $conn->query($sqlUpdate);
            echo "actividad 2 updateada\n";


         }
         mysqli_close($conn);


    }

    function guardarAct3($actividad,$grupo){
        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"foto1")){
            $actividad->foto1 = null;
        }
        if(!property_exists($actividad,"foto2")){
            $actividad->foto2 = null;
        }
        if(!property_exists($actividad,"foto3")){
            $actividad->foto3 = null;
        }
        if(!property_exists($actividad,"test")){
            $actividad->test = null;
        }
        
        $filess = scandir("/opt/lampp/proftpd/didaktikapp");
        $contImgs = 1;
        //Posible do while para coger las imagenes si o si cuando se suban
        for($j=0;$j<count($filess);$j++){
            $nombre = $filess[$j];
            $extension =  isset(explode(".",$nombre)[2]) ? explode(".",$nombre)[2] : null;
            if($extension == "jpg"){
                $mail = explode("_",$nombre)[0];
                $nomGrupo = explode("_",$nombre)[1];
                if($mail == $grupo->deviceId && $nomGrupo == $grupo->nombre){     
                    if($contImgs == 1){
                        $actividad->foto1 = "/opt/lampp/proftpd/didaktikapp/".$nombre;
                    }
                    if($contImgs == 2){
                        $actividad->foto2 = "/opt/lampp/proftpd/didaktikapp/".$nombre;
                    }
                    if($contImgs == 3){
                        $actividad->foto3 = "/opt/lampp/proftpd/didaktikapp/".$nombre;
                    }

                    $contImgs++;
                }

                
                
            }
        }

         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct3 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();



         if($idgrupo->idAct3 == null){
            $sqlIn = "INSERT INTO actividadUnibertsitatea (estado, fragment, test) VALUES ($actividad->estado, $actividad->fragment,'$actividad->test')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct3 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 3 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadUnibertsitatea SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->foto1 !=null){
                $img1 = addslashes(file_get_contents($actividad->foto1));
                $sqlUpdate.= " foto1 = '$img1',";
            }
            if($actividad->foto2 !=null){
                $img2 = addslashes(file_get_contents($actividad->foto2));
                $sqlUpdate.= " foto2 = '$img2',";
            }
            if($actividad->test !=null){
                $sqlUpdate.= " test = '". $actividad->test."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct3;
            $conn->query($sqlUpdate);


            if($actividad->foto3 !=null){
                $img3 = addslashes(file_get_contents($actividad->foto3));
                $sqlUpdate2="UPDATE actividadUnibertsitatea SET foto3 = '$img3' WHERE id = ". $idgrupo->idAct3;
                $conn->query($sqlUpdate2);
            }


            echo "actividad 3 updateada\n";

            if($actividad->foto1 != null)unlink($actividad->foto1);
            if($actividad->foto2 != null)unlink($actividad->foto2);
            if($actividad->foto3 != null)unlink($actividad->foto3);


         }
         mysqli_close($conn);


    }

    function guardarAct4($actividad,$grupo){

        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"puzle")){
            $actividad->puzle = null;
        }
        if(!property_exists($actividad,"palabra")){
            $actividad->palabra = null;
        }


         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct4 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();
         if($idgrupo->idAct4 == null){
            $sqlIn = "INSERT INTO actividadTrena (estado, fragment, puzle, palabra) VALUES ($actividad->estado, $actividad->fragment,'$actividad->puzle','$actividad->palabra')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct4 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 4 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadTrena SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->puzle !=null){
                $sqlUpdate.= " puzle = '". $actividad->puzle ."',";
            }
            if($actividad->palabra !=null){
                $sqlUpdate.= " palabra = '". $actividad->palabra ."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct4;
            $conn->query($sqlUpdate);
            echo "actividad 4 updateada\n";


         }
         mysqli_close($conn);


    }

    function guardarAct5($actividad,$grupo){

        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"foto1")){
            $actividad->foto1 = null;
        }
        if(!property_exists($actividad,"foto2")){
            $actividad->foto2 = null;
        }
        if(!property_exists($actividad,"frases")){
            $actividad->frases = null;
        }

        $filess = scandir("/opt/lampp/proftpd/didaktikapp");
        $contImgs = 1;
        //Posible do while para coger las imagenes si o si cuando se suban
        for($j=0;$j<count($filess);$j++){
            $nombre = $filess[$j];
            $extension =  isset(explode(".",$nombre)[2]) ? explode(".",$nombre)[2] : null;
            if($extension == "jpg"){
                $mail = explode("_",$nombre)[0];
                $nomGrupo = explode("_",$nombre)[1];
                if($mail == $grupo->deviceId && $nomGrupo == $grupo->nombre){     
                    if($contImgs == 1){
                        $actividad->foto1 = "/opt/lampp/proftpd/didaktikapp/".$nombre;
                    }
                    if($contImgs == 2){
                        $actividad->foto2 = "/opt/lampp/proftpd/didaktikapp/".$nombre;
                    }

                    $contImgs++;
                }

                
                
            }
        }


         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct5 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();
         if($idgrupo->idAct5 == null){
            $sqlIn = "INSERT INTO actividadErrota (estado, fragment, frases) VALUES ($actividad->estado, $actividad->fragment,'$actividad->frases')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct5 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 5 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadErrota SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->foto1 !=null){
                $img1 = addslashes(file_get_contents($actividad->foto1));
                $sqlUpdate.= " foto1 = '$img1',";
            }
            if($actividad->foto2 !=null){
                $img2 = addslashes(file_get_contents($actividad->foto2));
                $sqlUpdate.= " foto2 = '$img2',";
            }
            if($actividad->frases !=null){
                $sqlUpdate.= " frases = '". $actividad->frases."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct5;
            $conn->query($sqlUpdate);
            echo "actividad 5 updateada\n";

            if($actividad->foto1 != null)unlink($actividad->foto1);
            if($actividad->foto2 != null)unlink($actividad->foto2);


         }
         mysqli_close($conn);

    }

    function guardarAct6($actividad,$grupo){

        
        if(!property_exists($actividad,"estado")){
            $actividad->estado = null;
        }

        if(!property_exists($actividad,"fragment")){
            $actividad->fragment = null;
        }
        if(!property_exists($actividad,"puzle")){
            $actividad->puzle = null;
        }
        if(!property_exists($actividad,"test")){
            $actividad->test = null;
        }


         // Create connection
         $conn = new mysqli("127.0.0.1", "didaktikapp", "Dw2*","bddidaktikapp");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         

         $deviceId = $grupo->deviceId . $grupo->id;
         $sql = "SELECT idGrupo,idAct6 FROM grupos WHERE deviceId = '$deviceId'";
         $result = $conn->query($sql);
         $idgrupo = (object) $result->fetch_assoc();
         if($idgrupo->idAct6 == null && $actividad->estado == 2){
            $sqlIn = "INSERT INTO actividadGernika (estado, fragment, puzle, test) VALUES ($actividad->estado, $actividad->fragment,'$actividad->puzle','$actividad->test')";
            $conn->query($sqlIn);

            $sqlUpdateGrupo = "UPDATE grupos SET idAct6 = $conn->insert_id WHERE idGrupo = $idgrupo->idGrupo";
            $conn->query($sqlUpdateGrupo);
            echo "actividad 6 insertada\n";

         }else{
            $sqlUpdate = "UPDATE actividadGernika SET ";

            if($actividad->estado !=null){
                $sqlUpdate.= " estado = ". $actividad->estado.",";
            }
            if($actividad->fragment !=null){
                $sqlUpdate.= " fragment = ". $actividad->fragment.",";
            }
            if($actividad->puzle !=null){
                $sqlUpdate.= " puzle = '". $actividad->puzle ."',";
            }
            if($actividad->test !=null){
                $sqlUpdate.= " test = '". $actividad->test ."',";
            }
            $sqlUpdate = substr($sqlUpdate,0,strlen($sqlUpdate)-1);
            $sqlUpdate.=" WHERE id = ". $idgrupo->idAct6;
            $conn->query($sqlUpdate);
            echo "actividad 6 updateada\n";


         }
         $sqlUpdateGrupoFin = "UPDATE grupos SET fechaFin = now() WHERE idGrupo = $idgrupo->idGrupo";
         $conn->query($sqlUpdateGrupoFin);

         mysqli_close($conn);


    }


?>
