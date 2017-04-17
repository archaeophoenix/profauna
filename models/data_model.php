<?php
class Data_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	//backup restore db
	//import excel

	function field($table){
		return $this->db->field($table);
	}

	function create($table, $data = array()){
		return $this->db->create($table, $data);
	}

	function read($table, $condition = null, $fields = "*"){
		return $this->db->read($table, $condition, $fields);
	}

	function update($table,$where,$data = array()){
		return $this->db->update($table,$where,$data);
	}

	function delete($table, $where){
		return $this->db->delete($table, $where);
	}

	function upload($data, $url = null, $rename = null){
		return $this->db->upload($data, $url, $rename);
	}

	function one($table, $condition = null, $fields = "*"){
		return $this->db->one($table, $condition, $fields);
	}

	function query($sql, $type = 'fetchAll'){
		return $this->db->query($sql, $type);
	}

	function dencrypt($action, $string) {
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';
	    // hash
	    // aes-128-cbc | aes-128-ctr | aes-256-cbc | aes-256-ctr
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	    if ( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    } else if( $action == 'decrypt' ) {
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }
	    return $output;
	}

}