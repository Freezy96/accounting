<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $query = $this->db->get('customer');
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('customer', $data)){
        	$return = true;
        	return $return;
        }else{
        	$return = false;
        	return $return;
        }

    }
}
?>
