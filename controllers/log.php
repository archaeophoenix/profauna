<?php
class Log extends Controller{

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

	function data($bulan = null, $tahun = null){
		$where = "WHERE MONTH(log.update) = '$bulan' AND YEAR(log.update) = '$tahun'" ;

		return $this->data->read('log','LEFT JOIN user ON user.id = log.id_user '.$where ,'username, log.update, aktivitas');
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'log/datas/'.date('m').'/'.date('Y'));
		}
	}

	function datas($bulan = null, $tahun = null){
		if(empty($bulan) || empty($tahun)){
			$this->direct(url.'log/datas/'.date('m').'/'.date('Y'));
		}
		
		$data['link'] = 'event/datas';
		$data['halaman'] = 'Event';
		$data['list'] = $this->data($bulan, $tahun);
		$data['param'] = ['bulan' => $bulan, 'tahun' => $tahun];
		$data['tahun'] = $this->data->read('log','','DISTINCT(YEAR(`update`)) tahun');
		$data['bulan'] = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

		$this->view->render('log/list',$data);
	}

	function transaksi($year, $month, $nav, $find = null){
		$data = $this->data->jurnal($year, $month, $nav, $find);
		echo json_encode($data);
	}
}