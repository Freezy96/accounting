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
           
            public function insertT($data){
        if($this->db->insert('total', $data)){
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
        $this->db->where("datee", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();


    }
    public function getbankdebit($date){
        $typed="receive";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbankcredit($date){
        $typec="payment";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("datee <", $date);
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


    public function getmbbdebit($date){
        $typed="receive";
        $bank="mbb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getmbbcredit($date){
        $typec="payment";
        $bank="mbb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancembb($date){
        $mbbd = $this->getmbbdebit($date);
            foreach ($mbbd as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $mbbc = $this->getmbbcredit($date);
            foreach ($mbbc as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $mbb=$sumd-$sumc;
        return $mbb;
    }
        public function getpbbdebit($date){
        $typed="receive";
        $bank="pbb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getpbbcredit($date){
        $typec="payment";
        $bank="pbb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancepbb($date){
        $pbbd = $this->getpbbdebit($date);
            foreach ($pbbd as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $pbbc = $this->getpbbcredit($date);
            foreach ($pbbc as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $pbb=$sumd-$sumc;
        return $pbb;
    }
        public function getrhbdebit($date){
        $typed="receive";
        $bank="rhb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getrhbcredit($date){
        $typec="payment";
        $bank="rhb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancerhb($date){
        $rhbd = $this->getrhbdebit($date);
            foreach ($rhbd as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $rhbc = $this->getrhbcredit($date);
            foreach ($rhbc as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $rhb=$sumd-$sumc;
        return $rhb;
    }
    public function gethlbdebit($date){
        $typed="receive";
        $bank="hlb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typed);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function gethlbcredit($date){
        $typec="payment";
        $bank="hlb";
        $this->db->select('SUM(amount)');
        $this->db->from('bank');
        $this->db->where("type", $typec);
        $this->db->where("bank", $bank);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getbalancehlb($date){
        $hlbd = $this->gethlbdebit($date);
            foreach ($hlbd as $key => $value) 
            {
                $sumd= $value['SUM(amount)'];
            }
        $hlbc = $this->gethlbcredit($date);
            foreach ($hlbc as $key => $value) 
            {
                $sumc= $value['SUM(amount)'];
            }
        $hlb=$sumd-$sumc;
        return $hlb;
    }
     public function getcohdata($date){
        $this->db->select('amount,datee');
        $this->db->from('coh');
        $this->db->order_by('bookid', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get();
        $result = $query->result_array();
        $amount=0;
         foreach ($result as $key => $value) 
            {
                $amount= $value['amount'];
            }

            return $amount;

    }

    public function get_all_cohdata(){
        $this->db->select('*');
        $this->db->from('coh');
        $query = $this->db->get();

        return $query->result_array();


    }
     public function gettotaldata($date){
         $this->db->select('*');
        $this->db->from('total');
        $this->db->where("datee", $date);
        $this->db->order_by('datee','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gettotaldebit($date){
        $typed="debit";
        $this->db->select('SUM(amount)');
        $this->db->from('total');
        $this->db->where('type', $typed);
        $this->db->where("datee <", $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function gettotalcredit($date){
        $typec="credit";
        $this->db->select('SUM(amount)');
        $this->db->from('total');
        $this->db->where('type', $typec);
        $this->db->where("datee <", $date);
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
        $balance=$sumc-$sumd;
        return $balance;
    }

    public function delete_bank($data){
        
        if($this->db->delete('bank', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 


    }

    public function delete_total($data){
        
        if($this->db->delete('total', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 


    }

    }
?>