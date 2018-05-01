<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_place extends CI_Model 
{
	var $table='study_place';
	var $desc='สถานที่ศึกษาดูงาน';
	function __construct()
	{
		parent::__construct();
		
			
	}
	function get_all()
	{
		$this->db->select('study_place.*,country_province.PROVINCE_NAME,country_amphur.AMPHUR_NAME,country_district.DISTRICT_NAME');
		$this->db->join('country_province','study_place.province_id=country_province.PROVINCE_ID');
		$this->db->join('country_amphur','study_place.amphur_id=country_amphur.AMPHUR_ID');
		$this->db->join('country_district','study_place.district_id=country_district.DISTRICT_ID');
		return $this->db->get('study_place')->result();
	}

	function post()
    {
        return $this->db->insert($this->table,$this->input->post());
    }

}

/* End of file template.php */
/* Location: ./application/models/amphur.php */
