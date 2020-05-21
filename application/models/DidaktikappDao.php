<?php

class DidaktikappDao extends CI_Model{
    

        //$rs->result() (Array de objetos)
        //$rs->result_array() (Array de arrays assoc)
        //$rs->row() (1 objeto)
        //$rs->row_array() (1 array assoc)
        //$rs->num_rows()
        //$db->affected_rows()
        //$db->insert_id()

    
    function __construct() {
        parent::__construct();
    }
    

    

    function getUser($username){
        $sql="SELECT idusuario,username,password,imagen,estiloAuto,indCardListas,dash FROM usuarios WHERE username like binary '$username'";
        $rs = $this->db->query($sql);
        $usuario = $rs->row();
        if(is_object($usuario)){
            $sql="SELECT g.idgrupo,nombregrupo,fechainicio,fechafin,idAct1,idAct2,idAct3,idAct4,idAct5,idAct6 FROM grupos g WHERE g.idgrupo in (SELECT d.idgrupo FROM cardGrupos d WHERE d.idgrupo = g.idgrupo AND idusuario = $usuario->idusuario)";
            $rs = $this->db->query($sql);
            $usuario->cardGrupos = $rs->result();
        }

        return $usuario;
    }

    function editUsername($idusuario,$username){
        $sql="UPDATE usuarios SET username='$username' WHERE idusuario = $idusuario";
        $this->db->query($sql);
    }

    function editPassword($idusuario,$password){
        $sql="UPDATE usuarios SET password='$password' WHERE idusuario = $idusuario";
        $this->db->query($sql);
    }

    function editFoto($idusuario,$imagen){
        
        $sql="UPDATE usuarios SET imagen = '$imagen' WHERE idusuario = $idusuario";
        $this->db->query($sql);

        $sql="SELECT imagen FROM usuarios WHERE idusuario = $idusuario";
        $rs = $this->db->query($sql);
        return $rs->row();

    }

    function editEstilo($idusuario,$estilo){
        $sql="UPDATE usuarios SET estiloAuto= $estilo WHERE idusuario = $idusuario";
        $this->db->query($sql);
    }

    function crearLista($nombre,$idusuario){
        $sql="INSERT INTO listas (nombreLista,idusuario) VALUES ('$nombre',$idusuario)";
        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function eliminarLista($idlista){
        $sql="DELETE FROM listas WHERE idlista = $idlista";
        $this->db->query($sql);
    }

    function eliminarDeLista($idlista,$idGrupo){
        $sql="DELETE FROM listasGrupos WHERE idlista = $idlista AND idgrupo = $idGrupo";
        $this->db->query($sql);

    }

    function anadirALista($idlista,$idgrupo){
        $sqlVerifica = "SELECT count(idlista) cont FROM listasGrupos WHERE  idlista = $idlista AND idgrupo = $idgrupo";
        $rs = $this->db->query($sqlVerifica);
        if($rs->row()->cont>0)
            return false;

        $sql="INSERT INTO listasGrupos (idlista,idgrupo) VALUES ($idlista,$idgrupo)";
        $this->db->query($sql);
        return true;
    }

    function updateCardListas($ind,$idusuario){
        $sql="UPDATE usuarios SET indCardListas = $ind WHERE idusuario = $idusuario";
        $this->db->query($sql);
    }



    function getListas($idusuario){
        $sqlListas = "SELECT idlista, nombreLista, idusuario FROM listas WHERE idusuario = $idusuario";
        $rs = $this->db->query($sqlListas);
        $listas = $rs->result();
        
        foreach ($listas as $lista) {
            $sql="SELECT g.idgrupo,nombreGrupo, fechaInicio FROM listasGrupos l , grupos g WHERE g.idGrupo = l.idGrupo AND l.idLista = $lista->idlista";
            $rs = $this->db->query($sql);
            $lista->grupos = $rs->result();
        }
        return $listas;
       
    }

    function buscarGrupos($nombreGrupo,$fechaHasta,$horaHasta,$fechaDesde,$horaDesde,$chechListas,$idusuario){
        $where = "WHERE 1=1 ";
        if(!empty($nombreGrupo)){
            $where.= "AND nombreGrupo LIKE '%$nombreGrupo%' ";
        }
        if(!empty($fechaHasta)&& !empty($horaHasta)){
            $where.="AND fechaInicio <= '$fechaHasta $horaHasta' ";
        }

        if(!empty($fechaDesde) && !empty($horaDesde)){
            $where.="AND fechaInicio >= '$fechaDesde $horaDesde' ";
        }
        if(!empty($chechListas)){
            $where.= "AND 0< (SELECT COUNT(*) FROM listasGrupos l WHERE g.idGrupo = l.idGrupo AND l.idlista in (SELECT idlista FROM listas WHERE idusuario = $idusuario) )";
        }

        $sql = "SELECT idgrupo,nombreGrupo,fechaInicio FROM grupos g $where ORDER BY fechaInicio desc LIMIT 12";
        $rs = $this->db->query($sql);
        $grupos = $rs->result();
        return $grupos;
       
    }

    function getGrupo($idGrupo){
        $sql = "SELECT idgrupo,nombregrupo,fechainicio,fechafin,idAct1,idAct2,idAct3,idAct4,idAct5,idAct6 FROM grupos WHERE idGrupo = $idGrupo";
        $rs = $this->db->query($sql);
        $grupo = $rs->row();
        return $grupo;
    }

    function getAct1($idAct1=-1){
        $sql = "SELECT id, estado, fragment, foto1, foto2, sopa, fecha FROM actividadZumeltzegi WHERE id = $idAct1";
        $rs = $this->db->query($sql);
        $act1 = $rs->row();
        return $act1;
    }

    function getAct2($idAct2=-1){
        $sql = "SELECT id, estado, fragment, test, fotos, fecha  FROM actividadSanMiguel WHERE id = $idAct2";
        $rs = $this->db->query($sql);
        return $rs->row();
    }

    function getAct3($idAct3=-1){
        $sql = "SELECT id, estado, fragment, test, foto1, foto2, foto3, fecha  FROM actividadUnibertsitatea WHERE id = $idAct3";
        $rs = $this->db->query($sql);
        return $rs->row();
    }

    function getAct4($idAct4=-1){
        $sql = "SELECT id, estado, fragment, puzle, palabra, fecha  FROM actividadTrena WHERE id = $idAct4";
        $rs = $this->db->query($sql);
        return $rs->row();
    }

    function getAct5($idAct5=-1){
        $sql = "SELECT id, estado, fragment, frases, foto1, foto2, fecha  FROM actividadErrota WHERE id = $idAct5";
        $rs = $this->db->query($sql);
        return $rs->row();
    }

    function getAct6($idAct6=-1){
        $sql = "SELECT id, estado, fragment, test, puzle, fecha  FROM actividadGernika WHERE id = $idAct6";
        $rs = $this->db->query($sql);
        return $rs->row();
    }



    function buscarGruposAdd($nombreGrupo,$idusuario){
        $sql = "SELECT idgrupo,nombreGrupo, fechaInicio FROM grupos g WHERE nombreGrupo LIKE '%$nombreGrupo%' AND 0< (SELECT COUNT(*) FROM listasGrupos l WHERE g.idGrupo = l.idGrupo AND l.idlista in (SELECT idlista FROM listas WHERE idusuario = $idusuario) ) AND 0 = (SELECT COUNT(idgrupo) FROM cardGrupos c WHERE c.idgrupo = g.idgrupo) ORDER BY nombreGrupo LIMIT 10";
        $rs = $this->db->query($sql);
        $grupos = $rs->result();
        return $grupos;
       
    }

    function addCardGrupo($idgrupo, $idusuario){
        $sql="INSERT INTO cardGrupos (idusuario,idgrupo) VALUES ($idusuario,$idgrupo)";
        $this->db->query($sql);
    }

    function deleteCardGrupo($idgrupo,$idusuario){
        $sql="DELETE FROM cardGrupos WHERE idusuario = $idusuario AND idgrupo = $idgrupo";
        $this->db->query($sql);
    }

    function updateDash($dash,$idusuario){
        $sql="UPDATE usuarios SET dash = '$dash' WHERE idusuario = $idusuario";
        $this->db->query($sql);
    }

    function getSumListaTest($idlista){
        $sql = "SELECT SUM(SUBSTRING(test,1,1)) num FROM actividadSanMiguel WHERE id in (SELECT idAct2 FROM grupos WHERE idGrupo in (SELECT idGrupo FROM listasGrupos WHERE idLista = $idlista))";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaListaTest($idlista){
        $sql = "SELECT AVG(SUBSTRING(test,1,1)) num FROM actividadSanMiguel WHERE id in (SELECT idAct2 FROM grupos WHERE idGrupo in (SELECT idGrupo FROM listasGrupos WHERE idLista = $idlista))";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getSumListaFotos($idlista){
        $sql = "SELECT SUM(SUBSTRING(fotos,1,1)) num FROM actividadSanMiguel WHERE id in (SELECT idAct2 FROM grupos WHERE idGrupo in (SELECT idGrupo FROM listasGrupos WHERE idLista = $idlista))";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaListaFotos($idlista){
        $sql = "SELECT AVG(SUBSTRING(fotos,1,1)) num FROM actividadSanMiguel WHERE id in (SELECT idAct2 FROM grupos WHERE idGrupo in (SELECT idGrupo FROM listasGrupos WHERE idLista = $idlista))";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaAct2Test(){
        $sql = "SELECT AVG(SUBSTRING(test,1,1)) num FROM actividadSanMiguel";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaAct2Fotos(){
        $sql = "SELECT AVG(SUBSTRING(fotos,1,1)) num FROM actividadSanMiguel";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaAct3(){
        $sql = "SELECT AVG(SUBSTRING(test,1,1)) num FROM actividadUnibertsitatea";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

    function getMediaAct6(){
        $sql = "SELECT AVG(SUBSTRING(test,1,1)) num FROM actividadGernika";
        $rs = $this->db->query($sql);
        return $rs->row()->num;
    }

   



    
    
}

