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
         $this->db->select("*");
          $this->db->from('customer');
          $blacklist='0';
          $this->db->where('blacklist',$blacklist);
        $query = $this->db->get();
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
           if(($status==""||$status=="closed") && $status!="late"&& $status!="baddebt"&& $status!=="0"){
                $statuscus="good";
           }elseif($status!="" && $status=="baddebt" && $status!=="0"){ 
                $statuscus="baddebt";
           }elseif($status!="" && $status=="late" && $status!="baddebt" && $status!=="0"){
                $statuscus="late";
           }

           $data = array(
            'status' => $statuscus
            );
        $this->db->where('customerid', $customerid);
        $this->db->update('customer', $data);
           

    }
}
public function reset_status($data){
  foreach ($data as $key => $value) {
           $customerid = $value['customerid'];
            $status = $value['status'];
        }
             $statuscus= $status;
             $statuscus="0";
           $data = array(
            'status' => $statuscus
            );
        $this->db->where('customerid', $customerid);
        $this->db->update('customer', $data);

}
        public function getstatus(){
        // Run the query
        $this->db->select('customerid, status');
        $this->db->from('customer');
        $query = $this->db->get();

        return $query->result_array();
    }

public function blackliststatus(){
        $data=$this->customer_model->getstatus();
         foreach ($data as $key => $value) {
           $customerid= $value['customerid'];
           $status = $value['status'];

           $blacklist= 0;
          if($status=="baddebt"){ 
                $blacklist="1";
           }
           $data = array(
            'blacklist' => $blacklist
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

      public function getblacklistuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('b.customerid, c.customername, c.address ,c.gender ,c.phoneno ,c.wechatname ,c.passport ,c.photopath');
        $this->db->from('blacklist b');
        $this->db->join('customer c', 'b.customerid = c.customerid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('c.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();

        return $query->result_array();
    }

 public function getblacklistdata(){
        // Run the query
          $this->db->select("*");
          $this->db->from('customer');
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
         
          $blacklist='1';
          $this->db->where('blacklist',$blacklist);
          $query = $this->db->get();
        return $query->result_array();
    }

    public function get_customer_payment_modal($customerid){
        // Run the query

        $this->db->select("p.paymentid, p.accountid, p.payment, p.paymenttype, p.paymentdate, c.customerid, c.customername, pt.packagetypename");
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('packagetype pt', 'a.packagetypeid = pt.packagetypeid', 'left');
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('c.companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $this->db->where('c.customerid', $customerid);

        $query = $this->db->get();
        return $query->result_array();
    }

}
?>
