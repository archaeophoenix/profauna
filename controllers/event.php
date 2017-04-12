<?php
class Event extends Controller{
	
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
		$where = (is_null($id)) ? "WHERE MONTH(event.tanggal_awal) = '$bulan' AND YEAR(event.tanggal_awal) = '$tahun'" : "WHERE event.id = '$id'";

		return $this->data->{$method}('event','LEFT JOIN projek ON projek.id = id_projek JOIN type ON type.id = event.id_type JOIN biodata p ON p.id = event.pemimpin JOIN biodata t ON t.id = event.tanggungjawab '.$where ,'event.id id, event.nama nama, event.foto foto, event.lokasi lokasi, projek.nama projek, type.nama type, event.id_type, id_projek, p.nama npemimpin, event.pemimpin, t.nama ntanggungjawab, event.tanggungjawab, event.keterangan, satwa, event.tanggal_awal tanggal_awal, event.tanggal_akhir tanggal_akhir, type.kts');
	}

	function index(){
		if(Session::get('log') == false) {
			$this->direct(url);
		} else {
			$this->direct(url.'event/datas/'.date('m').'/'.date('Y'));
		}
	}

	function datas($bulan = null, $tahun = null){
		if(empty($bulan) || empty($tahun)){
			$this->direct(url.'event/datas/'.date('m').'/'.date('Y'));
		}

		$data['link'] = 'event/datas';
		$data['halaman'] = 'Event';
		$data['list'] = $this->data(null, $bulan, $tahun);
		$data['param'] = ['bulan' => $bulan, 'tahun' => $tahun];
		$data['tahun'] = $this->data->read('registrasi','','DISTINCT(YEAR(tanggal)) tahun');
		$data['bulan'] = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Event';
		$this->data->create('log',$log);

		$this->view->render('event/list',$data);
	}

	function form($id = null){
		$data['data'] = (is_null($id)) ? null : $this->data($id) ;
		if (date('Y-m-d') > $data['data']['tanggal_awal'] && !empty($data['data'])){
			$this->direct(url.'event/datas/'.date('m').'/'.date('Y'));
			die();
		}

		$data['halaman'] = 'Event';
		$data['type'] = $this->data->read('type');
		$data['projek'] = $this->data->read('projek','','id, nama');

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Form Event '.$detail;
		$this->data->create('log',$log);

		$this->view->render('event/form',$data);
	}

	function peserta($id, $edit = null){
		$data['data'] = $this->data($id);
		if (date('Y-m-d') > $data['data']['tanggal_awal'] && !empty($data['data'])){
			$this->direct(url.'event/datas/'.date('m').'/'.date('Y'));
			die();
		}
		
		$data['edit'] = $edit;
		$data['peserta'] = $this->data->read('peserta',"JOIN biodata ON id_bio = biodata.id JOIN registrasi ON registrasi.id_bio = biodata.id JOIN event ON id_event = event.id WHERE registrasi.id = (SELECT id FROM registrasi WHERE id_bio = biodata.id ORDER BY id DESC LIMIT 1) AND id_event = '$id'",'peserta.id id, nilai, biodata.id idb, biodata.nama peserta, kts, status, jenis');
		$data['halaman'] = 'Event '.$data['data']['type'];

		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Form Peserta Event '.$detail;
		$this->data->create('log',$log);
		
		/*echo "<pre>";
		print_r($data);print_r($log);die();*/
		$this->view->render('event/peserta',$data);
	}

	function rem($id,$page){
		$this->data->delete('peserta',"id = $id");

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Hapus Peserta Event ';
		$this->data->create('log',$log);

		$this->direct(url.'event/peserta/'.$page);
	}

	function nilai($id){
		$type = $this->data->one('event','JOIN type ON event.id_type = type.id','kts');
		foreach ($_POST['nilai'] as $key => $value) {
			$data['nilai'] = $value;
			$this->data->update('peserta',"id = '".$key."'",$data);
			if ($type['kts'] == 1) {
				$ikts = $this->data->one('biodata',"ORDER BY kts DESC LIMIT 1",'kts');
				$kts['kts'] = $ikts['kts'] + 1;
				$this->data->update('biodata',"id = '".$_POST['id_bio'][$key]."'",$kts);
			}
		}
		/*echo "<pre>";
		print_r($_POST);
		die();*/
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Penilaian Peserta Event ';
		$this->data->create('log',$log);

		$this->direct(url.'event/peserta/'.$id);
	}

	function add($id, $projek = null){
		foreach ($_POST['id_bio'] as $key => $value) {
			$data['id_event'] = $id;
			$data['id_bio'] = $value;
			$data['id_projek'] = $projek;
			$data['jenis'] = $_POST['jenis'][$key];
			$this->data->create('peserta',$data);
		}

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Menambah Peserta Event ';
		$this->data->create('log',$log);

		$this->direct(url.'event/peserta/'.$id);
	}

	function detail($id){
		$data['halaman'] = 'Event';
		$data['data'] = $this->data($id);
		$data['member'] = $this->data->read('peserta','JOIN biodata ON id_bio = biodata.id WHERE id_event = "'.$id.'" GROUP BY id_bio','biodata.id id, biodata.nama nama, nilai');
		
		$detail = (is_null($id)) ? '' : '<span class="badge badge-info badge-icon"><a href="'.url.'bio/detail/'.$id.'">'.$data['data']['nama'].'</a></span>' ;
		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Membuka Halaman Detail Event '.$detail;
		$this->data->create('log',$log);

		$this->view->render('event/detail',$data);
		// echo "<pre>";print_r($data);
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
			$this->data->create('event',$_POST);
		} else {
			unset($_POST['otof']);
			$projek['id_projek'] = $_POST['id_projek'];
			$this->data->update('peserta',"id_event = '$id'",$projek);
			$this->data->update('event',"id = '$id'",$_POST);
		}
		/*echo '<pre>';
		print_r($_POST);
		die();*/

		$log['id_user'] = $_SESSION['id'];
		$log['aktivitas'] = 'Manipulasi Data Event ';
		$this->data->create('log',$log);

		$this->direct(url.'event/datas');
	}

}