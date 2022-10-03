<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookfest extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->output->delete_cache();
	}

	public function mail($from, $to, $subject, $content, $name = "Bookfest"){
	    $this->load->library('email');

		$this->email->from($from, $name);
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($content);

		return $this->email->send();
	}

	public function randomCode(){
		$res = "";
		for ($i = 1; $i <= 6; $i++){
			$res .= strval(rand(0, 9));
		}
		return $res;
	}

	public function checkLogin(){
		$email = $this->input->cookie('email');
		$tokenid = $this->input->cookie('tokenid');
		if (!is_null($tokenid) && !is_null($email)){
			$this->load->model('account');
			$res = $this->account->selectLogin($email);
			if (count($res) > 0 && $res[0]['tokenid'] == $tokenid){
				return true;
			}
		}
		return false;
	}

	public function defaultImage(&$img){
	    if (is_null($img) || $img==""){
	    	$img = base_url(). "image/404.jpg";
	    }
	}

}

/* End of file Bookfest.php */
/* Location: ./application/controllers/Bookfest.php */