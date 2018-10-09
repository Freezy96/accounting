<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Book_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function insertB($data){
        if($this->db->insert('bank', $data)){
        	$return = "insert";
            $id = $this->db->insert_id();
        	return $id;
        }else{
        	$return = "false";
        	return $return;
        }

    }
        public function insertC($data){
        if($this->db->insert('COH', $data)){
            $return = "insert";
            $id = $this->db->insert_id();
            return $id;
        }else{
            $return = "false";
            return $return;
        }

    }
            public function insertE($data){
        if($this->db->insert('Emp', $data)){
            $return = "insert";
            $id = $this->db->insert_id();
            return $id;
        }else{
            $return = "false";
            return $return;
        }

    }
            public function insertT($data){
        if($this->db->insert('Total', $data)){
            $return = "insert";
            $id = $this->db->insert_id();
            return $id;
        }else{
            $return = "false";
            return $return;
        }

    }

     public function getbankdata($date){ 

        $this->db->select('*');
        $this->db->from('bank');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();


    }
     public function getbankdebit($date){
        $typed="receive";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')<", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbankcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')<", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancebank($date){
        $debit = $this->getbankdebit($date);
            foreach ($debit as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $credit = $this->getbankdebit($date);
            foreach ($credit as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $balance=$sumd-$sumc;
        return $balance;
    }
     public function getcohdata(){
        $this->db->select('coh');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
     public function getempdata(){
        $this->db->select('emp');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
     public function gettotaldata(){
        $this->db->select('total');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    }
?>