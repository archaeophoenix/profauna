<?php
class Login_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}

	function logon(){
		return $this->db->one('user','WHERE active = 1 AND username = "'.$_POST['username'].'" AND password = "'.$this->dencrypt('encrypt',$_POST['password']).'"' );
	}

	function login($id){
		return $this->db->one('user',"WHERE id = '$id'",'id,username, status, active');
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