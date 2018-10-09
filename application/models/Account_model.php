<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.accountid , SUM(a.totalamount),a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, p.packagetypename, MIN(a.status)');
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
    public function getbaddebtuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('b.accountid, a.accountid , SUM(a.totalamount),a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, MAX(a.duedate), a.packageid, ag.agentname, p.packagetypename, a.guarantyitem');

        $this->db->from('baddebt b');
        $this->db->join('account a', 'b.accountid = a.accountid', 'left');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.totalamount >=', 0);
        $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }


  public function getbaddebtaccid(){
        $this->db->select('accountid');
        $this->db->from('baddebt');
        $query = $this->db->get();
        return $query->result_array();
}
    public function getuserdata_payment_use($refid){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.accountid , a.totalamount, (select sum(a.totalamount) from account a where a.refid = '.$refid.') sum_total, a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
        $this->db->order_by("a.duedate", "asc");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_payment_amount($accountid){
        // Run the query
        $this->db->select('payment, paymenttype');
        $this->db->from('payment');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getuserdatamodal($data){
        // Run the query
        $refid = $this->getrefid($data);
        foreach ($refid as $value) {
            $refid_res = $value['refid'];
        }
        $this->db->select('a.accountid, a.totalamount, a.refid, a.oriamount, a.customerid, c.customername, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename, a.guarantyitem');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        $this->db->where('refid', $refid_res);
        // $this->db->group_by('pay.accountid');// add group_by
        $this->db->order_by("a.duedate", "asc");
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

    public function get_accountid_using_refid($refid){
        // Run the query
        $this->db->select('accountid');
        $this->db->from('account');
        $this->db->where('refid', $refid);
        $this->db->order_by("duedate", "asc");
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

    public function get_max_accountline(){
        // Run the query
        $this->db->select_max('accountline');
        $this->db->from('account');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_accountline($accountid_check_accountline){
        // Run the query
        $this->db->select('accountline');
        $this->db->from('account');
        $this->db->where('accountid', $accountid_check_accountline);
        $query = $this->db->get();
        $res = $query->result_array();
        foreach ($res as $key => $value) {
            $accountline = $value['accountline'];
        }
        return $accountline;
    }

    public function getuserdatainsertcustomer(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('customer');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_30_4week(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_30_4week');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_25_month(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_25_month');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_pay_everyday(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_manual_payeveryday_manualdays');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_5days_4week(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_manual_5days_4week');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_20_week(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_20_week');
        return $query->result_array();
    }
        public function getuserdatainsertpackage_15_week(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_15_week');
        return $query->result_array();
    }
        public function getuserdatainsertpackage_15_5days(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_15_5days');
        return $query->result_array();
    }
        public function getuserdatainsertpackage_10_5days(){
        // Run the query
        $this->db->select('*');
        ///////////////Combo of User Indentity///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity///////////////////
        $query = $this->db->get('package_10_5days');
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

    public function get_package_type_id($data)
    {
      $packagetypename = $data;
      $this->db->select('packagetypeid');
      $this->db->where('packagetypename', $packagetypename);
      $query = $this->db->get('packagetype');
      return $query->result_array();
    }

    public function get_package_info($packagename, $packageid)
    {
      //database 名字，在insert的选项那边的前缀
      $dbname = $packagename;
      $packageid = $packageid;
      $this->db->where('packageid', $packageid);
      $query = $this->db->get($dbname);
      return $query->result_array();
    }

    public function get_payment_info($accountid)
    {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
         return $query->result_array();
    }
    public function insert_interest($total_interest, $accountid)
    {

        
    
    $data = array(
    'interest' => $total_interest,
    );
    $this->db->where('accountid', $accountid);
    $this->db->update('account', $data);
        }

    public function insert_amount($amount_change, $accountid)
    {
    $data = array(
    'amount' => $amount_change
    );
    $this->db->where('accountid', $accountid);
    $this->db->update('account', $data);
    }

    // Package 30 / 4Week 滚利息
    public function interest_30_4week()
    {
        $this->db->select('a.accountid, a.packageid ,a.totalamount, a.duedate, p.packagetypename, a.oriamount, a.status');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $packagetypeid_array = $query->result_array();
        foreach ($packagetypeid_array as $key => $value) 
        {
            $packagename = $value['packagetypename'];
            $status = $value['status'];
            $packageid = $value['packageid'];
            $duedate = $value['duedate'];
            $oriamount = $value['oriamount'];
            $accountid = $value['accountid'];
            $totalamount = $value['totalamount'];

            
            $packageinfo = $this->get_package_info($packagename, $packageid);
            foreach ($packageinfo as $key => $value) 
            {
                $interest = $value['interest'];
                $lentamount = $value['lentamount'];
            
                //for package_manual_payeveryday_manualdays
                if ($packagename == "package_manual_payeveryday_manualdays") {
                    $totaldays_package_manual_payeveryday_manualdays = $value['days'];
                }
                

            // $diff = abs(strtotime($date1) - strtotime($date2));


            // $years = floor($diff / (365*60*60*24));
            // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $now = strtotime(date("Y-m-d")); // or your date as well
            $due_date = strtotime($duedate);
            $timeDiff = abs($now - $due_date);
            $days = $timeDiff/86400; 
            // $days = $days-1;
            // echo "<script>console.log( 'days value: " .$days. "' );</script>";
            $date1 = date("Y-m-d");
            $date2 = date("Y-m-d",strtotime($duedate));
                        
        $paymentinfo = $this->get_payment_info($accountid);
        $payment = 0;
        foreach ($paymentinfo as $key => $value) 
        {
            $payment += $value['payment'];
        }
           if($days>=60){
                    $days=60;
                }

        $payment_info = $this->get_payment_info($accountid);

            if ($days>0 && $date2<$date1 ) 
            {

                echo "<script>console.log('".$packagename.":".$days."')</script>";
                //package 不是closed 就跑利息
                if($packagename == "package_30_4week" && $status !=="closed"  )
                {
                    $total_interest = $interest * $days;
                    $this->insert_interest($total_interest,$accountid);
                }
                elseif($packagename == "package_manual_5days_4week" && $status !=="closed"  )
                {
                    $total_interest = $interest * $days;
                    $this->insert_interest($total_interest,$accountid);
                }
                //5天账 公式
                elseif($packagename == "package_manual_payeveryday_manualdays" && $status !=="closed" )
                {
                    if ($days<=$totaldays_package_manual_payeveryday_manualdays) {
                        $total_interest = $interest * $days;
                        $this->insert_interest($total_interest,$accountid);
                    }
                    
                }
                //一个月 迟一天110% 算法不同 在这边就那payment来减了 而不是像其他的一样 在view那边加减
                //重要：： interest / amount会变！
                elseif ($packagename == "package_25_month" && $status !=="closed"  )
                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                    }
                    //每次 + 1天来取得date
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) 
                    { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date);
                        $date_eachday = date("Y-m-d", $date_eachday);
                        // echo "<script>console.log('package_25_month:".$date_eachday."');</script>";
                        $check_match_date = 0;
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] == $date_eachday) 
                            {
                                $check_match_date = 1;
                                $payment_paid += $value['payment'];
                            }
                        }
                        //当天有payment
                        if ($check_match_date == 1) 
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = (($oriamount - $payment_amount_date_less_than_duedate) * ((100+$interest)/100)) - $payment_paid;
                            }
                            //其他天
                            else
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount * ((100+$interest)/100)) - $payment_paid;
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = (($oriamount - $payment_amount_date_less_than_duedate) * ((100+$interest)/100));
                            }
                            //其他天
                            else
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount * ((100+$interest)/100));
                            }
                        }
                    }
                    $this->update_total_amount($total_amount,$accountid);
                }

            if ($packagename == "package_20_week"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                    }
                    //每次 + 1天来取得date
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) 
                    { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date);
                        $date_eachday = date("Y-m-d", $date_eachday);
                        // echo "<script>console.log('package_25_month:".$date_eachday."');</script>";
                        $check_match_date = 0;
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] == $date_eachday) 
                            {
                                $check_match_date = 1;
                                $payment_paid += $value['payment'];
                            }
                        }
                        //当天有payment
                        if ($check_match_date == 1) 
                        {
                            //第一天/只有一天
                             if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                   
                               
                            }elseif ($i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest)- $payment_paid;
                            }
                            //其他天
                            elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.2- $payment_paid;
                            }elseif($i>=60){

                            }else{
                                $total_amount = $total_amount- $payment_paid;
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                   
                               
                            }elseif ($i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest);
                            //其他天
                            }elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.2;
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                     $this->update_total_amount($total_amount,$accountid);
                }
            


            if($packagename == "package_15_week"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                    }
                    //每次 + 1天来取得date
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) 
                    { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date);
                        $date_eachday = date("Y-m-d", $date_eachday);
                        // echo "<script>console.log('package_25_month:".$date_eachday."');</script>";
                        $check_match_date = 0;
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] == $date_eachday) 
                            {
                                $check_match_date = 1;
                                $payment_paid += $value['payment'];
                            }
                        }
                        //当天有payment
                        if ($check_match_date == 1) 
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                   
                               
                            }elseif ( $i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest)- $payment_paid;
                            }
                            //其他天
                            elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.15- $payment_paid;
                            }elseif($i>=60){

                            }else{
                                $total_amount = $total_amount- $payment_paid;
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                   
                               
                            }elseif ( $i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 ) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest);
                            //其他天
                            }elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.15;
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                     $this->update_total_amount($total_amount,$accountid);
                }

                if ($packagename == "package_15_5days"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                    }
                    //每次 + 1天来取得date
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) 
                    { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date);
                        $date_eachday = date("Y-m-d", $date_eachday);
                        // echo "<script>console.log('package_25_month:".$date_eachday."');</script>";
                        $check_match_date = 0;
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] == $date_eachday) 
                            {
                                $check_match_date = 1;
                                $payment_paid += $value['payment'];
                            }
                        }
                        //当天有payment
                        if ($check_match_date == 1) 
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest)- $payment_paid;
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.15- $payment_paid;
                            }elseif($i>=60){

                            }else{
                                $total_amount = $total_amount- $payment_paid;
                            }
                        }
                        //当天没有payment
                        else{
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest);
                            //其他天
                            }elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.15;
                            }elseif($i>=60){

                            }
                        }
                    }
                     $this->update_total_amount($total_amount,$accountid);
                }


            if($packagename == "package_10_5days"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                    }
                    //每次 + 1天来取得date
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) 
                    { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date);
                        $date_eachday = date("Y-m-d", $date_eachday);
                        // echo "<script>console.log('package_25_month:".$date_eachday."');</script>";
                        $check_match_date = 0;
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] == $date_eachday) 
                            {
                                $check_match_date = 1;
                                $payment_paid += $value['payment'];
                            }
                        }
                        //当天有payment
                        if ($check_match_date == 1) 
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest)- $payment_paid;
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.1- $payment_paid;
                            }elseif($i>=60){

                            }else{
                                $total_amount = $total_amount- $payment_paid;
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = ($total_amount)+($interest);
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount)*1.1;
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                     $this->update_total_amount($total_amount,$accountid);

                }
            }
        }
    }
}

   public function insert_payment($data)
   {
        if($this->db->insert('payment', $data))
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

   
    //算 database里面的totalamount
    public function count_total_amount()
   {
        //拿所有的payment，groupby accountid
        $result_payment = $this->groupby_accountid_total_amount();

        $this->db->select('a.accountid, a.amount, a.interest, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as $key => $val) 
        {
            if ($val['packagetypename'] == "package_25_month"|| $val['packagetypename'] == "package_20_week" || $val['packagetypename'] == "package_15_week" || $val['packagetypename'] == "package_15_5days" || $val['packagetypename'] == "package_10_5days") 
            {
                //do nothing
            }
            else
            {
                $amount = $val['amount'];
                $interest = $val['interest'];
                $accountid = $val['accountid'];
                $totalamount = $amount+$interest;
                foreach ($result_payment as $key => $value) 
                {
                    if($val['accountid'] == $value['accountid'])
                    {
                        // echo "<script>console.log( 'Debug value: " .$value['accountid']. "' );</script>";
                        $payment = $value['SUM(payment)'];
                        $totalamount = $amount+$interest-$payment;
                    }
                }
                $this->update_total_amount($totalamount,$accountid);
            }
            
            
        }
    }

    public function groupby_accountid_total_amount()
    {
        $this->db->select('accountid, SUM(payment)');
        $this->db->from('payment');
        $this->db->group_by('accountid');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function update_total_amount($totalamount,$accountid)
    {
        $this->db->where('accountid', $accountid);
        $this->db->update('account', array('totalamount' => $totalamount)); 
    }

    public function account_status_set()
    {
        $this->db->select('a.accountid, a.totalamount, a.duedate, p.packagetypename ,a.status');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $val) {
            $accountid = $val['accountid'];
            $totalamount = $val['totalamount'];
            $packagetypename = $val['packagetypename'];
            $duedate = $val['duedate'];
            $now = time(); // or your date as well
            $due_date = strtotime($duedate);
            $datediff = $now - $due_date;

            $days = round($datediff / (60 * 60 * 24));
            $days = $days-1;
            $status= $val['status'];
           $res= $this->get_payment_days($accountid);
            foreach ($res as $key => $val) {
                $paymentdate = $val['MAX(paymentdate)'];
                $payment_date = strtotime($paymentdate);
                $now = time(); 
                $datediff2 = $now - $payment_date;
                $pdays = round($datediff2 / (60 * 60 * 24));
            }

           // echo "<script>console.log('accountid:".$accountid."')</script>";
           //  echo "<script>console.log('totalamount:".$totalamount."')</script>";
           //  echo "<script>console.log('days:".$days."')</script>";
            // echo "<script>alert(".$days.")</script>";
            if($totalamount <= 0 && $status != "baddebt"){
                $status = "closed";
                $this->set_status($status, $accountid); 
            }elseif($days>=4 && $days<=29 && $totalamount >= 0 && $status != "baddebt"){
                $status = "late";
                $this->set_status($status, $accountid);
            }elseif($pdays>=30 && $totalamount > 0 && $status != "baddebt"){
                $status = "baddebt";
                $this->set_status($status , $accountid);
            }else{
                
            }
            
        }
    }
     public function get_payment_days($accountid)
    {   $this->db->select('MAX(paymentdate),accountid');
        $this->db->where('accountid', $accountid);
        $this->db->from('payment');
         $query = $this->db->get();
         return $query->result_array();
    }

    public function set_status($status,$accountid)
    {
        $this->db->where('accountid', $accountid);
        $this->db->update('account', array('status' => $status)); 
    }

     public function get_status()
    {
        $this->db->select('status, accountid');
        $this->db->from('account');
        $query = $this->db->get();
         return $query->result_array();
    }
 public function get_accountid()
    {
        $this->db->select('accountid');
        $this->db->from('account');
        $query = $this->db->get();
         return $query->result_array();
    }

public function set_account_baddebt()
    {   $accountid = $this->input->post('accountid');
        $status="baddebt";
        $this->db->where('accountid', $accountid);
        $this->db->update('account', array('status' => $status)); 
    }
 public function insert_baddebt($data){
   
        if($this->db->insert('baddebt', $data))
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
       }

    }


    //计算agent利息，跟着agent利息变动（以前的account也会）
    // public function count_agent_salary_auto_follow()
    // {
        
    //     $this->db->select('SUM(a.totalamount), a.agentid, a.packageid, p.packagetypename');
    //     $this->db->from('account a');
    //     $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
    //     ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
    //     $company_identity = $this->session->userdata('adminid');
    //     $this->db->where('a.companyid', $company_identity);
    //     ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
    //     $this->db->group_by('a.refid');// add group_by
    //     $query = $this->db->get();
    //     $check_closed_all = $query->result_array();
    //     foreach ($check_closed_all as $key => $value) {
    //         $agentid = $value['agentid'];
    //         echo "<script>console.log( 'Debug value: " . $agentid. "' );</script>";
    //         if ($agentid!=0) {
    //             $packagename = $value['packagetypename'];
    //             $packageid = $value['packageid'];
    //             if ($value['SUM(a.totalamount)'] <= 0) 
    //             {
                    
    //                 $charge_array = $this->get_agent_charge($agentid);
    //                 foreach ($charge_array as $key => $value_charge) {
    //                     $charge = $value_charge['charge'];
    //                 }
    //                 $packageinfo = $this->get_package_info($packagename, $packageid);
    //                 foreach ($packageinfo as $key => $val) {
    //                     $lentamount = $val['lentamount'];
    //                     $salary = $lentamount * $charge /100;
    //                     $this->insert_agent_salary($agentid, $salary);
    //                 }
    //             } 
    //         }
               
    //     }
    // }

    //计算agent利息，进account的时候就定好了（以前的account不会）
    public function count_agent_salary()
    {
        //sum all accountline totalamount
        $result_complete_paid = $this->check_complete_paid_account();
        //get all agent id
        $get_all_agent = $this->load->agent_model->getuserdata();
        //create variable liek salary1, salary2, using agentid
        foreach ($get_all_agent as $key => $value_agent) {

            $create_agent_salary_variable = $value_agent['agentid'];
            ${'salary'.$create_agent_salary_variable} = 0;
        }
        foreach ($result_complete_paid as $key => $value) {
            //check sum of totalamount is 0 or not
            $totalamount_check = $value['SUM(totalamount)'];
            echo "<script>console.log(".$totalamount_check.");</script>";
            if($totalamount_check<=0)
            {
                //completed accountline
                $get_accountline_account_info = $value['accountline'];
                //get accountid by accountline
                $result_smallest_accountid_by_accountline = $this->get_smallest_accid($get_accountline_account_info);
                //get account info by accountid
                $result_get_account_info = $this->get_account_info($result_smallest_accountid_by_accountline);
                foreach ($result_get_account_info as $key => $value_info) 
                {
                    $agentid = $value_info['agentid'];
                    //check agent里面还有没有这个人（因为上面set variable 是跟着agent table的 这便是跟着account的）
                    foreach ($get_all_agent as $key => $value_agent) 
                    {
                        if ($agentid == $value_agent['agentid']) 
                        {
                            // echo "string";
                            if ($agentid != 0) 
                            {
                                $packagename = $value_info['packagetypename'];
                                $packageid = $value_info['packageid'];
                                $charge = $value_info['agentcharge'];
                                
                                //package info
                                $packageinfo = $this->get_package_info($packagename, $packageid);
                                //calculation agent salary
                                foreach ($packageinfo as $key => $val) 
                                {
                                    $lentamount = $val['lentamount'];
                                    $totalamount = $val['totalamount'];
                                    $base = $totalamount - $lentamount;
                                    ${'salary'.$agentid} += $base * $charge / 100;
                                } 
                                $this->insert_agent_salary($agentid, ${'salary'.$agentid});
                            }
                        }
                    }
                }
            }
        }
    }
            
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

        $this->db->select('a.agentid, a.packageid, p.packagetypename, a.agentcharge');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.accountid', $accountid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_agent_charge($agentid)
    {
        
        $this->db->select('charge');
        $this->db->from('agent');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('agentid', $agentid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_agent_salary($agentid, $salary)
    {
        
        $this->db->where('agentid', $agentid);
        $this->db->update('agent', array('salary' => $salary)); 
    }

   public function get_duedate($accountid)
    {
        $this->db->select('duedate');
        $this->db->from('account');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $duedate = $value['duedate'];
        }
        return $duedate;
    }

    public function get_linkaccount($accountid){
        // Run the query
        $this->db->select('linkaccount');
        $this->db->from('account');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
        $res = $query->result_array();
        foreach ($res as $key => $value) {
            $linkaccount = $value['linkaccount'];
        }
        return $linkaccount;
    }

public function set_baddebt_update($accountid){
        // Run the query
        $accountid = $accountid;
        $data = $this->getrefid($accountid);
        foreach ($data as $key => $value) {
        $refid=$value['refid'];
        $status = "baddebt";
        $data = array(
            'status' => $status
            );
        $this->db->where('status !=', "closed");
        $this->db->where('refid', $refid);
        $this->db->update('account', $data);
}
        $query = $this->db->get('account');
        return $query->result_array();

    }

    public function pull_to_next_period($accountid_destination, $totalamount)
    {
        // Run the query
        $this->db->select('amount');
        $this->db->from('account');
        $this->db->where('accountid', $accountid_destination);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $final_amount = $value['amount']+$totalamount;
        }
        $original_accountid = $accountid_destination-1;
        // $amount = $this->sum_payment_by_accid($original_accountid);
        $this->pull_to_next_period_update_original($original_accountid, 0);
        if($this->pull_to_next_period_update($accountid_destination, $final_amount) )
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
       }
    }

    public function pull_to_next_period_update($accountid_destination, $final_amount)
    {
        // Run the query
        $this->db->where('accountid', $accountid_destination);
        if($this->db->update('account', array('amount' => $final_amount)))
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
       }
    }

    public function pull_to_next_period_update_original($accountid_original, $amount)
    {
        // Run the query
        $this->db->where('accountid', $accountid_original);
        if($this->db->update('account', array('amount' => $amount, 'interest' => '0', 'status' => 'closed')))
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
       }
    }

    public function sum_payment_by_accid($accountid_original)
    {
        $this->db->select('payment');
        $this->db->from('payment');
        $this->db->where('accountid', $accountid_original);
        $query = $this->db->get();
        $res = $query->result_array();
        $amount = 0;
        foreach ($res as $key => $value) {
            $amount += $value['payment'];
        }
        return $amount;
    }

}
?>
