<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Register extends CI_Model{
    function __construct(){
        parent::__construct();
    }


    public function regis($username, $password, $campany) {
    $this->db->set('username', $username);
    $this->db->set('password', $password);
    $this->db->set('campany', $campany );
        if ($this->db->insert('admin');
             INSERT INTO news (username, password, campany) VALUES ('$username', '$password', '$campany')
            ) {
            return $this->db->insert_id();
        } else {
            log_message ( 'error', 'register error-->' . $this->db->last_query () );
            return false;
        }return false;
    }
}
?>