<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Register_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
   

    public function regis($username, $password, $campany) {
    $this->db->select('username');
    $this->db->from('admin');
    $this->db->where('username',$username);
    $query=$this->db->get();

    if ($query->num_rows()>0) {
redirect('register');
          echo "<script>alert(' Username is available')</script>";
                      
         
    }else{

    $this->db->set('username', $username);
    $this->db->set('password', $password);
    $this->db->set('campany', $campany );
        if ($this->db->insert('admin')) {
            $sql = "INSERT INTO admin (username, password, campany) VALUES ('$username', '$password', '$campany')";
            return $this->db->insert_id();  
            redirect('register');
            echo "<script>alert('Registered successfully!')</script>";

        } else {

            return false;
        }return false;
    }
}

    
    }

?>