<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->model("didaktikappDao");
	}
	
	public function index(){
        if(!isset($this->session->usuario)){
            $this->load->view('login');
		}else{
			redirect("main");
		}
	}

	public function login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if(empty($username)||empty($password)){
			echo "Rellena todos los campos ||";
			throw new Exception;
		}else{
			$usu = $this->didaktikappDao->getUser($username);
			for($i=0;$i<count($usu->cardGrupos);$i++){
				$grupo = $usu->cardGrupos[$i];
				$grupo->actividades = (object)[];
				if(strlen($grupo->idAct1)>0){
					$grupo->actividades->act1 = $this->didaktikappDao->getAct1($grupo->idAct1);
				}
				if(strlen($grupo->idAct2)>0){
					$grupo->actividades->act2 = $this->didaktikappDao->getAct2($grupo->idAct2);
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


			}
			if (!is_object($usu)) {
				echo "Usuario no existe ||";
				throw new Exception;
			}
			if($usu->password != $password){
				echo "Contraseña incorrecta ||";
				throw new Exception;
			}else{
				//ENTRA EN LA WEB
				$this->session->set_userdata("usuario",$usu);
			}
		} 


		
	}

	public function logout(){
		session_destroy();
		redirect('login');
	}

}
