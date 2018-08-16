<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

  function __construct(){
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->model('security_model');
    }

  public function index()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    $res = $this->load->Package_model->main_30_4week();
    $data['main_30_4week'] = $res;
    // $res = $this->load->Package_model->getpackagedata();
    // $data['result'] = $res;
    // $res = $this->load->Package_model->getpackagedata();
    // $data['result'] = $res;
    $res = $this->load->Package_model->main_25_month();
    $data['main_25_month'] = $res;
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

 public function insert_30_4week()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    ///////////////Combo of User Identity Insert///////////////////
    $company_identity = $this->session->userdata('adminid');
    ///////////////Combo of User Identity Insert///////////////////
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    'totalamount' => $this->input->post('totalamount'),
    'week1' => $this->input->post('week1'),
    'week2' => $this->input->post('week2'),
    'week3' => $this->input->post('week3'),
    ///////////////Combo of User Identity Insert///////////////////
    'companyid' => $company_identity,
    ///////////////Combo of User Identity Insert///////////////////
    'week4' => $this->input->post('week4')
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_30_4week($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_30_4week()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_30_4week($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function insert_25_month()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    ///////////////Combo of User Identity Insert///////////////////
    $company_identity = $this->session->userdata('adminid');
    ///////////////Combo of User Identity Insert///////////////////
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    ///////////////Combo of User Identity Insert///////////////////
    'companyid' => $company_identity,
    ///////////////Combo of User Identity Insert///////////////////
    'totalamount' => $this->input->post('totalamount')
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_25_month($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_25_month()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_25_month($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

 public function insert_20_week()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    'totalamount' => $this->input->post('totalamount'),
    'week1' => $this->input->post('week1'),
    'week2' => $this->input->post('week2'),
    'week3' => $this->input->post('week3'),

    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_30_4week($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_20_week()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_20_week($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }

    $this->load->view('template/footer');
  }
  public function insert_15_week()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    'totalamount' => $this->input->post('totalamount'),
    'week1' => $this->input->post('week1'),
    'week2' => $this->input->post('week2'),
    'week3' => $this->input->post('week3'),

    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_30_4week($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_15_week()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_20_week($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }

    $this->load->view('template/footer');
  }
}
?>