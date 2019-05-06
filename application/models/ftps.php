<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ftps extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
        $this->load->model('country_geography','geography');
		$this->load->model('country_province','province');
		$this->load->model('country_amphur','amphur');
		$this->load->model('country_district','district');
        $this->load->model('country_zipcode','zipcode');
        $this->load->model('study_place');
        $this->load->model('study_place_rest');
        $this->load->model('study_trip');			
    }
    function ReportSubjectList($filter)
    {
        if(empty($filter))
        $sql="SELECT
        subject_list.id as subject_id,
        subject_list.subject_code,
        subject_list.subject_name,
        (SELECT
                        COUNT(study_period_trip.id)
                        FROM
                        study_period_trip
                        WHERE
                        study_period_trip.subject_list_id=subject_id) as total
        FROM
        subject_list
        ORDER BY total DESC";
        else
        $sql="SELECT
        subject_list.id as subject_id,
        subject_list.subject_code,
        subject_list.subject_name,
        (SELECT
                        COUNT(study_period_trip.id)
                        FROM
                        study_period_trip
                        WHERE
                        study_period_trip.subject_list_id=subject_id 
                        AND
study_period_trip.start_date BETWEEN CAST('".$filter['start_date']."' AS DATE) AND CAST(study_period_trip.start_date AS DATE) AND
study_period_trip.end_date BETWEEN CAST(study_period_trip.end_date AS DATE) AND CAST('".$filter['end_date']."' AS DATE)) as total
        FROM
        subject_list
        ORDER BY total DESC";

        $result=$this->db->query($sql)->result();
        return $result;

    }
    function ReportSubjectMajor($filter)
    {
        if(empty($filter))
        $sql="SELECT
                subject_major.id as major_id,
                subject_major.major_name,
                (SELECT
                COUNT(study_period_trip.id)
                FROM
                study_period_trip
                WHERE
                study_period_trip.subject_major_selected LIKE CONCAT('%', major_id, '%')) as total
                FROM
                subject_major";
        else
        $sql="SELECT
        subject_major.id as major_id,
        subject_major.major_name,
        (SELECT
        COUNT(study_period_trip.id)
        FROM
        study_period_trip
        WHERE
        study_period_trip.subject_major_selected LIKE CONCAT('%', major_id, '%') 
        AND
study_period_trip.start_date BETWEEN CAST('".$filter['start_date']."' AS DATE) AND CAST(study_period_trip.start_date AS DATE) AND
study_period_trip.end_date BETWEEN CAST(study_period_trip.end_date AS DATE) AND CAST('".$filter['end_date']."' AS DATE)) as total
        FROM
        subject_major";

         $result=$this->db->query($sql)->result();
         return $result;
    }
    function ReportProvince($filter)
    {
        if(empty($filter))
        $sql="SELECT DISTINCT
                    study_period_trip.end_location as province,
                    (SELECT
                    COUNT(study_period_trip.end_location)
                    FROM
                    study_period_trip
                    WHERE
                    study_period_trip.end_location = province) as total
                    FROM
                    study_period_trip";
        else
        $sql="SELECT DISTINCT
                    study_period_trip.end_location as province,
                    (SELECT
                    COUNT(study_period_trip.end_location)
                    FROM
                    study_period_trip
                    WHERE
                    study_period_trip.end_location = province 
                    AND
study_period_trip.start_date BETWEEN CAST('".$filter['start_date']."' AS DATE) AND CAST(study_period_trip.start_date AS DATE) AND
study_period_trip.end_date BETWEEN CAST(study_period_trip.end_date AS DATE) AND CAST('".$filter['end_date']."' AS DATE)) as total
                    FROM
                    study_period_trip";
        
            $result=$this->db->query($sql)->result();
            return $result;
    }
    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		//$strHour= date("H",strtotime($strDate));
		//$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
    function get_subject_major($id=null)
    {
       if($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('subject_major')->row();
        }
       else return $this->db->get('subject_major')->result();

    }
    function get_subject($id=null)
    {
        if($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('subject_list')->row();
        }
       else return $this->db->get('subject_list')->result();

    } 
    function post_subject_major()
    {
        return $this->db->insert('subject_major',$this->input->post());
    }
    function post_subject()
    {
        return $this->db->insert('subject_list',$this->input->post());
    }
    function put_subject_major($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('subject_major',$this->input->post());
    }
    function put_subject($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('subject_list',$this->input->post());
    }
    function delete_subject_major($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('subject_major');
    }
    function delete_subject($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('subject_list');
    }

}