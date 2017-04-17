<?php
class Jabatan extends Controller{
	
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
		$where = (is_null($id)) ? '' : "WHERE jabatan.id = '$id'";

		return $this->data->{$method}('jabatan','LEFT JOIN jabatan atasan ON jabatan.id_atasan = atasan.id '.$where,'jabatan.id id, jabatan.nama nama, atasan.nama atasan, atasan.id id_atasan');
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'jabatan/datas/');
		}
	}

	function inactive($id){
		
		$this->data->update('jabatan',"id = '$id'",array('active' => 0));

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Inactive Data Jabatan';
		$this->data->create('log',$log);

		$this->direct(url.'jabatan/datas/');
	}

	function creup($id = null){
		if (is_null($id)) {
			$this->data->create('jabatan',$_POST);
		} else {
			$this->data->update('jabatan',"id = '$id'",$_POST);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Jabatan';
		$this->data->create('log',$log);

		$this->direct(url.'jabatan/datas/');
	}

	function datas($id = null){

		$data['id'] = $id;
		$data['halaman'] = 'Jabatan';
		$data['jabatan'] = $this->data() ;
		$data['atasan'] = $this->data() ;
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Via Pendaftaran';
		$this->data->create('log',$log);

		$this->view->render('jabatan/field',$data);
	}

}