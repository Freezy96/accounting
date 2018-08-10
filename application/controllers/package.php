<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->Package_model->getpackagedata();
		$data['result'] = $res;
    	$this->load->view('Package/main', $data);
		$this->load->view('template/footer');
	}
	public function inset(){

    $amount = $this->input->post('amount');
    $persent = $this->input->post('persent');
    $days = $this->input->post('days');

        // Load the model
        $this->load->model('Package_model');
        // Validate the user can logi
        $result = $this->Package_model->insetP($amount, $persent, $days);
        // Now we verify the result
        
    }
     public function edit(){
  try{
  	$amount = $this->input->post('amount');
    $persent = $this->input->post('persent');
    $days = $this->input->post('days');

  
    $this->package_model->editP($amount, $persent, $days);
   
   echo 'success';
  }catch(Exception $e){
   echo $e;
  }
 }

 public function delete(){
  try{
   $this->package_model->deleteP($this->input->post('packageid'));
  }catch(Exception $e){
   echo 'error';
  }
  echo 'success';
 }

 public function insert()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    // $res = $this->load->Package_model->getpackagedata();
    // $data['result'] = $res;
    $this->load->view('Package/insert');
    $this->load->view('template/footer');
  }

 public function qqq()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');

    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    'totalamount' => $this->input->post('totalamount'),
    'week1' => $this->input->post('week1'),
    'week2' => $this->input->post('week2'),
    'week3' => $this->input->post('week3'),
    'week4' => $this->input->post('week4')
    );
    $res = $this->load->Package_model->qwe($data);
    $data['result'] = $res;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

}
?>