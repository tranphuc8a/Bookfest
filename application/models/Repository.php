<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repository extends CI_Model {
	public $variable;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function selectAll($email){
	    $query = "select * from BOOK, BOOK_INFO where BOOK.state not like 'deleted' and 
	    		BOOK.id = BOOK_INFO.id and BOOK.email = '$email';";
	    return $this->db->query($query)->result_array();
	}

	public function search($email, $key){
		if (is_null($key) or $key == ""){
			return $this->selectAll($email);
		}
	    $query = "select * from BOOK, BOOK_INFO where BOOK.state not like 'deleted' and 
	    		BOOK.id = BOOK_INFO.id and (locate(name, '$key') > 0 or name like '%$key%') and BOOK.email = '$email';";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

}

/* End of file Repository.php */
/* Location: ./application/models/Repository.php */