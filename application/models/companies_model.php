<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Companies_model extends CI_Model {

	const TBL_NAME = 'companies';

	const TBL_NAME_PENDING = 'companies_pending';

	const TBL_NAME_OFFICER = 'companies_officer';

	/**
	* Search Company Info
	* 
	* @param array $cdata
	* return boolean
	*/
	public function search_company_info( $cdata = NULL )
	{

		$this->db->select( Companies_model::TBL_NAME.'.*' );

		foreach ($cdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Companies_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Search Pending Company Officer
	* 
	* @param array $cpdata
	* return boolean
	*/
	public function search_pending_officer( $cpdata = NULL )
	{

		$this->db->select( Companies_model::TBL_NAME_PENDING.'.*' );

		foreach ($cpdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Companies_model::TBL_NAME_PENDING );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Add Pending Company Officer 
	* 
	* @param array $cpdata
	* return int
	*/
	public function add_pending_officer( $cpdata = NULL )
	{

		$this->db->set( 'cp_added', 'NOW()', false );
		$this->db->insert( Companies_model::TBL_NAME_PENDING, $cpdata );

		return $this->db->insert_id();

	}

	/**
	* Add Company Officer Information
	* 
	* @param array $codata
	* return int
	*/
	public function add_officer_info( $codata = NULL )
	{

		$this->db->set( 'co_added', 'NOW()', false );
		$this->db->insert( Companies_model::TBL_NAME, $codata );

		return $this->db->insert_id();

	}

	/**
	* Update Pending Officer
	* 
	* @param array $cpdata
	* return boolean
	*/
	public function update_pending_officer( $cpid = NULL, $cpdata = NULL )
	{

		$this->db->where( 'cp_id', $cpid );
		$this->db->set( 'cp_updated', 'NOW()', false );
	    $this->db->update( Companies_model::TBL_NAME_PENDING, $cpdata );

	}

	/**
	* Search Doctor Details
	* 
	* @param array $dddata
	* return arrau
	*/
	public function search_doctor_detail( $dddata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_DETAIL.'.*' );

		foreach ($dddata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_DETAIL );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Add Doctor Details
	* 
	* @param array $ddata
	* return int
	*/
	public function add_doctor_detail( $dddata = NULL )
	{

		$this->db->set( 'dd_updated', 'NOW()', false );
		$this->db->insert( Doctors_model::TBL_NAME_DETAIL, $dddata );

		return $this->db->insert_id();

	}

	/**
	* Update Doctor Details
	* 
	* @param array $dddata
	* return boolean
	*/
	public function update_doctor_detail( $did = NULL, $dddata = NULL )
	{

		$this->db->where( 'dd_did', $did );
	    $this->db->update( Doctors_model::TBL_NAME_DETAIL, $dddata );

	}

	/**
	* Search Doctor Specialization
	* 
	* @param array $dsdata
	* return boolean
	*/
	public function search_doctor_specialization( $dsdata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_SPECIALIZATION.'.*' );

		foreach ($dsdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_SPECIALIZATION );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Add Doctor Specialization
	* 
	* @param array $dsdata
	* return void
	*/
	public function add_doctor_specialization( $did = NULL, $desc = null )
	{

		$this->db->where('ds_did', $did);
		$this->db->delete( Doctors_model::TBL_NAME_SPECIALIZATION ); 

		foreach ( $desc as $key => $val ) {
			$this->db->set( 'ds_did', $did );
			$this->db->set( 'ds_desc', $val );
			$this->db->insert( Doctors_model::TBL_NAME_SPECIALIZATION );
		}

	}

	/* Get All Company Officers
	* 
	* @param array $dr_company   
	* return boolean
	*/
	public function get_company_officers( $dr_company = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );
    	$this->db->where( 'dr_company', $dr_company );
		$this->db->from( Doctors_model::TBL_NAME_REGISTRATION );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get All Registered Doctor by Company
	* 
	* @param array $dr_company   
	* return boolean
	*/
	public function get_company_reg_doctors( $dr_company = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );
    	$this->db->where( 'dr_company', $dr_company );
		$this->db->from( Doctors_model::TBL_NAME_REGISTRATION );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get All Doctor Registration by Company
	* 
	* @param array $dr_company   
	* return boolean
	*/
	public function get_company_doctors( $dr_company = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );
    	$this->db->where( 'dr_company', $dr_company );
		$this->db->from( Doctors_model::TBL_NAME_REGISTRATION );
		$query = $this->db->get();

	    return $query->result_array();

	}


	/**
	* Search Doctor Registration
	* 
	* @param array $dr_link   
	* return boolean
	*/
	public function search_doctors_registrations( $dr_link = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );
    	$this->db->where( 'dr_link', $dr_link );
		$this->db->from( Doctors_model::TBL_NAME_REGISTRATION );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Search Doctor Registration by Given Field
	* 
	* @param array $data
	* return boolean
	*/
	public function search_doctors( $drdata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );

		foreach ($drdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_REGISTRATION );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Update Doctor Registration
	* 
	* @param array $dr_link   
	* return boolean
	*/
	public function update_doctors_registrations( $dr_link = NULL, $dr_data = NULL )
	{

	    $this->db->where( 'dr_link', $dr_link );
	    $this->db->set( 'dr_status', 'active' );
	    $this->db->update( Doctors_model::TBL_NAME_REGISTRATION );

	}

	/**
	* Register Doctor
	* 
	* @param array $dr_link   
	* return boolean
	*/
	public function register_doctor( $dr_id = NULL, $a_id = NULL )
	{

	    $this->db->where( 'dr_id', $dr_id );
	    $this->db->set( 'dr_aid', $a_id );
	    $this->db->update( Doctors_model::TBL_NAME_REGISTRATION );

	}

	/**
	* Save Doctor Registration
	* 
	* @param array $drdata   
	* return boolean
	*/
	public function add_doctors_registrations( $drdata = NULL )
	{

		$this->db->set( 'dr_dateadded', 'NOW()', false );
		$this->db->insert( Doctors_model::TBL_NAME_REGISTRATION, $drdata );

		return $this->db->insert_id();

	}

}