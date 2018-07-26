<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
        parent::__construct();
        $this->load->model('account_model');
    }

	public function index()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->account_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('account/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->account_model->getuserdatainsertcustomer();
		$data['result'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage();
		$data['package'] = $res;
		$this->load->view('account/insert', $data);
		$this->load->view('template/footer');
	}

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'customerid' => $this->input->post('customerid'),
		'packageid' => $this->input->post('packageid'),
		'oriamount' => $this->input->post('amount'),
		'amount' => $this->input->post('amount'),
		'payment' => $this->input->post('payment'),
		'datee' => $this->input->post('date')
		);

		$return = $this->account_model->insert($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('account');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$accountid = $this->input->post('accountid');
		$res = $this->load->account_model->getaccountdataupdate($accountid);
		$data['result'] = $res;
		$res = $this->load->account_model->getuserdatainsertcustomer();
		$data['customer'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage();
		$data['package'] = $res;
		$this->load->view('account/update', $data);
		$this->load->view('template/footer');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
