<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model{
    function __construct(){
        parent::__construct();
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