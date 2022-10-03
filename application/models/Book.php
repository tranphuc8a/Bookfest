<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Model {
	public $variable;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function selectDetailOne($id){
	    $query = "select * from BOOK, BOOK_INFO where BOOK.id = BOOK_INFO.id and BOOK.id = '$id' and BOOK.state not like 'deleted';";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    if (count($res) <= 0) return $res;
	    $images = $this->selectBookImage($id);
	    // $comments = $this->selectBookComment($id);
	    $res[0]["images"] = array_values(isset($images[0]) ? $images[0] : array());
	    // $res[0]["comments"] = $comments;	    
	    return $res;
	}

	public function selectBookImage($id){
	    $query = "select image1, image2, image3, image4, image5 from BOOK_IMAGE where id = '$id';";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function selectBookComment($productId){
	    $query = "select * from BOOK_COMMENT, PROFILE where productId = '$productId' and BOOK_COMMENT.email = PROFILE.email order by time asc;";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function selectComment($id){
	    $query = "select * from BOOK_COMMENT where BOOK_COMMENT.id = '$id'";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function insertComment($productId, $email, $star, $content){
	    $query = "insert into BOOK_COMMENT values(null, '$productId', '$email', '$star', '$content', now());";
	    return $this->db->query($query);
	}

	public function deleteComment($id){
	    $query = "delete from BOOK_COMMENT where BOOK_COMMENT.id = '$id'";
	    return $this->db->query($query);
	}

	public function updateComment($id, $star, $content){
	 	$query = "update BOOK_COMMENT set star = '$star', content = '$content' where BOOK_COMMENT.id = '$id'";
	    return $this->db->query($query);
	}

	public function selectAll(){
	    $query = "select * from BOOK, BOOK_INFO where BOOK.state not like 'deleted' and BOOK.id = BOOK_INFO.id;";
	    return $this->db->query($query)->result_array();
	}

	public function search($key){
		if (is_null($key) or $key == ""){
			return $this->selectAll();
		}
	    $query = "select * from BOOK, BOOK_INFO where BOOK.state not like 'deleted' and BOOK.id = BOOK_INFO.id and (locate(name, '$key') > 0 or name like '%$key%');";
	    $res = $this->db->query($query);
	    $res = $res->result_array();
	    return $res;
	}

	public function insertBook($email, $cost, $quantity, $sell){
	    $query = "insert into BOOK values(null, '$email', '$cost', '$quantity', '$sell', now(), 'OK');";
	    if ($this->db->query($query)){
	    	$query = "select * from BOOK where id in (SELECT LAST_INSERT_ID());";
			$result = $this->db->query($query);
			$res = $result->result_array();
			// mysqli_next_result( $this->db->conn_id );
			// $result->free_result();
			return $res;	
	    }
		return array();
	}

	public function insertBookInfo($id, $name, $author, $pages, $publisher, $detail, $avatar){
	    $query = "insert into BOOK_INFO values('$id', '$name', '$author', '$pages', '$publisher', '$detail', '$avatar');";
		return $this->db->query($query);
	}

	public function insertBookImage($id, $img){
	    $query = "delete from BOOK_IMAGE where BOOK_IMAGE.id = '$id';";
	    if ($this->db->query($query)){
	    	$query = "insert into BOOK_IMAGE values('$id', '$img[0]', '$img[1]', '$img[2]', '$img[3]', '$img[4]');";
	    	return $this->db->query($query);
	    }
	    return FALSE;
	}

	public function updateBook($id, $email, $cost, $quantity, $sell){
	    $query = "update BOOK set cost = '$cost', quantity = '$quantity', sell = '$sell' 
	    		where BOOK.id = '$id';";
	    return $this->db->query($query);
	}

	public function updateBookInfo($id, $name, $author, $pages, $publisher, $detail, $avatar){
	 	$query = "update BOOK_INFO set name = '$name', author = '$author', pages = '$pages', publisher = '$publisher',
	 			detail = '$detail', avatar = '$avatar' where BOOK_INFO.id = '$id';";
	    return $this->db->query($query);
	}

	public function updateBookImage($id, $img){
	    return $this->insertBookImage($id, $img);
	}

	public function deleteBookImage($id){
		$query = "delete from BOOK_IMAGE where id = '$id'";
		return $this->db->query($query);
	}

	public function deleteBookComment($id){
		$query = "delete from BOOK_COMMENT where id = '$id'";
		return $this->db->query($query);
	}

	public function deleteBookInfo($id){
	    $query = "delete from BOOK_INFO where id = '$id'";
		return $this->db->query($query);
	}

	public function deleteBook($id){
	    $query = "update BOOK set state='deleted' where id = '$id'";
	    return $this->db->query($query);
	}

	

}

/* End of file Book.php */
/* Location: ./application/models/Book.php */