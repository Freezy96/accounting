<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agent_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $this->db->select('ag.agentname, ag.charge, ag.companyid, ag.salary, ag.agentid, ap.payment');
        $this->db->from('agent ag');
        $this->db->join('agentpayment ap', 'ag.agentid = ap.agentid', 'left');
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('agent', $data)){
        	$return = "insert";
        	return $return;
        }else{
        	$return = "false";
        	return $return;
        }

    }

    public function getuserdataupdate($agentid){
        // Run the query
        $agentid = $agentid;
        $this->db->where('agentid', $agentid);
        $query = $this->db->get('agent');
        return $query->result_array();
    }

    public function update($data){
        foreach ($data as $key => $value) {
           $agentid = $value['agentid'];
        }
        $this->db->where('agentid', $agentid);
        if($this->db->replace('agent', $data)){
            $return = "update";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function delete($data){
        
        if($this->db->delete('agent', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }

    public function insert_payment($data){
        if($this->db->insert('agentpayment', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function get_agent_payment(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get('agent');
        return $query->result_array();

    }
}
?>
