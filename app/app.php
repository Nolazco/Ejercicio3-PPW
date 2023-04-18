<?php

namespace app;

require_once 'autoloader.php';
use Controllers\auth\LoginController as LoginController;
use Controllers\PostController as PostController;

if(!empty($_POST)){

	//*******************Login */
	$login = in_array('_login', array_keys(filter_input_array(INPUT_POST)));
	if($login){
		$datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
		$userLogin = new LoginController();
		print_r($userLogin->userAuth($datos));
	}
}

if(!empty($_GET)){
	//*******************Logout */
	$logout = in_array('_logout', array_keys(filter_input_array(INPUT_GET)));
	if($logout){
		$userLogout = new LoginController();
		$userLogout->logout();
		header('Location: /resources/views/home.php');
	}

	//*******************Cargar publicaciones previas */
	$pp = in_array('_pp', array_keys(filter_input_array(INPUT_GET)));
	if($pp){
		$post = new PostController();
		print_r($post->getPost());
	}

	$lp = in_array('_lp', array_keys(filter_input_array(INPUT_GET)));
	if($lp){
		$l = filter_input_array(INPUT_GET)["limit"];
		$lastpost = new PostController();
		print_r($lastpost->getPost($l));
	}
}