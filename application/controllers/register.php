<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
public function index()
    {   
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('register/main');
        $this->load->view('template/footer');
    }

    public function process(){
        // Load the model
        $this->load->model('register');
        // Validate the user can login
        $result = $this->register->validate();
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