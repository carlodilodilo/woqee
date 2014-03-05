<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends MY_Controller {

	private $doctorInfo;
	private $admin_doctor_info;

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('Doctors_model');
		$this->load->model('Admins_model');

		$this->load->library('form_validation');

		$login_info = $this->session->userdata( 'login' );

		// Checking for Record
		$this->doctorInfo = $this->Admins_model->getAdminInfo( $login_info['a_id'] );

		$ddata = array( 'd_aid' => $this->doctorInfo['a_id'] );
		$this->admin_doctor_info = $this->Doctors_model->search_doctor_info( $ddata );

		if( $this->doctorInfo['a_type'] == 1 ) {
			redirect('/manage/doctor', 'refresh');
		}

	}

	public function index()
	{
		redirect('/', 'refresh');
	}

	public function edit()
	{

		$ddata = array( 'd_aid' => $this->doctorInfo['a_id'] );
		$doctor_info = $this->Doctors_model->search_doctor_info( $ddata );

		$this->form_validation->set_rules('fname', 'First', 'required');
		$this->form_validation->set_rules('lname', 'Last', 'required');

		if( $this->input->post('password') ) {
			$this->form_validation->set_rules('password', 'Password', 'matches[repassword]');
		}

		$success = false;
		if ($this->form_validation->run() == true) {

			$bday = $this->input->post('bday');

			if( $this->input->post('password') ) {
				$adata = array(
					'a_password' => md5($this->input->post('password'))
				);
				$this->Admins_model->update_admin_doctor( $this->doctorInfo['a_id'], $adata );
			}

			if( empty($doctor_info) ) {
				$ddata = array(
					'd_aid' => $this->doctorInfo['a_id'],
					'd_bday' => date( 'Y-m-d', strtotime( $bday ) )
				);
				$did = $this->Doctors_model->add_doctor_info( $ddata );

				$dddata = array( 
					'dd_did' => $did,
					'dd_premed' => $this->input->post('premed'),
					'dd_medicine' => $this->input->post('medicine'),
					'dd_residency' => $this->input->post('residency'),
				);
				$doctor_info = $this->Doctors_model->add_doctor_detail( $dddata );

				$success = 'added';
			} else {
				$did = $doctor_info['d_id'];

				$ddata = array(
					'd_bday' => date( 'Y-m-d', strtotime( $bday ) )
				);

				$this->Doctors_model->update_doctor_info( $did, $ddata );

				$dddata = array( 
					'dd_premed' => $this->input->post('premed'),
					'dd_medicine' => $this->input->post('medicine'),
					'dd_residency' => $this->input->post('residency'),
				);
				$this->Doctors_model->update_doctor_detail( $did, $dddata );

				$success = 'updated';
			}

			$post_specialization = $this->input->post('specialization');
			if( !empty($post_specialization) ) {
				$specialization = $post_specialization;
				$this->Doctors_model->add_doctor_specialization( $did, $specialization );
			}

			$ddata = array( 'd_aid' => $this->doctorInfo['a_id'] );
			$doctor_info = $this->Doctors_model->search_doctor_info( $ddata );
		}

		$doctor_specialization = array();
		$doctor_detail = array();
		if ( !empty($doctor_info) ) {
			$dsdata = array( 'ds_did' => $doctor_info['d_id'] );
			$doctor_specialization = $this->Doctors_model->search_doctor_specialization( $dsdata );

			$dddata = array( 'dd_did' => $doctor_info['d_id'] );
			$doctor_detail = $this->Doctors_model->search_doctor_detail( $dddata );
		}

		$this->load->model('Associations_model');
		$doctors_association = $this->Associations_model->get_doctor_associations( $this->doctorInfo['a_id'] );

		$association_members = array();
		if( !empty($doctors_association) ) {
			foreach( $doctors_association as $association ) {
				$association_members[$association['assc_id']] = $this->Associations_model->get_associations_members( $association['assc_id'] );
			}
		}

		$doctor_credentials = array();
		if ( !empty($doctor_info) ) {
			$dcdata = array( 'dc_did' => $doctor_info['d_id'] );
			$doctor_credentials = $this->Doctors_model->get_all_doctor_credentails( $dcdata );
		}

		$doctor_clinics = array();
		if ( !empty($doctor_info) ) {
			$dodata = array( 'do_did' => $doctor_info['d_id'] );
			$doctor_clinics = $this->Doctors_model->get_all_doctor_clinics( $dodata );
		}

		$data = array(
			'title' => 'Doctor Edit',
			'doctorInfo' => $this->doctorInfo,
			'doctor_info' => $doctor_info,
			'doctor_specialization' => $doctor_specialization,
			'doctors_association' => $doctors_association,
			'doctor_credentials' => $doctor_credentials,
			'doctor_clinics' => $doctor_clinics,
			'doctor_detail' => $doctor_detail,
			'association_members' => $association_members,
			'success' => $success
			);

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message') ;

		$this->load_main_tpl( 'doctor/edit', $data );
	}

	public function view( $did = NULL )
	{
		if( empty($did) ) {
			$did = 1;
		}

		$data = array(
			'title' => ''
			);

		$this->load_main_tpl( 'doctor/view', $data );
	}

	public function register( $encoded = NULL )
	{

		if( empty($encoded) ) {
			redirect('/', 'refresh');
		}

		$doctor_registration = $this->Doctors_model->search_doctors_registrations( $encoded );

		if( empty($doctor_registration) ) {
			redirect('/', 'refresh');
		}

		$encoded = base64_decode( $encoded );
		$encoded = explode( "|", $encoded );

		$dr_email = $encoded[0];
		$dr_company = $encoded[1];

		$exist = false;
		if($doctor_registration['dr_status'] != 'active') {
			if( $doctor_registration['dr_email'] == $dr_email && $doctor_registration['dr_company'] == $dr_company ) {
				if( $doctor_registration['dr_status'] != 'active' ) {
					$dr_data = array(
						'dr_status' => 'active'
						);
					$this->Doctors_model->update_doctors_registrations( $doctor_registration['dr_link'] );
				}
			}
		} else {
			$this->load->model('Admins_model');

			$adata = array( 'a_email' => $doctor_registration['dr_email'] );
			$a_info = $this->Admins_model->search_admin( $adata );

			if( !empty($a_info['a_id']) ) {
				$this->Doctors_model->register_doctor( $doctor_registration['dr_id'], $a_info['a_id'] );
				$exist = true;
			}

		}

		$data = array(
			'title' => 'Doctor Register Completion',
			'doctor_registration' => $doctor_registration,
			'email' => $doctor_registration['dr_email'],
			'exist' => $exist
			);

		$this->load_main_tpl( 'doctor/register', $data );

	}

	public function clinic( $clinic_id = NULL, $del = false ) {
		$edit = ( !empty($clinic_id) ) ? true : false ;

		if( $del ) {
			$did = $this->admin_doctor_info['d_id'];

			$this->Doctors_model->remove_doctor_clinic( $clinic_id );

			$this->Doctors_model->reset_doctor_clinic_days( $clinic_id, $did );

			redirect('/doctor/edit/#clinics', 'refresh');
		}

		$this->form_validation->set_rules('do_address', 'Address', 'required');

		$success = false;
		if ( $this->form_validation->run() == true ) {

			$clinic_data = $this->input->post();

			$did = $this->admin_doctor_info['d_id'];

			if ( $edit ) {
				$this->Doctors_model->edit_doctor_clinic( $dcred_id, $dc_data );
			} else {
				$do_data = array(
					'do_did' => $did,
					'do_address' => $clinic_data['do_address'],
					'do_number' => $clinic_data['do_number'],
				);

				$clinic_id = $this->Doctors_model->add_doctor_clinic( $do_data );
			}

			$this->Doctors_model->reset_doctor_clinic_days( $clinic_id, $did );

			$clinic_days = array( 'mon', 'tue', 'wed', 'thurs', 'fri', 'sat', 'sun' );

			foreach ( $clinic_days as $clinic_day ) { 

				if ( isset($clinic_data[$clinic_day]) ) {

					$clinic_date = $clinic_day;
					$clinic_from = $clinic_data[$clinic_day.'_from'];
					$clinic_to = $clinic_data[$clinic_day.'_to'];

					$dod_data = array(
						'dod_doid' => $clinic_id,
						'dod_day' => $clinic_date,
						'dod_from' => $clinic_from,
						'dod_to' => $clinic_to
					);

					$this->Doctors_model->add_doctor_clinic_days( $dod_data );

				}

			}

			redirect('/doctor/clinic/' . $clinic_id, 'refresh');

		}

		$data = array(
			'edit' => $edit
			);

		$data['clinic_id'] = false;
		if( $edit ) {
			$dodata = array(
				'do_id' => $clinic_id, 
				'do_did' => $this->admin_doctor_info['d_id'] 
				);

			$data['clinic_id'] = $clinic_id;
			$data['clinic_data'] = $this->Doctors_model->get_doctor_clinic( $dodata );

			$doddata = array(
				'dod_doid' => $clinic_id, 
				);
			$clinic_days = $this->Doctors_model->get_doctor_clinic_days( $doddata );

			$data['clinic_data_days'] = array();
			$data['clinic_data_days_time'] = array();

			if ( !empty($clinic_days) ) {
				foreach ( $clinic_days as $clinic_day ) {
					$data['clinic_data_days'][] = $clinic_day['dod_day'];
					$data['clinic_data_days_time'][$clinic_day['dod_day']]['from'] = $clinic_day['dod_from'];
					$data['clinic_data_days_time'][$clinic_day['dod_day']]['to'] = $clinic_day['dod_to'];
				}
			}
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message') ;

		$this->load_main_tpl( 'doctor/clinic', $data );
	}

	public function credential( $dcred_id = NULL, $del = false ) {
		$edit = ( !empty($dcred_id) ) ? true : false ;

		if( $del ) {
			$did = $this->admin_doctor_info['d_id'];

			$this->Doctors_model->remove_doctor_credential( $dcred_id );

			redirect('/doctor/edit/#credentials', 'refresh');
		}

		$this->form_validation->set_rules('dc_title', 'Title / Name', 'required');
		$this->form_validation->set_rules('dc_year', 'Year', 'required');
		$this->form_validation->set_rules('dc_description', 'Description', 'required');

		$success = false;
		if ( $this->form_validation->run() == true ) {

			$credential = $this->input->post();

			$dc_data = array(
					'dc_title' => $credential['dc_title'],
					'dc_year' => $credential['dc_year'],
					'dc_description' => $credential['dc_description']
				);

			if ( $edit ) {
				$this->Doctors_model->edit_doctor_credential( $dcred_id, $dc_data );
			} else {
				$did = $this->admin_doctor_info['d_id'];
				$dcred_id = $this->Doctors_model->add_doctor_credential( $did, $dc_data );
			}

			redirect('/doctor/credential/' . $dcred_id, 'refresh');

		}

		$data['credential_id'] = false;
		if( $edit ) {
			$dcdata = array(
				'dc_id' => $dcred_id, 
				'dc_did' => $this->admin_doctor_info['d_id'] 
				);

			$data['credential_id'] = $dcred_id;
			$data['credential_data'] = $this->Doctors_model->get_doctor_credentail( $dcdata );
		}

		if ( $this->input->post() ) {
			$data['credential_data'] = $this->input->post();
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message') ;

		$this->load_main_tpl( 'doctor/credential', $data );
	}

	public function completion() {
		$dr_id = $this->input->post('dr_id');

		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$password = $this->input->post('password');

		$this->load->model('Doctors_model');
		$this->load->model('Admins_model');

		$drdata = array( 'dr_id' => $dr_id );
		$dr_info = $this->Doctors_model->search_doctors( $drdata );

		$adata = array(
				'a_company' => $dr_info['dr_company'],
				'a_email' => $dr_info['dr_email'],
				'a_fname' => $fname,
				'a_mname' => $mname,
				'a_lname' => $lname,
				'a_password' => md5($password),
			);
		$a_id = $this->Admins_model->add_admin_doctor( $adata );

		$this->Doctors_model->register_doctor( $dr_id, $a_id );

		$result = array("success" => true);
		print json_encode($result);
		exit;
	}

}

/* End of file doctor.php */
/* Location: ./application/controllers/doctor.php */