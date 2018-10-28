<?php

class Password extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('security_model');
        $this->load->model('password_model');
    }

    public function index()
    {   $this->security_model->secure_session_login();
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $this->load->view('Password/main');
        $this->load->view('template/footer');
    }
    

    public function update(){

    $adminid = $this->session->userdata('adminid');
    $newpassword = $this->input->post('newpassword');

        
        $return['return'] = $this->password_model->update($adminid, $newpassword);

        $this->session->set_flashdata('return',$return);

        echo "<script>window.location.href='".base_url()."password';</script>";
       
        
        $this->load->view('template/footer');
    }
}
    
        
    

?>