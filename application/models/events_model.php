<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model {

	const TBL_NAME = 'events';

	/**
	* Get Current Company Events
	* 
	* @param array $company_id
	* return boolean
	*/
	public function get_current_events( $company_id = NULL )
	{

		$this->db->select( '*' );

    	$this->db->where( 'e_company', $company_id );
		$this->db->where( 'e_date = DATE(NOW())', NULL, FALSE );

		$this->db->from( Events_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Get Lastest Company Events
	* 
	* @param array $company_id
	* return boolean
	*/
	public function get_latest_events( $company_id = NULL )
	{

		$this->db->select( '*' );
		$this->db->from( Events_model::TBL_NAME );
    	$this->db->where( 'e_company', $company_id );

		$this->db->where( 'e_date < NOW()', NULL, FALSE );
		$this->db->order_by( 'e_date', 'desc'); 

		$query = $this->db->get();

	    return $query->row_array();

	}

	/**
	* Get Upcoming Company Events
	* 
	* @param array $company_id
	* return boolean
	*/
	public function get_upcoming_events( $company_id = NULL )
	{

		$this->db->select( '*' );
		$this->db->from( Events_model::TBL_NAME );
    	$this->db->where( 'e_company', $company_id );

		$this->db->where( 'e_date > NOW()', NULL, FALSE );
		$this->db->order_by( 'e_date' ); 

		$query = $this->db->get();

	    return $query->row_array();

	}

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
		$this->db->order_by( 'e_date' ); 
		$query = $this->db->get();

	    return $query->result_array();

	}

	/**
	* Save Event Registration
	* 
	* @param array $edata
	* return boolean
	*/
	public function add_company_event( $edata = NULL )
	{

		$this->db->set( 'e_dateadded', 'NOW()', false );
		$this->db->insert( Events_model::TBL_NAME, $edata );

		return true;

	}

	/**
	* Update Event Registration
	* 
	* @param array $edata
	* return boolean
	*/
	public function update_company_event( $eid = NULL, $edata = NULL )
	{

		$this->db->where( 'e_id', $eid );
	    $this->db->update( Events_model::TBL_NAME, $edata );

	}

}