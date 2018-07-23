<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
public function index()
    {   
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('register/main');
        $this->load->view('template/footer');
    }

    public function process(){
        // Load the model
        $this->load->model('register_model');
        // Validate the user can login
        $result = $this->register_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $this->index();
        }else{
            // If user did validate, 
            // Send them to members area
            redirect('home');
        }        
    }
}