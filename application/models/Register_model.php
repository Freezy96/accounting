<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Register_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
   

    public function regis($username, $password, $campany) {
 $this->db->set('username', $username);
    $this->db->set('password', $password);
    $this->db->set('campany', $campany );
        if ($this->db->insert('admin')) {
            $sql = "INSERT INTO admin (username, password, campany) VALUES ('$username', '$password', '$campany')";
            return $this->db->insert_id();
        } else {

            return false;
        }return false;
    }
}
?>