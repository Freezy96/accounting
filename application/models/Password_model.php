<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function update($data){
        $password = $this->input->post('password');
        $newpassword = $this->input->post('newpassword'); 
        if($this->db->where('password', $password)){
            foreach ($data as $key => $value) {
            $data = array(
            'password' => $newpassword
            );
       
            if($this->db->update('admin', $data)){
                $return = "update";
              
           
             }
        } 
        echo "<script>alert('Change successfully!')</script>";
    }else{
           
             echo "<script>alert('Password Error!')</script>"; 
        }
    }
}
?>