<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function secure_session_login(){
        // Run the query
        $userid = $this->session->userdata('adminid');
        if($userid == "")
        {
            echo "<script>alert('Plese Login First !');</script>";
            echo "<script>window.location.replace('login');</script>";
        }

    }

}
?>
