<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require "Bookfest.php";

class ReceiptController extends Bookfest {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		
	}

	public function buynow($productid, $quantity = 1){
		if (!$this->checkLogin()){
			header("location: " . base_url());
			return;
		}
	    $productid = urldecode($productid);
	    $quantity = urldecode($quantity);
	    $email = $this->input->cookie('email');
	    $this->load->model('book');
	    $res = $this->book->selectDetailOne($productid);
	    if (count($res) > 0){
	    	$res = $res[0];
	    	// echo "here";
	    	if ((int) $quantity + (int) $res['sell'] <= (int) $res['quantity']){
	    		$this->load->model('receipt');
	    		$res = $this->receipt->insertReceipt($productid, $quantity, $res['cost'], $email, $res['email'], "", "", "", "", 'not_submitted');
	    		header("location: " . base_url() . "index.php/user#/receipt?id=" . $res['id']);
	    		return;
	    	}
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function selectReceipt($id){
		if (!$this->checkLogin()){
			return;
		}
	    $id = urldecode($id);
	    $this->load->model("receipt");
	    $res = $this->receipt->selectReceipt($id)[0];
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function deleteReceipt($id){
	    if (!$this->checkLogin()){
			return;
		}
		$id = urldecode($id);
		$this->load->model("receipt");
		$res = $this->receipt->deleteReceipt($id);
		echo json_encode(array("success" => $res, "id" => $id));
	}

	public function updateReceipt(){
	    if (!$this->checkLogin()){
			return;
		}
		$this->load->model("receipt");
		$id = $this->input->post("id");
		$address = $this->input->post("address");
		$message = $this->input->post("message");
		$quantity = $this->input->post("quantity");
		$cost = $this->input->post("cost");
		$res = $this->receipt->updateReceiptCustomer($id, $address, $message, $quantity, $cost);
		echo json_encode(array("success" => $res, "quantity" => $quantity));
	}

	public function submitReceipt(){
	 	if (!$this->checkLogin()){
			return;
		}
		$this->load->model("receipt");
		$id = $this->input->post("id");
		$address = $this->input->post("address");
		$message = $this->input->post("message");
		$quantity = $this->input->post("quantity");
		$cost = $this->input->post("cost");
		$res = $this->receipt->updateReceiptCustomer($id, $address, $message, $quantity, $cost);
		if (!$res) {
			echo json_encode(array("success" => $res));
			return false;
		}
		$res = $this->receipt->updateReceiptState($id, "submitted");
		echo json_encode(array("success" => $res));   
	}

	public function accept($id){
	    if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'submitted' && $email == $receipt['sellemail']){
		    	$res = $this->receipt->updateReceiptState($id, "accepted");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email));
	}

	public function deny($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'submitted' && $email == $receipt['sellemail']){
		    	$res = $this->receipt->updateReceiptState($id, "deny");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email)); 
	}

	public function deliver(){
	    if (!$this->checkLogin()){
	    	return;
	    }
	    $id = $this->input->post("id");
	    $during = (int) $this->input->post("during");
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'accepted' && $email == $receipt['sellemail']){
		    	$res1 = $this->receipt->updateReceiptProvider($id, 3600*$during);
		    	$res2 = $this->receipt->updateReceiptState($id, "delivering");
		    	echo json_encode(array("success" => $res1&&$res2));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email));
	}

	public function cancel($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'accepted' && $email == $receipt['sellemail']){
		    	$res = $this->receipt->updateReceiptState($id, "cancel");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email)); 
	}

	public function received($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'delivering' && $email == $receipt['buyemail']){
		    	$res = $this->receipt->updateReceiptState($id, "received");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email)); 
	}

	public function complain($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'delivering' && $email == $receipt['buyemail']){
		    	$now = $this->receipt->now();
		    	if (strtotime($now) >= (strtotime($receipt['time']) + (int) $receipt['during'])){
			    	$res = $this->receipt->updateReceiptState($id, "failed");
			    	echo json_encode(array("success" => true));
			    	return;
		    	}
		    }
	    }

	    echo json_encode(array("success" => false, "now" => strtotime($now), "except" => strtotime($receipt['time']) + (int) $receipt['during'])); 
	}

	public function takeback($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'delivering' && $email == $receipt['sellemail']){
		    	$res = $this->receipt->updateReceiptState($id, "cancel");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email)); 
	}

	public function comment($id){
	 	if (!$this->checkLogin()){
	    	return;
	    }
	    $id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("receipt");
	    $receipt = $this->receipt->selectReceipt($id);
	    if (isset($receipt[0])){
	    	$receipt = $receipt[0];
		    if ($receipt['state'] == 'received' && $email == $receipt['buyemail']){
		    	$res = $this->receipt->updateReceiptState($id, "success");
		    	echo json_encode(array("success" => $res));
		    	return;
		    }
	    }

	    echo json_encode(array("success" => false, "id" => $id, "email" => $email)); 
	}

	public function selectReceipts(){
		if (!$this->checkLogin()){
			return;
		}
		$email = $this->input->cookie("email");
		$this->load->model("receipt");
		$res = $this->receipt->selectReceipts($email);
		echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function selectReceiptsCustomer($email = null){
		if (!$this->checkLogin()){
			return;
		}
		$email = urldecode($email);
		$this->load->model("receipt");
		$res = $this->receipt->selectReceiptsCustomer($email);
		echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function selectReceiptsProvider($email){
	    if (!$this->checkLogin()){
			return;
		}
		$email = urldecode($email);
		$this->load->model("receipt");
		$res = $this->receipt->selectReceiptsProvider($email);
		echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function search($key = null){
		if (!$this->checkLogin()){
			return;
		}
	    $email = $this->input->cookie("email");
	    if (!$key or $key == ""){
	    	echo "this";
	    	$this->selectReceipts($email);
	    	return;
	    }
	    $key = urldecode($key);
	    $this->load->model("receipt");
	    $res = $this->receipt->search($email, $key);
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

}

/* End of file Receipt.php */
/* Location: ./application/controllers/Receipt.php */