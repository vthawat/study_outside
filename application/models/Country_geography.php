<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country_geography extends CI_Model 
{
	var $table='country_geography';
	var $desc='ภูมิภาค';
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
		$this->db->get_where($this->table,array('GEO_ID'=>$geo_id))->result();
	}
}