<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blacklist_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get('blacklist');
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('blacklist', $data)){
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

    public function getuserdataupdate($blacklistid){
        // Run the query
        $blacklistid = $blacklistid;
        $this->db->where('blacklistid', $blacklistid);
        $query = $this->db->get('blacklist');
        return $query->result_array();
    }

        public function getuserstatus(){
        // Run the query
        $this->db->select('b.customerid, a.status');
        $this->db->from('blacklist b');
        $this->db->join('account a', 'a.customerid = b.customerid', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }
     public function userstatus($blacklistid){
        $data=$this->blacklist_model->getuserstatus($blacklistid);
         foreach ($data as $key => $value) {
           $status = $value['status'];
        }

        }

public function checkuserstatus(){
        $data=$this->blacklist_model->getuserstatus();
         foreach ($data as $key => $value) {
           $blacklistid= $value['blacklistid'];
           $status = $value['status'];

           if($status!="" && $status=="baddebt"){ 
        $this->db->select(*);
        $this->db->from('customer');
        $this->db->join('account a', 'a.customerid = b.customerid', 'left');
           }

           $data = array(
            'status' => $statuscus
            );
        $this->db->where('blacklistid', $blacklistid);
        $this->db->update('blacklist', $data);
           

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
