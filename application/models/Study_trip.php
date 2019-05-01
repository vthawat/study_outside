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

	function get_all()
	{
		$this->db->order_by('id',"desc");
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
	function get_by_status($status="")
	{
		$this->db->where('status',$status);
		$result=$this->db->get($this->table)->result();
		return $result;
	}
	function get_schedule_plan_by_trip_id($id)
	{
		$this->db->where('period_trip_id',$id);
		$result=$this->db->get('schedule_plan')->row();
		return $result;

	}
	function get_student_list_by_trip_id($id)
	{
		$this->db->where('period_trip_id',$id);
		$result=$this->db->get('student_list_name')->result();
		return $result;

	}
	function get_student_list_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('student_list_name')->row();
	}
	function post_student_list($data)
	{
		return $this->db->insert('student_list_name',$data);
	}
	function put_student_list($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update('student_list_name',$data);
	}
	function delete_student_list_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete('student_list_name');
	}
	function delete_all_student_list_by_trip_id($id)
	{
		$this->db->where('period_trip_id',$id);
		return $this->db->delete('student_list_name');
	}
	function get_trip_show_oncalendar()
	{
		$json_trips=array();
		$sql="SELECT
			study_period_trip.id,
			subject_list.subject_code,
			subject_list.subject_name,
			study_period_trip.start_date,
			study_period_trip.end_date,
			study_period_trip.`status`,
			study_period_trip.end_location
			FROM
			study_period_trip
			INNER JOIN subject_list ON study_period_trip.subject_list_id = subject_list.id";
		$result=$this->db->query($sql)->result();
		if(!empty($result))
			foreach($result as $item)
			{
				array_push($json_trips,["id"=>$item->id,
										"title"=>$item->subject_code.' '.$item->subject_name,
										"description"=>'จ.'.$item->end_location,
										"start"=>$item->start_date,
										"end"=>$item->end_date.' 24:00:00',
										"allDay"=>true,
										"color"=>'#'.$this->random_color()]);
			}
		return json_encode($json_trips);
		
		

	}
	function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}
	
	function random_color() {
		return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
	}
	function has_schedule($id)
	{
		$result=$this->get_schedule_plan_by_trip_id($id);
		if($result) return TRUE;
		else return FALSE;
	}
	function set_trip_status()
	{
		$this->trip_status=[1=>'อยู่ระหว่างการดำเนินการ',
							2=>'สร้างเส้นทางแล้ว',
							3=>'สร้างกำหนดการเดินทางแล้ว',
							4=>'อนุมัติแล้ว'
							];
	}
	function post_schedule($data)
	{
		$result=$this->get_schedule_plan_by_trip_id($data['period_trip_id']);
		if(empty($result)) { // insert new row
			$this->put_trip_status($data['period_trip_id'],"สร้างกำหนดการเดินทางแล้ว");
			return $this->db->insert("schedule_plan",$data);
		}
		else{
			// update row
			$data['schedule_html']=NULL; 
			$this->put_trip_status($data['period_trip_id'],"สร้างกำหนดการเดินทางแล้ว");
			$this->db->where('period_trip_id',$data['period_trip_id']);
			return $this->db->update("schedule_plan",$data);
		}
		//return $this->db->insert("schedule_plan",$data);
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
	function put_schedule($data)
	{
		$this->db->where('period_trip_id',$data['period_trip_id']);
		return $this->db->update("schedule_plan",$data);
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
