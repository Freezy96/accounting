<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baddebt extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Baddebt_model');
        $this->load->model('security_model');
    }

    public function index()
    {   $this->security_model->secure_session_login();
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $res = $this->load->baddebt_model->getaccountdata();
		$data['result'] = $res;
        $this->load->view('baddebt/main', $data);
        $this->load->view('template/footer');


	
        }
    

    public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('customer/insert');
		$this->load->view('template/footer');
	}

	public function baddebt_insert_db()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$date_today = date("Y-m-d");
		$status = $this->input->post('status');

		if($this-> $status=="baddebt")
			{
			$data = array(
				'accountid' => $this->input->post('accountid' . $i),
				'datee' => $date_today
				);
			$return = $this->account_model->insert_baddebt($data);

			}

		
	}
}

