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

    public function get_package_type_id($data)
    {
      $packagetypename = $data;
      $this->db->select('packagetypeid');
      $this->db->where('packagetypename', $packagetypename);
      $query = $this->db->get('packagetype');
      return $query->result_array();
    }

<<<<<<< HEAD
    public function insert_20_week($data)
    {
      if($this->db->insert('package_20_week', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }
=======
    public function get_package_info($packagename, $packageid)
    {
      //database 名字，在insert的选项那边的前缀
      $dbname = $packagename;
      $packageid = $packageid;
      $this->db->where('packageid', $packageid);
      $query = $this->db->get($dbname);
      return $query->result_array();
    }

>>>>>>> master
    public function insert_15_week($data)
    {
      if($this->db->insert('package_15_week', $data)){
            $return = "insert";
            return $return;
        }else{
            $return = "false";
            return $return;
        }
    }
}
?>