<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.accountid , a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, p.packagetypename');
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

    public function getuserdata_payment_use($refid){
        // Run the query
        // $this->db->distinct('a.refid');
        $this->db->select('a.accountid , a.refid, a.customerid, c.customername, a.oriamount, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
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
        $this->db->select('a.accountid, a.refid, a.oriamount, a.customerid, c.customername, a.amount, a.datee, a.interest, a.duedate, a.packageid, ag.agentname, ag.agentid, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        $this->db->where('refid', $refid_res);
        // $this->db->group_by('pay.accountid');// add group_by
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
        $query = $this->db->get('package_30_4week');
        return $query->result_array();
    }

    public function getuserdatainsertpackage_25_month(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('package_25_month');
        return $query->result_array();
    }
    public function getuserdatainsertpackage_20_week(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('package_20_week');
        return $query->result_array();
    }
        public function getuserdatainsertpackage_15_week(){
        // Run the query
        $this->db->select('*');
        $query = $this->db->get('package_15_week');
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
        $this->db->select('payment');
        $this->db->from('payment');
        $this->db->where('accountid', $accountid);
        $query = $this->db->get();
         return $query->result_array();
    }
    public function insert_interest($total_interest, $accountid)
    {
    $data = array(
    'interest' => $total_interest
    );
    $this->db->where('accountid', $accountid);
    $this->db->update('account', $data);
    }

    // Package 30 / 4Week 滚利息
    public function interest_30_4week()
    {
        $this->db->select('a.accountid, a.packageid,a.totalamount, a.duedate, p.packagetypename, a.oriamount, a.status');
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
            
            $payment = "";
            $paymentinfo = $this->get_payment_info($accountid);
             foreach ($paymentinfo as $key => $value) {
                $payment = $value['payment'];
            }
        
            $packageinfo = $this->get_package_info($packagename, $packageid);
            foreach ($packageinfo as $key => $value) {
                $interest = $value['interest'];
                $lentamount = $value['lentamount'];
            }
            

            // $diff = abs(strtotime($date1) - strtotime($date2));


            // $years = floor($diff / (365*60*60*24));
            // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $now = time(); // or your date as well
            $due_date = strtotime($duedate);
            $datediff = $now - $due_date;
            $days = round($datediff / (60 * 60 * 24));

            $date1 = date("Y-m-d");
            $date2 = date("Y-m-d",strtotime($duedate));
            // echo ;
            // echo "<script>console.log('Year:'+"..");</script>";
            // echo "<script>console.log('Month:'+".$months.");</script>";
            // echo "<script>console.log('Day:'+".$days.");</script>";
            // echo "<script>console.log('Day:'+".$date1.");</script>";
            // echo "<script>console.log('Day:'+".$date2.");</script>";
        // if ($days>=60){
        //     $status = "baddebt";
        //     }
            if ($days>0 && $date2<$date1) {
                //package 不是closed 就跑利息
                if($packagename == "package_30_4week" && $status !=="closed" && $status !=="baddebt")
                {
                    $total_interest = $interest * $days;
                    $this->insert_interest($total_interest,$accountid);
                }
                elseif ($packagename == "package_25_month" && $status !=="closed" && $status !=="baddebt")
                {
                    $total_interest = $oriamount * pow((100+$interest)/100, $days) - $oriamount;
                    $this->insert_interest(number_format($total_interest, 2, '.', ''),$accountid);
                }
                

            }

if ($payment!==""){
            if ($days<=0) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount* 20/100;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount* 15/100;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==1) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==2&&$days<7) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==7) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==8) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==9&&$days<14) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==14) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==15) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==16&&$days<21) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==21) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==22) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==23&&$days<28) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==28) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==29) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==30&&$days<35) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==35) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==36) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==37&&$days<42) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==42) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==43) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==44&&$days<49) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==49) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==50) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==51&&$days<56) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==56) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount*0.2;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount*0.15;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==57) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
            }elseif ($days==58&&$days<60) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {    
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $totalamount+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$totalamount;

                }

}else{
            if ($days<=0) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $lentamount* 20/100;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = $lentamount* 15/100;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==1) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ($lentamount* 0.2)+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ($lentamount* 0.15)+$interest;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=2 && $days<6) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ($lentamount* 0.2)+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt" && $status !=="baddebt")
                {
                     $total_interest = ($lentamount* 0.15)+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==7) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.2)+($interest*2))*0.2+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.15)+($interest*2))*0.15+(($interest*2));
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==8) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.2)+($interest*2))*0.2+($interest*3);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.15)+($interest*2))*0.15+(($interest*3));
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=9 &&$days<14) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.2)+($interest*2))*0.2+($interest*4);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (($lentamount* 1.15)+($interest*2))*0.15+($interest*4);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==14) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*4);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*4);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==15) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*5);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*5);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=16 && $days<21) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==21) {
            if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==22) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>= 23 && $days < 28) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==28) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }elseif ($days==29) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }elseif ($days>=30 && $days<35) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }elseif ($days==35) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==36) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=37 &&$days<42) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==42) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==43) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=44 &&$days<49) {
                                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==49) {
                 if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==50) {
                 if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=51 && $days<56) {
                  if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =(((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = (((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==56) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount;
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days==57) {
                if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }elseif ($days>=58) {
             if ($packagename == "package_20_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest =((((((((($lentamount* 1.2)+($interest*2))*1.2+($interest*2))*0.2+(($lentamount* 1.2)+($interest*2))*0.2+($interest*6)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2)+$lentamount*1.2)*1.2-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
                elseif ($packagename == "package_15_week"  && $status !=="closed" && $status !=="baddebt")
                {
                     $total_interest = ((((((((($lentamount* 1.15)+($interest*2))*1.15+($interest*2))*0.15+(($lentamount* 1.15)+($interest*2))*0.15+($interest*6)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2)+$lentamount*1.15)*1.15-$lentamount+($interest*2);
                     $this->insert_interest($total_interest,$accountid);
                     $totalamount = $total_interest+$lentamount;

                }
            }
        
        }
    }
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

    public function insert_baddebt($data)
   {
        if($this->db->insert('baddebt', $data))
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

        $this->db->select('accountid, amount, interest');
        $this->db->from('account');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $val) {
            $amount = $val['amount'];
            $interest = $val['interest'];
            $accountid = $val['accountid'];
            $totalamount = $amount+$interest;
            $this->update_total_amount($totalamount,$accountid);
        }

        foreach ($result as $key => $val) {
            $amount = $val['amount'];
            $interest = $val['interest'];
            $accountid = $val['accountid'];
            foreach ($result_payment as $key => $value) {
                if($val['accountid'] == $value['accountid'])
                {
                    echo "<script>console.log( 'Debug value: " .$value['accountid']. "' );</script>";
                    $payment = $value['SUM(payment)'];
                    $totalamount = $amount+$interest-$payment;
                    $this->update_total_amount($totalamount,$accountid);
                }
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
public function get_days()
    {
        $this->db->select('a.accountid, a.packageid,a.totalamount, a.duedate, a.oriamount, a.status');
        $this->db->from('account a');
        // $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();

        return $query->result_array();
    }
    public function account_status_set()
    {
        $this->db->select('accountid, totalamount');
        $this->db->from('account');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $val) {
            $accountid = $val['accountid'];
            $totalamount = $val['totalamount'];
            $status = "closed";

       
            $get_days =$this->get_days();
            foreach ($get_days as $key => $value) 
        {
            $duedate = $value['duedate'];

            $date1 = date("Y-m-d");
            $date2 = date("Y-m-d",strtotime($duedate));
            
            $diff = abs(strtotime($date2) - strtotime($date1));


            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if ($days>=60){
                $status = "baddebt";
                $this->set_status($status, $accountid);
            }
            // if($totalamount <= 0){
            //     $this->set_status($status, $accountid); 
            // }
            }
        }
    }

    public function set_status($status,$accountid)
    {
        $this->db->where('accountid', $accountid);
        $this->db->update('account', array('status' => $status)); 
    }


}
?>
