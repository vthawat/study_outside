<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country_province extends CI_Model 
{
	var $table='country_province';
	var $desc='จังหวัด';

	function __construct()
	{
		parent::__construct();		
	}
	function get_all()
	{
		$this->db->order_by('GEO_ID');
		return $this->db->get($this->table)->result();
	}
	function get_by_geo_id($geo_id)
	{
		$this->db->where(array('GEO_ID'=>$geo_id));
		return $this->db->get($this->table)->result();
	}
	function get_by_id($province_id)
	{
		$this->db->where('PROVINCE_ID',$province_id);
		return $this->db->get($this->table)->row();
	}
}

/* End of file template.php */
/* Location: ./application/models/province.php */
