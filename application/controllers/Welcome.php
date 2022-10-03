<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("Bookfest.php");

class Welcome extends Bookfest {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index(){
		if (!$this->checkLogin()){
			header("location: ". base_url() ."index.php/login/loginControl");
			return;
		}
		$this->load->model('account');
		$email = $this->input->cookie('email');
		$emailLogin = $this->account->selectUser($email);
		$role = $emailLogin[0]['role'];
		if ($role == 'admin'){
			header("location: ". base_url() ."index.php/user");
		} else {
			header("location: ". base_url() ."index.php/user");
		}
	}
}
