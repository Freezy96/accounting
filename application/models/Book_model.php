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
    }
?>