<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country_amphur extends CI_Model 
{
	var $table='country_amphur';
	var $desc='อำเภอ';
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
		$this->db->where(array('GEO_ID'=>$geo_id));
		return $this->db->get($this->table)->result();
	}
	function get_by_province_id($province_id)
	{
		$this->db->where('PROVINCE_ID',$province_id);
		$this->db->not_like('AMPHUR_NAME','*');
		return $this->db->get($this->table)->result();
	}
		function get_by_id($amphur_id)
	{
		$this->db->where('AMPHUR_ID',$amphur_id);
		return $this->db->get($this->table)->row();
	}
}

/* End of file template.php */
/* Location: ./application/models/amphur.php */
