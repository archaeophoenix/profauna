<?php
class Index extends Controller{
	
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

		/*print_r($result);
		die();*/

		$this->getModel('data');
		$this->data->update('registrasi','(tanggal + INTERVAL 12 YEAR_MONTH) <= "'.date('Y-m-d').'"',array('status' => 'Simpatisan'));
	}

	function staff($id = null){
		$method = (is_null($id)) ? "read" : "one" ;
		$where = (is_null($id)) ? '' : "AND staff.id = '$id'";

		return $this->data->{$method}('staff','JOIN jabatan ON jabatan.id = id_jabatan WHERE active = 1 '.$where,'staff.id id, staff.nama nama, jabatan.nama jabatan, id_jabatan, tanggal_awal, tanggal_akhir, id_atasan, active');
	}

	function mboh(){
		echo "<pre>";
		foreach ($this->data->field('biodata') as $key => $value){
			echo $value['Field'].' | ';
		}
		echo "<br>";
		echo "<br>";
		foreach ($this->data->field('registrasi') as $key => $value){
			echo $value['Field'].' | ';
		}
	}

	function index(){
		if(Session::get('log') == false) {
			$this->view->single('login');
		} else {
			$data['halaman'] = 'Dashboard';
			$data['staff'] = $this->staff();
			$data['abjad'] = ['a','b','c','d','e','f','g','h','i','j','k','l'];
			$data['bulan'] = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
			$data['event'] = $this->data->one('event','WHERE MONTH(tanggal_awal) = '.date('m').' AND YEAR(tanggal_awal) = '.date('Y'),'COUNT(id) id');
			$data['projek'] = $this->data->one('projek','WHERE MONTH(tanggal_awal) = '.date('m').' AND YEAR(tanggal_awal) = '.date('Y'),'COUNT(id) id');
			$data['renewal'] = $this->data->read('registrasi','WHERE status = "Supporter" GROUP BY renewal','COUNT(status) jumlah, renewal,YEAR(tanggal), MONTH(tanggal)');
			$data['registrasi'] = $this->data->one('registrasi','WHERE renewal IS NULL AND YEAR(tanggal) = "'.date('Y').'" AND MONTH(tanggal)  = "'.date('m').'" GROUP BY YEAR(tanggal), MONTH(tanggal)','COUNT(id) id,YEAR(tanggal), MONTH(tanggal)');
			$data['reg'] = $this->data->read('registrasi','WHERE renewal IS NULL AND YEAR(tanggal) = '.date('Y').' GROUP BY MONTH(tanggal)','COUNT(id) jumlah, MONTH(tanggal) bulan');
			$data['regis'] = $this->data->read('registrasi','WHERE renewal IS NULL GROUP BY YEAR(tanggal) ORDER BY YEAR(tanggal) DESC LIMIT 12','COUNT(id) jumlah,YEAR(tanggal) tahun');
			// echo'<pre>';print_r($data);die();
			$log['id_user'] = $_SESSION['id'];
			$log['aktivitas'] = 'Membuka Halaman Dashboard';
			$this->data->create('log',$log);
			
			$this->view->render('index',$data);
		}
	}

}