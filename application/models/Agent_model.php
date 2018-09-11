<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agent_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get('agent');
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
        $this->db->select('SUM(payment), agentid');
        $this->db->from('agentpayment');
        $this->db->group_by('agentid');
        $query = $this->db->get();
        return $query->result_array();

    }
    ////////////////////////////////////////////////////////////////////////////////////////
    // public function count_agent_salary()
    // {
    //     //sum all accountline totalamount
    //     $result_complete_paid = $this->check_complete_paid_account();
    //     //get all agent id
    //     $get_all_agent = $this->load->agent_model->getuserdata();
    //     //create variable liek salary1, salary2, using agentid
    //     foreach ($get_all_agent as $key => $value_agent) {
    //         $create_agent_salary_variable = $value_agent['agentid'];
    //         ${'salary'.$create_agent_salary_variable} = 0;
    //     }
    //     foreach ($result_complete_paid as $key => $value) {
    //         //check sum of totalamount is 0 or not
    //         $totalamount_check = $value['SUM(totalamount)'];
    //         echo "<script>console.log(".$totalamount_check.");</script>";
    //         if($totalamount_check<=0)
    //         {
    //             //completed accountline
    //             $get_accountline_account_info = $value['accountline'];
    //             //get accountid by accountline
    //             $result_smallest_accountid_by_accountline = $this->get_smallest_accid($get_accountline_account_info);
    //             //get account info by accountid
    //             $result_get_account_info = $this->get_account_info($result_smallest_accountid_by_accountline);
    //             foreach ($result_get_account_info as $key => $value_info) {
    //                 $agentid = $value_info['agentid'];
    //                 if ($agentid != 0) 
    //                 {
    //                     $packagename = $value_info['packagetypename'];
    //                     $packageid = $value_info['packageid'];
    //                     $charge = $value_info['agentcharge'];
                        
    //                     //package info
    //                     $packageinfo = $this->get_package_info($packagename, $packageid);
    //                     //calculation agent salary
    //                     foreach ($packageinfo as $key => $val) {
    //                             $lentamount = $val['lentamount'];
    //                             $totalamount = $val['totalamount'];
    //                             $base = $totalamount - $lentamount;
    //                             ${'salary'.$agentid} += $base * $charge / 100;
                               
    //                         } 
    //                     $this->insert_agent_salary($agentid, ${'salary'.$agentid});
    //                 }
                    
    //             }
    //         }
    //     }
    // }
            
    public function check_complete_paid_account()
    {
        
        $this->db->select('SUM(totalamount), accountline');
        $this->db->from('account');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('accountline');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_smallest_accid($get_accountline_account_info)
    {
        
        $this->db->select_min('accountid');
        $this->db->from('account');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('accountline', $get_accountline_account_info);
        $query = $this->db->get();
        $res = $query->result_array();
        foreach ($res as $key => $value) {
            $accountid = $value['accountid'];
        }
        return $accountid;
    }

    public function get_account_info($accountid)
    {

        $this->db->select('a.accountid, a.agentid, a.packageid, p.packagetypename, a.agentcharge, a.customerid, c.customername, c.wechatname');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.accountid', $accountid);
        $query = $this->db->get();
        return $query->result_array();
    }
    ////////////////////////////////////////////////////////////////////////////////////////
}
?>
