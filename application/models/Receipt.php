<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt extends CI_Model {
	public $variable;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function now(){
	    $res = $this->db->query("SELECT now();")->result_array();
	    $res = array_values($res[0]);
	    return $res[0];
	}

	public function selectReceipt($id){
		$query = "select * from RECEIPT where id = '$id';";
		return $this->db->query($query)->result_array();
	}

	public function insertReceipt($productid, $quantity, $cost, $buyemail, $sellemail, $address, $message, $time, $during, $state){
	    $query = "insert into RECEIPT values (null, '$productid', '$quantity', '$cost', '$buyemail', 
	    		'$sellemail', '$address', '$message', now(), '$during', '$state');";
	    if ($this->db->query($query)){
	    	$query = "select * from RECEIPT where id = LAST_INSERT_ID();";
	    	return $this->db->query($query)->result_array();
	    }
	    return null;
	}

	public function updateReceiptCustomer($id, $address, $message, $quantity, $cost){
		$query = "update RECEIPT set address='$address', message='$message', quantity='$quantity', cost='$cost', time=now() 			where id='$id';";
		return $this->db->query($query);
	}

	public function updateReceiptProvider($id, $during){
		$query = "update RECEIPT set during='$during',time=now() where id='$id';";
		return $this->db->query($query);
	}

	public function updateReceiptState($id, $state){
		$query = "update RECEIPT set state='$state' where id='$id';";
		return $this->db->query($query);
	}

	public function deleteReceipt($id){
	    $res = $this->selectReceipt($id)[0];
	    if ($res && ($res['state'] == 'not_submitted' 
	    		  	|| $res['state'] == 'submitted'
					|| $res['state'] == 'deny'
					|| $res['state'] == 'failed'
					|| $res['state'] == 'cancel')){
	    	$query = "update RECEIPT set state = 'deleted' where id = '$id';";
	    	return $this->db->query($query);
	    }
	    return false;
	}

	public function selectReceipts($email){
		$query = "select * from USER where email = '$email';";
		$res = $this->db->query($query)->result_array();
		if (count($res) > 0){
			$res = $res[0];
			if ($res['role'] == 'customer'){
				return $this->selectReceiptsCustomer($email);
			} else if ($res['role'] == 'provider') {
				return $this->selectReceiptsProvider($email);
			}
		}
		return array();
	}

	public function selectReceiptsCustomer($email = null){
		$query = "select RECEIPT.id, RECEIPT.quantity, RECEIPT.productid, RECEIPT.sellemail, RECEIPT.buyemail, RECEIPT.cost as cost, RECEIPT.state, BOOK_INFO.name, BOOK_INFO.avatar, BOOK.cost as productcost FROM RECEIPT, BOOK_INFO, BOOK where RECEIPT.productid = BOOK_INFO.id and BOOK.id = BOOK_INFO.id and BOOK.state not like 'deleted' and RECEIPT.buyemail = '$email' and RECEIPT.state not like 'deleted' order by RECEIPT.time desc;";
		return $this->db->query($query)->result_array();
	}

	public function selectReceiptsProvider($email){
	 	$query = "select RECEIPT.id, RECEIPT.quantity, RECEIPT.productid, RECEIPT.sellemail, RECEIPT.buyemail, RECEIPT.cost as cost, RECEIPT.state, BOOK_INFO.name, BOOK_INFO.avatar, BOOK.cost as productcost FROM RECEIPT, BOOK_INFO, BOOK where RECEIPT.productid = BOOK_INFO.id and BOOK.id = BOOK_INFO.id and BOOK.state not like 'deleted' and RECEIPT.sellemail = '$email' and RECEIPT.state not like 'deleted' order by RECEIPT.time desc;";
		return $this->db->query($query)->result_array();
	}

	public function search($email, $key){
	 	$query = "select * from USER where email = '$email';";
		$res = $this->db->query($query)->result_array();
		if (count($res) > 0){
			$res = $res[0];
			if ($res['role'] == 'customer'){
				return $this->searchReceiptsCustomer($email, $key);
			} else if ($res['role'] == 'provider') {
				return $this->selectReceiptsProvider($email, $key);
			}
		}
		return array();   
	}

	public function searchReceiptsCustomer($email, $key){
	 	$query = "select RECEIPT.id, RECEIPT.quantity, RECEIPT.productid, RECEIPT.sellemail, RECEIPT.buyemail, RECEIPT.cost as cost, RECEIPT.state, BOOK_INFO.name, BOOK_INFO.avatar, BOOK.cost as productcost 
	 		FROM RECEIPT, BOOK_INFO, BOOK, PROFILE
	 		where RECEIPT.productid = BOOK_INFO.id and BOOK.id = BOOK_INFO.id and 
	 			BOOK.state not like 'deleted' and RECEIPT.state not like 'deleted' and
	 			RECEIPT.buyemail = '$email' and RECEIPT.sellemail = PROFILE.email and (
	 			(locate(BOOK_INFO.name, '$key') > 0 or BOOK_INFO.name like '%$key%') or
	 			(RECEIPT.state = '$key') or
	 			(locate(PROFILE.name, '$key') > 0 or PROFILE.name like '%$key%')
	 		)  order by RECEIPT.time desc;";
		return $this->db->query($query)->result_array();   
	}

	public function searchReceiptsProvider($email, $key){
	    $query = "select RECEIPT.id, RECEIPT.quantity, RECEIPT.productid, RECEIPT.sellemail, RECEIPT.buyemail, RECEIPT.cost as cost, RECEIPT.state, BOOK_INFO.name, BOOK_INFO.avatar, BOOK.cost as productcost FROM RECEIPT, BOOK_INFO, BOOK, PROFILE
	    	where RECEIPT.productid = BOOK_INFO.id and BOOK.id = BOOK_INFO.id and 
	    		BOOK.state not like 'deleted' and RECEIPT.state not like 'deleted' and
	    		RECEIPT.sellemail = '$email' and RECEIPT.buyemail = PROFILE.email and (
	 			(locate(BOOK_INFO.name, '$key') > 0 or BOOK_INFO.name like '%$key%') or
	 			(RECEIPT.state = '$key' and RECEIPT.state not like 'not_submitted') or
	 			(locate(PROFILE.name, '$key') > 0 or PROFILE.name like '%$key%')
	 		) order by RECEIPT.time desc;";
		return $this->db->query($query)->result_array();
	}

}

/* End of file Receipt.php */
/* Location: ./application/models/Receipt.php */