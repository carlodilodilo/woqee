<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Association extends MY_Controller {

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('Doctors_model');
		$this->load->model('Associations_model');
		$this->load->model('Admins_model');

		$this->load->library('form_validation');

		$login_info = $this->session->userdata( 'login' );

		// Checking for Record
		$this->doctorInfo = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

	}

	public function view( $assc_id = NULL ) {
		if ( empty($assc_id) ) {
			redirect('/', 'refresh');
		}

		$asscdata = array(
				'assc_id' => $assc_id
			);
		$assoc_info = $this->Associations_model->get_association_info( $asscdata );

		$association_admins = $this->Associations_model->get_associations_admins( $assoc_info['assc_id'] );

		$doctor_specializations = array();
		$doctor_detail = array();
		if ( !empty($association_admins) ) {
			foreach ( $association_admins as $association_admin ) {
				$dsdata = array( 'ds_did' => $association_admin['d_id'] );
				$doctor_specializations[$association_admin['d_id']] = $this->Doctors_model->search_doctor_specialization( $dsdata );
			}

			// $dddata = array( 'dd_did' => $association_admin['d_id'] );
			// $doctor_detail = $this->Doctors_model->search_doctor_detail( $dddata );
		}

		$association_members = $this->Associations_model->get_associations_members( $assoc_info['assc_id'] );

		if ( !empty($association_members) ) {
			foreach ( $association_members as $association_member ) {
				$dsdata = array( 'ds_did' => $association_member['d_id'] );
				$doctor_specializations[$association_member['d_id']] = $this->Doctors_model->search_doctor_specialization( $dsdata );
			}

			// $dddata = array( 'dd_did' => $association_admin['d_id'] );
			// $doctor_detail = $this->Doctors_model->search_doctor_detail( $dddata );
		}

		$data = array(
				'assoc_info' => $assoc_info, 
				'association_admins' => $association_admins, 
				'doctor_specializations' => $doctor_specializations, 
				'association_members' => $association_members 
			);

		$this->load_main_tpl( 'association/view', $data );
	}

	public function add() {
		$assoc_name = $this->input->post('assoc_name');
		$assoc_tagline = $this->input->post('assoc_tagline');

		$asscdata = array(
				'assc_name' => $assoc_name,
				'assc_tagline' => $assoc_tagline
			);
		$assc_id = $this->Associations_model->add_association( $asscdata );

		$this->Associations_model->add_association_admin( $assc_id, $this->doctorInfo['a_id'] );

		$ddata = array( 'd_aid' => $this->doctorInfo['a_id'] );
		$doctor_info = $this->Doctors_model->search_doctor_info( $ddata );

		$this->Associations_model->add_association_doctor( $assc_id, $doctor_info['d_id'] );

		$result = array("success" => true);
		print json_encode($result);
		exit;
	}

}

/* End of file doctor.php */
/* Location: ./application/controllers/doctor.php */