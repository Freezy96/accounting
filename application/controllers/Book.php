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
		'bank'=> $this->input->post('bank'),
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
		$date = date("Y-m-d");	
		$data = array(
		
		'amount' => $this->input->post('amount'),
		'datee' => $date
		);
		echo "<script>alert('insert successfully!'); location.href='/accounting/book/bank';</script>";
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
		'bank'=> $this->input->post('bank'),
		'type' => $this->input->post('type'),
		'amount' => $this->input->post('amount'),
		'datee' => $this->input->post('datee')
		);
		 echo "<script>alert('insert successfully!'); location.href='/accounting/book/bank';</script>";
		$return = $this->book_model->insertB($data);
		$data['return'] = $return;

		$this->load->view('template/footer');
	}
	
	public function bank(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
		$date = $this->input->post('date');
		if ($date == "") {
			$date = date("Y-m-d");
		}
        $res= $this->load->book_model->getbankdata($date);
        $data['result'] = $res;
        $result=$this->load->book_model->getbalancebank($date);
        $data['balance'] = $result;
        $result1=$this->load->book_model->getbalancembb($date);
        $data['mbb'] = $result1;
        $result2=$this->load->book_model->getbalancepbb($date);
        $data['pbb'] = $result2;
        $result3=$this->load->book_model->getbalancerhb($date);
        $data['rhb'] = $result3;
        $result4=$this->load->book_model->getbalancehlb($date);
        $data['hlb'] = $result4;
        $res2= $this->load->book_model->getcohdata($date);
        $data['coh'] = $res2;
        $res_all_coh= $this->load->book_model->get_all_cohdata();
        $data['all_coh'] = $res_all_coh;
        // echo "<script>console.log(".$result.")</script>";
        
    	$this->load->view('book/bank',$data);
    	$this->load->view('template/footer');

	}
		public function coh(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $date = $this->input->post('date');
       
        $result=$this->load->book_model->getbalancecoh($date);
        $data['balance'] = $result;
        $res= $this->load->book_model->getcohdata($date);
        $data['result'] = $res;
    	$this->load->view('book/coh',$data);
    	$this->load->view('template/footer');

	}
		
		public function Total(){
		$this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $date = $this->input->post('date');
        if ($date == "") {
			$date = date("Y-m-d");
		}
        $result= $this->load->book_model->gettotaldata($date);
        $data['result'] = $result;
        $res=$this->load->book_model->getbalancetotal($date);
        $data['balance'] = $res;
    	$this->load->view('book/Total',$data);
    	$this->load->view('template/footer');

	}

	public function delete_bank()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'bookid' => $this->input->post('book_bank_id')
		);

		$return = $this->book_model->delete_bank($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('book/bank');
		}
		$this->load->view('template/footer');
	}

	public function delete_total()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'bookid' => $this->input->post('book_total_id')
		);

		$return = $this->book_model->delete_total($data);
		$data['return'] = $return;

		if($return == true){

			$this->session->set_flashdata('return',$data);
			redirect('book/total');
		}
		$this->load->view('template/footer');
	}
}
