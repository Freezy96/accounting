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
    }

	public function index()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->customer_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('customer/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('customer/insert');
		$this->load->view('template/footer');
	}

	public function insertdb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'customername' => $this->input->post('name'),
		'address' => $this->input->post('address'),
		'phoneno' => $this->input->post('phoneno'),
		'gender' => $this->input->post('gender')
		);

		$return = $this->customer_model->insert($data);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('customer');
		}
		$this->load->view('template/footer');
	}

	public function update()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$data = array(
		'customerid' => $this->input->post('customerid')
		);
		$res = $this->load->customer_model->getuserdataupdate($data);
		$data['result'] = $res;
		$this->load->view('customer/update', $data);
		$this->load->view('template/footer');
	}

	public function updatedb()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		
		$data = array(
		'customerid' => $this->input->post('customerid'),
		'customername' => $this->input->post('name'),
		'address' => $this->input->post('address'),
		'phoneno' => $this->input->post('phoneno'),
		'gender' => $this->input->post('gender')
		);

		$return = $this->customer_model->update($data);
		$data['return'] = $return;

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
		'customerid' => $this->input->post('customerid')
		);

		$return = $this->customer_model->delete($data, $customerid);
		$data['return'] = $return;

		if($return == true){
			// session to sow success or not, only available next page load
			$this->session->set_flashdata('return',$data);
			redirect('customer');
		}
		$this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
