<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Print_Model extends CI_Model{
    function __construct(){
        parent::__construct();
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
        $this->db->select('a.refid, a.duedate');
        $this->db->from('account a');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $date_select=strtotime($date);
        $date_3week=strtotime("-21 days", strtotime($date));
        $date_3week = date("Y-m-d",$date_3week);
        $this->db->where('a.duedate >=',  $date_3week);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getuserdata($refid,$duedate){
        $this->db->select('a.accountid, SUM(a.totalamount), a.oriamount, a.customerid, c.customername, c.address, c.gender, a.amount, a.datee, a.interest, a.duedate, a.packageid, c.phoneno, ag.agentname, p.packagetypename');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.refid', $refid);
        $this->db->where('a.duedate <=', $duedate);
        $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }
    }
?>
