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
            $id = $this->db->insert_id();
        	return $id;
        }else{
        	$return = "false";
        	return $return;
        }

    }

    public function submit_profile($picture){
        $this->db->insert('tbl_st_picture', $picture);
        }

    public function getuserdataupdate($customerid){
        // Run the query
        $customerid = $customerid;
        $this->db->where('customerid', $customerid);
        $query = $this->db->get('customer');
        return $query->result_array();
    }

        public function getuserstatus(){
        // Run the query
        $this->db->select('c.customerid, a.status');
        $this->db->from('customer c');
        $this->db->join('account a', 'a.customerid = c.customerid', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }
     public function userstatus($customerid){
        $data=$this->customer_model->getuserstatus($customerid);
         foreach ($data as $key => $value) {
           $status = $value['status'];
        }

        }

public function checkuserstatus(){
        $data=$this->customer_model->getuserstatus();
         foreach ($data as $key => $value) {
           $customerid= $value['customerid'];
           $status = $value['status'];

           $statuscus= $status;
           if(($status=""||$status=="closed") && $statuscus!="late"&& $statuscus!="baddebt"){
                $statuscus="good";
           }elseif($status!="" && $status="baddebt"){ 
                $statuscus="bad";
           }elseif($status!="" && $status="late" && $statuscus!="baddebt"){
                $statuscus="late";
           }

           $data = array(
            'status' => $statuscus
            );
        $this->db->where('customerid', $customerid);
        $this->db->update('customer', $data);
           

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

    public function update_photo_pathname($return_id, $fpath){
        $this->db->where('customerid',$return_id);
        $this->db->update('customer', array('photopath' => $fpath));
        $return = "insert";
        return $return;
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
