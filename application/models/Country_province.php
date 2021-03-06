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
		$this->db->order_by('PROVINCE_NAME');
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
	function get_province_of_place()
	{
		$sql="SELECT DISTINCT
		country_province.PROVINCE_ID,
		country_province.PROVINCE_NAME
		FROM
		study_place
		INNER JOIN country_province ON study_place.province_id = country_province.PROVINCE_ID
		ORDER BY
		country_province.PROVINCE_NAME ASC";
		return $this->db->query($sql)->result();
	}
}

/* End of file template.php */
/* Location: ./application/models/province.php */
