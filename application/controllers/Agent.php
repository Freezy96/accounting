<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {

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
        $this->load->model('agent_model');
        $this->load->model('account_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->account_model->count_agent_salary();
		
		$count = 0;
		//prevent empty display error
		$data['salary_completed'] = array();
		//只拿 first_account_interest 的
		$check_complete_paid_account = $this->load->agent_model->check_complete_paid_account();
			foreach ($check_complete_paid_account as $key => $val) 
			{
	            //check sum of totalamount is 0 or not
	            $totalamount_check = $val['SUM(a.totalamount)'];
	            $agentid_complete = $val['MIN(ag.agentid)'];
	            // echo "<script>console.log(".$totalamount_check.");</script>";
	            echo "<script>console.log(".$agentid_complete.");</script>";
	            if($totalamount_check<=0)
	            {
	                //completed accountline
	                $get_accountline_account_info = $val['accountline'];
	                //get accountid by accountline
	                $result_smallest_accountid_by_accountline = $this->load->agent_model->get_smallest_accid($get_accountline_account_info);
	                //get account info by accountid
	                $result_get_account_info = $this->load->agent_model->get_account_info($result_smallest_accountid_by_accountline);
	                
	                foreach ($result_get_account_info as $key => $value_info) {
	                    $agentid_completed = $value_info['agentid'];
	                    
	                    if ($agentid_completed != 0) 
	                    {	
	                    	$accountid = $value_info['accountid'];
	                        $packagename = $value_info['packagetypename'];
	                        $packageid = $value_info['packageid'];
	                        $charge = $value_info['agentcharge'];
	                        $customername = $value_info['customername'];
	                        $wechatname = $value_info['wechatname'];
	                        $refid = $value_info['refid'];
	                        //package info
	                        $packageinfo = $this->load->account_model->get_package_info($packagename, $packageid);
	                        //calculation agent salary

	                        foreach ($packageinfo as $key => $val_package) 
	                        {
	                        	$salary = 0;
                                $lentamount = $val_package['lentamount'];
                                $totalamount = $val_package['totalamount'];
                                $base = $totalamount - $lentamount;
                                $salary += $base * $charge / 100;
                               	$data['salary_completed'][$count] = array(
                               		'customername' => $customername,
                               		'wechatname' => $wechatname,
                               		'refid' => $refid,
                               		'lentamount' => $lentamount,
                               		'totalamount' => $totalamount,
                               		'accountid' => $accountid,
                               		'agentid_completed' => $agentid_completed,
                               		'agent_charge' => $charge,
                               		'salary' => $salary
                               	);
                               	$count++;
                            } 
	                    }
	                    
	                }
	            }
	        }
	    $data['count_completed'] = $count;
		// print_r($data['count_completed']);//complete pass to view//////////////////////
		$res = $this->load->agent_model->get_agent_payment();
		$data['payment'] = $res;

		$res = $this->load->agent_model->get_agent_payment_not_grouped();
		$data['payment_not_grouped'] = $res;

		$res = $this->load->agent_model->get_agent_customer();
		$data['customer'] = $res;

		$res = $this->load->agent_model->getuserdata();
		$data['result'] = $res;

    	$this->load->view('agent/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('agent/insert');
		$this->load->view('template/footer');
	}

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'agentname' => $this->input->post('name'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'charge' => $this->input->post('charge')
		);

		$return = $this->agent_model->insert($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('agent');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$agentid = $this->input->post('agentidedit');
		$res = $this->load->agent_model->getuserdataupdate($agentid);
		$data['result'] = $res;
		$this->load->view('agent/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$agentid = $this->input->post('agentidedit');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////		
		$data = array(
		'agentname' => $this->input->post('name'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'charge' => $this->input->post('charge')
		);

		$return = $this->agent_model->update($data, $agentid);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('agent');
		}
		$this->load->view('template/footer');
	}

	public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'agentid' => $this->input->post('agentiddelete')
		);

		$return = $this->agent_model->delete($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('agent');
		}
		$this->load->view('template/footer');
	}

	public function payment()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'agentid' => $this->input->post('agentid'),
		'paymentdate' => date("Y-m-d"),
		'refid' => $this->input->post('refid'),
		'payment' => $this->input->post('agentpayment')
		);

		$return = $this->agent_model->insert_payment($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('agent');
		}
		$this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
