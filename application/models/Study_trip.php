<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_trip extends CI_Model 
{
	var $table='study_period_trip';
	var $desc='่กำหนดการเดินทางศึกษาดูงาน';
	var $trip_status=array();
	var $start_time_frame='8.00';
	var $end_time_frame='18.00';
	var $time_break='12:00';
	var $study_time=array("1:00","1:30","2:00","2:30","3:00"); // unit hour.
	function __construct()
	{
		parent::__construct();
		$this->set_trip_status();
	}
	function isTimeBreak($start_time,$end_time)
	{
		$time_break = new Datetime($this->time_break);
		$begintime = new DateTime($start_time);
		$endtime = new DateTime($end_time);
		if($time_break > $begintime && $time_break < $endtime){
			// between times
			return TRUE;
		} else {
			// not between times
			return FALSE;
		}
	}
	function isTimeRest($start_time)
	{

		$start = strtotime($this->start_time_frame);
		$end   = strtotime($start_time);
		// diff time
		$time_frame  = $end-$start; // unit second
		if($time_frame>=$this->cal_trip_perday()) return TRUE;  // over 1 day
		else return FALSE;
	}
	function NextDay($date,$days){
		//$date = "04-15-2013";
		$date1 = str_replace('-', '/', $date);
		$tomorrow = date('Y-m-d',strtotime($date1 . "+".($days-1)." days"));
		return $tomorrow;
	}
	function cal_trip_perday()
	{
		$start = strtotime($this->start_time_frame);
		$end   = strtotime($this->end_time_frame);
		// diff time
		$time_frame  = $end-$start; // unit second
		return $time_frame;
	}
	function is_create_schedule($day=1,$routing)
	{
		$time_frame=$this->cal_trip_perday()*$day;
		foreach($routing as $route)
		{
			if(!empty($route->total_duration)){

				$duration_time=$route->total_duration*$day;
				$percent=($duration_time*100)/$this->cal_trip_perday();
				$percent=floor($percent);
				print $percent;
				if($day==1)
					if($percent<100) return TRUE;
				elseif($day==2)
				    if($percent>100) return TRUE;
				elseif($day==3)
				    if($percent>200) return TRUE;
					
		
				//else return FALSE;
			}
		}
	}
	function get_all()
	{
		return $this->db->get($this->table)->result();
	}
	function get_by_id($id)
	{
		
		$this->db->where('id',$id);
		$trips=$this->db->get($this->table)->row();
		if(!empty($trips)) {
			//set time_frame
			$this->start_time_frame=$trips->start_timeframe;
			$this->end_time_frame=$trips->end_timeframe;
		}
		return $trips;
		//return $this->db->get($this->table)->row();
	}
	function set_trip_status()
	{
		$this->trip_status=[1=>'อยู่ระหว่างการดำเนินการ',
							2=>'สร้างเส้นทางแล้ว',
							3=>'สร้างกำหนดการเดินทางแล้ว',
							4=>'อนุมัติแล้ว'
							];
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
	function check_trip_status($status)
	{
		
		if(empty($status)) return 0;
		else{
			$status=array_keys($this->trip_status,$status);
			return $status[0];
		}

	}
	function put_place_selected($id)
	{
		$data=$this->input->post();
		$data['place_selected']=json_encode($data['place_selected']);
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return $this->put_trip_status($id,"สร้างเส้นทางแล้ว");
		else return FALSE;
	}
	
	function place_ordering($id)
	{
		$data=$this->input->post();
		$data['place_ordering']=json_encode($data['place_ordering']);
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return TRUE;
		else return FALSE;
	}
	function put_trip_routing($id)
	{
		$data=$this->input->post();
		$data['routing']=json_encode($data['routing']);
		$this->db->where('study_period_trip.id',$id);
		if($this->db->update($this->table,$data)) return TRUE;
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
	function schedule_time_shift($segment_time=0,$duration_seconds=0)
	{
		$endTime = new DateTime($this->end_time_frame);  // end time frame

	   	if($segment_time==0)
			$startTime = new DateTime($this->start_time_frame); // start time frame
		else 
		$startTime = new DateTime($segment_time); // start time first	
		//if($startTime < $endTime)  // time shift
			$startTime->modify('+'.$duration_seconds.' seconds');
		return $startTime->format('H:i');

	}
	function delete($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete($this->table)) return TRUE;
		else return FALSE;
		
	}
	
	

}

/* End of file template.php */
/* Location: ./application/models/Study_trip.php */
