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
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbankcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancebank($date){
        $debit = $this->getbankdebit($date);
            foreach ($debit as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $credit = $this->getbankcredit($date);
            foreach ($credit as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $balance=$sumd-$sumc;
        return $balance;
    }
     public function getcohdata($date){
        $this->db->select('*');
        $this->db->from('coh');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getcohdebit($date){
        $typed="receive";
        $this->db->select('SUM(amount)');
        $this->db->from('coh');
        $this->db->where("type", $typed);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getcohcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('coh');
        $this->db->where("type", $typec);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancecoh($date){
        $debit = $this->getcohdebit($date);
            foreach ($debit as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $credit = $this->getcohcredit($date);
            foreach ($credit as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $balance=$sumd-$sumc;
        return $balance;
    }
     public function getempdata($date){
         $this->db->select('*');
        $this->db->from('emp');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getempdebit($date){
        $typed="receive";
        $this->db->select('SUM(amount)');
        $this->db->from('emp');
        $this->db->where("type", $typed);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getempcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('emp');
        $this->db->where("type", $typec);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalanceemp($date){
        $debit = $this->getempdebit($date);
            foreach ($debit as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $credit = $this->getempcredit($date);
            foreach ($credit as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $balance=$sumd-$sumc;
        return $balance;
    }
     public function gettotaldata($date){
         $this->db->select('*');
        $this->db->from('total');
        $this->db->where("DATE_FORMAT(datee,'%Y-%m')", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }public function gettotaldebit($date){
        $typed="receive";
        $this->db->select('SUM(amount)');
        $this->db->from('total');
        $this->db->where("type", $typed);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function gettotalcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('total');
        $this->db->where("type", $typec);
        $this->db->where("DATE_FORMAT(datee,'%Y-%m') <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancetotal($date){
        $debit = $this->gettotaldebit($date);
            foreach ($debit as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $credit = $this->gettotalcredit($date);
            foreach ($credit as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $balance=$sumd-$sumc;
        return $balance;
    }
    

    }
?>