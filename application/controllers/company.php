<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MY_Controller {

	private $admin_info;

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('Companies_model');
		$this->load->model('Admins_model');

		$this->load->library('form_validation');

		$login_info = $this->session->userdata( 'login' );

		// Checking for Record
		$this->admin_info = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

	}

	public function index()
	{
		redirect('/', 'refresh');
	}

	public function invite( $encoded = NULL )
	{

		if( empty($encoded) ) {
			redirect('/', 'refresh');
		}

		$cpdata = array(
			'cp_link' => $encoded
		);
		$officerInfo = $this->Companies_model->search_pending_officer( $cpdata );

		if( empty($officerInfo) ) {
			redirect('/', 'refresh');
		}

		$encoded = base64_decode( $encoded );
		$encoded = explode( "|", $encoded );

		$cp_email = $encoded[0];
		$cp_company = $encoded[1];

		$exist = false;
		if( $officerInfo['cp_status'] != 'active' ) {
			if( $officerInfo['cp_email'] == $cp_email && $officerInfo['cp_cid'] == $cp_company ) {
				if( $officerInfo['cp_status'] != 'active' ) {
					$cpdata = array(
						'cp_status' => 'active'
						);
					$this->Companies_model->update_pending_officer( $officerInfo['cp_id'], $cpdata );
				}
			}
		} else {

			$adata = array( 'a_email' => $officerInfo['cp_email'] );
			$a_info = $this->Admins_model->search_admin( $adata );

			if( !empty($a_info['a_id']) ) {
				$exist = true;
			}

		}

		$cdata = array(
			'c_id' => $officerInfo['cp_cid']
		);
		$companyInfo = $this->Companies_model->search_company_info( $cdata );

		$data = array(
			'title' => 'Officer Register Completion',
			'officerInfo' => $officerInfo,
			'companyInfo' => $companyInfo,
			'email' => $officerInfo['cp_email'],
			'exist' => $exist
			);

		$this->load_main_tpl( 'company/register', $data );

	}

	public function add_officer() {

		$officerEmail = $this->input->post('officerEmail');

		$error = false;

		$cpdata = array(
			'cp_email' => $officerEmail
		);
		$officerInfo = $this->Companies_model->search_pending_officer( $cpdata );

		if( !empty($officerInfo) ) {
			if( $officerInfo['cp_status'] == 'pending' ) {
				$error = $officerEmail . ' already recieved invite';
			}

			if( $officerInfo['cp_status'] == 'active' ) {
				$error = $officerEmail . ' already active since ' . date( 'F j, Y', strtotime($officerInfo['cp_updated']) );
			}
		}

		if( $error ) {
			$result = array(
				"success" => false,
				"message" => $error
			);
			print json_encode($result);
			exit;
		}

		$emailLink = base64_encode( $officerEmail . '|' . $this->admin_info['a_company'] );

		$cpdata = array(
			'cp_email' => $officerEmail,
			'cp_status' => 'pending',
			'cp_cid' => $this->admin_info['a_company'],
			'cp_link' => $emailLink,
			);
		$this->Companies_model->add_pending_officer( $cpdata );

		// Contact subject
		$subject = "Woqee"; 

		// Details
		$message = $this->config->base_url() . '/company/officer/' . $emailLink;

		// Mail of sender
		$mail_from = 'no-reply@woqee.com'; 

		// From 
		$header = "from: Woqee <$mail_from>";

		// Enter your email address
		$to = $officerEmail;
		@mail( $to, $subject, $message, $header );

		$result = array("success" => true);
		print json_encode($result);
	}

	public function remove_officer() {
		$officer_id = $this->input->post('officer_id');
		$this->Admins_model->remove_company_officer( $officer_id );

		$result = array("success" => true);
		print json_encode($result);	
	}

	public function completion() {
		$cp_id = $this->input->post('cp_id');

		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$password = $this->input->post('password');

		$cpdata = array(
			'cp_id' => $cp_id
		);
		$officerInfo = $this->Companies_model->search_pending_officer( $cpdata );

		$adata = array(
				'a_company' => $officerInfo['cp_cid'],
				'a_email' => $officerInfo['cp_email'],
				'a_fname' => $fname,
				'a_mname' => $mname,
				'a_lname' => $lname,
				'a_password' => md5($password),
			);

		$a_id = $this->Admins_model->add_company_officer( $adata );

		$result = array("success" => true);
		print json_encode($result);
		exit;
	}

}

/* End of file doctor.php */
/* Location: ./application/controllers/doctor.php */