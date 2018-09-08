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
		foreach ($res as $key => $value) {
            $packagename =  $value['packagetypename'];
            $packageid = $value['packageid'];
            $res_info = $this->load->account_model->get_package_info($packagename, $packageid);
            $data['p'.$packageid] = $res_info;
        }
        // 先滚利息
		$this->load->account_model->interest_30_4week();
		// 再算totalamount
		$this->load->account_model->count_total_amount();
		$this->load->account_model->account_status_set();

    	$this->load->view('account/main', $data);		
		$this->load->view('template/footer');

	}

	public function insert()
	{	$this->security_model->secure_session_login();
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
		$res = $this->load->account_model->getuserdatainsertpackage_25_month();
		$data['package_25_month'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_20_week();
		$data['package_20_week'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_15_week();
		$data['package_15_week'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_15_5days();
		$data['package_15_5days'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_10_5days();
		$data['package_10_days'] = $res;
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
		$agentid = $this->input->post('agentid');
		$agentcharge_array = $this->load->account_model->get_agent_charge($agentid);
		$agent_charge=0;
		foreach ($agentcharge_array as $key => $value_charge) {
			$agent_charge = $value_charge['charge'];
		}
		 
			
		
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////
		//get max accountline then +1 for the new one
				$max_accountline = $this->load->account_model->get_max_accountline();
				foreach ($max_accountline as $key => $value) {
					$accountline = $value['accountline']+1; //auto increment
				}
		///////////////////////////////////package_30_4week//////////////////////////////////////
		
		if (substr( $package_type_id, 0, 16) === "package_30_4week") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				$week1 = $value['week1'];
				$week2 = $value['week2'];
				$week3 = $value['week3'];
				$week4 = $value['week4'];
			}

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
				'interest' => 0,
				'amount' => $week1,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week2,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date1,
				'duedate' => $date2,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week3,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date2,
				'duedate' => $date3,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week4,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date3,
				'duedate' => $date4,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
		}
		
		///////////////////////////////////package_30_4week//////////////////////////////////////

		///////////////////////////////////package_25_month//////////////////////////////////////
		
		if (substr( $package_type_id, 0, 16) === "package_25_month") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
			}

				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}
				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 month", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}

				
				if (substr( $package_type_id, 0, 15) === "package_20_week") 
		{	
			$packagename = substr( $package_type_id, 0, 15);
			$packageid = substr( $package_type_id, 15, 16 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}


		if (substr( $package_type_id, 0, 15) === "package_15_week") 
		{	
			$packagename = substr( $package_type_id, 0, 15);
			$packageid = substr( $package_type_id, 15, 16 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'guarantyitem'=>$this->input->post('guarantyitem'),
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}

		if (substr( $package_type_id, 0, 16) === "package_15_5days") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}


		if (substr( $package_type_id, 0, 16) === "package_10_5days") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal = $this->input->post('date');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $this->input->post('customerid'),
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'guarantyitem'=>$this->input->post('guarantyitem'),
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => $agent_charge,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}
		///////////////////////////////////package_25_month//////////////////////////////////////


		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('account');
		}
		$this->load->view('template/footer');
	}

	public function modal() 
	{	
		$accountid = $this->input->post('accountid');
		$data = $this->account_model->getuserdatamodal($accountid);
		//用accountid 拿refid,再用refid那所有的accountid，在拿所有的payment出来，吧同样的payment merge起来，组成几个东西，push进array
		$get_refid = $this->account_model->getrefid($accountid);
		foreach ($get_refid as $key => $value) {
			$refid = $value['refid'];
		}
		$get_all_acc_id = $this->account_model->get_accountid_using_refid($refid);
		$count_array = -1;
		foreach ($get_all_acc_id as $key => $value) {
			$count_array++;
			$all_account_id = $value['accountid'];
			$get_payment = $this->account_model->get_payment_amount($all_account_id);
			$payment = 0;
			$interest_paid = 0;
			foreach ($get_payment as $key => $value) {
				if($value['paymenttype']=="amount")
				{
					$payment+=$value['payment'];
				}
				// elseif($value['paymenttype']=="interest")
				// {
				// 	$interest_paid+=$value['payment'];
				// }
				if($value['paymenttype']=="discount")
				{
					$payment+=$value['payment'];
				}
				if($value['paymenttype']=="newpackage")
				{
					$payment+=$value['payment'];
				}
				// ${'data'. $all_account_id} = array();
				$data[$count_array]["payment"] = $payment;
				// $data[$count_array]["interest_paid"] = $interest_paid;

			}
		}
		
	     
	    echo json_encode($data);

		//Either you can print value or you can send value to database
	}

	public function payment()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$refid = $this->input->post('account_refid');
		$res = $this->load->account_model->getuserdata_payment_use($refid);
		$data['result'] = $res;
		foreach ($res as $key => $value) {
			$accountid = $value['accountid'];
			$res = $this->load->account_model->get_payment_amount($accountid);
			$data['payment_amount'.$accountid] = $res;
		}

		$res = $this->load->account_model->getuserdatainsertpackage_30_4week();
		$data['package_30_4week'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_25_month();
		$data['package_25_month'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_20_week();
		$data['package_20_week'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_15_week();
		$data['package_15_week'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_15_5days();
		$data['package_15_5days'] = $res;
		$res = $this->load->account_model->getuserdatainsertpackage_10_5days();
		$data['package_10_5days'] = $res;
		
		$this->load->view('account/payment', $data);
		$this->load->view('template/footer');
	}

	public function baddebt()
    {
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
         $res1= $this->load->account_model->get_status();

        foreach ($res1 as $key => $value) {
            $status = $value['status'];
            $accountid = $value['accountid'];
            $data['result'] = $res1;
            if ($status=="baddebt") {
            $this->baddebt_insert_db($accountid);
        }



        $res = $this->load->account_model->getbaddebtuserdata();
        $data['result'] = $res;
        foreach ($res as $key => $value) {
            $packagename =  $value['packagetypename'];
            $packageid = $value['packageid'];
            $res_info = $this->load->account_model->get_package_info($packagename, $packageid);
            $data['p'.$packageid] = $res_info;
        }
        // 先滚利息
        $this->load->account_model->interest_30_4week();
        // 再算totalamount
        $this->load->account_model->count_total_amount();
        $this->load->account_model->account_status_set();



    }
        $this->load->view('account/baddebt', $data);
        $this->load->view('template/footer');

    }

	public function payment_insert_db()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$account_number_count = $this->input->post('account_number_count');
		$date_today = date("Y-m-d");

		// $this->insertdb_switch_package($customerid, $packageid);
		$customerid = $this->input->post('customerid');
		// echo "<script>console.log(".$customerid.")</script>";
		for ($i=1; $i < $account_number_count+1; $i++) 
		{ 
			//switch package
			$checkpackage = $this->input->post('packageid' . $i);
			if($checkpackage!="")
			{
				$packageid = $checkpackage;
				$guarantyitem = $this->input->post('guarantyitem_name' . $i);
				$accountid_check_accountline = $this->input->post('accountid' . $i);
				$accountline =  $this->account_model->get_accountline($accountid_check_accountline);
				echo "<script>console.log('Debug:".$guarantyitem."')</script>";
				//packageid here is packagename + id
				$this->insertdb_switch_package($customerid, $packageid, $guarantyitem, $accountline);


				if (substr( $packageid, 0, 16) === "package_30_4week") 
				{
					$packagename_getinfo = substr( $packageid, 0, 16);
					$packageid_get_info = substr( $packageid, 16, 17 );
					// echo "<script>console.log(".$packagename_getinfo.")</script>";
					// echo "<script>console.log(".$packageid_get_info.")</script>";
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);

				}
				if (substr( $packageid, 0, 16) === "package_25_month") 
				{
					$packagename_getinfo = substr( $packageid, 0, 16);
					$packageid_get_info = substr( $packageid, 16, 17 );
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);
				}
				if (substr( $packageid, 0, 15) === "package_20_week") 
				{
					$packagename_getinfo = substr( $packageid, 0, 15);
					$packageid_get_info = substr( $packageid, 15, 16 );
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);

				}
				if (substr( $packageid, 0, 15) === "package_15_week") 
				{
					$packagename_getinfo = substr( $packageid, 0, 15);
					$packageid_get_info = substr( $packageid, 15, 16 );
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);
				}
				if (substr( $packageid, 0, 16) === "package_15_5days") 
				{
					$packagename_getinfo = substr( $packageid, 0, 16);
					$packageid_get_info = substr( $packageid, 16, 17 );
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);

				}
				if (substr( $packageid, 0, 16) === "package_10_5days") 
				{
					$packagename_getinfo = substr( $packageid, 0, 16);
					$packageid_get_info = substr( $packageid, 16, 17 );
					$package_info = $this->account_model->get_package_info($packagename_getinfo, $packageid_get_info);
				}

				foreach ($package_info as $key => $val) {
					$lentamount = $val['lentamount'];
					// echo "<script>console.log(".$lentamount.")</script>";
				}
				//check amount greater than lentamount anot
				$amount_check_greater_smaller = $this->input->post('totalamount_check_limitation' . $i);
				if($lentamount>$amount_check_greater_smaller)
				{
					$payment_amount = $amount_check_greater_smaller;
				}
				else
				{
					$payment_amount = $lentamount;
				}

				$data_newpackage = array(
					'accountid' => $this->input->post('accountid' . $i),
					'payment' => $payment_amount,
					'paymenttype' => "newpackage",
					'paymentdate' => $date_today
					);
				echo "<script>console.log(".$payment_amount.")</script>";
				$return = $this->account_model->insert_payment($data_newpackage);
			}

			// $amount = $this->input->post('amount');
			//minus payment then minus discount
			$step_by_step_amount = $this->input->post('totalamount_check_limitation' . $i);
			if($this->input->post('amount' . $i)!="")
			{
				//check the amount number exceed limit anot.
				if ($step_by_step_amount<$this->input->post('amount' . $i)) {
					$amount = $step_by_step_amount;
					$step_by_step_amount-=$amount;
				}
				else{
					$amount = $this->input->post('amount' . $i);
					$step_by_step_amount-=$amount;
				}
				$data = array(
					'accountid' => $this->input->post('accountid' . $i),
					'payment' => $amount,
					'paymenttype' => "amount",
					'paymentdate' => $date_today
					);
				echo "<script>console.log(".$this->input->post('amount' . $i).")</script>";
				$return = $this->account_model->insert_payment($data);

			}

			// if($this->input->post('interest' . $i)!="")
			// {
			// $data = array(
			// 	'accountid' => $this->input->post('accountid' . $i),
			// 	'payment' => $this->input->post('interest' . $i),
			// 	'paymenttype' => "interest",
			// 	'paymentdate' => $date_today
			// 	);
			// $return = $this->account_model->insert_payment($data);
			// }

			if($this->input->post('discount' . $i)!="")
			{
				//check the amount number exceed limit anot.
				if ($step_by_step_amount<$this->input->post('discount' . $i)) {
					$amount = $step_by_step_amount;
					$step_by_step_amount-=$amount;
				}
				else{
					$amount = $this->input->post('discount' . $i);
					$step_by_step_amount-=$amount;
				}
				$data = array(
					'accountid' => $this->input->post('accountid' . $i),
					'payment' => $amount,
					'paymenttype' => "discount",
					'paymentdate' => $date_today
					);
				echo "<script>console.log(".$this->input->post('amount' . $i).")</script>";
				$return = $this->account_model->insert_payment($data);
			}


		}
		// $data['return'] = $return;

		// if($return == true){
		// 	// session to sow success or not, only available next page load
		// 	$this->session->set_flashdata('return',$data);
		// 	redirect('account');
		// }
		redirect('account');
		$this->load->view('template/footer');
	}

	public function insertdb_switch_package($customerid, $packageid, $guarantyitem, $accountline)
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		$package_type_id = $packageid;
		$agentid = $this->input->post('agentid');
		$agentcharge_array = $this->load->account_model->get_agent_charge($agentid);
		foreach ($agentcharge_array as $key => $value_charge) {
			$agent_charge = $value_charge['charge'];
		}
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////

		///////////////////////////////////package_30_4week//////////////////////////////////////
		
		if (substr( $package_type_id, 0, 16) === "package_30_4week") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				$week1 = $value['week1'];
				$week2 = $value['week2'];
				$week3 = $value['week3'];
				$week4 = $value['week4'];
			}

				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$date2 = strtotime("+2 week", strtotime($dateoriginal));
				$date2 = date('Y-m-d', $date2);

				$date3 = strtotime("+3 week", strtotime($dateoriginal));
				$date3 = date('Y-m-d', $date3);

				$date4 = strtotime("+4 week", strtotime($dateoriginal));
				$date4 = date('Y-m-d', $date4);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week1,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
				

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week2,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date1,
				'duedate' => $date2,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week3,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date2,
				'duedate' => $date3,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);

				

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $week4,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $date3,
				'duedate' => $date4,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
		}
		
		///////////////////////////////////package_30_4week//////////////////////////////////////

		///////////////////////////////////package_25_month//////////////////////////////////////
		
		if (substr( $package_type_id, 0, 16) === "package_25_month") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
			}

				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}
				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 month", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}

				
				if (substr( $package_type_id, 0, 15) === "package_20_week") 
		{	
			$packagename = substr( $package_type_id, 0, 15);
			$packageid = substr( $package_type_id, 15, 16 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}


		if (substr( $package_type_id, 0, 15) === "package_15_week") 
		{	
			$packagename = substr( $package_type_id, 0, 15);
			$packageid = substr( $package_type_id, 15, 16 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'guarantyitem'=> $guarantyitem,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				'accountline' => $accountline,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}

				if (substr( $package_type_id, 0, 16) === "package_10_5days") 
		{	
			$packagename = substr( $package_type_id, 0, 16);
			$packageid = substr( $package_type_id, 16, 17 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}


		if (substr( $package_type_id, 0, 15) === "package_10_5days") 
		{	
			$packagename = substr( $package_type_id, 0, 15);
			$packageid = substr( $package_type_id, 15, 16 );
			//find id using name, 用于account 显示分类
			$res = $this->load->account_model->get_package_type_id($packagename);
			foreach ($res as $key => $value) {
				$packagetypeid = $value['packagetypeid'];
			}
			$res_info = $this->load->account_model->get_package_info($packagename, $packageid);
			foreach ($res_info as $key => $value) {
				$oriamount = $value['totalamount'];
				// $interest = $value['interest'];
				
			}
			
				$max_refid = $this->load->account_model->get_max_refid();
				foreach ($max_refid as $key => $value) {
					$refid = $value['refid']+1; //auto increment
				}

				$dateoriginal =  date('Y-m-d');
				$date1 = strtotime("+1 week", strtotime($dateoriginal));
				$date1 = date('Y-m-d', $date1);

				$data = array(
				'customerid' => $customerid,
				'packageid' => $packageid,
				'packagetypeid' => $packagetypeid,
				'oriamount' => $oriamount,
				'interest' => 0,
				'guarantyitem'=> $guarantyitem,
				'amount' => $oriamount,
				'refid' => $refid,
				// 'payment' => 0,
				'datee' => $dateoriginal,
				'duedate' => $date1,
				'agentcharge' => 0,
				///////////////Combo of User Identity Insert///////////////////
				'companyid' => $company_identity,
				///////////////Combo of User Identity Insert///////////////////
				'agentid' => $this->input->post('agentid')
				);
			
				$return = $this->account_model->insert($data);
				
		}
		///////////////////////////////////package_25_month//////////////////////////////////////


		// $data['return'] = $return;

		// if($return == true){
		// 	// session to sow success or not, only available next page load
		// 	$this->session->set_flashdata('return',$data);
		// 	// redirect('account');
		// }
		$this->load->view('template/footer');
	}
	public function set_baddebt()

    {	if($this->input->post('baddebtset') != ''){
		$accountid = $this->input->post('accountid');
        $status="baddebt";
        $this->db->where('accountid', $accountid);
        $this->db->update('account', array('status' => $status)); 
        echo "update success";
		$this->load->view('template/footer');
	}else{
		            echo $this->upload->display_errors();
		           
		    } 
    }

	public function baddebt_insert_db($accountid)
    {
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $this->db->select('*');
        $this->db->from('baddebt');
        $query = $this->db->get();
        // $my_array=array();

        $result = $query->result_array();
        $check_exist = "";
        foreach ($result as $key => $val) {
        $accountid_baddebt= $val['accountid'];
            if ($accountid_baddebt == $accountid) {
                $check_exist = "exist";
            }
        }

        if ($check_exist !== "exist") {
            $duedate = $this->load->account_model->get_duedate($accountid);
            $date = strtotime(date("Y-m-d", strtotime($duedate)) . " +60 days");
            $date = date ( 'Y-m-d' , $date );
            $data = array(
                'accountid' => $accountid,
                'datee' => $date
                );
            $return = $this->account_model->insert_baddebt($data);
        }
    }
}

	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
