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
    $company = $this->input->post('company');

    $this->db->select('username');
    $this->db->from('admin');
    $this->db->where('username',$username);
    $query=$this->db->get();

    if ($query->num_rows()>0) {

          echo "<script>alert(' Username already exist'); location.href='/accounting/register';</script>";
                        
         
    }else{

    $this->db->set('username', $username);
    $this->db->set('password', $password);
    $this->db->set('company', $company );
        if ($this->db->insert('admin')) {
            $sql = "INSERT INTO admin (username, password, company) VALUES ('$username', '$password', '$company')";
            $this->db->insert_id();  
            echo "<script>alert('Registered successfully!'); location.href='/accounting/register';</script>";
            
            
        }
        }
    }
        
    }

?>