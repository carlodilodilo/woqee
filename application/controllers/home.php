<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('Admins_model');

	}

	public function index()	{
		$data = array(
			);

		if( $this->session->userdata('login') ) {
			$this->login( $data );
		} else {
			$this->not_login( $data );
		}
	}

	private function not_login( $data ) {
		$data['message'] = $this->session->flashdata('message');

		$this->load_main_login_tpl( 'account/login', $data );
	}

	private function login( $data ) {

		// Checking for Record
		$login_info = $this->session->userdata('login');
		$doctorInfo = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

		if( $doctorInfo['a_type'] == 1 ) {
			redirect('/manage/doctor', 'refresh');
		}

		$this->load->model('Associations_model');
		$doctors_association = $this->Associations_model->get_doctor_associations( $doctorInfo['a_id'] );

		$association_members = array();
		if( !empty($doctors_association) ) {
			foreach( $doctors_association as $association ) {
				$association_members[$association['assc_id']] = $this->Associations_model->get_associations_members( $association['assc_id'] );
			}
		}

		$data = array(
				'doctors_association' => $doctors_association, 
				'association_members' => $association_members, 
			);

		$this->load_main_tpl( 'home/main', $data );
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */