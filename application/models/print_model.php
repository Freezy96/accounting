<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Print_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('account_model');
    }

    public function get_refid($accountid){
        // Run the query
        $this->db->select('refid');
        $this->db->from('account');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.duedate', $date);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_accountid_duedate_that_day($date){
        // Run the query
        $this->db->select('a.refid, MAX(a.duedate), MIN(a.duedate)');
        $this->db->from('account a');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $date_select=strtotime($date);
        $date_3week=strtotime("-21 days", strtotime($date));
        $date_select=(date("Y-m-d",$date_select));
        $date_3week=(date("Y-m-d",$date_3week));
        $this->db->where('a.duedate >=',  $date_3week);
        $this->db->where('a.duedate <=',  $date_select);
        $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getuserdata($refid,$duedate){
        $this->db->select('a.accountid, a.totalamount, a.oriamount, a.refid, a.customerid, c.customername, c.wechatname, c.address, c.gender, a.amount, a.datee, a.interest, a.duedate, a.packageid, c.phoneno, ag.agentname, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
        $this->db->where('a.totalamount >=', 0);
        $this->db->where('a.duedate <=', $duedate);
        $this->db->group_by('a.refid');// add group_by
        $this->db->order_by('a.duedate', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getuserdata_by_refid($refid, $duedate){
        // Run the query
        // $date_plus_4 = date("Y-m-d");
        // $date_plus_4 = strtotime("+4 days", strtotime($date_plus_4));
        // $date_plus_4 = date("Y-m-d", $date_plus_4);
        $this->db->select('a.accountid');
        $this->db->from('account a');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        // $this->db->where('a.duedate <=', $date_plus_4);
        $this->db->where('a.refid', $refid);
        $this->db->where('a.duedate <=', $duedate);
        // $this->db->order_by("a.homeremind", "desc");
        // $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_totalamount_home($accountid, $max_duedate)
    {
        $this->db->select('a.accountid, a.refid, a.packageid ,a.totalamount, a.duedate, p.packagetypename, a.oriamount, a.status, a.amount');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.accountid', $accountid);
        $query = $this->db->get();
        $packagetypeid_array = $query->result_array();
        $totalamount_home = 0;
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
            $amount = $value['amount'];
            
            $packageinfo = $this->account_model->get_package_info($packagename, $packageid);
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

            $now = strtotime($max_duedate); // or your date as well

            $due_date = strtotime($duedate);

            $timeDiff = abs($now - $due_date);
            $days = $timeDiff/86400; 
            // $days = $days-1;
            // echo "<script>console.log( 'days value: " .$days. "' );</script>";
            $date1 = $max_duedate;
            $date2 = date("Y-m-d",strtotime($duedate));
                        
        $paymentinfo = $this->account_model->get_payment_info($accountid);
        $payment = 0;
        foreach ($paymentinfo as $key => $value) 
        {
            $payment += $value['payment'];
        }

        $day_limitdays = 60;

        //SPECIAL FOR 4 WEEK PACKAGE & SELF DEFINE DAY
        if ($packagename == "package_30_4week") {
            $max_limit_date = $this->account_model->get_maxduedate_by_refid($refid);
            $max_limit_date = strtotime($max_limit_date);
            $max_limit_date = strtotime("+60 days", $max_limit_date);
            $max_limit_datedif = abs($due_date - $max_limit_date);
            $day_limitdays = $max_limit_datedif/86400; 
        }
        elseif ($packagename == "package_manual_payeveryday_manualdays") {
            $day_limitdays = $totaldays_package_manual_payeveryday_manualdays+2;
        }
        if($days>=$day_limitdays){
            $days=$day_limitdays;
        }

        $payment_info = $this->account_model->get_payment_info($accountid);
        $totalamount_home_payment_paid = 0;
        foreach ($payment_info as $key => $value) {
            $payment_paid = $value['payment'];
            $totalamount_home_payment_paid +=$payment_paid;
            if ($payment_paid<0) {
                $status ="open";
            }
        }
            // for before duedate
            $totalamount_home = $amount-$totalamount_home_payment_paid;

            if ($days>0 && $date2<$date1 ) 
            {

                // echo "<script>console.log('".$packagename.":".$days."')</script>";
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
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] >= $date_eachday) 
                        {
                            $payment_paid += $value['payment'];
                            echo "<script>console.log('payment:".$payment_paid."')</script>";
                        }
                    }

                        $totalamount_home = $amount + $total_interest-$payment_paid;
                    // $this->insert_interest($total_interest,$accountid);
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
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] >= $date_eachday) 
                        {
                            $payment_paid += $value['payment'];
                            echo "<script>console.log('payment:".$payment_paid."')</script>";
                        }
                    }

                        $totalamount_home = $amount + $total_interest-$payment_paid;
                    // $this->insert_interest($total_interest,$accountid);
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
                    $payment_paid = 0;
                    foreach ($payment_info as $key => $value) 
                    {
                        if ($value['paymentdate'] <= $date_eachday) 
                        {
                            $payment_paid += $value['payment'];
                            echo "<script>console.log('payment:".$payment_paid."')</script>";
                        }
                    }

                        $totalamount_home = $amount + $total_interest-$payment_paid;
                        // $this->insert_interest($total_interest,$accountid);
                    
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
                    $totalamount_home = $total_amount - $payment_amount_date_larger_than_duedate;
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
                    $totalamount_home = $total_amount - $payment_amount_date_larger_than_duedate;
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
                    $totalamount_home = $total_amount - $payment_amount_date_larger_than_duedate;
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
                    $totalamount_home = $total_amount - $payment_amount_date_larger_than_duedate;
                     // $this->update_total_amount($total_amount,$accountid);
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
                    $totalamount_home = $total_amount - $payment_amount_date_larger_than_duedate;
                     // $this->update_total_amount($total_amount,$accountid);

                }
            }
        }
    }
    return $totalamount_home;
}
    }
?>
