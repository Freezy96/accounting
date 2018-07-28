<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function logout()
    {
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect('default_controller');
    }
}
?>
