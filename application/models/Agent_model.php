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

    public function getuserdata_count_salary_first_account_interest(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $this->db->where('type', 'first_account_interest');
        $query = $this->db->get('agent');
        return $query->result_array();
    }

    public function getuserdata_count_salary_share_all_interest(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $this->db->where('type', 'share_all_interest');
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

    public function update($data, $agentid){
        $this->db->where('agentid', $agentid);
        if($this->db->update('agent', $data)){
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
        $this->db->select('SUM(payment), agentid, refid');
        $this->db->from('agentpayment');
        $this->db->group_by('agentid');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_agent_payment_not_grouped(){
        // Run the query
        $this->db->select('SUM(payment), agentid, refid, MAX(paymentdate)');
        $this->db->from('agentpayment');
        $this->db->group_by('refid');
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
        
        $this->db->select('SUM(a.totalamount), a.accountline, MIN(ag.agentid)');
        $this->db->from('account a');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        // $this->db->where('ag.companyid', $company_identity);
        $this->db->group_by('a.accountline');// add group_by
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

        $this->db->select('a.accountid, a.refid, a.agentid, a.packageid, p.packagetypename, a.agentcharge, a.customerid, c.customername, c.wechatname');
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

    public function get_agent_customer(){
        // Run the query
        $this->db->select('a.accountid , SUM(a.totalamount),a.refid, a.readytorun, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, c.wechatname, a.packageid, ag.agentname, a.agentid, p.packagetypename, MIN(a.status)');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();

        return $query->result_array();

    }

    public function get_share_all_agent_account(){
        // Run the query
                /////////////////////////////SHARE ALL INTEREST////////////////////////////////////////////////////////////////
        $data = array();
        $count = 0;
        //拿 share all 的agent
        $get_all_agent_share_all = $this->load->agent_model->getuserdata_count_salary_share_all_interest();
        foreach ($get_all_agent_share_all as $key => $value) {
            $salary = 0;
            $agentid_share_all = $value['agentid'];
            $agent_charge = $value['charge'];
            //用agent拿accline
            $get_accountline_by_agentid = $this->load->account_model->get_accountline_by_agentid($agentid_share_all);
            foreach ($get_accountline_by_agentid as $key => $value_accline) {
                $accline = $value_accline['accountline'];
                $customername = $value_accline['customername'];
                $wechatname = $value_accline['wechatname'];
                // echo $accline;
                //用accline 拿refid
                $get_refid_by_accline = $this->load->account_model->get_refid_by_accline($accline);
                foreach ($get_refid_by_accline as $key => $value_refid) {
                    $refid = $value_refid['refid'];
                    // echo $refid;
                    $packagetypename = $value_refid['packagetypename'];
                    $packageid_shareall = $value_refid['packageid'];
                    $package_info = $this->load->account_model->get_package_info($packagetypename, $packageid_shareall);
                    //拿lentamount
                    foreach ($package_info as $key => $value_package_info) {
                        $lentamount = $value_package_info['lentamount'];
                        // echo $lentamount;
                    }
                    //用来拿payment(每个同refid的account)
                    $get_accid_by_refid = $this->load->account_model->get_accid_by_refid($refid);
                    $payment_refid = 0;
                    foreach ($get_accid_by_refid as $key => $value_accid_by_refid) {
                        $accid = $value_accid_by_refid['accountid'];
                        $payment_refid += $this->load->account_model->sum_payment_by_accid_agent_salary($accid);
                        // echo $payment_refid;
                    }
                    //拿account 的info 用refid
                    $get_info_by_refid = $this->load->account_model->get_info_by_refid($refid);
                    foreach ($get_info_by_refid as $key => $value_info_refid) {
                        $refid_totalamount = $value_info_refid['SUM(a.totalamount)'];
                        $status = $value_info_refid['status'];
                        //条件

                        //还完 和 baddebt还完
                        if ($refid_totalamount <= 0 && ($status == "closed" || $status == "done")) {
                            $salary += ($payment_refid - $lentamount) * $agent_charge / 100;
                            // echo $salary;
                            $data[$count] = array(
                                'agentid' => $agentid_share_all,
                                'customername' => $customername,
                                'wechatname' => $wechatname,
                                'refid' => $refid,
                                'payment' => $payment_refid,
                                'lentamount' => $lentamount,
                                'agentcharge' => $agent_charge
                                );$count++;
                        }
                        //baddebt
                        elseif ($status == "baddebt") {
                            // ？？？？？？？？？？？？？？？？？？？？？？？？待定
                            $salary += ($payment_refid - $lentamount) * $agent_charge / 100;
                            print_r($salary);
                            $data[$count] = array(
                                'agentid' => $agentid_share_all,
                                'customername' => $customername,
                                'wechatname' => $wechatname,
                                'refid' => $refid,
                                'payment' => $payment_refid,
                                'lentamount' => $lentamount,
                                'agentcharge' => $agent_charge
                                );$count++;
                        }
                    }
                }
            }
            return $data;
        }
        /////////////////////////////SHARE ALL INTEREST////////////////////////////////////////////////////////////////

    }
}
?>
