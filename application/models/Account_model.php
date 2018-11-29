<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.accountid , SUM(a.totalamount),a.refid, a.readytorun, a.customerid, c.customername, c.wechatname, a.oriamount, a.amount, MIN(a.datee), a.interest, a.duedate, a.packageid, ag.agentname, p.packagetypename, MIN(a.status)');
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

     public function getuserdata_groupby_customername(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.customerid, c.customername, c.wechatname, SUM(a.totalamount)');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('c.customername');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getbaddebtuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('b.accountid, a.accountid ,SUM(a.totalamount) ,a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, MAX(a.duedate), a.packageid, ag.agentname, p.packagetypename, a.guarantyitem');

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
        $this->db->select('a.accountid , a.totalamount, (select sum(a.totalamount) from account a where a.refid = '.$refid.') sum_total, a.refid, a.guarantyitem, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename');
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

    public function get_payment_modal($accountid){
        // Run the query
        $this->db->select('accountid, payment, paymenttype, paymentdate');
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
        $this->db->select('a.accountid, a.totalamount, a.refid, a.oriamount, a.customerid, c.customername, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename, a.guarantyitem, a.pullnextperiod');
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
        $this->db->select('a.accountid, p.packagetypename, a.packageid');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        $this->db->where('a.refid', $refid);
        $this->db->order_by("a.duedate", "asc");
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

    public function get_maxduedate_by_refid($refid)
    {
        $this->db->select('MAX(duedate)');
        $this->db->from('account');
        $this->db->where('refid', $refid);
        $query = $this->db->get();
        $res = $query->result_array();
        foreach ($res as $key => $value) {
            $duedate = $value['MAX(duedate)'];
        }
        return $duedate;
    }

    // Package 30 / 4Week 滚利息
    public function interest_30_4week()
    {
        $this->db->select('a.accountid, a.amount, a.refid, a.packageid ,a.totalamount, a.duedate, p.packagetypename, a.oriamount, a.status');
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
            $refid = $value['refid'];
            $amount_4week = $value['amount'];
            
            $packageinfo = $this->get_package_info($packagename, $packageid);
            foreach ($packageinfo as $key => $value) 
            {
                $interest = $value['interest'];
                $lentamount = $value['lentamount'];
            
                //for package_manual_payeveryday_manualdays
                if ($packagename == "package_manual_payeveryday_manualdays") {
                    $totaldays_package_manual_payeveryday_manualdays = $value['days'];
                    $amount_every_day = $value['amounteveryday'];
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

        $day_limitdays = 60;

        //SPECIAL FOR 4 WEEK PACKAGE & SELF DEFINE DAY
        if ($packagename == "package_30_4week") {
            $max_limit_date = $this->get_maxduedate_by_refid($refid);
            $max_limit_date = strtotime($max_limit_date);
            $max_limit_date = strtotime("+60 days", $max_limit_date);
            $max_limit_datedif = abs($due_date - $max_limit_date);
            $day_limitdays = $max_limit_datedif/86400; 
        }
        elseif ($packagename == "package_manual_payeveryday_manualdays") {
            $day_limitdays = $totaldays_package_manual_payeveryday_manualdays;
        }
        if($days>=$day_limitdays){
            $days=$day_limitdays;
        }

        $payment_info = $this->get_payment_info($accountid);
        //看有没有负数 在payment里面
        foreach ($payment_info as $key => $value) {
            $payment_paid = $value['payment'];
            if ($payment_paid<0) {
                $status ="open";
            }
        }
            if ($days>0 && $date2<$date1 ) 
            {

                echo "<script>console.log('".$packagename.":".$days."')</script>";
                //package 不是closed 就跑利息
                if($packagename == "package_30_4week" && $status !=="closed"  )
                {
                    $total_interest = 0;

                    for ($i=1; $i <$days+1 ; $i++) {
                        $date_eachday = strtotime("+ ".$i." days", $due_date); //duedate +x days
                        $date_eachday = date("Y-m-d", $date_eachday);
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] < $date_eachday) 
                            {
                                $payment_paid += $value['payment'];
                                echo "<script>console.log('payment:".$payment_paid."')</script>";
                            }
                        }
                        
                        if ($i == 1) {
                            if ($payment_paid>=$amount_4week) { //350
                                $counting_interest_enable = $amount_4week+$total_interest;
                            }else{
                                $counting_interest_enable = $amount_4week+$interest;
                            }
                        }else{
                            $counting_interest_enable = $amount_4week+$total_interest;
                        }
                        
                        if ($payment_paid < $counting_interest_enable) {
                            $total_interest += $interest;
                        }
                    }
                    $this->insert_interest($total_interest,$accountid);
                }
                elseif($packagename == "package_manual_5days_4week" && $status !=="closed"  )
                {
                    $total_interest = 0;
                    for ($i=1; $i <$days+1 ; $i++) {
                        $date_eachday = strtotime("+ ".$i." days", $due_date); //duedate +x days
                        $date_eachday = date("Y-m-d", $date_eachday);
                        $payment_paid = 0;
                        foreach ($payment_info as $key => $value) 
                        {
                            if ($value['paymentdate'] < $date_eachday) 
                            {
                                $payment_paid += $value['payment'];
                                echo "<script>console.log('payment:".$payment_paid."')</script>";
                            }
                        }
                        
                        if ($i == 1) {
                            if ($payment_paid>=$amount_4week) { //350
                                $counting_interest_enable = $amount_4week+$total_interest;
                            }else{
                                $counting_interest_enable = $amount_4week+$interest;
                            }
                        }else{
                            $counting_interest_enable = $amount_4week+$total_interest;
                        }
                        
                        if ($payment_paid < $counting_interest_enable) {
                            $total_interest += $interest;
                        }
                    }
                    $this->insert_interest($total_interest,$accountid);
                }
                //5天账 公式
                // elseif($packagename == "package_manual_payeveryday_manualdays" && $status !=="closed" )
                elseif($packagename == "package_manual_payeveryday_manualdays" )//必须算完20天
                {
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
                        }
                    }

                    $total_interest = 0;

                    for ($i=1; $i <$days+1 ; $i++) { 
                        $date_eachday = strtotime("+ ".$i." days", $due_date); //duedate +x days
                        $date_eachday = date("Y-m-d", $date_eachday);

                        if ($i>1) {
                            $payment_paid = 0;
                            foreach ($payment_info as $key => $value) 
                            {
                                if ($value['paymentdate'] < $date_eachday) 
                                {
                                    $payment_paid += $value['payment'];
                                    echo "<script>console.log('payment:".$payment_paid."')</script>";
                                }
                            }

                            $counting_interest_enable = ($amount_every_day * ($i-1)) + $total_interest;
                            if ($payment_paid < $counting_interest_enable) {
                                $total_interest += $interest;
                            }
                        }
                        echo "<script>console.log(".$total_interest.")</script>";
                    }
                    $last_day = date("Y-m-d");
                    $duedate_plus_pay_day = strtotime("+ ".$days." days", $due_date);
                    $duedate_plus_pay_day = date("Y-m-d",$duedate_plus_pay_day);
                    if ($last_day>$duedate_plus_pay_day) {
                        $payment_paid = 0;
                            foreach ($payment_info as $key => $value) 
                            {
                                if ($value['paymentdate'] < $date_eachday) 
                                {
                                    $payment_paid += $value['payment'];
                                    echo "<script>console.log('payment:".$payment_paid."')</script>";
                                }
                            }

                            $counting_interest_enable = ($amount_every_day * ($i-1)) + $total_interest;
                            if ($payment_paid < $counting_interest_enable) {
                                $total_interest += $interest;
                            }
                    }
                        $this->insert_interest($total_interest,$accountid);
                    
                }
                //一个月 迟一天110% 算法不同 在这边就那payment来减了 而不是像其他的一样 在view那边加减
                //重要：： interest / amount会变！
                elseif ($packagename == "package_25_month" && $status !=="closed"  )
                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
                        }
                    }
                    echo "<script>console.log('package_25_month:".$payment_amount_date_less_than_duedate."');</script>";
                    echo "<script>console.log('package_25_month:".$payment_amount_date_larger_than_duedate."');</script>";
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
                                $total_amount = (($oriamount - $payment_amount_date_less_than_duedate) * ((100+$interest)/100)) - $payment_paid;echo "<script>console.log('totalamountb:".$total_amount."')</script>";
                            }
                            //其他天
                            else
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount * ((100+$interest)/100)) - $payment_paid;echo "<script>console.log('totalamountb:".$total_amount."')</script>";
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {
                                // t = 1250+125-300(payment)
                                $total_amount = (($oriamount - $payment_amount_date_less_than_duedate) * ((100+$interest)/100));echo "<script>console.log('totalamountb:".$total_amount."')</script>";
                            }
                            //其他天
                            else
                            {
                                //t = 1075+107.5-payment
                                $total_amount = ($total_amount * ((100+$interest)/100));echo "<script>console.log('totalamountb:".$total_amount."')</script>";
                            }
                        }
                    }
                    $total_amount = $total_amount - $payment_amount_date_larger_than_duedate;
                    $this->update_total_amount($total_amount,$accountid);
                }

            if ($packagename == "package_20_week"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
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
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate) - $payment_paid;
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                                }
                                
                                echo "<script>console.log('totalamounta:".$total_amount."')</script>";
                   
                               
                            }elseif ($i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {
                                    $total_amount = ($total_amount)+($interest)- $payment_paid;
                                }
                                
                            }
                            //其他天
                            elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {
                                    $total_amount = ($total_amount)*1.2- $payment_paid;
                                }
                            }elseif($i>=60){

                            }else{
                                if ($total_amount>0 || $payment_paid < 0) {
                                    $total_amount = $total_amount- $payment_paid;
                                }
                                
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate);
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                                }
                                
                   
                               
                            }elseif ($i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {
                                    $total_amount = ($total_amount)+($interest);
                                }
                                echo "<script>console.log('totalamountb:".$total_amount."')</script>";
                            //其他天
                            }elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {
                                    $total_amount = ($total_amount)*1.2;
                                }
                                echo "<script>console.log('totalamountc:".$total_amount."')</script>";
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                    $total_amount = $total_amount - $payment_amount_date_larger_than_duedate;
                     $this->update_total_amount($total_amount,$accountid);
                }
            


            if($packagename == "package_15_week"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
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
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate) - $payment_paid;
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                                }
                                
                   
                               
                            }elseif ( $i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 )
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest)- $payment_paid;}
                            }
                            //其他天
                            elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.15- $payment_paid;}
                            }elseif($i>=60){

                            }else{
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = $total_amount- $payment_paid;}
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate);
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                                }
                                
                   
                               
                            }elseif ( $i==2|| $i==8|| $i==9|| $i==15|| $i==16|| $i==22|| $i==23|| $i==29|| $i==30|| $i==36|| $i==37|| $i==43|| $i==44|| $i==50|| $i==51|| $i==57|| $i==58 ) 
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest);}
                            //其他天
                            }elseif($i==3 || $i==10 || $i==17 || $i==24 || $i==31 || $i==38 || $i==45 || $i==52 || $i==59)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.15;}
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                    $total_amount = $total_amount - $payment_amount_date_larger_than_duedate;
                     $this->update_total_amount($total_amount,$accountid);
                }

                if ($packagename == "package_15_5days"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
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
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate) - $payment_paid;
                                 }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                                 }
                                
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest)- $payment_paid;}
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.15- $payment_paid;}
                            }elseif($i>=60){

                            }else{
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = $total_amount- $payment_paid;}
                            }
                        }
                        //当天没有payment
                        else{
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate);
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                                }
                                
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest);}
                            //其他天
                            }elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.15;}
                            }elseif($i>=60){

                            }
                        }
                    }
                    $total_amount = $total_amount - $payment_amount_date_larger_than_duedate;
                     $this->update_total_amount($total_amount,$accountid);
                }


            if($packagename == "package_10_5days"  && $status !=="closed" )

                {   
                    //日期小过duedate的全部加起来
                    $payment_amount_date_less_than_duedate = 0;
                    $payment_amount_date_larger_than_duedate = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date2) //date2 就是 duedate
                        {
                            $payment_amount_date_less_than_duedate += $value['payment'];
                        }
                        $date_after_duedate = strtotime("+".$days." days", strtotime($date2));
                        $date_after_duedate = date("Y-m-d", $date_after_duedate);
                        if ($value['paymentdate'] > $date_after_duedate) //date2 就是 duedate
                        {
                            $payment_amount_date_larger_than_duedate += $value['payment'];
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
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate) - $payment_paid;
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest)- $payment_paid;
                                }
                                
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest)- $payment_paid;}
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.1- $payment_paid;}
                            }elseif($i>=60){

                            }else{
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = $total_amount- $payment_paid;}
                            }
                        }
                        //当天没有payment
                        else
                        {
                            //第一天/只有一天
                            if ($i == 1) 
                            {   
                                if ($payment_amount_date_less_than_duedate>=$oriamount) {
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate);
                                }else{
                                    $total_amount =($oriamount- $payment_amount_date_less_than_duedate)+($interest);
                                }
                   
                               
                            }elseif ($i==2|| $i==6 || $i==7 || $i==11 || $i==12 || $i==16 || $i==17 || $i==21 || $i==22 || $i==26 || $i==27 || $i==31 || $i==32 || $i==36 || $i==37 || $i==41 || $i==42 || $i==46 || $i==47 || $i==51 || $i==52 || $i==56 || $i==57) 
                            {
                                // t = 1250+125-300(payment)
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)+($interest);}
                            }
                            //其他天
                            elseif($i==3 || $i==8 || $i==13 || $i==18 || $i==23 || $i==28 || $i==33 || $i==38 || $i==43 || $i==48 || $i==53 || $i==58)
                            {
                                //t = 1075+107.5-payment
                                if ($total_amount>0 || $payment_paid < 0) {$total_amount = ($total_amount)*1.1;}
                            }elseif($i>=60){

                            }
                        }
                    
                    }
                    $total_amount = $total_amount - $payment_amount_date_larger_than_duedate;
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

        $this->db->select('a.accountid, a.amount, a.interest, p.packagetypename, a.duedate');
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
                $duedate = $val['duedate'];
                $today = date("Y-m-d");
                if($today<=$duedate){
                    $accountid = $val['accountid'];
                    $sum_payment_by_accid_count_total_amount = $this->sum_payment_by_accid_count_total_amount($accountid);
                    $amount = $val['amount'];
                    $totalamount = $amount - $sum_payment_by_accid_count_total_amount;
                    $this->update_total_amount($totalamount,$accountid);
                }
                // $this->update_total_amount($totalamount,$accountid);
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

    public function sum_payment_by_accid_count_total_amount($accountid)
    {
        $this->db->select('payment');
        $this->db->from('payment');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
        $res = $query->result_array();
        $amount = 0;
        foreach ($res as $key => $value) { 
            $amount += $value['payment'];
        }
        return $amount;
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
        $this->db->select('a.accountid, a.totalamount, a.duedate, p.packagetypename ,a.status, a.readytorun');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $val) {
            $readytorun = $val['readytorun'];
            // if ($readytorun == 1) {
                $accountid = $val['accountid'];
                $totalamount = $val['totalamount'];
                $packagetypename = $val['packagetypename'];
                $duedate = $val['duedate'];
                $now = time(); // date today in strtotime mode
                $due_date = strtotime($duedate);
                $datediff = $now - $due_date;

                $days = round($datediff / (60 * 60 * 24));
                $days = $days-1;
                $status= $val['status'];
                $res= $this->get_payment_days($accountid);

                $duedate_count_pdays = $duedate;
                //if got payment and paymentdate > duedate then duedate = paymentdate
                //if no payment then use duedate to count pdays
                foreach ($res as $key => $val) {
                    $paymentdate = $val['MAX(paymentdate)'];
                    if ($paymentdate>$duedate_count_pdays) {
                        $duedate_count_pdays = $paymentdate;
                    }
                }


                $paymentinfo = $this->get_payment_info($accountid);
                $payment_info = 0;
                foreach ($paymentinfo as $key => $value) 
                {
                    $payment_info += $value['payment'];
                }

                //count pdays
                $payment_date = strtotime($duedate_count_pdays);
                $now = time(); 
                $datediff2 = $now - $payment_date;
                // today - last payment date
                $pdays = round($datediff2 / (60 * 60 * 24));
                //就算是baddebt 只要 total 少过等于0 都算account close，为了避免customer从blacklist reset status 回来后又被误判成account baddebt, customer baddebt 回去blacklist 

                if($totalamount <= 0 && $status != "baddebt" && $status != "done"){
                    $status = "closed";
                    $this->set_status($status, $accountid); 

                }elseif($days>=4 && $days<=29 && $totalamount >= 0 && $status != "baddebt"){
                    $status = "late";
                    $this->set_status($status, $accountid);
                }elseif($pdays>=30 && $totalamount > 0 && $status != "baddebt"){
                    $status = "baddebt";
                    $this->set_status2($status , $accountid);

                }elseif($totalamount > 0 && $status != "baddebt" && $status != "late"){
                    $status = " ";
                    $this->set_status($status , $accountid);
                }elseif($totalamount <= 0 && $status == "baddebt"){
                    $status = "done";
                    $this->set_status($status , $accountid);
                }
            // }
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
        $this->db->where('status !=', "baddebt");
        $this->db->update('account', array('status' => $status)); 
    }

    public function set_status2($status,$accountid)
    {   $accountid = $accountid;
        $status = $status;
        $data = $this->getrefid($accountid);
        foreach ($data as $key => $value) {
        $refid=$value['refid'];
        $data = array(
            'status' => $status
            );
        $this->db->where('status !=', "closed");
        $this->db->where('status !=', "baddebt");
        $this->db->where('refid', $refid);
        $this->db->update('account', $data);
}        
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
        /////////////////////////////FIRST ACCOUNT INTEREST////////////////////////////////////////////////////////////////
        //sum all accountline totalamount
        $result_complete_paid = $this->check_complete_paid_account();
        //get agent id WITH FIRST ACCOUNT INTEREST
        $get_all_agent = $this->load->agent_model->getuserdata_count_salary_first_account_interest();
        //create variable liek salary1, salary2, using agentid
        foreach ($get_all_agent as $key => $value_agent) {

            $create_agent_salary_variable = $value_agent['agentid'];
            ${'salary'.$create_agent_salary_variable} = 0;
            //reset salary into 0
            $this->insert_agent_salary($create_agent_salary_variable, 0);
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
        /////////////////////////////FIRST ACCOUNT INTEREST////////////////////////////////////////////////////////////////

        /////////////////////////////SHARE ALL INTEREST////////////////////////////////////////////////////////////////
        //拿 share all 的agent
        $get_all_agent_share_all = $this->load->agent_model->getuserdata_count_salary_share_all_interest();
        foreach ($get_all_agent_share_all as $key => $value) {
            $salary = 0;
            $agentid_share_all = $value['agentid'];
            $agent_charge = $value['charge'];
            //用agent拿accline
            $get_accountline_by_agentid = $this->get_accountline_by_agentid($agentid_share_all);
            foreach ($get_accountline_by_agentid as $key => $value_accline) {
                $accline = $value_accline['accountline'];
                // echo $accline;
                //用accline 拿refid
                $get_refid_by_accline = $this->get_refid_by_accline($accline);
                foreach ($get_refid_by_accline as $key => $value_refid) {
                    $refid = $value_refid['refid'];
                    // echo $refid;
                    $packagetypename = $value_refid['packagetypename'];
                    $packageid_shareall = $value_refid['packageid'];
                    $package_info = $this->get_package_info($packagetypename, $packageid_shareall);
                    //拿lentamount
                    foreach ($package_info as $key => $value_package_info) {
                        $lentamount = $value_package_info['lentamount'];
                        // echo $lentamount;
                    }
                    //用来拿payment(每个同refid的account)
                    $get_accid_by_refid = $this->get_accid_by_refid($refid);
                    $payment_refid = 0;
                    foreach ($get_accid_by_refid as $key => $value_accid_by_refid) {
                        $accid = $value_accid_by_refid['accountid'];
                        $payment_refid += $this->sum_payment_by_accid_agent_salary($accid);
                        // echo $payment_refid;
                    }
                    //拿account 的info 用refid
                    $get_info_by_refid = $this->get_info_by_refid($refid);
                    foreach ($get_info_by_refid as $key => $value_info_refid) {
                        $refid_totalamount = $value_info_refid['SUM(a.totalamount)'];
                        $status = $value_info_refid['status'];
                        //条件

                        //还完 和 baddebt还完
                        if ($refid_totalamount <= 0 && ($status == "closed" || $status == "done")) {
                            $salary += ($payment_refid - $lentamount) * $agent_charge / 100;
                            // echo $salary;
                        }
                        //baddebt
                        elseif ($status == "baddebt") {
                            // ？？？？？？？？？？？？？？？？？？？？？？？？待定
                            $salary += ($payment_refid - $lentamount) * $agent_charge / 100;
                        }
                    }
                }
            }
            $this->insert_agent_salary($agentid_share_all, $salary);
        }
        /////////////////////////////SHARE ALL INTEREST////////////////////////////////////////////////////////////////
    }

    public function get_accountline_by_agentid($agentid_share_all)
    {
        $this->db->select('a.accountline, c.customername, c.wechatname');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.agentid', $agentid_share_all);
        $this->db->group_by('a.refid');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_refid_by_accline($accline)
    {
        $this->db->select('a.refid, p.packagetypename, a.packageid');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.accountline', $accline);
        $this->db->group_by('a.refid');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_info_by_refid($refid)
    {
        $this->db->select('SUM(a.totalamount), a.status');
        $this->db->from('account a');
        // $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_accid_by_refid($refid)
    {
        $this->db->select('a.accountid');
        $this->db->from('account a');
        // $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function sum_payment_by_accid_agent_salary($accid)
    {
        $this->db->select('payment');
        $this->db->from('payment');
        $this->db->where('accountid', $accid);
        $query = $this->db->get();
        $res = $query->result_array();
        $amount = 0;
        foreach ($res as $key => $value) {
            $amount += $value['payment'];
        }
        return $amount;
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
        $amount = $this->sum_payment_by_accid($original_accountid);
        $this->pull_to_next_period_update_original($original_accountid, $amount);
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
        if($this->db->update('account', array('amount' => $amount, 'interest' => '0', 'pullnextperiod' => '1', 'status' => 'closed')))
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

    public function run_account_update($refid){

        $this->db->where('refid', $refid);
        $this->db->update('account', array('readytorun' => '1'));
        echo json_encode($refid);

    }
       public function delete($refid){
        $ref = $this->get_accountid_using_refid($refid);
        if($this->db->delete('account', array('refid' => $refid))){
            $this->deletepayment($ref);
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }

    public function deletepayment($ref){

        foreach ($ref as $key => $value) {
            $accountid = $value['accountid'];
            echo $accountid;
            $this->db->delete('payment', array('accountid' => $accountid));
        }
    }

}
?>
