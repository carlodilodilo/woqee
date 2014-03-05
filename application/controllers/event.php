<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MY_Controller {

	private $admin_info;

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Admins_model');
		$this->load->model('Events_model');

		$login_info = $this->session->userdata( 'login' );

		$adminInfo = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

		$this->admin_info = $adminInfo;
	}

	public function index()
	{
		// redirect('/manage/doctor/', 'refresh');
	}

	public function add()
	{

		$edata = array(
			'e_company' => $this->admin_info['a_company'],
			'e_date'    => date( "Y-m-d H:i:s", strtotime($this->input->post('date_event')) ),
			'e_end'     => date( "Y-m-d H:i:s", strtotime($this->input->post('end_event')) ),
			'e_name'    => $this->input->post('name_event'),
			'e_start'   => date( "Y-m-d H:i:s", strtotime($this->input->post('start_event')) ),
			);

		$this->session->set_flashdata('eventMessage', 'add');

		$this->Events_model->add_company_event( $edata );
		$result = array("success" => true);
		print json_encode($result);

	}

	public function edit()
	{

		$eid = $this->input->post('event_id');

		$edata = array(
			'e_company' => $this->admin_info['a_company'],
			'e_date'    => date( "Y-m-d H:i:s", strtotime($this->input->post('date_event')) ),
			'e_end'     => date( "Y-m-d H:i:s", strtotime($this->input->post('end_event')) ),
			'e_name'    => $this->input->post('name_event'),
			'e_start'   => date( "Y-m-d H:i:s", strtotime($this->input->post('start_event')) ),
			);

		$this->session->set_flashdata('eventMessage', 'edit');

		$this->Events_model->update_company_event( $eid, $edata );
		$result = array("success" => true);
		print json_encode($result);

	}

	public function registration()
	{
		$doctors_registrations = $this->Doctors_model->get_company_doctors( $this->admin_info['a_company'] );

		$data = array(
			'title' => 'Registration Period Manager',
			'admin_info' => $this->admin_info,
			'company_info' => $this->company_info,
			'doctors_registrations' => $doctors_registrations
			);

		$this->load_main_tpl( 'manage/registration', $data );
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

		$emailLink = base64_encode( $this->input->post('doctorEmail') . '|' . $this->admin_info['a_company'] );

		$drdata = array(
			'dr_email' => $this->input->post('doctorEmail'),
			'dr_status' => 'pending',
			'dr_company' => $this->admin_info['a_company'],
			'dr_link' => $emailLink,
			);

		$this->Doctors_model->add_doctors_registrations( $drdata );
		$result = array("success" => true);
		print json_encode($result);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */