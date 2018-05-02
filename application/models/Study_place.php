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
	   $data=$this->input->post();
	   $subject_major_list=$this->input->post('subject_major_id');
	   unset($data['subject_major_id']);
	   $this->db->insert($this->table,$data);
	   $study_place_id=$this->db->insert_id();
	   foreach($subject_major_list as $subject_major_id)
		$this->post_study_place_major_list($study_place_id,$subject_major_id);
	
	return TRUE;

	}
	function post_study_place_major_list($study_place_id,$subject_major_id)
	{
		$data=array('study_place_id'=>$study_place_id,
					'subject_major_id'=>$subject_major_id);
		$this->db->insert('study_place_major_list',$data);
	}

}

/* End of file template.php */
/* Location: ./application/models/amphur.php */
