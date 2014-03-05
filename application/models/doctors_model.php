<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Doctors_model extends CI_Model {



	const TBL_NAME = 'doctors';

	const TBL_NAME_DETAIL = 'doctors_details';

	const TBL_NAME_REGISTRATION = 'doctors_registrations';

	const TBL_NAME_SPECIALIZATION = 'doctors_specializations';

	const TBL_NAME_CREDENTIAL = 'doctors_credentials';

	const TBL_NAME_CLINIC = 'doctors_offices';

	const TBL_NAME_CLINIC_DAY = 'doctors_offices_days';

	const TBL_NAME_COMPANY = 'company';

	/**
	* Search Doctor Information
	* 
	* @param array $ddata
	* return boolean
	*/
	public function search_doctor_info( $ddata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME.'.*' );

		foreach ($ddata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Add Doctor Information
	* 
	* @param array $ddata
	* return int
	*/
	public function add_doctor_info( $ddata = NULL )
	{

		$this->db->set( 'd_added', 'NOW()', false );
		$this->db->insert( Doctors_model::TBL_NAME, $ddata );

		return $this->db->insert_id();

	}

	/**
	* Update Doctor Info
	* 
	* @param array $ddata   
	* return boolean
	*/
	public function update_doctor_info( $did = NULL, $ddata = NULL )
	{

		$this->db->where( 'd_aid', $did );
	    $this->db->update( Doctors_model::TBL_NAME, $ddata );

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

			if( !empty($val) ) {
				$this->db->insert( Doctors_model::TBL_NAME_SPECIALIZATION );
			}
		}

	}

	/**
	* Get All Doctor Credential
	* 
	* @param array $dcdata
	* return array
	*/
	public function get_all_doctor_credentails ( $dcdata = NULL ) {

		$this->db->select( Doctors_model::TBL_NAME_CREDENTIAL.'.*' );

		foreach ($dcdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CREDENTIAL );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get Doctor Credential
	* 
	* @param array $dcdata
	* return array
	*/
	public function get_doctor_credentail( $dcdata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_CREDENTIAL.'.*' );

		foreach ($dcdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CREDENTIAL );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Add Doctor Credential
	* 
	* @param array $dc_data
	* return void
	*/
	public function add_doctor_credential( $did = NULL, $dc_data = null )
	{

		$this->db->set( 'dc_added', 'NOW()', false );
		$this->db->set( 'dc_did', $did );

		$this->db->insert( Doctors_model::TBL_NAME_CREDENTIAL, $dc_data );

		return $this->db->insert_id();

	}

	/**
	* Edit Doctor Credential
	* 
	* @param array $dc_data   
	* return boolean
	*/
	public function edit_doctor_credential( $dc_id = NULL, $dc_data = NULL )
	{

	    $this->db->where( 'dc_id', $dc_id );
	    $this->db->update( Doctors_model::TBL_NAME_CREDENTIAL, $dc_data );

	}

	/**
	* Edit Doctor Credential
	* 
	* @param array $dcred_id
	* return boolean
	*/
	public function remove_doctor_credential( $dcred_id ) {

		$this->db->where( 'dc_id', $dcred_id );
		$this->db->delete( Doctors_model::TBL_NAME_CREDENTIAL );

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
	public function get_company_doctors( $dr_company = NULL, $dr_eid = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_REGISTRATION.'.*' );
    	$this->db->where( 'dr_company', $dr_company );
    	$this->db->where( 'dr_eid', $dr_eid );
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


	/*******************************
	********************************
	*  Doctor's Clinic Functionality
	********************************
	*******************************/

	/**
	* Get All Doctor's Clinic
	* 
	* @param array $dodata
	* return boolean
	*/
	public function get_all_doctor_clinics( $dodata )
	{
		$this->db->select( Doctors_model::TBL_NAME_CLINIC.'.*' );

		foreach ($dodata as $key => $value) {
			$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CLINIC );
		$query = $this->db->get();

	    $clinics = $query->result_array();

	    $doctor_clinics = array();
	    if ( !empty($clinics) ) {

	    	foreach ($clinics as $clinic) {
				$doddata = array(
					'dod_doid' => $clinic['do_id'], 
				);
	    		$clinic_days = $this->get_doctor_clinic_days( $doddata );

	    		$doctor_clinics[$clinic['do_id']] = $clinic;
	    		$doctor_clinics[$clinic['do_id']]['days'] = $clinic_days;
	    	}

	    }

		return $doctor_clinics;
	}

	public function get_all_doctor_clinics_days( $dodata )
	{
		$this->db->select( Doctors_model::TBL_NAME_CLINIC.'.*' );

		foreach ($dodata as $key => $value) {
			$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CLINIC );
		$query = $this->db->get();

	    return $query->result_array();
	}

	/**
	* Get Doctor's Clinic
	* 
	* @param array $do_data
	* return boolean
	*/
	public function get_doctor_clinic( $dodata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_CLINIC.'.*' );

		foreach ($dodata as $key => $value) {
			$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CLINIC );
		$query = $this->db->get();

		return $query->row_array();

	}

	/**
	* Add Doctor's Clinic
	* 
	* @param array $do_data
	* return boolean
	*/
	public function add_doctor_clinic( $dodata = NULL )
	{

		$this->db->set( 'do_added', 'NOW()', false );
		$this->db->insert( Doctors_model::TBL_NAME_CLINIC, $dodata );

		return $this->db->insert_id();

	}

	/**
	* Remove Doctor's Clinic
	* 
	* @param array $do_data
	* return boolean
	*/
	public function remove_doctor_clinic( $clinic_id ) {
		$this->db->where( 'do_id', $clinic_id );
		$this->db->delete( Doctors_model::TBL_NAME_CLINIC );
	}

	/**
	* Get Doctor's Clinic Days
	* 
	* @param array $doddata
	* return boolean
	*/
	public function get_doctor_clinic_days( $doddata = NULL )
	{

		$this->db->select( Doctors_model::TBL_NAME_CLINIC_DAY.'.*' );

		foreach ( $doddata as $key => $value ) {
			$this->db->where( $key, $value );
		}

		$this->db->from( Doctors_model::TBL_NAME_CLINIC_DAY );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Add Doctor's Clinic Days
	* 
	* @param array $do_data
	* return boolean
	*/
	public function add_doctor_clinic_days( $doddata = NULL )
	{

		$this->db->insert( Doctors_model::TBL_NAME_CLINIC_DAY, $doddata );

		return $this->db->insert_id();

	}

	/**
	* Remove All Doctor's Clinic Days
	* 
	* @param array $dvdata   
	* return boolean
	*/
	public function reset_doctor_clinic_days( $clinic_id, $dvdata = NULL )
	{

		$this->db->where( 'dod_doid', $clinic_id );
		$this->db->delete( Doctors_model::TBL_NAME_CLINIC_DAY ); 

		return $this->db->insert_id();

	}

}