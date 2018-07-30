<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('security_model');
    }

    public function index()
    {   $this->security_model->secure_session_login();
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $this->load->view('register/main');
        $this->load->view('template/footer');
    }

    public function process(){

    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $campany = $this->input->post('campany');

        // Load the model
        $this->load->model('register_model');
        // Validate the user can logi
        $result = $this->register_model->regis($username, $password, $campany);
        // Now we verify the result
        if(! $result){
            echo "<script>alert('Registered successfully!')</script>";
         
        }else{

            redirect('register');
        }        
    }
}
?>