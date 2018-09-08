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
        $this->load->model('blacklist_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->blacklist_model->getuserdata();
		$data['result'] = $res;
		
    	$this->load->view('blacklist/main', $data);
		$this->load->view('template/footer');

	}

	public function insert()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('blacklist/insert');
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
		$redirect = $this->input->post('redirect_destination');
		$statuscus=$this->blacklist_model->checkuserstatus();
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

		$return_id = $this->blacklist_model->insert($data);

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

		

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			if($redirect!="")
			{
				redirect($redirect);
			}
			else
			{
				redirect('blacklist');
			}
			
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$blacklistid = $this->input->post('blacklistidedit');
		$res = $this->load->blacklist_model->getuserdataupdate($blacklistid);
		$data['result'] = $res;
		$this->load->view('blacklist/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		///////////////Combo of User Identity Insert///////////////////
		$company_identity = $this->session->userdata('adminid');
		///////////////Combo of User Identity Insert///////////////////
			$redirect = $this->input->post('redirect_destination');
		$data = array(
		'blacklistid' => $this->input->post('balcklistid'),
		'customerid' => $this->input->post('customerid'),
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

		$return = $this->blacklist_model->update($data);
		$data['return'] = $return;

		$customerid_photouse = $this->input->post('blacklistidedit');
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
			    $return = $this->blacklist_model->update_photo_pathname($customerid_photouse,$fpath);
			    $data['return'] = $return;
		    }
		    else{
		            echo $this->upload->display_errors();
		            // $data['return'] = "Failed";
		    	// redirect('customer');
		    } 

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('blacklist');
		}
		$this->load->view('template/footer');
	}

	public function delete()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'blacklistid' => $this->input->post('blacklistiddelete')
		);

		$return = $this->customer_model->delete($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('blacklist');
		}
		$this->load->view('template/footer');
	}
}