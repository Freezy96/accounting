<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getemployeedata(){
        // Run the query
        $query = $this->db->get('employee');
        return $query->result_array();
    }

    public function insert($data){
        if($this->db->insert('employee', $data)){
        	$return = "insert";
        	return $return;
        }else{
        	$return = "false";
        	return $return;
        }

    }

    public function getuserdataupdate($employeeid){
        // Run the query
        $employeeid = $employeeid;
        $this->db->where('employeeid', $employeeid);
        $query = $this->db->get('employee');
        return $query->result_array();
    }

    public function update($data){
        foreach ($data as $key => $value) {
           $employeeid = $value['employeeid'];
        }
        $this->db->where('employeeid', $employeeid);
        if($this->db->replace('employee', $data)){
            $return = "update";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function delete($data){
        
        if($this->db->delete('employee', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }
}
?>
