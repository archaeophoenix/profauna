<?php
class Staff extends Controller{
	
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
		$where = (is_null($id)) ? '' : "AND staff.id = '$id'";

		// return $this->data->{$method}('staff','JOIN biodata ON biodata.id = id_bio JOIN jabatan ON jabatan.id = id_jabatan WHERE active = 1 '.$where,'staff.id id, biodata.nama nama, id_bio, jabatan.nama jabatan, id_jabatan, tanggal_awal, tanggal_akhir, id_atasan, active');
		return $this->data->{$method}('staff','JOIN jabatan ON jabatan.id = id_jabatan WHERE active = 1 '.$where,'staff.id id, staff.nama nama, jabatan.nama jabatan, id_jabatan, tanggal_awal, tanggal_akhir, id_atasan, active');
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'staff/datas/');
		}
	}

	function inactive($id){
		
		$this->data->update('staff',"id = '$id'",array('active' => 0));

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Hapus Data Staff';
		$this->data->create('log',$log);

		$this->direct(url.'staff/datas/');
	}

	function creup($id = null){
		$_POST['tanggal_awal'] = date('Y-m-d',strtotime($_POST['tanggal_awal']));
		$_POST['tanggal_akhir'] = date('Y-m-d',strtotime($_POST['tanggal_akhir']));

		if (is_null($id)) {
			$this->data->create('staff',$_POST);
		} else {
			$this->data->update('staff',"id = '$id'",$_POST);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Staff';
		$this->data->create('log',$log);

		$this->direct(url.'staff/datas/');
	}

	function datas($bulan = null, $tahun = null, $id = null){
		if(empty($bulan) || empty($tahun)){
			$this->direct(url.'staff/datas/'.date('m').'/'.date('Y'));
		}

		$data['id'] = $id;
		$data['link'] = 'staff/datas';
		$data['halaman'] = 'Staff';
		$data['staff'] = $this->data() ;
		$data['jabatan'] = $this->data->read('jabatan') ;
		$data['param'] = ['bulan' => $bulan, 'tahun' => $tahun];
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;
		$data['tahun'] = $this->data->read('staff','','DISTINCT(YEAR(tanggal_awal)) tahun');
		$data['bulan'] = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Halaman Data Staff';
		$this->data->create('log',$log);

		$this->view->render('staff/fields',$data);
	}

}