<?php
class Data extends Controller{
	
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
			$res["query"]="Unit";
    		$res["suggestions"] = ['please login in '.url];
    		echo json_encode($res);
		}
		
	}

	function index(){
		$term = $_GET[ "query" ];
		$barang = $this->model->read('kodepos',"WHERE kelurahan LIKE '%$term%' OR kecamatan LIKE '%$term%' OR kabupaten LIKE '%$term%' OR kodepos LIKE '%$term%' LIMIT 30");
		$result = array();
		foreach ($barang as $company) {
			$company[ "data" ] = $company["kelurahan"].' '.$company["kecamatan"].' '.$company["kabupaten"].' '.$company["propinsi"].' ('.$company["kodepos"].')';
			$company[ "value" ] = $company["kelurahan"].' '.$company["kecamatan"].' '.$company["kabupaten"].' '.$company["propinsi"].' ('.$company["kodepos"].')';
			/*$company[ "data" ] = $company["data"];
			$company[ "value" ] = $company["value"];*/
			$companyLabel = $company[ "value" ];
			if ( strpos( strtoupper($companyLabel), strtoupper($term) ) !== false ) {
				array_push( $result, $company );
			}
		}
		$res["query"]="Unit";
    	$res["suggestions"]=$result;
		echo json_encode($res);
	}

	function biodata(){
		$term = $_GET[ "query" ];
		$barang = $this->model->read('biodata',"WHERE nama LIKE '%$term%' LIMIT 30",'id, nama');
		$result = array();
		foreach ($barang as $company) {
			$company["value"] = $company["nama"];
			$company["data"] = $company["nama"];
			$companyLabel = $company["value"];
			if ( strpos( strtoupper($companyLabel), strtoupper($term) ) !== false ) {
				array_push( $result, $company );
			}
		}
		$res["query"]="Unit";
    	$res["suggestions"]=$result;
		echo json_encode($res);
	}

	function peserta($id = 'null',$kts = null){
		$where = ($id == 'null') ? '' : "AND id NOT IN ($id)";
		$where .= (empty($kts)) ? '' : "AND (kts = 0 OR kts IS NULL)";
		$term = $_GET[ "query" ];
		$barang = $this->model->read('biodata',"WHERE nama LIKE '%$term%' $where LIMIT 30",'id, nama, kts');
		$result = array();
		foreach ($barang as $company) {
			$company["value"] = $company["nama"];
			$company["data"] = $company["nama"];
			$companyLabel = $company["value"];
			if ( strpos( strtoupper($companyLabel), strtoupper($term) ) !== false ) {
				array_push( $result, $company );
			}
		}
		$res["query"]="Unit";
    	$res["suggestions"]=$result;
		echo json_encode($res);
	}

	function url(){
		echo "<pre>";
		print_r($_SERVER);
		print_r(explode('/', $_SERVER['REQUEST_URI']));
	}

}