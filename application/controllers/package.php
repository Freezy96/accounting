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
    $res = $this->load->Package_model->main_25_month();
    $data['main_25_month'] = $res;
    $res = $this->load->Package_model->main_20_week();
    $data['main_20_week'] = $res;
    $res = $this->load->Package_model->main_15_week();
    $data['main_15_week'] = $res;
    $res = $this->load->Package_model->main_10_week();
    $data['main_10_week'] = $res;
    $res = $this->load->Package_model->main_15_5days();
    $data['main_15_5days'] = $res;
    $res = $this->load->Package_model->main_10_5days();
    $data['main_10_5days'] = $res;
    $res = $this->load->Package_model->main_manual_payeveryday_manualdays();
    $data['main_manual_payeveryday_manualdays'] = $res;
    $res = $this->load->Package_model->main_manual_5days_4week();
    $data['main_manual_5days_4week'] = $res;
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

  public function insert_manual_payeveryday_manualdays()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    ///////////////Combo of User Identity Insert///////////////////
    $company_identity = $this->session->userdata('adminid');
    ///////////////Combo of User Identity Insert///////////////////
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $this->input->post('interest'),
    'totalamount' => $this->input->post('totalamount'),
    'amounteveryday' => $this->input->post('amounteveryday'),
    ///////////////Combo of User Identity Insert///////////////////
    'companyid' => $company_identity,
    ///////////////Combo of User Identity Insert///////////////////
    'days' => $this->input->post('days')
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_manual_payeveryday_manualdays($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_manual_payeveryday_manualdays()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_manual_payeveryday_manualdays($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function insert_manual_5days_4week()
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
    $return = $this->Package_model->insert_manual_5days_4week($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_manual_5days_4week()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_manual_5days_4week($data);
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
    $lentamount = $this->input->post('lentamount');
    $interest= $this->input->post('interest');
    $totalamount= ($lentamount*1.2);
    $company_identity = $this->session->userdata('adminid');
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $interest,
    'totalamount' => $totalamount,
     'companyid' => $company_identity
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_20_week($data);
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
    $lentamount = $this->input->post('lentamount');
    $interest= $this->input->post('interest');
    $totalamount= ($lentamount*1.15);
    $company_identity = $this->session->userdata('adminid');
    $data = array(
   
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $interest,
    'totalamount' => $totalamount,
     'companyid' => $company_identity
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_15_week($data);
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
    $return = $this->load->Package_model->delete_15_week($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }

    $this->load->view('template/footer');
  }
  public function insert_10_week()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $lentamount = $this->input->post('lentamount');
    $interest= $this->input->post('interest');
    $totalamount= ($lentamount*1.10);
    $company_identity = $this->session->userdata('adminid');
    $data = array(
   
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $interest,
    'totalamount' => $totalamount,
     'companyid' => $company_identity
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_10_week($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }
 
  public function delete_10_week()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_10_week($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }

    $this->load->view('template/footer');
  }
  public function insert_15_5days()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $lentamount = $this->input->post('lentamount');
    $interest= $this->input->post('interest');
    $totalamount= ($lentamount*1.15);
    $company_identity = $this->session->userdata('adminid');
    $data = array(
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $interest,
    'totalamount' => $totalamount,
     'companyid' => $company_identity
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_15_5days($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }

  public function delete_15_5days()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_15_5days($data);
    $data['return'] = $return;

    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }

    $this->load->view('template/footer');
  }
  public function insert_10_5days()
  { $this->security_model->secure_session_login();
    $this->load->helper('url');
    $lentamount = $this->input->post('lentamount');
    $interest= $this->input->post('interest');
    $totalamount= ($lentamount*1.1);
    $company_identity = $this->session->userdata('adminid');
    $data = array(
 
    'lentamount' => $this->input->post('lentamount'),
    'interest' => $interest,
    'totalamount' => $totalamount,
     'companyid' => $company_identity
    );
    $this->load->model('Package_model');
    $return = $this->Package_model->insert_10_5days($data);
    $data['return'] = $return;
    if($return == true){
      // session to sow success or not, only available next page load
      $this->session->set_flashdata('return',$data);
      redirect('package');
    }
    $this->load->view('template/footer');
  }
 
  public function delete_10_5days()
  { 
    $this->load->helper('url');
    $this->load->view('template/header');
    $this->load->view('template/nav');
    
    $data = array(
    'packageid' => $this->input->post('packagedelete')
    );
    // $this->load->model('Package_model');
    $return = $this->load->Package_model->delete_10_5days($data);
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