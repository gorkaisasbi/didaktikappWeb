<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->model("didaktikappDao");
	}
	
	public function index(){
		if(empty($this->session->usuario->idusuario)){
			redirect('login');
		}else{
			$listas = $this->didaktikappDao->getListas($this->session->usuario->idusuario);
			$this->session->set_userdata("listas",$listas);
			$this->load->view('dash');
		}
	}


	public function updateDash(){
		$dash = $this->input->post("dash");
		$this->didaktikappDao->updateDash($dash,$this->session->usuario->idusuario);
		echo "exito";
	}

	public function verGrupo($idGrupo=-1){
		//Buscar datos grupo y cargar vista
		if($idGrupo>-1){
			$grupo = $this->didaktikappDao->getGrupo($idGrupo);
			$grupo->actividades = (object)[];
			if(strlen($grupo->idAct1)>0){
				$grupo->actividades->act1 = $this->didaktikappDao->getAct1($grupo->idAct1);
				$grupo->actividades->act1->foto1 = base64_encode($grupo->actividades->act1->foto1);
				$grupo->actividades->act1->foto2 = base64_encode($grupo->actividades->act1->foto2);
			}
			if(strlen($grupo->idAct2)>0){
				$grupo->actividades->act2 = $this->didaktikappDao->getAct2($grupo->idAct2);
				$grupo->actividades->act2->foto1 = base64_encode($grupo->actividades->act2->foto1);
			}
			if(strlen($grupo->idAct3)>0){
				$grupo->actividades->act3 = $this->didaktikappDao->getAct3($grupo->idAct3);
				$grupo->actividades->act3->foto1 = base64_encode($grupo->actividades->act3->foto1);
				$grupo->actividades->act3->foto2 = base64_encode($grupo->actividades->act3->foto2);
				$grupo->actividades->act3->foto3 = base64_encode($grupo->actividades->act3->foto3);
			}
			if(strlen($grupo->idAct4)>0){
				$grupo->actividades->act4 = $this->didaktikappDao->getAct4($grupo->idAct4);
			}
			if(strlen($grupo->idAct5)>0){
				$grupo->actividades->act5 = $this->didaktikappDao->getAct5($grupo->idAct5);
				$grupo->actividades->act5->foto1 = base64_encode($grupo->actividades->act5->foto1);
				$grupo->actividades->act5->foto2 = base64_encode($grupo->actividades->act5->foto2);
			}
			if(strlen($grupo->idAct6)>0)$grupo->actividades->act6 = $this->didaktikappDao->getAct6($grupo->idAct6);
			$data['grupo'] = $grupo;
			$this->load->view('grupo',$data);
		}
	}

	public function buscarGrupos($horaDesde = "",$horaHasta = ""){
		$nombreGrupo = $this->input->post("txtBuscar");
		$fechaDesde = $this->input->post("fechaDesde");
		$fechaHasta = $this->input->post("fechaHasta");
		$checkListas = $this->input->post("checkListas");

		$grupos = $this->didaktikappDao->buscarGrupos($nombreGrupo,$fechaHasta,$horaHasta,$fechaDesde,$horaDesde,$checkListas,$this->session->usuario->idusuario);
		echo json_encode($grupos);
	}

	public function buscarGruposAdd($nombreGrupo=""){
		$grupos = $this->didaktikappDao->buscarGruposAdd($nombreGrupo,$this->session->usuario->idusuario);
		echo json_encode($grupos);
	}


	public function editUsername(){
		$username = $this->input->post("user");
		$this->didaktikappDao->editUsername($this->session->usuario->idusuario,$username);
		$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($username));
		echo $username;
	}

	public function editFoto(){
		$imagen = $_FILES['file']['tmp_name'];
		$row = $this->didaktikappDao->editFoto($this->session->usuario->idusuario,addslashes(file_get_contents($imagen)));
		$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($this->session->usuario->username));
		echo "exito";
	}

	public function editPass(){
		$password = $this->input->post("pass1");
		$this->didaktikappDao->editPassword($this->session->usuario->idusuario,$password);
		$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($this->session->usuario->username));
		echo $password;
	}

	public function editEstilo($estilo){
		$this->didaktikappDao->editEstilo($this->session->usuario->idusuario,$estilo);
		$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($this->session->usuario->username));
		echo "exito";
	}

	public function crearLista(){
		$nombreLista = $this->input->post("nombreLista");
		$idLista = $this->didaktikappDao->crearLista($nombreLista,$this->session->usuario->idusuario);
		$listas = $this->session->listas;
		$lNueva = (object)["idlista"=>$idLista,"nombreLista"=>$nombreLista,"idusuario"=>$this->session->usuario->idusuario,"grupos"=>[]];
		$listas[] = $lNueva;
		$this->session->set_userdata("listas",$listas);
		echo json_encode($lNueva);
	}

	public function eliminarLista($idLista=-1){
		if($idLista>-1){
			$this->didaktikappDao->eliminarLista($idLista);
			$this->session->set_userdata("listas",$this->didaktikappDao->getListas($this->session->usuario->idusuario));
			echo "exito";
		}

	}

	public function eliminarDeLista($idLista=-1,$idGrupo = -1){
		if($idLista>-1 && $idGrupo > -1){
			$this->didaktikappDao->eliminarDeLista($idLista,$idGrupo);
			$this->session->set_userdata("listas",$this->didaktikappDao->getListas($this->session->usuario->idusuario));
			echo "exito";
		}

	}

	public function anadirALista($idLista=-1,$idGrupo = -1){
		if($idLista>-1 && $idGrupo > -1){
			$this->didaktikappDao->anadirALista($idLista,$idGrupo);
			echo "exito";
		}

	}
	public function updateCardListas($ind=-1){
		if($ind>-1){
			$this->didaktikappDao->updateCardListas($ind,$this->session->usuario->idusuario);
			$this->session->usuario->indCardListas = $ind;
			if($ind == 1){
				$htmlListas = $this->load->view('cardListas', '', true);
				echo $htmlListas;
			}else{
				echo "exito";

			}
		}

	}

	public function addCardGrupo($idGrupo=-1){
		if($idGrupo>-1){
			$this->didaktikappDao->addCardGrupo($idGrupo,$this->session->usuario->idusuario);
			$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($this->session->usuario->username));
			$data['grupo'] = $this->didaktikappDao->getGrupo($idGrupo);
			$htmlcardGrupo = $this->load->view('cardGrupo', $data, true);
			echo $htmlcardGrupo;

		}

	}

	public function deleteCardGrupo($idGrupo=-1){

		if($idGrupo>-1){
			$this->didaktikappDao->deleteCardGrupo($idGrupo,$this->session->usuario->idusuario);
			$this->session->set_userdata("usuario",$this->didaktikappDao->getUser($this->session->usuario->username));
			echo "exito";

		}


	}



}





