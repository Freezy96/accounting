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
    $this->db->select('username, password');
    $this->db->from('admin');
    
    $username = $this->input->post('username');
   
    
    $this->db->where('username',$username);
    $data=$this->db->get();

        
        $return = $this->password_model->update($data);
       
        
        $this->load->view('template/footer');
    }
}
    
        
    

?>