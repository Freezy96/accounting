<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baddebt extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('baddedt_model');
        $this->load->model('security_model');
    }
    public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->baddedt_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('baddedt/main', $data);
		$this->load->view('template/footer');
	}
}