<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins_model extends CI_Model {

	const TBL_NAME = 'admins';
	const TBL_NAME_TYPE = 'admins_type';
	const TBL_NAME_COMPANY = 'companies';

    public function login( $a_email = NULL, $a_password = NULL ) {

		$a_email = $this->input->post('email') ? $this->input->post('email') : $a_email ;
		$a_password = $this->input->post('password') ? $this->input->post('password') : $a_password ;
		$a_password = do_hash( $a_password, 'md5' );

		$this->db->select('*'); 
		$this->db->from( Admins_model::TBL_NAME ); 
		$this->db->join(Admins_model::TBL_NAME_TYPE, Admins_model::TBL_NAME_TYPE.'.at_type = '.Admins_model::TBL_NAME.'.a_type');
		$this->db->join(Admins_model::TBL_NAME_COMPANY, Admins_model::TBL_NAME_COMPANY.'.c_id = '.Admins_model::TBL_NAME.'.a_company');
        $this->db->where('a_email', $a_email); 
        $this->db->where('a_password', $a_password); 

        $query = $this->db->get();

		if ($query->num_rows() > 0)	{
	        return $query->row_array();
	    } else {
	    	return false;
	    }

    }

    public function getAdminInfo( $a_id = NULL ) {

		$this->db->select('*');
		$this->db->from( Admins_model::TBL_NAME );
		$this->db->join(Admins_model::TBL_NAME_TYPE, Admins_model::TBL_NAME_TYPE.'.at_type = '.Admins_model::TBL_NAME.'.a_type');
		$this->db->join(Admins_model::TBL_NAME_COMPANY, Admins_model::TBL_NAME_COMPANY.'.c_id = '.Admins_model::TBL_NAME.'.a_company');
        $this->db->where('a_id', $a_id); 

        $query = $this->db->get();

		if ($query->num_rows() > 0)	{
	        return $query->row_array();
	    } else {
	    	return false;
	    }

    }

    public function countCompanyStats( $c_id = NULL, $a_type = NULL ) {

		$this->db->from( Admins_model::TBL_NAME );
        $this->db->where('a_company', $c_id); 

        foreach ($a_type as $key => $value) {
			$this->db->where_in('a_type', $a_type);
        }

        $this->db->where('a_datedeleted IS NULL', null, false); 

		return $this->db->count_all_results();

    }

    public function get_company_officers( $a_company = NULL ) {

		$this->db->select('*');
		$this->db->from( Admins_model::TBL_NAME );
        $this->db->where('a_company', $a_company); 
        $this->db->where('a_type !=', 3); 
        $this->db->where('a_datedeleted IS NULL', null, false); 

        $query = $this->db->get();

		if ($query->num_rows() > 0)	{
	        return $query->result_array();
	    } else {
	    	return false;
	    }

    }

    public function get_company_doctors( $a_company = NULL ) {

		$this->db->select('*');
		$this->db->from( Admins_model::TBL_NAME );
        $this->db->where('a_company', $a_company); 
        $this->db->where('a_type', 3); 
        $this->db->where('a_datedeleted IS NULL', null, false); 

        $query = $this->db->get();

		if ($query->num_rows() > 0)	{
	        return $query->result_array();
	    } else {
	    	return false;
	    }

    }

    public function add_company_officer( $a_data = NULL ) {

		$this->db->set( 'a_added', 'NOW()', false );
		$this->db->set( 'a_type', '2');
		$this->db->insert( Admins_model::TBL_NAME, $a_data );

		return true;

    }

    public function remove_company_officer( $a_id = NULL ) {

		$this->db->where( 'a_id', $a_id );
		$this->db->set( 'a_datedeleted', 'NOW()', false );
	    $this->db->update( Admins_model::TBL_NAME );

		return true;

    }

	/**
	* Search Admin
	* 
	* @param array $adata
	* return boolean
	*/
	public function search_admin( $adata = NULL )
	{

		$this->db->select( Admins_model::TBL_NAME.'.*' );

		foreach ($adata as $key => $value) {
	    	$this->db->where( $key, $value );
		}

		$this->db->from( Admins_model::TBL_NAME );
		$query = $this->db->get();

	    return $query->row_array();

	}

    public function add_admin_doctor( $a_data = NULL ) {

		$this->db->set( 'a_added', 'NOW()', false );
		$this->db->set( 'a_type', '3');
		$this->db->insert( Admins_model::TBL_NAME, $a_data );

		return $this->db->insert_id();

    }

    public function update_admin_doctor( $aid = NULL, $adata = NULL ) {

		$this->db->set( 'a_dateupdated', 'NOW()', false );
		$this->db->where( 'a_type', '3');
		$this->db->where( 'a_id', $aid );
	    $this->db->update( Admins_model::TBL_NAME, $adata );

    }

    public function search_company_officer( $where_data = NULL ) {

		$this->db->select('*');
		$this->db->from( Admins_model::TBL_NAME );

		foreach ($where_data as $key => $value) {
			$this->db->where($key, $value);
		}

        $query = $this->db->get();

		if ($query->num_rows() > 0)	{
	        return $query->result_array();
	    } else {
	    	return false;
	    }

    }

}