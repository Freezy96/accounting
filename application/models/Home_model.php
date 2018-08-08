<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $this->db->select('a.accountid, a.oriamount, a.customerid, c.customername, a.amount, a.payment, a.datee, a.interest, a.duedate, a.packageid, c.phoneno, ag.agentname, p.name');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('package p', 'a.packageid = p.packageid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>
