<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expenses_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getitemdata(){
        // Run the query
        $this->db->select('*');
        $this->db->from('expenses');
        // $this->db->join('customer c', 'a.customerid = c.customerid', 'left');
        // $this->db->join('agent ag', 'a.agentid = ag.agentid', 'left');
        // $this->db->join('packagetype p', 'a.packagetypeid = p.packagetypeid', 'left');
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (JOIN VERSION) -- 请自己换///////////////////
        // $this->db->group_by('a.refid');// add group_by
        $query = $this->db->get();
        return $query->result_array();
    }

     public function insert($data){
        if($this->db->insert('expenses', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function delete($data){
        
        if($this->db->delete('expenses', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }

    public function update($data){
        foreach ($data as $key => $value) {
           $expensesid = $value['expensesid'];
        }
        $this->db->where('expensesid', $expensesid);
        if($this->db->update('expenses', $data)){
            $return = "update";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function getuserdataupdate($expensesid){
        // Run the query
        $this->db->where('expensesid', $expensesid);
        $query = $this->db->get('expenses');
        return $query->result_array();
    }

}
?>
