<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	private $admin_info;
	private $company_info;

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Admins_model');
		$this->load->model('Doctors_model');

		$login_info = $this->session->userdata( 'login' );

		// Checking for Record
		$adminInfo = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

		if( $adminInfo['a_type'] == 3 ) {
			redirect('/', 'refresh');
		}

		$company_total_doctors = $this->Admins_model->countCompanyStats( $login_info['a_company'], array(3) );
		$company_total_ioc = $this->Admins_model->countCompanyStats( $login_info['a_company'], array(1,2) );

		$this->admin_info = $adminInfo;

		$this->company_info = array(
			'company_name' 		  	=> $adminInfo['c_desc'],
			'company_total_doctors' => $company_total_doctors,
			'company_total_ioc' 	=> $company_total_ioc
			);
	}

	public function index()
	{
		redirect('/manage/doctor/', 'refresh');
	}

	public function doctor()
	{
		$this->load->model('Events_model');

		$current_event = $this->Events_model->get_current_events( $this->admin_info['a_company'] );

		$latest_event = false;
		$upcoming_events = false;
		if( empty($current_event) ) {
			$latest_event = $this->Events_model->get_latest_events( $this->admin_info['a_company'] );
			$upcoming_events = $this->Events_model->get_upcoming_events( $this->admin_info['a_company'] );
		}

		$doctors_registrations = array();
		if( !empty($current_event) || !empty($latest_event) ) {
			$e_id = ( !empty($current_event) ) ? $current_event['e_id'] : $latest_event['e_id'] ;
			$doctors_registrations = $this->Doctors_model->get_company_doctors( $this->admin_info['a_company'], $e_id );
		}

		$data = array(
			'title' => 'Company Manage',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'doctors_registrations' => $doctors_registrations,
			'current_event' => $current_event,
			'latest_event' => $latest_event,
			'upcoming_events' => $upcoming_events
			);

		$this->load_main_tpl( 'manage/index', $data );
	}

	public function profile( $success = NULL )
	{

		$success = false;

		$compay_officers = $this->Admins_model->get_company_officers( $this->admin_info['a_company'] );

		$data = array(
			'title' => 'Company Manage',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'success' => $success
			);

		$this->load_main_tpl( 'manage/profile', $data );
	}

	public function officer( $success = NULL )
	{

		$compay_officers = $this->Admins_model->get_company_officers( $this->admin_info['a_company'] );

		$data = array(
			'title' => 'Company Manage',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'compay_officers' => $compay_officers,
			'success' => $success
			);

		$this->load_main_tpl( 'manage/officers', $data );
	}

	public function registration( $success = NULL )
	{
		$this->load->model('Events_model');

		$eventMessage = $this->session->flashdata('eventMessage');

		$company_id = $this->admin_info['a_company'];

		$doctors_registrations = $this->Doctors_model->get_company_doctors( $company_id );
		$company_events = $this->Events_model->get_company_events( $company_id );

		$data = array(
			'title' => 'Registration Period Manager',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'doctors_registrations' => $doctors_registrations,
			'company_events' => $company_events,
			'eventMessage' => $eventMessage
			);

		$this->load_main_tpl( 'manage/registration', $data );
	}

	public function doctors()
	{
		$company_id = $this->admin_info['a_company'];
		$company_admin_id = $this->admin_info['a_id'];

		$company_doctors = $this->Admins_model->get_company_doctors( $this->admin_info['a_company'] );

		$data = array(
			'title' => 'Company Manage',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'company_doctors' => $company_doctors
			);

		$this->load_main_tpl( 'manage/doctors', $data );
	}

	public function expire()
	{
		$data = array(
			'title' => 'Company Manage',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info
			);

		$this->load_main_tpl( 'manage/expire', $data );
	}

	public function invite_doctor() {
		$this->load->model('Doctors_model');
		$this->load->model('Events_model');

		$emailLink = base64_encode( $this->input->post('doctorEmail') . '|' . $this->admin_info['a_company'] );

		$current_event = $this->Events_model->get_current_events( $this->admin_info['a_company'] );

		$drdata = array(
			'dr_email' => $this->input->post('doctorEmail'),
			'dr_status' => 'pending',
			'dr_company' => $this->admin_info['a_company'],
			'dr_company_admin' => $this->admin_info['a_id'],
			'dr_link' => $emailLink,
			'dr_eid' => $current_event['e_id'],
			);

		$this->Doctors_model->add_doctors_registrations( $drdata );

		// Contact subject
		$subject = "Invitaion - Welcome to Woqee.com"; 

		// Details
  		$message = 'You been invited by <company name> to activate your account
		<a href="' . $this->config->base_url() . "/doctor/register/" . $emailLink . ">Click Here</a>";

		// Mail of sender
		$mail_from = 'no-reply@woqee.com'; 

		// From 
		$header = "from: Woqee <$mail_from>";

		// Enter your email address
		$to = $this->input->post('doctorEmail');
		@mail( $to, $subject, $message, $header );

		$result = array("success" => true);
		print json_encode($result);
	}

	public function testemail( $auth = false ) {

		$this->load->library('email');

		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => '',
		  'smtp_pass' => '',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));

		$this->email->from('no-reply@fluffyitpurrs.com', 'Fluffy It Purrs');
		$this->email->to('fluffyitpurrs@yahoo.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		$this->email->send();

		echo $this->email->print_debugger();

	}

	public function xtestemail( $auth = false ) {
		if( $auth != 'sample' ) {
			redirect('/', 'refresh');
		}

		$this->load->library('email');

	    $subject = 'This is a test';
        $message = '<p>This message has been sent for tesing purposes.</p>';

        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				    <title>'.htmlspecialchars($subject, ENT_QUOTES, $this->email->charset).'</title>
				    <style type="text/css">
				        body {
			            font-family: Arial, Verdana, Helvetica, sans-serif;
			            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
					'.$message.'
				</body>
			</html>';

        $result = $this->email
            ->from( 'sample@sample.com' ) 
            // ->reply_to( 'yoursecondemail@somedomain.com')  
            ->to( 'sample@sample.com' ) 
            ->subject( $subject ) 
            ->message( $body ) 
            ->send(); 

        var_dump( $result );
        var_dump( $this->email->print_debugger() );
        exit;

	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */