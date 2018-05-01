<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country_zipcode extends CI_Model 
{
	var $table='country_zipcode';
	var $desc='รหัสไปรษณีย์';
	function __construct()
	{
		parent::__construct();		
	}
	
	function get_all()
	{
		return $this->db->get($this->table)->result();
	}
	function get_by_geo_id($geo_id)
	{
		return $this->db->get_where($this->table,array('GEO_ID'=>$geo_id))->result();
	}
	function get_by_district_id($district_id)
	{
		return $this->db->get_where($this->table,array('DISTRICT_ID'=>$district_id))->row()->ZIPCODE;
	}
}