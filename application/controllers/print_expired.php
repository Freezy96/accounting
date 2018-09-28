<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Print_Expired extends CI_Controller {
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
		$date = $this->input->post('date');
		$result_duedate = $this->load->print_model->get_accountid_duedate_that_day($date);
		$i = 0;
        foreach ($result_duedate as $key => $value) {
            $refid = $value['refid'];
            $duedate = $value['MAX(a.duedate)'];
            $res = $this->load->print_model->getuserdata($refid,$duedate);
            $data['result' . $i] = $res;
            $i++;
        }
		$data['count'] = $i;
    	$this->load->view('print/main', $data);
		$this->load->view('template/footer');
	}
}
?>