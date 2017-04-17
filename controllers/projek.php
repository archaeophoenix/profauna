<?php
class Projek extends Controller{
	
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

	function data($id = null, $bulan = null, $tahun = null){
		$method = (is_null($id)) ? "read" : "one" ;
		$where = (is_null($id)) ? "WHERE MONTH(projek.tanggal_awal) = '$bulan' AND YEAR(projek.tanggal_awal) = '$tahun'" : "WHERE projek.id = '$id'";

		return $this->data->{$method}('projek','LEFT JOIN event ON projek.id = id_projek JOIN type ON type.id = projek.id_type JOIN biodata p ON p.id = projek.pemimpin JOIN biodata t ON t.id = projek.tanggungjawab '.$where ,'projek.id id, projek.nama nama, projek.foto foto, projek.lokasi lokasi, type.nama type, projek.id_type, p.nama npemimpin, projek.pemimpin, t.nama ntanggungjawab, projek.tanggungjawab, projek.keterangan, projek.tanggal_awal tanggal_awal, projek.tanggal_akhir tanggal_akhir, event.nama event , event.id id_event');
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'projek/datas/'.date('m').'/'.date('Y'));
		}
	}

	function datas($bulan = null, $tahun = null){
		if(empty($bulan) || empty($tahun)){
			$this->direct(url.'projek/datas/'.date('m').'/'.date('Y'));
		}

		$data['link'] = 'projek/datas';
		$data['halaman'] = 'Projek';
		$data['list'] = $this->data(null, $bulan, $tahun);
		$data['param'] = ['bulan' => $bulan, 'tahun' => $tahun];
		$data['tahun'] = $this->data->read('registrasi','','DISTINCT(YEAR(tanggal)) tahun');
		$data['bulan'] = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Projek';
		$this->data->create('log',$log);

		$this->view->render('projek/list',$data);
	}

	function form($id = null){
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;
		if (date('Y-m-d') > $data['data']['tanggal_awal'] && !empty($data['data'])){
			$this->direct(url.'projek/datas/'.date('m').'/'.date('Y'));
			die();
		}

		$data['halaman'] = 'Projek';
		$data['type'] = $this->data->read('type');

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Form Projek '.$detail;
		$this->data->create('log',$log);

		$this->view->render('projek/form',$data);
	}

	function detail($id){
		$data['halaman'] = 'Projek';
		$data['data'] = $this->data($id);
		$data['member'] = $this->data->read('peserta','JOIN biodata ON id_bio = biodata.id WHERE id_projek = "'.$id.'" GROUP BY id_bio','biodata.id id, biodata.nama nama, nilai');

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Detail Projek '.$detail;
		$this->data->create('log',$log);

		$this->view->render('projek/detail',$data);
		// echo "<pre>";print_r($data);
	}

	function peserta($id, $edit = null){
		$data['data'] = $this->data($id);
		if (date('Y-m-d') > $data['data']['tanggal_awal'] && !empty($data['data'])){
			$this->direct(url.'projek/datas/'.date('m').'/'.date('Y'));
			die();
		}

		$data['edit'] = $edit;
		$data['peserta'] = $this->data->read('peserta',"JOIN biodata ON id_bio = biodata.id JOIN registrasi ON registrasi.id_bio = biodata.id JOIN projek ON id_projek = projek.id WHERE registrasi.id = (SELECT id FROM registrasi WHERE id_bio = biodata.id ORDER BY id DESC LIMIT 1) AND id_projek = '$id'",'peserta.id id, nilai, biodata.id idb, biodata.nama peserta, kts, status');
		$data['halaman'] = 'Projek '.$data['data']['type'];

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Form Peserta Projek '.$detail;
		$this->data->create('log',$log);
		
		/*echo "<pre>";
		print_r($data);die();*/
		$this->view->render('projek/peserta',$data);
	}

	function rem($id,$page){
		$this->data->delete('peserta',"id = $id");

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Hapus Peserta Projek ';
		$this->data->create('log',$log);

		$this->direct(url.'projek/peserta/'.$page);
	}

	function nilai($id){
		$value = $this->data->one('projek','JOIN type ON projek.id_type = type.id','kts');
		if ($value['kts'] == 1) {
			
		}
		foreach ($_POST['nilai'] as $key => $value) {
			$data['nilai'] = $value;
			$this->data->update('peserta',"id = '".$key."'",$data);
		}
		$this->direct(url.'projek/peserta/'.$id);
	}

	function add($id){
		foreach ($_POST['id_bio'] as $key => $value) {
			$data['id_bio'] = $value;
			$data['id_projek'] = $id;
			$this->data->create('peserta',$data);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Menambah Peserta Projek ';
		$this->data->create('log',$log);

		$this->direct(url.'projek/peserta/'.$id);
	}

	function submit($id = null){
		$_POST['tanggal_awal'] = date('Y-m-d',strtotime($_POST['tanggal_awal']));
		$_POST['tanggal_akhir'] = date('Y-m-d',strtotime($_POST['tanggal_akhir']));
		
		if (!empty($_FILES['foto']['name'])){
			$foto = $this->data->upload('foto', 'assets/images', uniqid());
			$_POST['foto'] = 'assets/images/'.$foto['name'];
			if (isset($_POST['otof'])) {
				if (file_exists($_POST['otof'])){
					unlink($_POST['otof']);
				}
			}
		}


		if (is_null($id)) {
			$this->data->create('projek');
		} else {
			unset($_POST['otof']);
			$this->data->update('projek',"id = '$id'",$_POST);
		}
		/*echo '<pre>';
		print_r($_POST);
		die();*/

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Projek ';
		$this->data->create('log',$log);

		$this->direct(url.'projek/datas');
	}

}