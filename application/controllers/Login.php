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
