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