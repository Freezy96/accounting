<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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
        $this->load->model('package_model');
        $this->load->model('account_model');
        $this->load->model('agent_model');
        $this->load->model('security_model');$this->load->helper('url');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->account_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('account/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$max_refid = $this->load->account_model->get_max_refid();
		$data['refid'] = $max_refid;
		$res = $this->load->account_model->getuserdatainsertcustomer();
		$data['result'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_30_4week();
		$data['package_30_4week'] = $res;
		// $res = $this->load->account_model->getuserdatainsertpackage();
		// $data['package_30_4week'] = $res;
		// $res = $this->load->account_model->getuserdatainsertpackage();
		// $data['package_30_4week'] = $res;
		// $res = $this->load->account_model->getuserdatainsertpackage();
		// $data['package_30_4week'] = $res;
		$res = $this->load->agent_model->getuserdata();
		$data['agent'] = $res;
		$this->load->view('account/insert', $data);
		$this->load->view('template/footer');
	}

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		$package_type_id = $this->input->post('packageid');

		///////////////////////////////////package_30_4week//////////////////////////////////////
		
		if (substr( $package_type_id, 0, 16) === "package_30_4week") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			$res = $this->load->package_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->package_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				$interest = $value['interest'];
				$week1 = $value['week1'];
				$week2 = $value['week2'];
				$week3 = $value['week3'];
				$week4 = $value['week4'];
			}
			echo "<script>console.log( 'Debug Objects: " . $result . "' );</script>";

				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}
				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$date2 = strtotime("+2 week", strtotime($dateoriginal));
				$date2 = date('Y-m-d', $date2);

				$date3 = strtotime("+3 week", strtotime($dateoriginal));
				$date3 = date('Y-m-d', $date3);

				$date4 = strtotime("+4 week", strtotime($dateoriginal));
				$date4 = date('Y-m-d', $date4);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => $interest,
				'amount' => $week1,
				'refid' => $refid,
				'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => $interest,
				'amount' => $week2,
				'refid' => $refid,
				'payment' => 0,
				'datee' => $date1,
				'duedate' => $date2,
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => $interest,
				'amount' => $week3,
				'refid' => $refid,
				'payment' => 0,
				'datee' => $date2,
				'duedate' => $date3,
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => $interest,
				'amount' => $week4,
				'refid' => $refid,
				'payment' => 0,
				'datee' => $date3,
				'duedate' => $date4,
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
		}
		
		///////////////////////////////////package_30_4week//////////////////////////////////////


		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('account');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$accountid = $this->input->post('accountid');
		$res = $this->load->account_model->getaccountdataupdate($accountid);
		$data['result'] = $res;
		$res = $this->load->account_model->getuserdatainsertcustomer();
		$data['customer'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage();
		$data['package'] = $res;
		$res = $this->load->agent_model->getuserdata();
		$data['agent'] = $res;
		$this->load->view('account/update', $data);
		$this->load->view('template/footer');
	}

	public function modal() 
	{	
		$accountid = $this->input->post('accountid');
		$data = $this->account_model->getuserdatamodal($accountid);
	        
	    echo json_encode($data);

		//Either you can print value or you can send value to database
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
