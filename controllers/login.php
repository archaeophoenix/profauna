<?php
class Login extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		$this->getModel('data');
	}

	function index(){
		$result = $this->model->logon();
		if(!empty($result)){
			Session::start();
			$_SESSION = $result;
			Session::set('log',true);
			$log['id_user'] = $_SESSION['id'];
			$log['aktivitas'] = 'Login';
			$this->data->create('log',$log);
		}
		$this->direct(url);
	}

}