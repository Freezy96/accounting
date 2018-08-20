<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_Model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getpackagedata(){
        // Run the query
        $query = $this->db->get('package');
        return $query->result_array();
    }
    public function insetP($amount, $persent, $days) {
    $this->db->set('amount', $amount);
    $this->db->set('persent', $persent);
    $this->db->set('day', $day );
        if ($this->db->insert('package')) {
            $sql = "INSERT INTO package (amount, persent, days) VALUES ('$amount', '$persent', '$days')";
            return $this->db->insert_id();
        } else {

            return false;
        }return false;
    }
    public function editP($amount, $persent, $days)
     {

      $this->db->set('amount', $amount);
      $this->db->set('persent', $persent);
      $this->db->set('day', $day );
      //指定要更新的id
      $this->db->where('packageid', $packageid);
      //存入資料庫
      $this->db->update('package');
      //產生： UPDATE news SET title = '$title', content = '$content' WHERE id = $id
     }

     //刪除
     public function deleteP($id){
      $this->db->delete('package', array('packageid' => $id));
      //產生：  DELETE FROM news WHERE id = $id
     }
    public function main_30_4week()
    {
      // Run the query
      ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
      $query = $this->db->get('package_30_4week');
      return $query->result_array();
    }

    public function insert_30_4week($data)
    {
      if($this->db->insert('package_30_4week', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }
    
    public function delete_30_4week($data)
    {
      if($this->db->delete('package_30_4week', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }

<<<<<<< HEAD
    public function get_package_type_id($data)
    {
      $packagetypename = $data;
      $this->db->select('packagetypeid');
      $this->db->where('packagetypename', $packagetypename);
      $query = $this->db->get('packagetype');
      return $query->result_array();
    }

<<<<<<< HEAD

=======
>>>>>>> 545b24d0f9b5b19de951672faf14becd27df2ba2
    public function main_20_week()
=======
    public function main_25_month()
>>>>>>> master
    {
      // Run the query
      ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
        $company_identity = $this->session->userdata('adminid');
        $this->db->where('companyid', $company_identity);
        ///////////////Combo of User Indentity (ORIGINAL VERSION)///////////////////
      $query = $this->db->get('package_25_month');
      return $query->result_array();
    }

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 545b24d0f9b5b19de951672faf14becd27df2ba2
    public function insert_20_week($data)
    {
      if($this->db->insert('package_20_week', $data)){
            $return = "insert";
=======
    public function insert_25_month($data)
    {
      if($this->db->insert('package_25_month', $data)){
            $return = "delete";
>>>>>>> master
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }
<<<<<<< HEAD
<<<<<<< HEAD

    
    public function delete_20_1week($data)
=======
    public function get_package_info($packagename, $packageid)

=======
    
    public function delete_20_1week($data)

=======

    public function delete_25_month($data)
>>>>>>> master
    {
      if($this->db->delete('package_25_month', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }

    public function main_20_week()
    {
      // Run the query
      $query = $this->db->get('package_20_week');
      return $query->result_array();
    }

    // public function insert_20_week($data)
    // {
    //   if($this->db->insert('package_20_week', $data)){


    //         $return = "insert";
    //         return $return;
    //     }else{
    //         $return = "false";
    //         return $return;
    //     }
    // }
    
    public function delete_20_1week($data)
    {
<<<<<<< HEAD
      if($this->db->insert('package_15_week', $data)){
        
            $return = "insert";
=======
      if($this->db->delete('package_20_week', $data)){
            $return = "delete";
>>>>>>> master
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }

    public function main_15_week()
    {
      // Run the query
      $query = $this->db->get('package_20_week');
      return $query->result_array();
    }

    // public function insert_15_week($data)
    // {

        
    //         $return = "insert";
    //         return $return;
    //     }else{
    //         $return = "false";
    //         return $return;
    //     }
    // }
    
    public function delete_15_week($data)
    {
      if($this->db->delete('package_15_week', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }

}
?>