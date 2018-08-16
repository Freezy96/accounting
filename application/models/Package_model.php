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

    public function main_25_month()
    {
      // Run the query
      $query = $this->db->get('package_25_month');
      return $query->result_array();
    }

    public function insert_25_month($data)
    {
      if($this->db->insert('package_25_month', $data)){
            $return = "delete";
            return $return;
        }else{
            $return = "false";
            return $return;
        } 
    }

    public function delete_25_month($data)
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

    public function main_20_week()
    {
      // Run the query
      $query = $this->db->get('package_20_week');
      return $query->result_array();
    }

    public function insert_20_week($data)
    {
      if($this->db->insert('package_20_week', $data)){
        double lentamount = 'lentamount';
        double interest = 'interest';
        double totalamount = lentamount*interest;
        double week1 = totalamount;

            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }
    
    public function delete_20_1week($data)
    {
      if($this->db->delete('package_20_week', $data)){
            $return = "delete";
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

    public function main_15_week()
    {
      // Run the query
      $query = $this->db->get('package_20_week');
      return $query->result_array();
    }

    public function insert_15_week($data)
    {
      if($this->db->insert('package_15_week', $data)){
        double lentamount = 'lentamount';
        double interest = 'interest';
        double totalamount = lentamount*interest;
        double week1 = totalamount;
        
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }
    
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