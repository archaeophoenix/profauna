<?php
class Type extends Controller{
	
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

		return $this->data->{$method}('type',$where);
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'type/datas/');
		}
	}

	function inactive($id){
		
		$this->data->update('type',"id = '$id'",array('active' => 0));

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Inactive Data Type Event';
		$this->data->create('log',$log);

		$this->direct(url.'type/datas/');
	}

	function creup($id = null){
		if (is_null($id)) {
			$this->data->create('type',$_POST);
		} else {
			$this->data->update('type',"id = '$id'",$_POST);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Type Event';
		$this->data->create('log',$log);

		$this->direct(url.'type/datas/');
	}

	function datas($id = null){

		$data['id'] = $id;
		$data['halaman'] = '	Type Event / Projek';
		$data['type'] = $this->data() ;
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Type Event';
		$this->data->create('log',$log);

		$this->view->render('type/field',$data);
	}

}