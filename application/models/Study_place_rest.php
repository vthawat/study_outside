<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_place_rest extends CI_Model 
{
	var $table='study_place_rest';
	var $desc='สถานที่พักค้างคืน';
	function __construct()
	{
		parent::__construct();
		
			
	}
	function get_all($fillter=array(),$limit=null,$page=null)
	{
		$this->db->select('study_place_rest.*,country_province.PROVINCE_NAME,country_amphur.AMPHUR_NAME,country_district.DISTRICT_NAME');
		$this->db->join('country_province','study_place_rest.province_id=country_province.PROVINCE_ID','left');
		$this->db->join('country_amphur','study_place_rest.amphur_id=country_amphur.AMPHUR_ID','left','left');
		$this->db->join('country_district','study_place_rest.district_id=country_district.DISTRICT_ID','left');
		$this->db->group_by('study_place_rest.id');
		$this->db->from('study_place_rest');
		foreach($fillter as $key=>$item)
				 if(empty($item)) unset($fillter[$key]);

		$this->db->where($fillter);
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		//exit(print $this->db->last_query());
		return $query->result();
	//	return $this->db->get('study_place')->result();
	}
	function get_by_id($id)
	{
		$this->db->select('study_place_rest.*,country_province.PROVINCE_NAME,country_amphur.AMPHUR_NAME,country_district.DISTRICT_NAME');
		$this->db->join('country_province','study_place_rest.province_id=country_province.PROVINCE_ID','left');
		$this->db->join('country_amphur','study_place_rest.amphur_id=country_amphur.AMPHUR_ID','left');
		$this->db->join('country_district','study_place_rest.district_id=country_district.DISTRICT_ID','left');
		$this->db->where('id',$id);
		return $this->db->get('study_place_rest')->row();	
	}


	function post()
    {
	   $data=$this->input->post();
	   return $this->db->insert($this->table,$data); 
	}


	function put($place_id)
	{
		$data=$this->input->post();
		$subject_major_list=$this->input->post('subject_major_id');

		$this->db->where('id',$place_id);
		if($this->db->update($this->table,$data)) return TRUE;
		else return FALSE;

	}

	function delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}
}

/* End of file template.php */
/* Location: ./application/models/study_place_rest.php */
