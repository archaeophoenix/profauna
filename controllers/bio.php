<?php
class Bio extends Controller{
	
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
		$where = '';
		$method = (is_null($id)) ? "read" : "one" ;
		// $where = (is_null($id)) ? "AND MONTH(registrasi.tanggal) = '2' AND YEAR(registrasi.tanggal) = '2017'" : "AND biodata.id = '$id'";
		if(is_null($id)){
			$where = (isset($_POST['filter'])) ? $_POST['filter'] : ' AND (registrasi.tanggal BETWEEN "'.date('Y').'-'.date('m').'-01" AND "'.date('Y').'-'.date('m').'-'.cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')).'") ' ;
		} else {
			$where = "AND biodata.id = '$id'";
		}


		// 'AND ((registrasi.tanggal BETWEEN '02' AND '03') AND renewal IS NULL) AND (registrasi.status = '') AND (registrasi.type = '') AND (alamat LIKE '%%' OR address LIKE '%%') '

		return $this->data->{$method}('biodata',"JOIN registrasi ON id_bio = biodata.id LEFT JOIN via ON via.id = registrasi.id_via LEFT JOIN kodepos ON biodata.id_kota = kodepos.id WHERE registrasi.id = (SELECT id FROM registrasi WHERE id_bio = biodata.id ORDER BY id DESC LIMIT 1) ".$where ,'biodata.id id, kts, ktp, fb, nama, email, agama, telpon, telp, alamat, address, profesi, id_kota, kelamin, tempat_lahir, tanggal_lahir, detail_profesi, tempat_profesi, kodepos, kelurahan, kecamatan, jenis, kabupaten, propinsi, registrasi.id via, id_via, status, tanggal, keterangan, type, via.via chanel, FLOOR(DATEDIFF("'.date('Y-m-d').'",tanggal_lahir) / 365) usia');
	}

	function mboh() {
		$ok = 'aksjhd kasdya dkkajshd aksjdh aksdjhask daskjdhaklshd aksd';
		echo "<pre>";
		print_r(explode('|', $ok));
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'bio/datas');
		}
	}

	function renewal($id){
		$reg = $this->data->one('registrasi',"JOIN biodata ON id_bio = biodata.id WHERE registrasi.id = '".$_POST['id']."'",'biodata.id id, nama, renewal');
		$_POST['id_bio'] = $id ;
		$_POST['renewal'] = $reg['renewal'] + 1;
		$_POST['tanggal'] = date('Y-m-d',strtotime($_POST['tanggal']));
		unset($_POST['id']);
		$this->data->create('registrasi',$_POST);

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Submit Renewal <span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$reg['id'].'">'.$reg['nama'].'</a></span>';
		$this->data->create('log',$log);
		// die();
		$this->direct(url);
	}

	function pengguna($id = null){
		$method = (is_null($id)) ? "read" : "one" ;
		$where = (is_null($id)) ? "" : "WHERE id = '$id'" ;
		return $this->data->{$method}('user',$where, 'id, username, status, active');
	}

	function user($id = null){
		$data['id'] = $id;
		$data['halaman'] = 'Pengguna';
		$data['user'] = $this->pengguna();
		$data['hak'] = ['Admin', 'Pimpinan', 'Petugas'];
		$data['data'] = (is_null($id)) ? null : $this->pengguna($id);
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman User';
		$this->data->create('log',$log);
		/*echo "<pre>".$id.' => '.$is.'<br>';
		print_r($data);die();*/
		$this->view->render('bio/field',$data);
	}

	function active($id = null){
		/*echo "<pre>";
		print_r($_POST);*/
		$_POST['password'] = (empty($_POST['password'])) ? null : $this->data->dencrypt('encrypt', $_POST['password']) ;
		if (empty($id)) {
			$this->data->create('user',$_POST);
		} else {
			unset($_POST['id']);
			if (empty($_POST['password'])) {
				unset($_POST['password']);
			}
			$this->data->update('user',"id = '$id'",$_POST);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Mamipulasi Data User';
		$this->data->create('log',$log);

		$this->direct(url.'bio/user');
	}

	function detail($id){
		$data['halaman'] = 'Biodata';
		$data['data'] = $this->data($id);
		$data['member'] = $this->data->read('peserta','LEFT JOIN event ON peserta.id_event = event.id LEFT JOIN projek ON peserta.id_projek = projek.id WHERE id_bio = "'.$id.'" GROUP BY id_projek','peserta.id id_peserta, nilai, id_event, event.nama event, event.keterangan eketerangan, event.tanggal_awal etanggal_awal, event.tanggal_akhir etanggal_akhir, peserta.id_projek, projek.nama projek, projek.keterangan pketerangan, projek.tanggal_awal ptanggal_awal, projek.tanggal_akhir ptanggal_akhir');
		// echo "<pre>";print_r($data);die();

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Submit Renewal <span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>';
		$this->data->create('log',$log);

		$this->view->render('bio/detail',$data);
		/*foreach ($data['data'] as $key => $value) {
			echo $key." ".$value.'<br>';
		}*/
	}

	function reg($id){
		$data['halaman'] = 'Biodata';
		$data['via'] = $this->data->read('via', 'WHERE active = 1');
		$data['data'] = $this->data($id) ;

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Renewal <span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>';
		$this->data->create('log',$log);

		$this->view->render('bio/renewal',$data);
		
	}

	function datas(){

		$data['link'] = 'bio/datas';
		$data['halaman'] = 'Biodata';
		$data['list'] = $this->data();
		$data['propinsi'] = $this->data->read('kodepos','GROUP BY propinsi ORDER BY propinsi ASC','propinsi');
		$data['kota'] = $this->data->read('kodepos','GROUP BY kabupaten ORDER BY kabupaten ASC','kabupaten');

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman List Biodata';
		$this->data->create('log',$log);

		$this->view->render('bio/list',$data);
	}

	function form($id = null){
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;
		
		if ($data['data']['status'] == 'Simpatisan') {
			$this->direct(url.'bio');
			die();
		}

		$data['halaman'] = 'Biodata';
		$data['via'] = $this->data->read('via', 'WHERE active = 1');
		$data['agama'] = ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Lain-lain'];

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Form Biodata '.$detail;
		$this->data->create('log',$log);

		$this->view->render('bio/form',$data);
	}

	function submit($id = null){
		extract($_POST);
		/*echo "<pre>";
		print_r($_POST);
		die();*/
		$bio['tanggal_lahir'] = date('Y-m-d',strtotime($bio['tanggal_lahir']));
		$bio['alamat'] = trim($bio['alamat'].' | '.$bio['kelurahan']);
		$bio['address'] = trim($bio['address'].' | '.$bio['kel']);
		unset($bio['kelurahan']);
		unset($bio['kel']);
		
		$via['tanggal'] = date('Y-m-d',strtotime($via['tanggal']));
		
		if (is_null($id)) {
			$id = $this->data->create('biodata',$bio);
			
			$via['id_bio'] = $id;
			$this->data->create('registrasi',$via);
		} else {
			$this->data->update('biodata',"id = '$id'",$bio);
			$this->data->update('registrasi',"id = '$via[id]'",$via);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Submit Biodata ';
		$this->data->create('log',$log);

		$this->direct(url.'/bio');
	}

}