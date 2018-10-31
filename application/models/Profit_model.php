<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profit_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function get_this_day_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m-%d')", $date);
        $this->db->where("paymenttype !=", "discount");
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_month_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m')", $date);
        $this->db->where("paymenttype !=", "discount");
        $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_year_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y')", $date);
        $this->db->where("paymenttype !=", "discount");
        $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_day_payment_discount($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m-%d')", $date);
        $this->db->where("paymenttype", "discount");
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_month_payment_discount($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m')", $date);
        $this->db->where("paymenttype", "discount");
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_year_payment_discount($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('payment p');
        $this->db->join('account a', 'p.accountid = a.accountid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y')", $date);
        $this->db->where("paymenttype", "discount");
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

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

    public function account_groupby_refid(){
        
        $this->db->select('a.packageid, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        $this->db->group_by('a.refid');// add group_by
        $this->db->where("DATE_FORMAT(datee,'%Y-%m-%d')", $date);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_all_account_day($date){
        $this->db->select('a.datee, month(a.datee), year(a.datee), a.packageid, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('a.refid');// add group_by
        // $this->db->where("DATE_FORMAT(datee,'%Y-%m-%d')", $date);
        $query = $this->db->get();


        return $query->result_array();
    }

    public function get_this_day_loss_lent($date){
        $loss_lent_out = 0;
        $acc_day = $this->get_all_account_day($date);
        foreach ($acc_day as $key => $value) {
            $datee = $value['datee'];
            if ($datee == $date) {
                $dbname = $value['packagetypename'];
                $packageid = $value['packageid'];
                $package_info = $this->get_package_info($dbname, $packageid);
                foreach ($package_info as $key => $value) {
                    $loss_lent_out+=$value['lentamount'];
                }
            }
        }

        return $loss_lent_out;
    }

    public function get_this_month_loss_lent($date){
        
        $loss_lent_out = 0;
        $acc_month = $this->get_all_account_day($date);
        foreach ($acc_month as $key => $value) {
            if ($value['month(a.datee)']<10) {
                $datee_month = "0".$value['month(a.datee)'];
            }else{
                $datee_month = $value['month(a.datee)'];
            }
            $datee = $value['year(a.datee)']."-".$datee_month;
            if ($datee == $date) {
                $dbname = $value['packagetypename'];
                $packageid = $value['packageid'];
                $package_info = $this->get_package_info($dbname, $packageid);
                foreach ($package_info as $key => $value) {
                    $loss_lent_out+=$value['lentamount'];
                }
            }
        }

        return $loss_lent_out;
    }

    public function get_this_year_loss_lent($date){
        
        $loss_lent_out = 0;
        $acc_month = $this->get_all_account_day($date);
        foreach ($acc_month as $key => $value) {
            $datee = $value['year(a.datee)'];
            if ($datee == $date) {
                $dbname = $value['packagetypename'];
                $packageid = $value['packageid'];
                $package_info = $this->get_package_info($dbname, $packageid);
                foreach ($package_info as $key => $value) {
                    $loss_lent_out+=$value['lentamount'];
                }
            }
        }

        return $loss_lent_out;
    }
    //day 需要吗？
    public function get_this_month_loss_employee(){
        
        $this->db->select('SUM(salary)');
        $this->db->from('employee');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('companyid');// add group_by
        $query = $this->db->get();
        $result_salary = $query->result_array();
        $salary = 0;
        foreach ($result_salary as $key => $value) {
            $salary = $value['SUM(salary)'];
        }
        return $salary;
    }

    public function get_this_year_loss_employee(){
        
        $this->db->select('SUM(salary)');
        $this->db->from('employee');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->group_by('companyid');// add group_by
        $query = $this->db->get();
        $result_salary = $query->result_array();
        $salary = 0;
        foreach ($result_salary as $key => $value) {
            $salary = $value['SUM(salary)'];
        }
        $salary = $salary*12;
        return $salary;
    }

    public function get_day_agent_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('agentpayment p');
        $this->db->join('agent a', 'p.agentid = a.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m-%d')", $date);
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_month_agent_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('agentpayment p');
        $this->db->join('agent a', 'p.agentid = a.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y-%m')", $date);
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_year_agent_payment($date){
        
        $this->db->select('SUM(payment)');
        $this->db->from('agentpayment p');
        $this->db->join('agent a', 'p.agentid = a.agentid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(paymentdate,'%Y')", $date);
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_day_expenses($date){
        
        $this->db->select('SUM(expensesfee)');
        $this->db->from('expenses');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(expensesdate,'%Y-%m-%d')", $date);
        // $this->db->group_by('expensesdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_month_expenses($date){
        
        $this->db->select('SUM(expensesfee)');
        $this->db->from('expenses');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(expensesdate,'%Y-%m')", $date);
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_this_year_expenses($date){
        
        $this->db->select('SUM(expensesfee)');
        $this->db->from('expenses');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where("DATE_FORMAT(expensesdate,'%Y')", $date);
        // $this->db->group_by('paymentdate');// add group_by
        $query = $this->db->get();

        return $query->result_array();
    }

}
?>
