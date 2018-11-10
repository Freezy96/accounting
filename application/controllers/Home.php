<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
        parent::__construct();
        $this->load->model('security_model');
        $this->load->model('home_model');
    }

	public function index()
	{	
		$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->home_model->getuserdata();

		foreach ($res as $key => $value) {
			$totalamount = 0;
			// use to get all accountid
			$refid = $value['refid']; echo "<script>console.log('refid: ".$refid."')</script>";
			$max_duedate = $value['MAX(a.duedate)'];
			// get account using refid
			$account_by_refid = $this->load->home_model->getuserdata_by_refid($refid);
			foreach ($account_by_refid as $key => $value_refid) {
				$accountid = $value_refid['accountid'];
				$amount_to_be_pay = $this->load->home_model->count_totalamount_home($accountid, $max_duedate);
				if ($amount_to_be_pay > 0) {
					$totalamount += $amount_to_be_pay;
				}
				// echo "accid:".$accountid;echo "<br>";echo $totalamount;echo "<br>";
				echo "<script>console.log('total:".$totalamount."')</script>";
			}
			// echo $totalamount;echo "<br>";
			// echo "<script>console.log('total:".$totalamount."')</script>";
			$data['totalamount'.$refid] = $totalamount;
			$data['total_include_havent_reach'.$refid] = $this->load->home_model->count_total_include_hevent_reach($refid);
		}
		$data['result'] = $res;


		$this->load->dbutil();
		// $hour = date("H", mktime(date("H") + 5));  control timezone
		// $hour = date("H", mktime(date("H"))); 
		//noew follow the -5 timezone
		$check = 0;
		$date_today = date("Y-m-d");
		// $day = date("D"); 
		// if($day == 'Wed') 
		// {
			//check today backup ady or not 
			$result_checkdb = $this->load->home_model->get_db_check_exist();
			foreach ($result_checkdb as $key => $value) {
				if ($value['date'] == $date_today) {
					$check = 1;
				}
			}
			if ($check != 1) {
				$prefs = array(     
			    'format'      => 'zip',             
			    'filename'    => 'my_db_backup.sql'
			    );


				$backup =& $this->dbutil->backup($prefs); 

				$db_name = 'backup-on-'. date("Y-m-d") .'.zip';
				$save = 'Backup_DB/'.$db_name;
				// autobackup
				$this->load->helper('file');
				write_file($save, $backup); 
				//insert into db as ady backup evidence
				$this->load->home_model->insert_dbbackup($date_today);
			}
			
		// } 
		
		$this->load->view('home/main', $data);
		$this->load->view('template/footer');
	}

	public function homeremind()
	{	
		$accountid = $this->input->post('accountid');
		//is checked
		$checked = $this->input->post('checked');
		$this->home_model->update_status_home_check($accountid,$checked);
		// echo json_encode($checked);
		// $this->update_status_home_check($accountid);
		// echo json_encode($checked);
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */