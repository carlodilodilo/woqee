<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recover extends MY_Controller {

	public function index() {
		$data = array(
				'title' => 'Forgot Password'
			);

		$this->load_main_login_tpl( 'account/forgot_password', $data );
	}

}

/* End of file forgot_pasword.php */
/* Location: ./application/controllers/forgot_pasword.php */