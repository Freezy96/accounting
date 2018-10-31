<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {

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


		///////////////////////////////////////////


    	$this->load->view('backup/main');
		$this->load->view('template/footer');
	}

	public function backup_db()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		$this->load->dbutil();
		
		$prefs = array(     
		    'format'      => 'zip',             
		    'filename'    => 'my_db_backup.sql'
		    );


		$backup =& $this->dbutil->backup($prefs); 

		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'Backup_DB/'.$db_name;
		// autobackup
		$this->load->helper('file');
		write_file($save, $backup); 

		//download
		// $this->load->helper('download');
		// force_download($db_name, $backup);
		$this->load->view('backup/backup_complete');
		$this->load->view('template/footer');
	}

	public function restore_db_main()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');

		$this->load->view('backup/restore_db_main');
		$this->load->view('template/footer');
	}

	public function restore_db()
	{	$this->security_model->secure_session_login();
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('template/nav');
		//Set line to collect lines that wrap
		$templine = '';

		// Read in entire file
		// $lines = $this->input->post('sqlfile');
		$lines = file($_FILES["sqlfile"]["tmp_name"]);
		// $lines = file('Backup_DB/backup-on-2018-10-22/my_db_backup.sql');
		// print_r($lines);
		//Loop through each line
		foreach ($lines as $line)
		{
		// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
		continue;

		// Add this line to the current templine we are creating
		$templine .= $line;

		// If it has a semicolon at the end, it's the end of the query so can process this templine
		if (substr(trim($line), -1, 1) == ';')
		{
		// Perform the query
		$this->db->query($templine);

		// Reset temp variable to empty
		$templine = '';
		}
		}
		$this->load->view('backup/restore_complete');
		$this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

		