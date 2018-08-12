<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $this->db->select('a.accountid, a.customerid, c.customername, a.oriamount, a.amount, a.payment, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, p.name');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('package p', 'a.packageid = p.packageid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getuserdatamodal($data){
        // Run the query
        $refid = $this->getrefid($data);
        foreach ($refid as $value) {
            $refid_res = $value['refid'];
        }
        $this->db->select('a.accountid, a.refid, a.oriamount, a.customerid, c.customername, a.amount, a.payment, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.name');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('package p', 'a.packageid = p.packageid', 'left');
        $this->db->where('refid', $refid_res);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getrefid($data){
        // Run the query
        $this->db->select('refid');
        $this->db->from('account');
        $this->db->where('accountid', $data);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_max_refid(){
        // Run the query
        $this->db->select_max('refid');
        $this->db->from('account');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getuserdatainsertcustomer(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('customer');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_30_4week(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('package_30_4week');
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('account', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function getaccountdataupdate($accountid){
        // Run the query
        $accountid = $accountid;
        $this->db->where('accountid', $accountid);
        $query = $this->db->get('account');
        return $query->result_array();
    }
}
?>
