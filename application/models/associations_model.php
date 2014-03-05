<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Associations_model extends CI_Model {

	const TBL_NAME = 'associations';
	const TBL_NAME_ADMIN = 'associations_admins';
	const TBL_NAME_DOCTOR = 'associations_doctors';

	/**
	* Get Company Events
	* 
	* @param array $company_id
	* return boolean
	*/
	public function get_company_events( $company_id = NULL )
	{

		$this->db->select( '*' );
    	$this->db->where( 'e_company', $company_id );
		$this->db->from( Events_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Save Association
	* 
	* @param array $assocdata
	* return boolean
	*/
	public function add_association( $assocdata = NULL )
	{

		$this->db->set( 'assc_created', 'NOW()', false );
		$this->db->insert( Associations_model::TBL_NAME, $assocdata );

		return $this->db->insert_id();

	}

	/**
	* Save Association Admin
	* 
	* return boolean
	*/
	public function add_association_admin( $assoc_id = NULL, $admin_id = NULL )
	{

		$this->db->set( 'assca_aid', $admin_id );
		$this->db->set( 'assca_associd', $assoc_id );
		$this->db->set( 'assca_dateadded', 'NOW()', false );
		$this->db->insert( Associations_model::TBL_NAME_ADMIN );

		return $this->db->insert_id();

	}

	/**
	* Save Association Doctor
	* 
	* @param array $assocdata
	* return boolean
	*/
	public function add_association_doctor( $assoc_id = NULL, $doctor_id = NULL )
	{

		$this->db->set( 'asscd_did', $doctor_id );
		$this->db->set( 'asscd_associd', $assoc_id );
		$this->db->insert( Associations_model::TBL_NAME_DOCTOR );

		return $this->db->insert_id();

	}

	/**
	* Get Doctor's Associations
	* 
	* @param int $doctor_id
	* return boolean
	*/
	public function get_doctor_associations( $doctor_id = NULL )
	{

		$this->db->select( '*' );
    	$this->db->where( 'assca_aid', $doctor_id );
		$this->db->from( Associations_model::TBL_NAME_ADMIN );
		$this->db->join( Associations_model::TBL_NAME, 'assca_associd = assc_id', 'left');
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get Associations Admins
	* 
	* @param int $assc_id
	* return boolean
	*/
	public function get_associations_admins( $assc_id = NULL ) {

		$this->db->select( '*' );
    	$this->db->where( 'assca_associd', $assc_id );
		$this->db->from( Associations_model::TBL_NAME_ADMIN );
		$this->db->join( Admins_model::TBL_NAME, 'a_id = assca_aid', 'inner');
		$this->db->join( Doctors_model::TBL_NAME, 'd_aid = assca_aid', 'inner');
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get Associations Members
	* 
	* @param int $assc_id
	* return boolean
	*/
	public function get_associations_members( $assc_id = NULL ) {

		$this->db->select( '*' );
    	$this->db->where( 'asscd_associd', $assc_id );
		$this->db->from( Associations_model::TBL_NAME_DOCTOR );
		$this->db->join( Doctors_model::TBL_NAME, 'd_id = asscd_did', 'inner');
		$this->db->join( Admins_model::TBL_NAME, 'a_id = d_aid', 'inner');
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Get Association Info
	* 
	* @param array $asscdata
	* return array
	*/
	public function get_association_info( $asscdata = NULL )
	{

		$this->db->select( Associations_model::TBL_NAME.'.*' );

		foreach ($asscdata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Associations_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->row_array();

	}

}