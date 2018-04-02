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
		$data['app_name']=$this->config->item('app_info')['app_name'];
		$data['app_desc']=$this->config->item('app_info')['app_desc'];
		$data['app_version']=$this->config->item('app_info')['app_version'];
		$data['app_admin_department']=$this->config->item('app_info')['app_admin_department'];
		$data['app_admin_contact']=$this->config->item('app_info')['app_admin_contact'];
		$data['app_admin_email']=$this->config->item('app_info')['app_admin_email'];
		$data['app_admin_phone']=$this->config->item('app_info')['app_admin_phone'];
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
	function place($action=null)
	{
		switch($action)
		{
			case 'new':
				$data['content']=array('color'=>'success',
									  'detail'=>$this->load->view('frm_place_study',null,TRUE));
				$this->template->write_view('content','contents',$data);
				$this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>เพิ่มใหม่');
			break;
		default;
		$data['content']=array('color'=>'primary',
									'size'=>9,
									'title'=>'จำนวนทั้งหมด xx สถานที่',
									'toolbar'=>'<a class="btn icon-btn btn-success add-new" href="'.base_url('staff/place/new').'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>เพิ่มใหม่</a>',
									'detail'=>$this->load->view('place_list_items',null,TRUE));
		$this->template->write_view('content','contents',$data);
		// prepare data for fillter 
		//$this->template->add_js($this->load->view('js/geo_fillter.js',null,TRUE),'embed',TRUE);
		//$fillter['status_list']=$this->trader_profile->get_status_all();
		//$fillter['geo_fillter']=$this->country_geography->get_all();
		//$fillter['product_type_fillter']=$this->base_product_type->get_all();
		$data['content']=array('title'=>"<i class='fa fa-filter fa-fw'></i>ตัวกรองข้อมูล",
								'size'=>3,
								'color'=>'success',
								'detail'=>'');
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','สถานที่ศึกษาดูงาน');
		}
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
		case 'edit':
				$data['edit_item']=$this->ftps->get_subject_major($id);
				$data['action']=base_url('staff/put/subject_major/'.$id);
				$data['content']=array('title'=>'',
				'color'=>'primary',
				//'toolbar'=>$this->load->view('toolsbar',null,TRUE),
				'detail'=>$this->load->view('frm_subject_major',$data,TRUE));
				$this->template->write('page_header','ชื่อสาขาวิชา<i class="fa fa-fw fa-angle-double-right"></i> แก้ไข');
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
	function subject($action=null,$id=null)
	{
		switch($action)
		{
			case 'new':
				$data['action']=base_url('staff/post/subject');
				$data['content']=array('title'=>'',
				'color'=>'primary',
				//'toolbar'=>$this->load->view('toolsbar',null,TRUE),
				'detail'=>$this->load->view('frm_subject',$data,TRUE));
				$this->template->write('page_header','ชื่อวิชา<i class="fa fa-fw fa-angle-double-right"></i> เพิ่มใหม่');
				$this->template->write_view('content','contents',$data);
			break;
			case 'edit':
				$data['edit_item']=$this->ftps->get_subject($id);
				$data['action']=base_url('staff/put/subject/'.$id);
				$data['content']=array('title'=>'',
				'color'=>'primary',
				//'toolbar'=>$this->load->view('toolsbar',null,TRUE),
				'detail'=>$this->load->view('frm_subject',$data,TRUE));
				$this->template->write('page_header','ชื่อวิชา<i class="fa fa-fw fa-angle-double-right"></i> แก้ไข');
				$this->template->write_view('content','contents',$data);
			break;
			default;
			$data['Subject']=$this->ftps->get_subject();
			$data['content']=array('title'=>'รายชื่อวิชาฝึกภาคสนาม',
								'color'=>'primary',
								'toolbar'=>$this->load->view('toolsbar',null,TRUE),
								'detail'=>$this->load->view('subject',$data,TRUE));
			$this->template->write_view('content','contents',$data);
			$this->template->write('page_header','ข้อมูลพื้นฐาน<i class="fa fa-fw fa-angle-double-right"></i> รายวิชาฝึกภาคสนาม');
		}
		$this->template->render();

	}
	function post($action=null)
	{
		switch($action)
		{
			case 'subject_major':
				if($this->ftps->post_subject_major())
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			break;
			case 'subject':
				if($this->ftps->post_subject())
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			break;
			default;
			show_error('ไม่สามารถดำเนินการได้');
		}

	}
	function put($action=null,$id)
	{
		switch($action)
		{
			case 'subject_major':
				if($this->ftps->put_subject_major($id))
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			break;
			case 'subject':
				if($this->ftps->put_subject($id))
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			break;
			default;
			show_error('ไม่สามารถดำเนินการได้');
		}

	}
	function delete($action=null,$id)
	{
		switch($action)
		{
			case 'subject_major':
				if($this->ftps->delete_subject_major($id))
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถลบได้');
			break;
			case 'subject':
				if($this->ftps->delete_subject($id))
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถลบได้');
			break;

			default;
			show_error('ไม่สามารถดำเนินการได้');
		}

	}
}