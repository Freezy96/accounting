 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Baddebt_Model extends CI_Model{

     public function getaccountdata(){
        // Run the query
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $query = $this->db->get('account');
        return $query->result_array();
    }
    public function get_status($accountid)
    {
        $this->db->select('status');
        $this->db->from('account');
        $query = $this->db->get();
         return $query->result_array();
    }
 public function insert_baddebt($data)
   {
        if($this->db->insert('baddebt', $data))
        {
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }

    }

    public function delete($data){
        
        if($this->db->delete('customer', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        }    

    }
}