<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expenses extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('print_model');
        $this->load->model('security_model');
        $this->load->model('expenses_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->expenses_model->getitemdata();
		$data['result'] = $res;
    	$this->load->view('expenses/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('expenses/insert');
		$this->load->view('template/footer');
	}

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////	
		$count = $this->input->post('count_times');
		for ($i=1; $i < $count+1; $i++) { 
			if ($this->input->post('expensesname'.$i)!="") {
				$data = array(
				'expensesitem' => $this->input->post('expensesname'.$i),
				'expensesfee' => $this->input->post('fee'.$i),
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'expensesdate' => date("Y-m-d")
				);

				$return = $this->expenses_model->insert($data);
			}
		}
		
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('expenses');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$expensesid = $this->input->post('expensesidedit');
		$res = $this->load->expenses_model->getuserdataupdate($expensesid);
		$data['result'] = $res;
		$this->load->view('expenses/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'expensesid' => $this->input->post('expensesidedit'),
		'expensesitem' => $this->input->post('itemname'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'expensesfee' => $this->input->post('fee')
		);

		$return = $this->expenses_model->update($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('expenses');
		}
		$this->load->view('template/footer');
	}

	public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'expensesid' => $this->input->post('expensesiddelete')
		);

		$return = $this->expenses_model->delete($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('expenses');
		}
		$this->load->view('template/footer');
	}
}
?>