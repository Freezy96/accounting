<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->employee_model->getemployeedata();
		$data['result'] = $res;
    	$this->load->view('employee/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('employee/insert');
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
		$data = array(
		'employeename' => $this->input->post('employeename'),
		'salary' => $this->input->post('salary'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'contactnum' => $this->input->post('contactnum')
		);

		$return = $this->employee_model->insert($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('employee');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$employeeid = $this->input->post('employeeidedit');
		$res = $this->load->employee_model->getuserdataupdate($employeeid);
		$data['result'] = $res;
		$this->load->view('employee/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$employeeid = $this->input->post('employeeidedit');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'employeename' => $this->input->post('name'),
		'salary' => $this->input->post('salary'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'contactnum' => $this->input->post('contactnum')
		);

		$return = $this->employee_model->update($data, $employeeid);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('employee');
		}
		$this->load->view('template/footer');
	}

	public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'employeeid' => $this->input->post('employeeiddelete')
		);

		$return = $this->employee_model->delete($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('employee');
		}
		$this->load->view('template/footer');
	}
}


