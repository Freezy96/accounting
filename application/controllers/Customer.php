<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

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
        $this->load->model('customer_model');
        $this->load->model('account_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		// 再滚利息
		$this->load->account_model->interest_30_4week();
		// 再算totalamount
		$this->load->account_model->count_total_amount();
		// 再set status
		$this->load->account_model->account_status_set();

		$this->load->customer_model->reset_duedate();
		$this->load->customer_model->checkuserstatus();
		$this->load->customer_model->blackliststatus();

		$res = $this->load->customer_model->getuserdata();
		$data['result'] = $res;

    	$this->load->view('customer/main', $data);
		$this->load->view('template/footer');

	}

	public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('customer/insert');
		$this->load->view('template/footer');
	}

	public function customer_exist_check()
	{
		$name = $this->input->post('name');
		$passport = $this->input->post('passport');
		$data = $this->customer_model->check_availability($name,$passport);
		echo $data;
	}

	// public function customer_exist_check_normal()
	// {
	// 	$name = $this->input->post('name');
	// 	$passport = $this->input->post('passport');
	// 	$data = $this->customer_model->check_availability_normal($name,$passport);
	// 	echo $data;
	// }

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////
		$redirect = $this->input->post('redirect_destination');
		$statuscus=$this->customer_model->checkuserstatus();
		$customername=$this->input->post('name');
		$passport_check = $this->input->post('passport');
		$exist_check = $this->customer_model->check_availability($customername,$passport_check);
		// echo $blacklist_check;
		// if ($exist_check == "yes") {
		// 	$this->session->set_flashdata('return',"update");
		// 	redirect("customer");
		// }
		

			$data = array(
			'customername' => $this->input->post('name'),
			'wechatname' => $this->input->post('wechatname'),
			'address' => $this->input->post('address'),
			'phoneno' => $this->input->post('phoneno'),
			'passport' => $this->input->post('passport'),
			///////////////Combo of User Identity Insert///////////////////
			'companyid' => $company_identity,
			///////////////Combo of User Identity Insert///////////////////
			'gender' => $this->input->post('gender')
			);

			$return_id = $this->customer_model->insert($data);
			$return = $return_id;
			$data['return'] = "insert";

				$config['upload_path']= realpath(APPPATH . '../Image/Customer_Image');
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['file_name'] = $return_id;
				$config['max_size'] = "2048000"; 
				$config['max_height'] = "9999";
				$config['max_width'] = "9999";
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('profilePic')){
						$image_data = $this->upload->data();
					    $fname=$image_data[file_name];
					    $temp = explode(".", $fname);
						$newfilename = $return_id . '.' . end($temp);

					    $fpath=site_url().'Image/Customer_Image/'.$newfilename;
					    $return = $this->customer_model->update_photo_pathname($return_id,$fpath);
					    $data['return'] = $return;
				    }
				    else{
				            echo $this->upload->display_errors();
				            // $data['return'] = "Failed";
				    		// redirect('customer');
				    } 
				    
			
		
			
			
		$this->session->set_flashdata('return',$data);
				if($redirect!="")
				{
					echo "<script>window.location.href='".base_url().$redirect."';</script>";
				}
				else
				{
					echo "<script>window.location.href='".base_url()."customer';</script>";
				}
		$this->load->view('template/footer');
	}

public function insertbl(){	
		$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('customer/insert');
		$this->load->view('template/footer');
	}	

public function insertbldb(){	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////
		$redirect = $this->input->post('redirect_destination');
		$statuscus=$this->customer_model->checkuserstatus();
		$customername=$this->input->post('name');
		$passport_check = $this->input->post('passport');
		$exist_check = $this->customer_model->check_availability($customername,$passport_check);
		$status="baddebt";
		$blacklist="1";
		$reset="1";
		$date = date("Y-m-d");

		// echo $blacklist_check;
		// if ($exist_check == "yes") {
		// 	$this->session->set_flashdata('return',"update");
		// 	redirect("customer");
		// }
		

			$data = array(
			'customername' => $this->input->post('name'),
			'wechatname' => $this->input->post('wechatname'),
			'address' => $this->input->post('address'),
			'phoneno' => $this->input->post('phoneno'),
			'passport' => $this->input->post('passport'),
			///////////////Combo of User Identity Insert///////////////////
			'companyid' => $company_identity,
			///////////////Combo of User Identity Insert///////////////////
			'gender' => $this->input->post('gender'),
			'status' => $status,
			'blacklist' => $blacklist,
			'reset'=>$reset,
			're-date' => $date

			);

			$return_id = $this->customer_model->insert($data);
			$return = $return_id;
			$data['return'] = "insert";

				$config['upload_path']= realpath(APPPATH . '../Image/Customer_Image');
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['file_name'] = $return_id;
				$config['max_size'] = "2048000"; 
				$config['max_height'] = "9999";
				$config['max_width'] = "9999";
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('profilePic')){
						$image_data = $this->upload->data();
					    $fname=$image_data[file_name];
					    $temp = explode(".", $fname);
						$newfilename = $return_id . '.' . end($temp);

					    $fpath=site_url().'Image/Customer_Image/'.$newfilename;
					    $return = $this->customer_model->update_photo_pathname($return_id,$fpath);
					    $data['return'] = $return;
				    }
				    else{
				            echo $this->upload->display_errors();
				            // $data['return'] = "Failed";
				    		// redirect('customer');
				    } 
				    
			
		
			
			
		$this->session->set_flashdata('return',$data);
				if($redirect!="")
				{
					echo "<script>window.location.href='".base_url().$redirect."';</script>";
				}
				else
				{
					echo "<script>window.location.href='".base_url()."customer';</script>";
				}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$customerid = $this->input->post('customeridedit');
		$res = $this->load->customer_model->getuserdataupdate($customerid);
		$data['result'] = $res;
		$this->load->view('customer/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$customerid = $this->input->post('customeridedit');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////
		$redirect = $this->input->post('redirect_destination');
		$data = array(
		// 'customerid' => $customerid,
		'customername' => $this->input->post('name'),
		'wechatname' => $this->input->post('wechatname'),
		'address' => $this->input->post('address'),
		'phoneno' => $this->input->post('phoneno'),
		///////////////Combo of User Identity Insert///////////////////
		'companyid' => $company_identity,
		///////////////Combo of User Identity Insert///////////////////
		'gender' => $this->input->post('gender'),
		'passport' => $this->input->post('passport')
		);

		$return = $this->load->customer_model->update($data, $customerid);
		$data['return'] = $return;

		$customerid_photouse = $this->input->post('customeridedit');

		if (file_exists($_FILES['profilePic']['tmp_name']) || is_uploaded_file($_FILES['profilePic']['tmp_name'])) {
			$config['upload_path']= realpath(APPPATH . '../Image/Customer_Image');
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $customerid_photouse;
			$config['max_size'] = "2048000"; 
			$config['max_height'] = "9999";
			$config['max_width'] = "9999";
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('profilePic')){
						$image_data = $this->upload->data();
					    $fname=$image_data[file_name];
					    $temp = explode(".", $fname);
						$newfilename = $customerid_photouse . '.' . end($temp);

					    $fpath=site_url().'Image/Customer_Image/'.$newfilename;
					    $return = $this->customer_model->update_photo_pathname($customerid_photouse,$fpath);
				    $data['return'] = $return;
			    }
			    else{
			            echo $this->upload->display_errors();
			            // $data['return'] = "Failed";
			    	// redirect('customer');
			    }

		}

		    

 

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('customer');
		}
		$this->load->view('template/footer');
	}

	public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'customerid' => $this->input->post('customeriddelete')
		);

		$return = $this->customer_model->delete($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('customer');
		}
		$this->load->view('template/footer');
	}
public function resets()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('template/nav');
		$data = array(
		'customerid' => $this->input->post('customerresetstatus')
		);
		$return = $this->customer_model->reset_status($data);
			redirect('customer');
			$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('customer');
		}
$this->load->view('template/footer');
	}

	 public function blacklist()
    {
       $this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		// 再滚利息
		$this->load->account_model->interest_30_4week();
		// 再算totalamount
		$this->load->account_model->count_total_amount();
		// 再set status
		$this->load->account_model->account_status_set();

		$this->load->customer_model->reset_duedate();
		$this->load->customer_model->checkuserstatus();
		$this->load->customer_model->blackliststatus();
		$res = $this->load->customer_model-> getblacklistdata();
		$data['result'] = $res;
        $this->load->view('customer/blacklist', $data);
        $this->load->view('template/footer');

    }


	public function blacklist_insert_db($customerid)
    {
        $this->load->helper('url');
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $this->db->select('*');
        $this->db->from('blacklist');
        $query = $this->db->get();
        // $my_array=array();

        $res1= $this->load->customer_model->getstatus();
 foreach ($data as $key => $value) {
           $customerid= $value['customerid'];
           $status = $value['status'];


          if($status=="baddebt"){ 
                $data = array(
            'customerid' => $customerid
            );
           }
           
        $this->db->where('customerid', $customerid);
        $this->db->insert('blacklist', $data);
           

    }
            $return = $this->customer_model->insert_blacklist($data);
   }
public function blacklistbutton($customerid){
	$customerid=$customerid;
	$this->load->insertblacklist($customerid);
	$this->load->toblacklist($customerid);
}
  public function insertblacklist($customerid){
  	 $data = array(
            'customerid' => $customerid
           );

	$this->db->where('customerid', $customerid);
         $this->db->insert('blacklist', $data);
 $return = $this->customer_model->insert_blacklist($data);

  }
  
	public function toblacklist($customerid)
	{	
		$blacklist=1;
		$data = array(
		'blacklist' => $blacklist,
		);

		$return = $this->customer_model->update($data);
	} 
       public function customer_payment_modal() 
	{	
		$customerid = $this->input->post('customerid');
		$data = $this->customer_model->get_customer_payment_modal($customerid);
		//用accountid 拿refid,再用refid那所有的accountid，在拿所有的payment出来，吧同样的payment merge起来，组成几个东西，push进array
		// $get_refid = $this->account_model->getrefid($accountid);
		// foreach ($get_refid as $key => $value) {
		// 	$refid = $value['refid'];
		// }
		// $get_all_acc_id = $this->account_model->get_accountid_using_refid($refid);
		// $count_array = -1;
		// foreach ($get_all_acc_id as $key => $value) {
		// 	$count_array++;
		// 	$all_account_id = $value['accountid'];
		// 	$get_payment = $this->account_model->get_payment_amount($all_account_id);
		// 	$payment = 0;
		// 	$interest_paid = 0;
		// 	foreach ($get_payment as $key => $value) {
		// 		if($value['paymenttype']=="amount")
		// 		{
		// 			$payment+=$value['payment'];
		// 		}
		// 		// elseif($value['paymenttype']=="interest")
		// 		// {
		// 		// 	$interest_paid+=$value['payment'];
		// 		// }
		// 		if($value['paymenttype']=="discount")
		// 		{
		// 			$payment+=$value['payment'];
		// 		}
		// 		if($value['paymenttype']=="newpackage")
		// 		{
		// 			$payment+=$value['payment'];
		// 		}
		// 		// ${'data'. $all_account_id} = array();
		// 		$data[$count_array]["payment"] = $payment;
		// 		// $data[$count_array]["interest_paid"] = $interest_paid;
 		// 	}
		// }
		
	     
	    echo json_encode($data);
 		//Either you can print value or you can send value to database
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
