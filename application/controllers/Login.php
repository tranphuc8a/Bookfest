<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("Bookfest.php");

class Login extends Bookfest {
	public function __construct(){
		parent::__construct();
	}
	
	public function loginControl(){
		echo date("Y-m-d H:i:s", strtotime('+ 5 hours'));
		$this->load->view('loginview');
	}

	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->load->model("account");
		$res = $this->account->selectUser($email);
		if (count($res) == 0){
			echo "Account not exist";
		} else if ($password != $res[0]['hashmk']){
			echo "password is wrong";
		} else {
			echo "success";
			$token = md5($email.$password.strval(time()));
			$this->account->updateLogin($email, $token);
			$this->input->set_cookie('email', $email, 24*3600);
			$this->input->set_cookie('tokenid', $token, 24*3600);
		}
	}

	public function api_code_register(){
		$cookie_code = $this->input->cookie('cookie_code');
		if (!is_null($cookie_code)){
			// $this->input->set_cookie('cookie_code', $code, -2*60);
			echo "Vui lòng đợi 2 phút";
			return;
		}
		$email = $this->input->post('email');
	    $this->load->model('account');
	    // check:
	    $res = $this->account->selectUser($email);
	    if (count($res) > 0){
	    	echo "Email đã đăng ký";
	    } else {
	    	$code = $this->randomCode();
	    	$this->input->set_cookie('cookie_code', md5($code), 2*60);
	    	$this->account->updateCode($email, md5($code));
	    	$header = "Code for registering Bookfest account";
	    	$content = "Thankyou for registering Bookfest.<br>Your code is " . $code;
	    	$this->mail("bksnet20222@gmail.com", $email, $header, $content);
	    	echo "Đã gửi mã code tới email của bạn, hiệu lực 2 phút";
	    }
	}

	public function api_code_forgot_pass(){
		$cookie_code = $this->input->cookie('cookie_code');
		if (!is_null($cookie_code)){
			// $this->input->set_cookie('cookie_code', $code, -2*60);
			echo "Vui lòng đợi 2 phút";
			return;
		}
		$email = $this->input->post('email');
	    $this->load->model('account');
	    // check:
	    $res = $this->account->selectUser($email);
	    if (count($res) <= 0){
	    	echo "Email không tồn tại";
	    } else {
	    	$code = $this->randomCode();
	    	$this->input->set_cookie('cookie_code', md5($code), 2*60);
	    	$this->account->updateCode($email, md5($code));
	    	$header = "Code for reseting Bookfest account";
	    	$content = "Secure your account!<br>Your code is " . $code;
	    	$this->mail("bksnet20222@gmail.com", $email, $header, $content);
	    	echo "Đã gửi mã code tới email của bạn, hiệu lực 2 phút";
	    }	
	}

	public function register(){
		$cookie_code = $this->input->cookie('cookie_code');
		if (is_null($cookie_code)){
			echo "Code hết hạn, vui lòng thao tác lại";
			return;
		}
		$code = $this->input->post('code');
	    $email = $this->input->post('email');
	    $this->load->model('account');
	    $trueCode = $this->account->selectCode($email)[0]['code'];
		if (md5($code) != $trueCode){
			echo "Code sai, vui lòng nhập lại";
			return;	
		}
	    // check:
	    $res = $this->account->selectUser($email);
	    if (count($res) > 0){
	    	echo "Email đã đăng ký";
	    	return;
	    }
	    // create new account:
	    $password = $this->input->post('password');
	    $name = $this->input->post('name');
	    $phone = $this->input->post('phone');
	    $role = $this->input->post('role');
	    $dob = $this->input->post('strdob');
	    $res = $this->account->insertUser($email, $password, $role, $name, $phone, $dob);
	    if ($res){
	    	echo "Đăng ký thành công";
	    	$this->input->set_cookie('cookie_code', '', 0);
	    } else {
	    	echo "Đăng ký không thành công";
	    }
	}

	public function validate_code(){
		$cookie_code = $this->input->cookie('cookie_code');
		if (is_null($cookie_code)){
			echo "Code hết hạn, vui lòng thao tác lại";
			return;
		}
		$code = $this->input->post('code');
	    $email = $this->input->post('email');
	    $this->load->model('account');
	    $trueCode = $this->account->selectCode($email)[0]['code'];
		if (md5($code) != $trueCode){
			echo "Code sai, vui lòng nhập lại";
			return;	
		}
		$this->input->set_cookie('cookie_code', '', 0);
		echo "success";
	}

	public function forgot_pass(){
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	    $this->load->model('account');
	    $res = $this->account->changePassword($email, $password);
	    if ($res){
	    	echo "Đổi mật khẩu thành công";
	    } else {
	    	echo "Đổi mật khẩu thất bại";
	    }   
	}

	public function logout(){
		$this->input->set_cookie('email', '$email', 0);
		$this->input->set_cookie('tokenid', '$token', 0);
		header("location: ".base_url()."index.php/welcome");
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */