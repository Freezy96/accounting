<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
        $date_plus_4 = date("Y-m-d");
        $date_plus_4 = strtotime("+4 days", strtotime($date_plus_4));
        $date_plus_4 = date("Y-m-d", $date_plus_4);
        $this->db->select('MAX(a.accountid), SUM(a.totalamount), a.oriamount, a.customerid, c.customername, a.amount, MIN(a.datee), a.interest, MAX(a.duedate), a.packageid, c.phoneno, ag.agentname, p.packagetypename, MAX(a.homeremind)');
        $this->db->from('account a');
        $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('a.companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $this->db->where('a.duedate <=', $date_plus_4);
        $this->db->where('a.totalamount >=', 0);
        // $this->db->order_by("a.homeremind", "desc");
        $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_db_check_exist(){
        // Run the query
        $this->db->select('*');
        $this->db->from('dbbackup');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_dbbackup($date_today){
        // Run the query
        if($this->db->insert('dbbackup', array('date' => $date_today))){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }

    public function update_status_home_check($accountid,$checked)
    {   
        $this->db->where("accountid", $accountid);
        if ($checked == 'true') {
            $this->db->update("account", array('homeremind' => 'checked'));
        }else{
            $this->db->update("account", array('homeremind' => 'non_checked'));
        }
        // echo json_encode($checked);
        // $this->update_status_home_check($accountid);
    }

}
?>
