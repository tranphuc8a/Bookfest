<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	public $config = array();

	public function __construct(){
		parent::__construct();
		$this->load->library("upload");
		$this->config = array(
			'overwrite'		=> true, 
			"upload_path" 	=> "./uploads/", 
			"allowed_types"	=> 'png|jpg|jpeg|gif'
		);
	}

	public function setFilename($filename){
	    $this->config['file_name'] = $filename;
	}
	public function setFilepath($filepath){
	    $this->config['upload_path'] = $filepath;
	}
	public function getFileURL(){
	    return base_url() . $this->config['file_name'] . $this->config['upload_path'];
	}

	public function index(){
		
	}

	public function loadConfig($config){
	    $this->upload->initialize($config, TRUE);
	}

	public function getErrors(){
	    return array_values($this->upload->error_msg);
	}

	public function upload($field){
	    $this->loadConfig($this->config);
	    if ($this->upload->do_upload($field)){
	    	$this->config['file_name'] = $this->upload->file_name;
	    	$this->config['file_path'] = $this->upload->file_path;

	    	return true;
	    }

	    return false;
	}

}

/* End of file File.php */
/* Location: ./application/controllers/File.php */