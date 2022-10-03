<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("Bookfest.php");

class Product extends Bookfest {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		
	}

	public function view($id){
	    if (!$this->checkLogin()) {
	    	header("location: " . base_url());
	    	return;
	    }
	   	$this->load->view("productView", array("id" => $id));
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
	    echo json_encode($res);
	}


	// API
	public function searchBook($key){
	    if (!$this->checkLogin()) return;
		$key = urldecode($key);
	    $this->load->model('book');
	    $res = $this->book->search($key);
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res);
	}

	public function selectAllBook(){
	    if (!$this->checkLogin()) return;
		$this->load->model('book');
	    $res = $this->book->selectAll();
	    foreach ($res as &$value) {
	        $this->defaultImage($value['avatar']);
	    }
	    echo json_encode($res);	
	}

	public function selectDetailBook($id){
	    if (!$this->checkLogin()) return;	    
		$this->load->model('book');
		$id = urldecode($id);
	    $res = $this->book->selectDetailOne($id)[0];
        $this->defaultImage($res['avatar']);
	    echo json_encode($res);	
	}

	public function deleteBook($id){
		if (!$this->checkLogin()) return;	    
		$this->load->model('book');
	    $res = $this->book->deleteBook($id);
	    echo json_encode(array("success"=>$res));	   
	}

	public function uploadBookImage($field, $email, $id){
	    if (isset($_FILES[$field]) && $_FILES[$field]['name'] != ""){
		    $path = "./uploads/";
		    $filename = $email . "book" . $id . $field . ".jpg";
			$config = array(
				'overwrite'		=> true,
				'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF",
				"upload_path" 	=> $path,
				'file_name' 	=> $filename
			);
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload($field)){
				$url = base_url() . '/uploads/' . $this->upload->file_name ;
				// if ($field != "avatar"){
		  //   		var_dump(_FILES[$field]);
		  //   		return;
		  //   	}
				return $url;
			} else {
				var_dump($this->upload->error_msg);
				return "";
			}
		}
		return "";
	}

	public function addBook(){
		if (!$this->checkLogin()){
			header("location: " . base_url());
		}
		$email = $this->input->cookie("email");
		$name = $this->input->post("name");
		$pages = $this->input->post("page");
		$author = $this->input->post("author");
		$publisher = $this->input->post("publisher");
		$detail = $this->input->post("detail");
		$cost = $this->input->post("cost");
		$quantity = $this->input->post("quantity");
		$sell = $this->input->post("sell");
		$avatar = "";
		
		$this->load->model("book");
		
		$res = $this->book->insertBook($email, $cost, $quantity, $sell);
		// $res = array(array('id' => "1"));
		$id = $res[0]['id'];

		$avatar = $this->uploadBookImage('avatar', $email, $id);
		$this->book->insertBookInfo($id, $name, $author, $pages, $publisher, $detail, $avatar);

		$img = array("", "", "", "", "");
		for ($i = 0; $i < 5; $i++){
			$img[$i] = $this->uploadBookImage('image' . $i, $email, $id);
		}
		$this->book->insertBookImage($id, $img);

	    header("location: ". base_url() ."index.php/user#/repository");
	}

	public function updateBook(){
	 	if (!$this->checkLogin()){
			header("location: " . base_url());
		}
		$email = $this->input->cookie("email");
		$id = $this->input->post("id");
		$name = $this->input->post("name");
		$pages = $this->input->post("page");
		$author = $this->input->post("author");
		$publisher = $this->input->post("publisher");
		$detail = $this->input->post("detail");
		$cost = $this->input->post("cost");
		$quantity = $this->input->post("quantity");
		$sell = $this->input->post("sell");
		$avatar = "";
		
		$this->load->model("book");
		
		$res = $this->book->updateBook($id, $email, $cost, $quantity, $sell);
		
		$avatar = $this->uploadBookImage('avatar', $email, $id);
		if ($avatar == "") $avatar = $this->input->post("oldAvatar");
		$this->book->updateBookInfo($id, $name, $author, $pages, $publisher, $detail, $avatar);

		$img = array("", "", "", "", "");
		for ($i = 0; $i < 5; $i++){
			$img[$i] = $this->uploadBookImage('image' . $i, $email, $id);
			if ($img[$i] == "") $img[$i] = $this->input->post("oldImage" . $i);
		}
		$this->book->updateBookImage($id, $img);
		// echo $id;
		// var_dump($_POST);
		// return;
	    header("location: ". base_url() . "index.php/product/view/" . $id);   
	}

	public function getComments($productId){
		$this->load->model('book');
	    $res = $this->book->selectBookComment($productId);
        foreach($res as &$value){
	        $this->defaultImage($value['avatar']);
        }
	    echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function insertComment(){
	    $this->load->model("book");
	    $email = $this->input->post("email");
	    $id = $this->input->post("productid");
	    $star = $this->input->post("star");
	    $content = $this->input->post("content");
	    $res = $this->book->insertComment($id, $email, $star, $content);
    	echo json_encode(array("success" => $res));
	}

	public function deleteComment($id){
	    $id = urldecode($id);
	    $this->load->model("book");
	    $cmt = $this->book->selectComment($id);
	    if (empty($cmt)) {
	    	echo json_encode(array("success" => true));
	    	return;
	    }
	    $email = $this->input->cookie("email");
	    if ($cmt[0]['email'] != $email) {
	    	json_encode(array("success" => false));
	    	return;
	    }
	    $res = $this->book->deleteComment($id);
	    echo json_encode(array("success" => $res));
	}

	public function updateComment(){
	    $this->load->model("book");
	    $emailCookie = $this->input->cookie('email');
	    $emailCmt = $this->input->post('email');
	    if ($emailCookie != $emailCmt) {
	    	json_encode(array("success" => false));
	    	return;
	    } 
	    $id = $this->input->post("id");
	    $star = $this->input->post("star");
	    $content = $this->input->post("content");
	    $res = $this->book->updateComment($id, $star, $content);
	    echo json_encode(array("success" => $res, "star"=>$star, "id"=>$id));
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */