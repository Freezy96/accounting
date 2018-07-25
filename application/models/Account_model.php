<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $this->db->select('a.accountid, c.customername, a.amount, a.payment, a.datee, a.interest, a.duedate, a.packageid');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getuserdatainsert(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('customer');
        return $query->result_array();
    }
}
?>
