<?php
class Via extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();

		$result = array();

		$this->getModel('login');
		if (!empty($_SESSION['id'])){
			$result = $this->login->login($_SESSION['id']);
		}
		
		if(!empty($result)){
			Session::start();
			$_SESSION = $result;
			Session::set('log',true);
		}

		if(Session::get('log') == false) {
			$this->direct(url);
		}

		$this->getModel('data');
	}

	function data($id = null){
		$method = (is_null($id)) ? "read" : "one" ;
		$where = (is_null($id)) ? '' : "WHERE id = '$id'";

		return $this->data->{$method}('via',$where);
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'via/datas/');
		}
	}

	function inactive($id){
		$this->data->update('via',"id = '$id'",array('active' => 0));
		
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Inactive Data Via Pendaftaran';
		$this->data->create('log',$log);

		$this->direct(url.'via/datas/');
	}

	function creup($id = null){
		if (is_null($id)) {
			$this->data->create('via',$_POST);
		} else {
			$this->data->update('via',"id = '$id'",$_POST);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Via Pendaftaran';
		$this->data->create('log',$log);

		$this->direct(url.'via/datas/');
	}

	function datas($id = null){

		$data['id'] = $id;
		$data['halaman'] = 'VIA Pendaftaran';
		$data['via'] = $this->data() ;
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Via Pendaftaran';
		$this->data->create('log',$log);

		$this->view->render('via/field',$data);
	}

}