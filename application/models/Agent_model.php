<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agent_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getuserdata(){
        // Run the query
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

    public function update($data){
        foreach ($data as $key => $value) {
           $agentid = $value['agentid'];
        }
        $this->db->where('agentid', $agentid);
        if($this->db->replace('agent', $data)){
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
}
?>
