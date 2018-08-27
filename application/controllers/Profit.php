<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profit extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('profit_model');
        $this->load->model('security_model');
    }

	public function index()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$day = $this->input->post('day');
		if ($this->input->post('month')<10) {
			$month = "0".$this->input->post('month');
		}else{
			$month = $this->input->post('month');
		}
		
		$year = $this->input->post('year');
		
		$date_day = $year."-".$month."-".$day;
		$date_month = $year."-".$month;
		$date_year = $year;

		$res = $this->load->profit_model->get_this_day_payment($date_day);
	    $data['day'] = $res;
	    $res = $this->load->profit_model->get_this_month_payment($date_month);
	    $data['month'] = $res;
	    $res = $this->load->profit_model->get_this_year_payment($date_year);
	    $data['year'] = $res;

	    $res = $this->load->profit_model->get_this_day_payment_discount($date_day);
	    $data['day_discount'] = $res;
	    $res = $this->load->profit_model->get_this_month_payment_discount($date_month);
	    $data['month_discount'] = $res;
	    $res = $this->load->profit_model->get_this_year_payment_discount($date_year);
	    $data['year_discount'] = $res;

	    $res = $this->load->profit_model->get_this_day_loss_lent($date_day);
	    $data['day_lent_loss'] = $res;
	    $res = $this->load->profit_model->get_this_month_loss_lent($date_month);
	    $data['month_lent_loss'] = $res;
	    $res = $this->load->profit_model->get_this_year_loss_lent($date_year);
	    $data['year_lent_loss'] = $res;

		$res = $this->load->profit_model->get_day_agent_payment($date_day);
	    $data['agent_payment_day'] = $res;
	    $res = $this->load->profit_model->get_month_agent_payment($date_month);
	    $data['agent_payment_month'] = $res;
	    $res = $this->load->profit_model->get_year_agent_payment($date_year);
	    $data['agent_payment_year'] = $res;
    	$this->load->view('profit/main', $data);
		$this->load->view('template/footer');
	}


}
?>