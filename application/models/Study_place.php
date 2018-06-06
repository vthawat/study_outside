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
	function get_by_id($id)
	{
		$this->db->select('study_place.*,country_province.PROVINCE_NAME,country_amphur.AMPHUR_NAME,country_district.DISTRICT_NAME');
		$this->db->join('country_province','study_place.province_id=country_province.PROVINCE_ID');
		$this->db->join('country_amphur','study_place.amphur_id=country_amphur.AMPHUR_ID');
		$this->db->join('country_district','study_place.district_id=country_district.DISTRICT_ID');
		$this->db->where('id',$id);
		return $this->db->get('study_place')->row();

	}
	function get_knowledge_by_study_place_id($study_place_id)
	{
		$this->db->where('study_place_id',$study_place_id);
		return $this->db->get('khowledge_items')->result();
	}
	function get_knowledge_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('khowledge_items')->row();
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
	function post_knowledge($study_place_id)
	{

		$data=array('study_place_id'=>$study_place_id,
					'title'=>$this->input->post('title'),
					 'desc'=>$this->input->post('desc'));
		if($this->db->insert('khowledge_items',$data))
		{
			 $knowledge_id=$this->db->insert_id();

			if (!empty($_FILES['knowledge_image']['name']))
			{
				// upload images file
					$config['upload_path'] = 'images/knowledge/';
					$config['overwrite']=TRUE;
					$config['allowed_types'] = 'jpg|png';
					$config['file_name']='knowledge-'.$knowledge_id;	
					$this->load->library('upload', $config);
					$this->upload->do_upload('knowledge_image');
					// update images name
					$this->db->where('id',$knowledge_id);
					$this->db->update('khowledge_items',array('images'=>$config['file_name'].$this->upload->data('file_ext')));
			}
			else{
				// update images blank name
					$this->db->where('id',$knowledge_id);
					$this->db->update('khowledge_items',array('images'=>'none-images.png'));	
			}
		return TRUE;
		}
		else return FALSE;

	}
	function put_knowledge($knowledge_id)
	{
		$data=array('title'=>$this->input->post('title'),
					 'desc'=>$this->input->post('desc'));
		$this->db->where('id',$knowledge_id);
		if($this->db->update('khowledge_items',$data))
		{
			if (!empty($_FILES['knowledge_image']['name']))
			{
				// upload images file
					$config['upload_path'] = 'images/knowledge/';
					$config['overwrite']=TRUE;
					$config['allowed_types'] = 'jpg|png';
					$config['file_name']='knowledge-'.$knowledge_id;	
					$this->load->library('upload', $config);
					$this->upload->do_upload('knowledge_image');
					// update images name
					$this->db->where('id',$knowledge_id);
					$this->db->update('khowledge_items',array('images'=>$config['file_name'].$this->upload->data('file_ext')));
			}
			return TRUE;	
		}
	}
	function put($study_place_id)
	{
		$data=$this->input->post();
		$subject_major_list=$this->input->post('subject_major_id');
		/* remove subject major list */
		if(!empty($subject_major_list)) 
			if($this->delete_subject_major_list($study_place_id))
				foreach($subject_major_list as $subject_major_id)
					$this->post_study_place_major_list($study_place_id,$subject_major_id);
		
		/* update study place */
		unset($data['subject_major_id']);
		$this->db->where('id',$study_place_id);
		if($this->db->update($this->table,$data)) return TRUE;
		else return FALSE;

	}
	function delete_subject_major_list($study_place_id)
	{
		$this->db->where('study_place_id',$study_place_id);
		$this->db->delete('study_place_major_list');
		return TRUE;
	}
	function delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}

	function post_study_place_major_list($study_place_id,$subject_major_id)
	{
		$data=array('study_place_id'=>$study_place_id,
					'subject_major_id'=>$subject_major_id);
		$this->db->insert('study_place_major_list',$data);
	}
	function get_study_place_major_list($study_place_id,$subject_major_id=null)
	{
		$this->db->where('study_place_id',$study_place_id);
		if($subject_major_id)
		{
			$this->db->where('subject_major_id',$subject_major_id);
			$result=$this->db->get('study_place_major_list')->result();
			if(!empty($result))
				return TRUE;
			else return FALSE;
		}
		else return $this->db->get('study_place_major_list')->result();
	}

}

/* End of file template.php */
/* Location: ./application/models/amphur.php */
