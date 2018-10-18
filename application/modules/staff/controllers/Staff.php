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
	function calendar()
	{
		$this->template->render();
	}
	function trip($action=null,$id=null)
	{
		switch($action)
		{
			case 'new':
				$this->template->add_js('assets/datepicker/bootstrap-datepicker.js');
				$this->template->add_js('assets/datepicker/locales/bootstrap-datepicker.th.js');
				$this->template->add_css('assets/datepicker/datepicker3.css');
				$this->template->add_js($this->load->view('js/datepicker.js',null,TRUE),'embed',TRUE);
				$this->template->write('page_header','<a href="../trip"><i class="fa fa-fw fa-calendar-check-o"></i>กำหนดการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างใหม่');
				$data['action']=base_url('staff/post/trip');
				$data['Subject_list']=$this->ftps->get_subject();
				$data['Subject_major']=$this->ftps->get_subject_major();
				$data['EndLocationList']=$this->province->get_all();
				$data['Knowledge_item']=$this->study_place->get_knowledge_group_by_name();
				$data['content']=['title'=>'',
								  'detail'=>$this->load->view('frm_trip',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			break;
			case 'waypoint':
			$this->template->write('page_header','<a href="../trip"><i class="fa fa-fw fa-calendar-check-o"></i>กำหนดการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างเส้นทาง');
			$title=$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
			$data['content']=['title'=>$title,
							  'color'=>'primary'];
			$this->template->write_view('content','contents',$data);
			break;

		default:
		$data['Trip_list']=$this->study_trip->get_all();
		$data['content']=['title'=>'รายการกำหนดการเดินทาง',
						  'color'=>'success',
						  'toolbar'=>'<a class="btn icon-btn btn-success add-new" href="'.base_url('staff/trip/new').'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>สร้างใหม่</a>',
						  'detail'=>$this->load->view('trip',$data,TRUE)];
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','<a href="trip"><i class="fa fa-fw fa-calendar-check-o"></i>กำหนดการเดินทาง</a>');
		}
		$this->template->render();	
	}
	function cars()
	{

		$this->template->render();
		
	}
	function report()
	{

		$this->template->render();
		
	}
	function json_get_amphur_by_province_id($province_id)
	{
		$amphur=array();
		foreach($this->amphur->get_by_province_id($province_id) as $item)
			array_push($amphur,array('id'=>$item->AMPHUR_ID,'amphur_name'=>$item->AMPHUR_NAME));
		print json_encode($amphur);
	}
	function json_get_district_by_amphur_id($amphur_id)
	{
		$district=array();
		foreach($this->district->get_by_amphur_id($amphur_id) as $item)
			array_push($district,array('id'=>$item->DISTRICT_ID,'district_name'=>$item->DISTRICT_NAME));
		print json_encode($district);
	}
	function place($action=null,$place_id=null)
	{
		switch($action)
		{
			case 'new':
				// map helpers
				$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&libraries=places&language=th','link');
				$this->template->add_js('assets/gmaps/js/locationpicker.jquery.min.js');
				$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
				$this->template->add_js($this->load->view('js/place-search.js',null,TRUE),'embed',TRUE);
				//
				$this->template->add_js($this->load->view('js/select-box.js',null,TRUE),'embed',TRUE);
				$data['Subject_major']=$this->ftps->get_subject_major();
				$data['action']=base_url('staff/post/place');
				$data['Province']=$this->province->get_all();
				$data['content']=array('color'=>'success',
										'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
									  'detail'=>$this->load->view('frm_place_study',$data,TRUE));
				$this->template->write_view('content','contents',$data);
				$this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>เพิ่มใหม่');
			break;
			case 'edit':
				// map helpers
				$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&libraries=places&language=th','link');
				$this->template->add_js('assets/gmaps/js/locationpicker.jquery.min.js');
				$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
				$this->template->add_js($this->load->view('js/place-search.js',null,TRUE),'embed',TRUE);
				//
				$this->template->add_js($this->load->view('js/select-box.js',null,TRUE),'embed',TRUE);
				
				$data['edit_item']=$this->study_place->get_by_id($place_id);
				$data['Subject_major']=$this->ftps->get_subject_major();
				$data['action']=base_url('staff/put/place/'.$place_id);
				$data['Province']=$this->province->get_all();
				$data['content']=array('color'=>'success',
										'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
									  'detail'=>$this->load->view('frm_place_study',$data,TRUE));
				$this->template->write_view('content','contents',$data);
				$this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
			
			break;
			case 'knowledge':
				 $this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>องค์ความรู้ของสถานที่');
				 $place=$this->study_place->get_by_id($place_id);
				 $data['knowledge_items']=$this->study_place->get_knowledge_by_study_place_id($place_id);
				 $data['Place']=$place;
				 $data['content']=array('color'=>'success',
										 'title'=>$place->place_name.' อ.'.$place->AMPHUR_NAME.' จ.'.$place->PROVINCE_NAME,
										 'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a> <a class="btn icon-btn btn-success add-new" href="'.base_url('staff/place/new_knowled/'.$place_id).'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>เพิ่มใหม่</a>',
										'detail'=>$this->load->view('knowledge_list',$data,TRUE));
				$this->template->write_view('content','contents',$data);				
			break;
			case 'new_knowled':
				$this->template->add_css($this->load->view('css/upload_knowledge_image.css',null,TRUE),'embed',TRUE);
				$this->template->add_js($this->load->view('js/upload_knowledge_image.js',null,TRUE),'embed',TRUE);
				$place=$this->study_place->get_by_id($place_id);
				$this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>องค์ความรู้ของสถานที่<i class="fa fa-fw fa-angle-double-right"></i>เพิ่มใหม่');
				$data['action']=base_url('staff/post/knowledge/'.$place_id);
				$data['content']=array('color'=>'success',
				'title'=>$place->place_name.' อ.'.$place->AMPHUR_NAME.' จ.'.$place->PROVINCE_NAME,
				'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
			   'detail'=>$this->load->view('frm_knowledge',$data,TRUE));
				$this->template->write_view('content','contents',$data);	
				break;
			case 'edit_knowledge':
				$this->template->add_css($this->load->view('css/upload_knowledge_image.css',null,TRUE),'embed',TRUE);
				$this->template->add_js($this->load->view('js/upload_knowledge_image.js',null,TRUE),'embed',TRUE);
				$place=$this->study_place->get_by_id($this->study_place->get_knowledge_by_id($place_id)->study_place_id);
				$this->template->write('page_header','สถานที่ศึกษาดูงาน<i class="fa fa-fw fa-angle-double-right"></i>องค์ความรู้ของสถานที่<i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
				$data['edit_item']=$this->study_place->get_knowledge_by_id($place_id);
				$data['action']=base_url('staff/put/knowledge/'.$place_id);
				$data['content']=array('color'=>'success',
				'title'=>$place->place_name.' อ.'.$place->AMPHUR_NAME.' จ.'.$place->PROVINCE_NAME,
				'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
			   'detail'=>$this->load->view('frm_knowledge',$data,TRUE));
				$this->template->write_view('content','contents',$data);
			break;

		default;
		$this->load->library('pagination');
		//load map
		$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&libraries=places&language=th','link');
		$this->template->add_js('assets/gmaps/js/gmap3.js');
		$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
		//$this->template->add_js($this->load->view('js/view-big-map.js',null,TRUE),'embed',TRUE);
		$filter=array();
				if(!empty($this->input->post()))
				{ 
					$filter['study_place.province_id']=$this->input->post('province_id');
					$filter['study_place.amphur_id']=$this->input->post('amphur_id');
					$filter['study_place.district_id']=$this->input->post('district_id');
					$filter['study_place_major_list.subject_major_id']=$this->input->post('subject_major_id');
					//exit(print_r($this->input->post('knowledge_id')));
					$filter['khowledge_items.id']=$this->input->post('knowledge_id');
				}
				$limit=5;
				$data['Study_place']=$this->study_place->get_all($filter,$limit,$this->input->get('page'));
				$config['total_rows'] = count($this->study_place->get_all($filter));
				$config['per_page'] = $limit;
				//$config['suffix'] ="&filter=".$filter;
				$config['query_string_segment']="page";
			//	$config['use_page_numbers'] = TRUE; 
				$config['first_url'] =base_url('staff/place');
				$config['num_links'] = 10;
				$config['page_query_string'] = TRUE;
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$this->pagination->initialize($config);
		$data['content']=array('color'=>'primary',
									'size'=>9,
									'title'=>'จำนวนทั้งหมด '.count($this->study_place->get_all()).' สถานที่',
									'toolbar'=>'<a class="btn icon-btn btn-success add-new" href="'.base_url('staff/place/new').'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>เพิ่มใหม่</a>',
									'detail'=>$this->load->view('place_list_items',$data,TRUE));
		$this->template->write_view('content','contents',$data);
		// prepare data for fillter 
		$this->template->add_js($this->load->view('js/select-box.js',null,TRUE),'embed',TRUE);
		$this->template->add_js($this->load->view('js/modal.js',null,TRUE),'embed',TRUE);
		$data['provice_list']=$this->province->get_province_of_place();
		$data['Subject_major']=$this->ftps->get_subject_major();
		$data['Knowledge_item']=$this->study_place->get_knowledge_group_by_name();
		$data['content']=array('title'=>"<i class='fa fa-filter fa-fw'></i>ตัวกรองข้อมูล",
								'size'=>3,
								'color'=>'success',
								'detail'=>$this->load->view('place_filter',$data,TRUE));
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','สถานที่ศึกษาดูงาน');
		}
		$this->template->render();
	}
	function place_detail($place_id=null)
	{
	
		// render for modal
		$data['knowledge_items']=$this->study_place->get_knowledge_by_study_place_id($place_id);
		$data['view_knowledge']=$this->load->view('knowledge_list',$data,TRUE);
		$data['item']=$this->study_place->get_by_id($place_id);
		$data['content']=array('color'=>'primary',
								'title'=>'<h3 class="text-success thai-webfont"><i class="fa fa-fw fa-map-pin"></i>'.$this->study_place->get_by_id($place_id)->place_name.'</h3>',
								'detail'=>$this->load->view('place_details',$data,TRUE));
		
		print $this->load->view('contents',$data,TRUE);
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
	function post($action=null,$study_place_id=null)
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
			case 'place':					
					if($this->study_place->post())
					redirect(base_url('staff/'.$action));
					else show_error('ไม่สามารถบันทึกได้');
			break;
			case 'knowledge':
				if($this->study_place->post_knowledge($study_place_id))
				redirect(base_url('staff/place/'.$action.'/'.$study_place_id),'refresh');
				else show_error('ไม่สามารถบันทึกได้');
			
			break;
			case 'trip':
				if($this->study_trip->post_trip())
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
			case 'place':
				if($this->study_place->put($id))
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			break;
			case 'knowledge':
				if($this->study_place->put_knowledge($id))
					redirect(base_url('staff/place/'.$action.'/'.$this->study_place->get_knowledge_by_id($id)->study_place_id));
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
			case 'place':
				if($this->study_place->delete($id))
					redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถลบได้');
			break;
			case 'knowledge':
				$study_place_id=$this->study_place->delete_knowledge($id);
				if($study_place_id)
					redirect(base_url('staff/place/'.$action.'/'.$study_place_id));
				else show_error('ไม่สามารถลบได้');
			break;
			default;
			show_error('ไม่สามารถดำเนินการได้');
		}

	}
}