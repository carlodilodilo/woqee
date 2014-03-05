<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_Controller extends CI_Controller {



    public function __construct() {

        parent::__construct();

		$this->load->helper('file');

    }



	public function load_main_login_tpl( $content, $content_data ) {



		$this->load->view( 'main_login/header', $content_data );

		$this->load->view( $content, $content_data );

		$this->load->view( 'main_login/footer' );



	}



	public function load_main_tpl( $content, $content_data ) {


		$session_exemption = array(
			'doctor/register',
			'company/register',
		);
		if( !$this->session->userdata('login') && !in_array($content, $session_exemption) ) {
			redirect('/', 'refresh');
		}

		$footer_data = array();

		$class = $this->router->fetch_class();
		$method = $this->router->fetch_method();

		$js_name = $class . '_' . $method . '.js';
		if( read_file( './assets/js/views/' . $js_name ) ) {
			$footer_data['js_name'] = $js_name;
		}

		$this->load->view( 'main/header', $content_data );

		$this->load->view( $content, $content_data );

		$this->load->view( 'main/footer', $footer_data );



	}



	public function pr( $string, $halt = false ) {

		print "<pre>";

		print_r( $string );

		print "</pre>";



		if( $halt ) {

			exit;

		}

	}

}

