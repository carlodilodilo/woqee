<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Admins_model');
	}

	public function login()
	{
		$this->load->helper('security');

		if( $this->input->post() ) {
			$login_info = $this->Admins_model->login();

			if( $login_info ) {
				$login['login'] = $login_info;
				$this->session->set_userdata( $login );
				
				if( $login_info['a_type'] != 3 ) {
					redirect('/manage/doctor', 'refresh');
				}

				redirect('/', 'refresh');
			}
		}

		$this->session->set_flashdata('message', true);
		redirect('/', 'refresh');
	}

	public function add()
	{
		$login_info = $this->session->userdata( 'login' );

		$email = $this->input->post('email');
		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$password = $this->input->post('password');
		$type = $this->input->post('type');
		$company = $login_info['a_company'];

		$where_data = array(
				'a_email' => $email,
				'a_type' => $type,
				'a_company' => $company,
			);
		$email_exist = $this->Admins_model->search_company_officer( $where_data );

		if( $email_exist ) {
			$result = array( "success" => false, "message" => "Email Already Exist!" );
			print json_encode($result);
			exit;
		} else {
			$admin_data = array(
				'a_email' 	 => $email,
				'a_type' 	 => $type,
				'a_company'  => $company,
				'a_fname' 	 => $fname,
				'a_mname' 	 => $mname,
				'a_lname' 	 => $lname,
				'a_password' => md5($password),
			);
			$this->Admins_model->add_company_officer( $admin_data );
			$result = array( "success" => true );
			print json_encode($result);
			exit;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */