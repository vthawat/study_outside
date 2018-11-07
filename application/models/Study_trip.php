<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_trip extends CI_Model 
{
	var $table='study_period_trip';
	var $desc='่กำหนดการเดินทางศึกษาดูงาน';
	var $trip_status=array();
	function __construct()
	{
		parent::__construct();
		$this->set_trip_color();
	}
	function get_all()
	{
		return $this->db->get($this->table)->result();
	}
	function get_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
	}
	function set_trip_color()
	{
		$this->trip_status=array(0=>'อยู่ระหว่างการดำเนินการ');
	}
	function post_trip()
	{
		$data=$this->input->post();
		$data['subject_major_selected']=json_encode($data['subject_major_selected']);
		$data['knowledge_selected']=json_encode($data['knowledge_selected']);
		$data['status']='อยู่ระหว่างการดำเนินการ'; // set init status
		// change format date dd/mm/yyyy to yyyy-mm-dd
		$start_date=explode('/',$data['start_date']);
		$end_date=explode('/',$data['end_date']);
		$data['start_date']=$start_date[2].'-'.$start_date[1].'-'.$start_date[0];
		$data['end_date']=$end_date[2].'-'.$end_date[1].'-'.$end_date[0];
		if($this->db->insert($this->table,$data)) return $this->db->insert_id();
		else return FALSE;
	}

	function put_trip($id)
	{
		$data=$this->input->post();
		$data['subject_major_selected']=json_encode($data['subject_major_selected']);
		$data['knowledge_selected']=json_encode($data['knowledge_selected']);
		$start_date=explode('/',$data['start_date']);
		$end_date=explode('/',$data['end_date']);
		$data['start_date']=$start_date[2].'-'.$start_date[1].'-'.$start_date[0];
		$data['end_date']=$end_date[2].'-'.$end_date[1].'-'.$end_date[0];
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return TRUE;
		else return FALSE;
	}
	function put_trip_status($id,$status)
	{
		$data=array("status"=>$status);
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return TRUE;
		else return FALSE;
	}
	function color_trip_status($status)
	{
		//$trip_status=$this->ge
	}
	function put_place_selected($id)
	{
		$data=$this->input->post();
		$data['place_selected']=json_encode($data['place_selected']);
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return $this->put_trip_status($id,"สร้างเส้นทางแล้ว");
		else return FALSE;
	}
	function suggest_location($trip_id)
	{
		$trips=$this->get_by_id($trip_id);
		$subject_major=json_decode($trips->subject_major_selected,TRUE);
		$knowledge_item=json_decode($trips->knowledge_selected,TRUE);
		$filter=array();
		$filter['study_place_major_list.subject_major_id']=$subject_major;
		$filter['khowledge_items.id']=$knowledge_item;
		return $this->study_place->get_all($filter);
	}
	
	

}

/* End of file template.php */
/* Location: ./application/models/Study_trip.php */
