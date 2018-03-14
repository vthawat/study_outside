<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		//exit(print_r($this->session->userdata()));
		$userinfo=$this->session->userdata('staff_id');
		if(empty($userinfo)) redirect(base_url('psuauthen'));
		$this->load->model('userinfo');
		$this->load->model('ftps');
		$this->template->set_template('admin');
		$data['User_info']=$this->userinfo->get_active_sign_in();
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));
		$data['app_name']='FTPS Application';
		$data['app_desc']='ระบบสารสนเทศบริหารจัดการการศึกษาภาคสนามด้วยกระบวนการวางแผนการเดินทางอัตโนมัติ';
		$data['app_version']='Version 1.0';
		$data['app_admin_department']='ภาควิชาพัฒนาการเกษตร';
		$data['app_admin_contact']='สุดารา คล้ายมณี';
		$data['app_admin_email']='sudara.k@psu.ac.th';
		$data['app_admin_phone']='6122';
		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write('app_name',$data['app_name'],TRUE);
		$this->template->write_view('menu','top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
		$this->template->add_css($this->load->view('css/admin-style.css',null,TRUE),'embed',TRUE);
		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
		$this->template->write_view('sidebar','sidebar');
	}
	public function index()
	{

		$this->template->render();
		
	}
	function subject_major($action=null,$id=null)
	{
		switch($action)
		{
		case 'new':
				$data['action']=base_url('staff/post/subject_major');
				$data['content']=array('title'=>'',
				'color'=>'primary',
				//'toolbar'=>$this->load->view('toolsbar',null,TRUE),
				'detail'=>$this->load->view('frm_subject_major',$data,TRUE));
				$this->template->write('page_header','ชื่อสาขาวิชา<i class="fa fa-fw fa-angle-double-right"></i> เพิ่มใหม่');
				$this->template->write_view('content','contents',$data);
		break;
		
		default;
		$data['Subject_major']=$this->ftps->get_subject_major();
		$data['content']=array('title'=>'รายชื่อสาขาวิชา',
								'color'=>'primary',
								'toolbar'=>$this->load->view('toolsbar',null,TRUE),
								'detail'=>$this->load->view('subject_major',$data,TRUE));
		$this->template->write('page_header','ข้อมูลพื้นฐาน<i class="fa fa-fw fa-angle-double-right"></i> สาขาวิชา');
		$this->template->write_view('content','contents',$data);
		}
		$this->template->render();
	}
	function subject()
	{
		$data['Subject']=$this->ftps->get_subject();
		$data['content']=array('title'=>'รายชื่อวิชาฝึกภาคสนาม',
								'color'=>'primary',
								'toolbar'=>$this->load->view('toolsbar',null,TRUE),
								'detail'=>$this->load->view('subject',$data,TRUE));
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','ข้อมูลพื้นฐาน<i class="fa fa-fw fa-angle-double-right"></i> รายวิชาฝึกภาคสนาม');
		$this->template->render();

	}
}