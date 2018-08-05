<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class print_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $query = $this->db->get('customer');
        return $query->result_array();
    }
    }
?>
