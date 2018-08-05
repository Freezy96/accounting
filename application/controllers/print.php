<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class print extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('print_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->print_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('Print/main', $data);
		$this->load->view('template/footer');
	}
}
?>