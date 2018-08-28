<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get('customer');
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('customer', $data)){
        	$return = "insert";
        	return $return;
        }else{
        	$return = "false";
        	return $return;
        }

    }

    public function getuserdataupdate($customerid){
        // Run the query
        $customerid = $customerid;
        $this->db->where('customerid', $customerid);
        $query = $this->db->get('customer');
        return $query->result_array();
    }

        public function getuserstatus($customerid){
        // Run the query
        $this->db->select('c.customerid, a.status');
        $this->db->from('customer c');
        $this->db->join('account a', 'c.customerid = a.customerid', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }
     public function userstatus($customerid){
        $data=$this->customer_model->getuserstatus($customerid);
         foreach ($data as $key => $value) {
           $status = $value['status'];
        }

        }


    public function update($data){
        foreach ($data as $key => $value) {
           $customerid = $value['customerid'];
        }
        $this->db->where('customerid', $customerid);
        if($this->db->replace('customer', $data)){
            $return = "update";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function delete($data){
        
        if($this->db->delete('customer', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }
}
?>
