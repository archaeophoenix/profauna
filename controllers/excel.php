<?php
class Excel extends Controller{
	
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

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$data['halaman'] = 'Import Biodata Dari Excel';
			$this->view->render('excel/field',$data);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Export Excel';
		$this->data->create('log',$log);
	}

	function export(){
		// Fungsi header dengan mengirimkan raw data excel
		// header("Content-type: application/vnd-ms-excel");
		 
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		// header("Content-Disposition: attachment; filename=tutorialweb-export.xls");
	}

	function import(){
		/*echo '<pre>';
		print_r($_FILES);*/
		$files = $_FILES['file'];
		error_reporting(~E_NOTICE);

		//upload file
	    move_uploaded_file($files['tmp_name'], $files['name']);
	    
	    //permision file
	    chmod($files['name'], 0777);


	    require('SpreadsheetReader.php');
	    require('excel_reader2.php');

	    //create obj from SpreadsheetReader to read excel file
	    $Reader = new SpreadsheetReader($files['name']);

	    // print_r($Reader);

	    //detail row excel file

	    //xls diawali index 1
	    //xlsx diawali index 0

	    $bio = array();
	    $reg = array();

	    $last = $this->data->one('biodata','ORDER BY id DESC LIMIT 1');

		foreach ($Reader as $Row => $val){
			$val[0] += $last['id'];
			
			$val[1] = ($val[1] == '') ? '""' : '"'.$val[1].'"' ;
			$val[10] = (strtolower($val[10]) == 'perempuan' || strtolower($val[10]) == 'p') ? 'Perempuan' : 'Laki-Laki' ;
			$val[17] = (strtoupper($val[17]) == 'PERPANJANG') ? 0 : 1 ;
			$val[16] = ($val[16] == '' || empty($val[16])) ? '1905-01-01' : date('Y-m-d',strtotime($val[16])) ;
			$val[12] = ($val[12] == '' || empty($val[12])) ? NULL : date('Y-m-d',strtotime($val[12])) ;

	        if ($Row != 0) {
	        	$bio[] = '("'.$val[0].'", '.$val[1].', "'.$val[2].'", "'.$val[3].'", "'.$val[4].'", "'.$val[5].'", "'.$val[6].'", "'.$val[7].'", "'.$val[8].'", "'.$val[9].'", "'.$val[10].'", "'.$val[11].'", "'.$val[12].'", "'.$val[13].'", "'.$val[14].'", '.$_SESSION['id'].')';
	        	$reg[] = '("'.$val[0].'","'.$val[15].'", "'.$val[16].'", "'.$val[17].'", (SELECT id FROM via WHERE via LIKE "%'.$val[18].'%"), '.$_SESSION['id'].')';
	        } 
	        // print_r($val).'<br>';

	       /* if ($Row == 4) {
	        	break;
	        }*/
	    }

	    $biodata = 'insert into biodata (id,kts,nama,email,agama,alamat,address,telpon,telp,profesi,kelamin,tempat_lahir,tanggal_lahir,detail_profesi,tempat_profesi,id_user) values '.implode(',', $bio);
	    $registrasi = 'insert into registrasi (id_bio,status,tanggal,type,id_via,id_user) values '.implode(',', $reg);

	    $this->data->query($biodata);
	    $this->data->query($registrasi);

	    $log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Submit Export Excel';
		$this->data->create('log',$log);

	    $this->direct(url.'bio/datas');


	    // unlink($files['name']);
	    //id	nama	kts	foto	email	agama	alamat	telpon	profesi	kelamin	tempat_lahir	tanggal_lahir	detail_profesi	tempat_profesi	status	tanggal	keterangan
	}

}