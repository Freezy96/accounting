<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function update($adminid, $newpassword){

        $this->db->where('adminid', $adminid);
        $this->db->update('admin', array('password' => $newpassword));
        $return = "update";
        return $return;
    }
}
?>