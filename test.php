<?php

    $files = scandir("/opt/lampp/proftpd/didaktikapp");
    for($i=0;$i<count($files);$i++){
        $nombre = $files[$i];
        if(count(explode(".",$nombre))>0){
            $extension =  explode(".",$nombre)[1];
            if($extension == "json"){
                $json = file_get_contents("/opt/lampp/proftpd/didaktikapp/".$nombre);
                $json = json_decode($json);
                $jsonObj = $json[0];
                if(property_exists($jsonObj,"grupo")){
                    $grupo = $jsonObj->grupo;
                    if(property_exists($jsonObj,"actividad")){
                        $actividad = $jsonObj->actividad;
                        //if($actividad->fragment == 8)
                            guardarGrupo($grupo);
                    }

                }
                //unlink("/opt/lampp/proftpd/didaktikapp/".$nombre);

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
        if ($result->num_rows == 0) {
            //No hay grupo con ese deviceId, insertar
            $sqlIn = "INSERT INTO grupos (nombreGrupo, fechaInicio, deviceId) VALUES ('$grupo->nombre', '$strDate','$deviceId')";
            $conn->query($sqlIn);
            echo "grupo insertado\n";
        }else{
            echo "grupo con deviceId ya existe\n";
        }


    }



?>
