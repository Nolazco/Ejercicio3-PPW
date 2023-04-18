<?php

	namespace Controllers\auth;

	use Models\user;

	class LoginController {
		public $sv; //Sesión válida
		public $name;
		public $id;
		public function __construct(){
			$this -> sv = false;
		}
		public function userAuth($datos){
			$user = new user();

			$result = $user->where([
				["username", $datos["username"]], 
				["passwd", $datos["passwd"]],
			])->get();
			if( count(json_decode($result)) > 0 ){
				//Se registra la sesión del usuario
				return $this->sessionRegister($datos);
			}else{
				//Destruir todo alv
				$this->sessionDestroy();
				echo json_decode(["r" => false]);
			}
		}

		private function sessionRegister($datos){
			session_start();
			$_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['username'] = $datos['username'];
			$_SESSION['passwd'] = $datos['passwd'];
			session_write_close();
			return json_encode(["r" => true]);
		}

		public function sessionValidate(){
			$user = new user();
			session_start();
			if(session_status() == PHP_SESSION_ACTIVE && count($_SESSION) > 0){
				$datos = $_SESSION;
				$result = $user->where([["username", $datos["username"]], 
										["passwd", $datos["passwd"]],
										])->get();
				if(count(json_decode($result)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
					session_write_close();
					$this->sv = true;
					$this->name = json_decode($result)[0]->name;
					$this->id = json_decode($result)[0]->id;
					return $result;
				}else{
					session_write_close();
					$this->sessionDestroy();
					return null;
				}
			}
		}

		private function sessionDestroy(){
			session_start();
			$_SESSION = [];
			session_destroy();
			session_write_close();
			$this->sv = false;
			$this->name = "";
			$this->id = "";
			return;	
		}

		public function logout(){
			$this->sessionDestroy();
			return;
		}
	}