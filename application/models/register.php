<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Register extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function register($username, $password, $campany) {
        if ($this->db->insert ( $this->table_name, array (
                'username' => $username,
                'password' => $password,
                'campany' => $campany  
        ) )) {
            return $this->db->insert_id();
        } else {
            log_message ( 'error', 'register error-->' . $this->db->last_query () );
            return false;
        }return false;
    }
    public function login($name, $password, $campany) {
        $this->db->where ( array (
                'username' => $username,
                'password' => $password,
                'campany' => $campany   
        ) );
        $query = $this->db->get ( $this->table_name );
        return $query->row_array ();
    }
}
?>