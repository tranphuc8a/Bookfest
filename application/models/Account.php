<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Model {

	public $variable;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}


	/*
	Quy ước đặt tên phương thức của model: (action)(Table)(params)
	- action: select(get), insert(add), update(set), delete(delete)
		+ selectTable(arrayOfWhere)
		+ insertTable(arrayOfFields)
		+ updateTable(arrayOfWhere, arrayOfField)
		+ deleteTable(arrayOfWhere)
	- Table: trường hợp tác động tới tất cả trường của bảng
	*/


	// table USER
	public function insertUser($email, $password, $role, $name, $phone, $dob){
		$day = date('Y-m-d');
		$query = "insert into USER values ('$email', '$password', '$role', 'normal', now());";
		if ($this->db->query($query)){
			$query = "insert into PROFILE values ('$email', '$name', null, '$phone', '$dob', '');";
			return $this->db->query($query);
		}
		return false;
	}	
	public function selectUser($email){
	    $query = "select * from USER where email = '$email'";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function updateUser($email, $hashmk, $role, $state){
	    $query = "update USER set hashmk = '$hashmk', role = '$role', state = '$state'
				where email = '$email';";
		return $this->db->query($query);
	}

	public function updatePassword($email, $hashmk){
		$query = "update USER set hashmk = '$hashmk' where email = '$email';";
		return $this->db->query($query);
	}


	public function selectProfile($email){
	 	$query = "select * from PROFILE where email = '$email'";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;   
	}
	public function selectUserProfile($email){
	 	$query = "select * from USER, PROFILE where USER.email = PROFILE.email and USER.email = '$email'";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;   
	}
	public function updateProfile($email, $name, $avatar, $phone, $dob, $detail = ""){
		$query = "update PROFILE set 
					name = '$name', avatar ='$avatar', phone = '$phone', dob = '$dob', detail = '$detail'
				where email = 'tranphuc8a@gmail.com';";
		return $this->db->query($query);
	}


	


	// Table LOGIN and CODE
	public function selectLogin($email){
	    $query = "select * from LOGIN where email = '$email';";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function updateLogin($email, $token){
		$res = $this->selectLogin($email);
		$query = "";
		$day = date("Y-m-d H:i:s", strtotime('+ 5 hours'));
		if (count($res) <= 0){
			$query = "insert into LOGIN values ('$email', '$token', now());";
		} else {
			$query = "update LOGIN set tokenid = '$token', time = now() where email = '$email';";
		}
		return $this->db->query($query);
	}

	public function selectCode($email){
	    $query = "select * from CODE where email = '$email';";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function updateCode($email, $code){
		$res = $this->selectCode($email);
		$query = "";
		$day = date("Y-m-d H:i:s", strtotime('+ 5 hours'));
		if (count($res) <= 0){
			$query = "insert into CODE values ('$email', '$code', now());";
		} else {
			$query = "update CODE set CODE.code = '$code', time = now() where email = '$email';";
		}
		return $this->db->query($query);
	}

}

/* End of file account.php */
/* Location: ./application/models/account.php */