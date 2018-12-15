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