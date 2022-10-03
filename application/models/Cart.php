<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Model {
	public $variable;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertBookToCart($email, $id, $quantity){
	    $query = "select * from CART where email = '$email' and id = '$id';";
	    $res = $this->db->query($query)->result_array();
	    if (count($res) > 0){
	    	$quantity = (int) $quantity + (int) $res[0]['quantity'];
	    	$query = "update CART set quantity = '$quantity' where id = '$id' and email = '$email';";
	    	return $this->db->query($query);
	    } else {
	    	$query = "insert into CART values('$email', '$id', '$quantity', now());";
	    	return $this->db->query($query);
	    }
	}

	public function selectAll($email){
	    $query = "select CART.id, BOOK_INFO.name, BOOK.cost, CART.quantity as quantity, BOOK_INFO.avatar, BOOK.quantity as bookquantity, BOOK.sell, CART.email from CART, BOOK, BOOK_INFO WHERE CART.id = BOOK.id and BOOK.id = BOOK_INFO.id and BOOK.state not like 'deleted' and CART.email = '$email';";
	    return $this->db->query($query)->result_array();
	}

	public function search($email, $key){
		if (is_null($key) or $key == ""){
			return $this->selectAll($email);
		}
	    $query = "select CART.id, BOOK_INFO.name, BOOK.cost, CART.quantity as quantity, BOOK_INFO.avatar, BOOK.quantity as bookquantity, BOOK.sell, CART.email from CART, BOOK, BOOK_INFO WHERE CART.id = BOOK.id and BOOK.id = BOOK_INFO.id and BOOK.state not like 'deleted' and CART.email = '$email' and BOOK.id = BOOK_INFO.id and (locate(name, '$key') > 0 or name like '%$key%');";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function deleteBookFromCart($email, $id){
	    $query = "delete from CART where email = '$email' and id = '$id';";
	    return $this->db->query($query);
	}

	public function updateBookFromCart($email, $id, $quantity){
	    $query = "update CART set quantity = '$quantity' where email = '$email' and id = '$id';";
	    return $this->db->query($query);
	}

}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */