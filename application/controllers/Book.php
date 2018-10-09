<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('book_model');
        $this->load->model('security_model');
    }
  	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('Book/main');
		$this->load->view('template/footer');
	}

	public function inserttotal()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('Book/inserttotal');
		$this->load->view('template/footer');
	}
	public function inserttotaldata()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'description' => $this->input->post('description'),
		'type' => $this->input->post('type'),
		'amount' => $this->input->post('amount'),
		'datee' => $this->input->post('datee')
		);
		echo "<script>alert('insert successfully!'); location.href='/accounting/book/total';</script>";
		$return = $this->book_model->insertT($data);
		$data['return'] = $return;

		$this->load->view('template/footer');
	}
	public function insertcoh()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('Book/insertcoh');
		$this->load->view('template/footer');
	}
	public function insertcohdata()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'description' => $this->input->post('description'),
		'type' => $this->input->post('type'),
		'amount' => $this->input->post('amount'),
		'datee' => $this->input->post('datee')
		);
		echo "<script>alert('insert successfully!'); location.href='/accounting/book/coh';</script>";
		$return = $this->book_model->insertC($data);
		$data['return'] = $return;

		$this->load->view('template/footer');
	}
	public function insertbank()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('Book/insertbank');
		$this->load->view('template/footer');
	}
public function insertbankdata()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'description' => $this->input->post('description'),
		'type' => $this->input->post('type'),
		'amount' => $this->input->post('amount'),
		'datee' => $this->input->post('datee')
		);
		 echo "<script>alert('insert successfully!'); location.href='/accounting/book/bank';</script>";
		$return = $this->book_model->insertB($data);
		$data['return'] = $return;

		$this->load->view('template/footer');
	}
	public function insertemp()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('Book/insertemp');
		$this->load->view('template/footer');
	}
public function insertempdata()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'description' => $this->input->post('description'),
		'type' => $this->input->post('type'),
		'amount' => $this->input->post('amount'),
		'datee' => $this->input->post('datee')
		);
		echo "<script>alert('insert successfully!'); location.href='/accounting/book/emp';</script>";
		$return = $this->book_model->insertE($data);
		$data['return'] = $return;

		$this->load->view('template/footer');
	}

	public function bank(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
		$day = $this->input->post('date');

		if ($this->input->post('month')<10) {
			$month = "0".$this->input->post('month');
		}else{
			$month = $this->input->post('month');
		}
		
		$year = $this->input->post('year');
		
		
		$date_month = $year."-".$month;
		$date_year = $year;
		echo "<script>console.log(".$date_month.")</script>";
		echo "<script>console.log(".$date_year.")</script>";
        $res= $this->load->book_model->getbankdata($date_month);
        $data['result'] = $res;
        $result=$this->load->book_model->getbalancebank($date_month);
        $data['balance'] = $result;
    	$this->load->view('book/bank',$data);
    	$this->load->view('template/footer');

	}
		public function coh(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $day = $this->input->post('date');

		if ($this->input->post('month')<10) {
			$month = "0".$this->input->post('month');
		}else{
			$month = $this->input->post('month');
		}
		
		$year = $this->input->post('year');
		
		
		$date_month = $year."-".$month;
		$date_year = $year;
		echo "<script>console.log(".$date_month.")</script>";
		echo "<script>console.log(".$date_year.")</script>";
        $result=$this->load->book_model->getbalancecoh($date_month);
        $data['balance'] = $result;
        $res= $this->load->book_model->getcohdata($date_month);
        $data['result'] = $res;
    	$this->load->view('book/coh',$data);
    		$this->load->view('template/footer');

	}
		public function emp(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $day = $this->input->post('date');

		if ($this->input->post('month')<10) {
			$month = "0".$this->input->post('month');
		}else{
			$month = $this->input->post('month');
		}
		
		$year = $this->input->post('year');
		
		
		$date_month = $year."-".$month;
		$date_year = $year;
		echo "<script>console.log(".$date_month.")</script>";
		echo "<script>console.log(".$date_year.")</script>";
        $result=$this->load->book_model->getbalanceemp($date_month);
        $data['balance'] = $result;
        $res= $this->load->book_model->getempdata($date_month);
        $data['result'] = $res;
    	$this->load->view('book/emp',$data);
    		$this->load->view('template/footer');

	}
		public function Total(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $day = $this->input->post('date');

		if ($this->input->post('month')<10) {
			$month = "0".$this->input->post('month');
		}else{
			$month = $this->input->post('month');
		}
		
		$year = $this->input->post('year');
		
		
		$date_month = $year."-".$month;
		$date_year = $year;
		echo "<script>console.log(".$date_month.")</script>";
		echo "<script>console.log(".$date_year.")</script>";
        $result=$this->load->book_model->getbalancetotal($date_month);
        $data['balance'] = $result;
        $res= $this->load->book_model->gettotaldata($date_month);
        $data['result'] = $res;
    	$this->load->view('book/total',$data);
    		$this->load->view('template/footer');

	}

public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'bookid' => $this->input->post('bookiddelete')
		);

		$return = $this->employee_model->delete($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('book');
		}
		$this->load->view('template/footer');
	}
}
