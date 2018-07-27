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
    }

	public function index()
	{	
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$res = $this->load->agent_model->getuserdata();
		$data['result'] = $res;
    	$this->load->view('agent/main', $data);
		$this->load->view('template/footer');
	}

	public function insert()
	{	
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
		
		$data = array(
		'agentname' => $this->input->post('name'),
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
		
		$data = array(
		'agentid' => $this->input->post('agentidedit'),
		'agentname' => $this->input->post('name'),
		'charge' => $this->input->post('charge')
		);

		$return = $this->agent_model->update($data);
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
