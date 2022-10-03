<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("Bookfest.php");

class User extends Bookfest {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if (!$this->checkLogin()){
			header("location: " . base_url());
		}
		$this->load->view('userHome');
	}

	public function viewme(){
	    echo "viewme";
	}

	public function view($email){
		$email = urldecode($email);
		$emailCookie = urldecode($this->input->cookie("email"));
		if ($email == $emailCookie){
			$this->viewme();
			return;
		}
	    echo $email;
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
	    		$res = $this->receipt->insertReceipt($productid, $quantity, $res['cost'], $email, $res['email'], "", "", "", "", 'not_submitted')[0];
	    		header("location: " . base_url() . "index.php/user#/receipt?id=" . $res['id']);
	    		return;
	    	}
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}


	// API
	public function getUser($email = NULL){
		if (!$this->checkLogin()) return;
		if ($email == null)
	    	$email = $this->input->cookie('email');
	    $email = urldecode($email);
	    $this->load->model('account');
	    $res = $this->account->selectUser($email)[0];
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}
	
	public function getProfile($email = NULL){
		if (!$this->checkLogin()) return;
		if ($email == null)
			$email = $this->input->cookie('email');
		$email = urldecode($email);
	    $this->load->model('account');
	    $res = $this->account->selectProfile($email)[0] ?? array();
	    $this->defaultImage($res['avatar']);
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);	
	}

	public function getUserProfile($email = null){
		if (!$this->checkLogin()) return;
		if ($email == null)
		    $email = $this->input->cookie('email');
		$email = urldecode($email);
	    $this->load->model('account');
	    $res = $this->account->selectUserProfile($email);
	    if (isset($res[0])){
	    	$res = $res[0];
	    } else {
	    	echo "{}";
	    	return;
	    }
	    $this->defaultImage($res['avatar']);
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);    
	}

	
	// REPOSITORY
	public function searchBookRepository($key){
	    if (!$this->checkLogin()) return;
		$key = urldecode($key);
	    $this->load->model('repository');
	    $email = $this->input->cookie('email');
	    $res = $this->repository->search($email, $key);
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function selectAllBookRepository(){
	    if (!$this->checkLogin()) return;
		$this->load->model('repository');
		$email = $this->input->cookie('email');
	    $res = $this->repository->selectAll($email);
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);	
	}

	// CART
	public function searchBookCart($key){
	    if (!$this->checkLogin()) return;
		$key = urldecode($key);
	    $this->load->model('cart');
	    $email = $this->input->cookie('email');
	    $res = $this->cart->search($email, $key);
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function selectAllBookCart(){
	    if (!$this->checkLogin()) return;
		$this->load->model('cart');
		$email = $this->input->cookie('email');
	    $res = $this->cart->selectAll($email);
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);	
	}

	public function insertBookToCart(){
	    if (!$this->checkLogin()) return;
	    $this->load->model("cart");
	    $email = $this->input->post("email");
	    $id = $this->input->post("id");
	    $quantity = $this->input->post("quantity");
	    $res = $this->cart->insertBookToCart($email, $id, $quantity);
	    echo json_encode(array("success" => $res));
	}

	public function updateBookFromCart(){
	    if (!$this->checkLogin()) return;
	    $this->load->model("cart");
	    // $emailCookie = $this->input->cookie("email");

	    $email = $this->input->post("email");
	    $id = $this->input->post("id");
	    $quantity = $this->input->post("quantity");
	    $res = $this->cart->updateBookFromCart($email, $id, $quantity);
	    echo json_encode(array("success" => $res, "quantity" => $quantity, "email" => $email, "id" => $id));   
	}

	public function deleteBookFromCart($id){
		$id = urldecode($id);
	    $email = $this->input->cookie("email");
	    $this->load->model("cart");
	    $res = $this->cart->deleteBookFromCart($email, $id);
	    echo json_encode(array("success" => $res));
	}

}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */