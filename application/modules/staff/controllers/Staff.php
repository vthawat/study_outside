<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		$userinfo=$this->session->userdata('staff_id');
		if(empty($userinfo)) redirect(base_url('psuauthen'));
		$this->load->model('userinfo');
		$this->load->model('ftps');
		$this->load->model('tmdweather');
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

		redirect(base_url('staff/calendar'));
	}
	function cars($action=null,$id=null)
	{
		switch($action)
		{
		case 'post':

				$data=$this->input->post();
				$car_record_id=$this->study_trip->post_booking_car($data,$id);
				if($car_record_id)
				{
					// create html
				//	$data['car_html_content']=$this->load->view('car_html_content',null,TRUE);
					//$car_record_html=$this->load->view('car_html_content',null,TRUE);
				//	$record_html['record_html']=$car_record_html;
				//	if($this->study_trip->put_booking_car($record_html,$car_record_id))
				//	{

					// phase variable for print pdf
					$car_record=$this->study_trip->get_car_record_by_id($car_record_id);
					$record_json=json_decode($car_record->record_json);
					$html_pdf=$this->load->view('car_html_content',null,TRUE);;
				//	$i=0;
						foreach($record_json as $key=>$value)
						{

					//		if($i==0)

						//		$html_pdf=str_replace("{".$key."}",$value,$car_record_html);
						
					//		else
								$html_pdf=str_replace("{".$key."}",$value,$html_pdf);
							
						//	$i++;
						}
						$record_html2pdf=array();
						$record_html2pdf['record_html2pdf']=$html_pdf;
						if($this->study_trip->put_booking_car($record_html2pdf,$car_record_id))
							redirect(base_url('staff/cars'));
						
				//	}
					 


				}
			//	redirect(base_url('staff/cars'));

		break;

		case 'create':
		$data['mode']='new';
		$data['action']=base_url('staff/cars/post/'.$id);
		$data['trips']=$this->study_trip->get_by_id($id);
		$data['content']=['title'=>'กรอกข้อมูลเพื่อสร้างบันทึกข้อความ',
											'color'=>'success',
											'detail'=>$this->load->view('frm_car_record',$data,TRUE)];
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','<a href="'.base_url('staff/cars').'"><i class="fa fa-fw fa-car"></i>รายการขอใช้รถ</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างบันทึกข้อความ');
		break;
		
		case 'edit_draf':
		$this->template->add_js('assets/summernote/summernote.min.js');
		$this->template->add_css('assets/summernote/summernote.css');
		$data['car_record']=$this->study_trip->get_car_record_by_id($id);
		
		$this->template->add_js($this->load->view('js/car_record_edit_html2pdf.js',$data,TRUE),'embed',TRUE);
	
		$data['content']=['title'=>'ปรับแต่งเพื่อจัดข้อความให้ได้ตามที่ต้องการ',
					'color'=>'success',
					'detail'=>$this->load->view('car_record_html_edit',$data,TRUE)];
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','<a href="'.base_url('staff/cars').'"><i class="fa fa-fw fa-car"></i>รายการออกใบข้อใช้รถ</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไขร่างบันทึกข้อความ');
		
		break;
		
		case 'edit_data':
		$data['car_record']=$this->study_trip->get_car_record_by_id($id);
		$data['mode']='edit';
		$data['action']=base_url('staff/cars/put_record_json/'.$id);
		$data['content']=['title'=>'ข้อมูลบันทึกขอความการขอใช้รถ',
										'color'=>'primary',
										'detail'=>$this->load->view('frm_car_record',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
				$this->template->write('page_header','<a href="'.base_url('staff/cars').'"><i class="fa fa-fw fa-car"></i>รายการออกใบข้อใช้รถ</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไขข้อมูล');	
		break;
		case 'put_record_json':
				$data['record_json']=json_encode($this->input->post());

				if($this->study_trip->put_booking_car($data,$id))
					/** update phase variable html2pdf */
				{
					
					$car_record=$this->study_trip->get_car_record_by_id($id);
				
									
					$record_json=json_decode($car_record->record_json);
					$html_pdf=$this->load->view('car_html_content',null,TRUE);
				//	$i=0;
						foreach($record_json as $key=>$value)
						{

						//	if($i==0)

						//		$html_pdf=str_replace("{".$key."}",$value,$car_record->record_html);
						
						//	else
								$html_pdf=str_replace("{".$key."}",$value,$html_pdf);
							
						//	$i++;
						}
						$record_html2pdf=array();
						$record_html2pdf['record_html2pdf']=$html_pdf;
						if($this->study_trip->put_booking_car($record_html2pdf,$id))
							redirect(base_url('staff/cars'));


				}
				else show_error('ไม่สามารถบันทึกได้');
		break;
		case 'put_record_html2pdf':
		// update draf layout
				$data=$this->input->post();
				if($this->study_trip->put_booking_car($data,$id))
				 print 'ok';
				else print 'no';
			exit();
	
		break;

		default: /** แสดงรายการขอใช้รถทั้งหมด */
		$data['trip_cars']=$this->study_trip->get_car_record_with_trip();
		$data['content']=['title'=>'รายการบันทึกข้อความ การขอใช้รถในการเดินทาง',
											'color'=>'primary',
											'detail'=>$this->load->view('car_item_list',$data,TRUE)];
		$this->template->write_view('content','contents',$data);
		
		$this->template->write('page_header','<i class="fa fa-fw fa-car"></i>รายการออกใบข้อใช้รถ');	
	
	}
		$this->template->render();
		
	}
	
	function test()
	{
		$mpdf = new \Mpdf\Mpdf();
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdf = new \Mpdf\Mpdf([
			'fontDir' => array_merge($fontDirs, [
				realpath('assets/fonts'),
			]),
			'fontdata' => $fontData + [
				'thsarabun' => [
					'R' => 'THSarabunNew.ttf',
					'I' => 'THSarabunNew Italic.ttf',
					'B' => 'THSarabunNew Bold.ttf',
				]
			],
			'default_font' => 'thsarabun',
			'mode' => 'utf-8',
			'format' => 'A4',
		]);
		

			$html=$this->load->view('car_record_html2pdf',null,TRUE);
			$mpdf->WriteHTML($html);
	//	$mpdf->WriteHTML('<h1>ทดสอบ Hello world!</h1>');

		$mpdf->Output();
	}
	function printCarPdf($id=null)
	{
		//print realpath('assets/fonts');
		$mpdf = new \Mpdf\Mpdf();
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdf = new \Mpdf\Mpdf([
			'fontDir' => array_merge($fontDirs, [
				realpath('assets/fonts'),
			]),
			'fontdata' => $fontData + [
				'thsarabun' => [
					'R' => 'THSarabunNew.ttf',
					'I' => 'THSarabunNew Italic.ttf',
					'B' => 'THSarabunNew Bold.ttf',
				]
			],
			'default_font' => 'thsarabun',
			'mode' => 'utf-8',
			'format' => 'A4',
		]);
	//	$html='';
		$car_record=$this->study_trip->get_car_record_by_id($id);
		//*** variable for header section */
	
		$record_json=json_decode($car_record->record_json);
		$data['car_html_content']=$car_record->record_html2pdf;
		$html_pdf=$this->load->view('car_record_html2pdf',$data,TRUE);
		//$i=0;
			foreach($record_json as $key=>$value)
			{

			//	if($i==0)

				//	$html_pdf=str_replace("{".$key."}",$value,$);
			
			//	else
					$html_pdf=str_replace("{".$key."}",$value,$html_pdf);
				
			//	$i++;
			}
		

			$mpdf->WriteHTML($html_pdf);
			$mpdf->Output('บันทึกข้อความ-การขอใช้รถ.pdf','I');
		
	}
	function calendar()
	{
		
		$this->template->write('page_header','<i class="fa fa-fw fa-calendar"></i>ปฏิทินการเดินทาง');
		$this->template->add_js('assets/pace/pace.min.js');
		$this->template->add_css($this->load->view('css/pace.css',null,TRUE),'embed',TRUE);
		$this->template->add_js('assets/fullcalendar-3.10.0/lib/moment.min.js');
		$this->template->add_js('assets/fullcalendar-3.10.0/fullcalendar.min.js');
		$this->template->add_js('assets/fullcalendar-3.10.0/locale/th.js');
		$this->template->add_css('assets/fullcalendar-3.10.0/fullcalendar.min.css');
		$this->template->add_js($this->load->view('js/calendar.js',null,TRUE),'embed',TRUE);
		$this->template->write_view('content','calendar');
		$this->template->render();
	
	}
	function get_calendar_events()
	{
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($this->study_trip->get_trip_show_oncalendar());
	}
	function calendar_trip_details($id=null)
	{	
		$data['student_list']=$this->study_trip->get_student_list_by_trip_id($id);
		$data['student_list']=$this->load->view('student_list_view',$data,TRUE);
		$data['trips']=$this->study_trip->get_by_id($id);
		$data['schedule']=$this->study_trip->get_schedule_plan_by_trip_id($id);
		$data['force_casts']=$this->load->view('schedule_weather_json_to_html',$data,TRUE);
		$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
		$data["content"]=["title"=>'<h3 class="thai-font">รายละเอียดการเดินทางของ'.$title.'<h3>',
											"color"=>"success",
											"detail"=>$this->load->view('trip_details_tabs',$data,TRUE)];
		print $this->load->view('contents',$data,TRUE);
	}
	function student($action=null,$id)
	{
		switch($action)
		{
			case 'new':
				$this->template->write('page_header','<a href="'.base_url('staff/trip/student/'.$id).'"><i class="fa fa-fw fa-calendar-check-o"></i>รายชื่อผู้ร่วมเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>เพิ่มใหม่');
				$data['action']=base_url('staff/post/student/'.$id);
				$data['content']=['title'=>'เพิ่มรายชื่อผู้ร่วมเดินทาง',
								  'detail'=>$this->load->view('frm_student',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			
				break;
			case 'edit':
					$data['edit_item']=$this->study_trip->get_student_list_by_id($id);
					$this->template->write('page_header','<a href="'.base_url('staff/trip/student/'.$data['edit_item']->period_trip_id).'"><i class="fa fa-fw fa-calendar-check-o"></i>รายชื่อผู้ร่วมเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
					$data['action']=base_url('staff/put/student/'.$id);
					$data['content']=['title'=>'แก้ไขรายชื่อผู้ร่วมเดินทาง',
										'detail'=>$this->load->view('frm_student',$data,TRUE)];
					$this->template->write_view('content','contents',$data);
			break;
		
		}

		$this->template->render();
	}
	function trip($action=null,$id=null)
	{
		switch($action)
		{
			case 'new': /** กำหนดความต้องการเดินทาง */
				$this->template->add_js('assets/datepicker/bootstrap-datepicker.js');
				$this->template->add_js('assets/datepicker/locales/bootstrap-datepicker.th.js');
				$this->template->add_css('assets/datepicker/datepicker3.css');
				$this->template->add_js($this->load->view('js/datepicker.js',null,TRUE),'embed',TRUE);
				$this->template->write('page_header','<a href="../trip"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างใหม่');
				$data['action']=base_url('staff/post/trip');
				$data['Subject_list']=$this->ftps->get_subject();
				$data['Subject_major']=$this->ftps->get_subject_major();
				$data['EndLocationList']=$this->province->get_province_of_place();
				$data['Knowledge_item']=$this->study_place->get_knowledge_group_by_name();
				$data['content']=['title'=>'',
								  'detail'=>$this->load->view('frm_trip',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			break;
			case 'edit': /** แก้ไขความต้องการเดินทาง */
				$this->template->add_js('assets/datepicker/bootstrap-datepicker.js');
				$this->template->add_js('assets/datepicker/locales/bootstrap-datepicker.th.js');
				$this->template->add_css('assets/datepicker/datepicker3.css');
				$this->template->add_js($this->load->view('js/datepicker.js',null,TRUE),'embed',TRUE);
				$this->template->write('page_header','<a href="../trip"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
				$data['edit_item']=$this->study_trip->get_by_id($id);
				$data['action']=base_url('staff/put/trip/'.$id);
				$data['Subject_list']=$this->ftps->get_subject();
				$data['Subject_major']=$this->ftps->get_subject_major();
				$data['EndLocationList']=$this->province->get_province_of_place();
				$data['Knowledge_item']=$this->study_place->get_knowledge_group_by_name();
				$data['content']=['title'=>'',
								  'detail'=>$this->load->view('frm_trip',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			break;
			case 'waypoint':  /**  เลือกสถานที่และสร้างเส้นทางอัตโนมัติ */
			$data['trips']=$this->study_trip->get_by_id($id);
			//load map
			$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&language=th','link');
			$this->template->add_js('assets/gmaps/js/gmap3.js');
			$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/modal.js',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/map-waypoint.js',$data,TRUE),'embed',TRUE);
			$this->template->write('page_header','<a href="../trip/"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างเส้นทางอัตโนมัติ');
			$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
			$data['place_relation']=$this->study_trip->suggest_location($id);
			$data['content']=['title'=>$title,
							  'color'=>'primary',
							  'detail'=>$this->load->view('waypoint-place',$data,TRUE)];
			$this->template->write_view('content','contents',$data);
			break;
			
			case 'custom_route': //** ปรับแต่งเส้นทางเอง **/
			$data['trips']=$this->study_trip->get_by_id($id);
						//load map
			$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&language=th','link');
			//$this->template->add_js('assets/gmaps/js/gmap3.js');
			$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
			$this->template->add_js('assets/sortable/jquery-sortable-min.js');
			//$this->template->add_js($this->load->view('js/place_sortable.js',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/map-waypoint-custom.js',$data,TRUE),'embed',TRUE);
			$this->template->add_css($this->load->view('css/sortable.css',null,TRUE),'embed',TRUE);
				$data['trips']=$this->study_trip->get_by_id($id);
				$this->template->write('page_header','<a href="../trip/"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>ปรับแต่งเส้นทางด้วยตนเอง');
				//$data['place_selected']=$this->study_trip->suggest_location($id);
				$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
				$data['content']=['title'=>$title,
								  'color'=>'primary',
								  'detail'=>$this->load->view('waypoint-custom',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			
			break;

			case 'schedule': /** กำหนดการเดินทางอัตโนมัติ */
			//load map
			$data['trips']=$this->study_trip->get_by_id($id);
			$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&libraries=places&language=th','link');
			$this->template->add_js('assets/gmaps/js/gmap3.js');
			$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/modal-place-rest.js',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/schedule.js',$data,TRUE),'embed',TRUE);
			$data['trips']=$this->study_trip->get_by_id($id);
			$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
			$this->template->write('page_header','<a href="'.base_url('staff/trip/edit/'.$id).'"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i><a href="'.base_url('staff/trip/custom_route/'.$id).'">ปรับแต่งเส้นทาง</a><i class="fa fa-fw fa-angle-double-right"></i>สร้างตารางกำหนดการเดินทาง');
			$data['content']=['title'=>$title,
							  'color'=>'primary',
							  'detail'=>$this->load->view('schedule',$data,TRUE)];
			$this->template->write_view('content','contents',$data);			
			break;
			case 'custom_schedule': /** ปรับแต่งกำหนดการด้วยตนเอง */
			$data['trips']=$this->study_trip->get_by_id($id);
			
	
			/*$this->template->add_js('assets/froala/js/froala_editor.min.js');
			$this->template->add_js('assets/froala/js/froala_editor.pkgd.min.js');
				$this->template->add_css('assets/froala/css/froala_editor.min.css');
				$this->template->add_css('assets/froala/css/froala_editor.pkgd.min.css');
				*/
				$this->template->add_js('assets/summernote/summernote.min.js');
				$this->template->add_css('assets/summernote/summernote.css');

				$this->template->add_js($this->load->view('js/schedule-editor.js',$data,TRUE),'embed',TRUE);
				$data['trips']=$this->study_trip->get_by_id($id);
				$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
				$this->template->write('page_header','<a href="'.base_url('staff/trip').'"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>ปรับแต่งกำหนดการเดินทางด้วยตนเอง');
				$data['schedule']=$this->study_trip->get_schedule_plan_by_trip_id($id);
				if(empty($data['schedule']->schedule_html))
				    // load schedule from json
					$data['schedule_html']=$this->load->view('schedule_json_to_html',$data,TRUE);
				else
				   // load schedule from html
					$data['schedule_html']=$data['schedule']->schedule_html;
				$data['content']=['title'=>$title,
				'color'=>'primary',
				'detail'=>$this->load->view('schedule_custom',$data,TRUE)];
				$this->template->write_view('content','contents',$data);

			break;
			case 'upload_student':  /** upload excel student list */
			if (isset($_POST["import"]))
			{
				$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
				if(in_array($_FILES["excel_student"]["type"],$allowedFileType))
				{
						// start upload file
						$targetPath = 'excel_student/'.$_FILES['excel_student']['name'];
						move_uploaded_file($_FILES['excel_student']['tmp_name'], $targetPath);

						// start read from excel file
						$inputFileName = realpath($targetPath);
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
				$sheetData=$spreadsheet->getActiveSheet();
					 // drop all record studen_list by id
					 $this->study_trip->delete_all_student_list_by_trip_id($id);


					 $r=0;
					 foreach ($sheetData->getRowIterator() AS $row)
					 {
								if($r>1)
								{
									$cellIterator = $row->getCellIterator();
									$cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
									$student_item=[]; // set data for keep new row
									foreach ($cellIterator as $col=>$cell)
												{
													
															$student_item['period_trip_id']=$id;
															if($col=="A") $student_item['std_code']=$cell->getValue();
															if($col=="B") $student_item['first_name']=$cell->getValue();
															if($col=="C") $student_item['last_name']=$cell->getValue();
															if($col=="D") $student_item['comment']=$cell->getValue();
															
												}
											//	print_r($student_item);	
											// insert 
											$this->study_trip->post_student_list($student_item);
								
								}
						$r++;
					}
					// finish import
					redirect(base_url('staff/trip/student/'.$id));

				}
				else show_error("ต้องเป็นไฟล์ Excel,*.xls , *.xlsx");

			}
			else show_error("ไม่พบไฟล์ที่จะ Upload");

			break;

			case 'student':  /***  จัดการรายชื่อนักศึกษา */

				$this->template->add_css($this->load->view('css/student-upload.css',null,TRUE),'embed',TRUE);
				$data['student_list']=$this->study_trip->get_student_list_by_trip_id($id);
				$title='รายวิชา '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_code.' '.$this->ftps->get_subject($this->study_trip->get_by_id($id)->subject_list_id)->subject_name;
				$this->template->write('page_header','<a href="'.base_url('staff/trip').'"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a><i class="fa fa-fw fa-angle-double-right"></i>รายชื่อผู้ร่วมเดินทาง');
				$data['content']=['title'=>$title,
				'toolbar'=>'<form method="post" action="'.base_url("staff/trip/upload_student/".$id).'" enctype="multipart/form-data"><div class="form-group"><input class="form-control-file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excel_student" required /><button type="submit" name="import" class="btn icon-btn btn-warning upload-excel"><span class="btn-glyphicon fa fa-arrow-circle-up img-circle text-black"></span>Upload</button> <a class="btn icon-btn btn-primary" href="'.base_url('staff/calendar').'"><span class="btn-glyphicon fa fa-calendar-o img-circle text-blue"></span>ปฏิทินการเดินทาง</a> <a class="btn icon-btn btn-success add-new" href="'.base_url('staff/student/new/'.$id).'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>เพิ่มรายชื่อ</a></div></form>',
				'color'=>'primary',
				'detail'=>$this->load->view('student',$data,TRUE)];
				$this->template->write_view('content','contents',$data);
			

			break;
 
		default: /** แสดงรายการความต้องการเดินทางทั้งหมด */
		
		$this->template->add_js('uiux/web/vendors/AdminLTE/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('uiux/web/vendors/AdminLTE/plugins/datatables/dataTables.bootstrap.js');
		$this->template->add_css('uiux/web/vendors/AdminLTE/plugins/datatables/dataTables.bootstrap.css');
		$this->template->add_js($this->load->view('js/data-table-trips.js',null,TRUE),'embed',TRUE);
		$data['Trip_list']=$this->study_trip->get_all();
		$data['content']=['title'=>'รายการความต้องการเดินทาง',
						  'color'=>'success',
						  'toolbar'=>'<a class="btn icon-btn btn-primary" href="'.base_url('staff/calendar').'"><span class="btn-glyphicon fa fa-calendar-o img-circle text-blue"></span>ปฏิทินการเดินทาง</a> <a class="btn icon-btn btn-success add-new" href="'.base_url('staff/trip/new').'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>สร้างใหม่</a>',
						  'detail'=>$this->load->view('trip',$data,TRUE)];
		$this->template->write_view('content','contents',$data);
		$this->template->write('page_header','<a href="trip"><i class="fa fa-fw fa-calendar-check-o"></i>ความต้องการเดินทาง</a>');
		}
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
	function json_get_end_time(){
		$duration=$this->input->get('duration');
		$start_time=$this->input->get('start_time');
		print $this->study_trip->schedule_time_shift($start_time,$duration);
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
				$this->template->write('page_header','<a href="'.base_url('staff/place').'">สถานที่ศึกษาดูงาน</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
			
			break;
			case 'knowledge':
				 $this->template->write('page_header','<a href="'.base_url('staff/place').'">สถานที่ศึกษาดูงาน</a><i class="fa fa-fw fa-angle-double-right"></i>องค์ความรู้ของสถานที่');
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
				$this->template->write('page_header','<a href="'.base_url('staff/place').'">สถานที่ศึกษาดูงาน</a><i class="fa fa-fw fa-angle-double-right"></i>องค์ความรู้ของสถานที่<i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
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
/*** PLACE REST */
function place_rest($action=null,$place_id=null)
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
			$data['action']=base_url('staff/post/place_rest');
			$data['Province']=$this->province->get_province_of_place();
			$data['content']=array('color'=>'success',
									'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
								  'detail'=>$this->load->view('frm_place_rest',$data,TRUE));
			$this->template->write_view('content','contents',$data);
			$this->template->write('page_header','สถานที่พักค้างคืน<i class="fa fa-fw fa-angle-double-right"></i>เพิ่มใหม่');
		break;
		case 'edit':
			// map helpers
			$this->template->add_js('https://maps.google.com/maps/api/js?key=AIzaSyBGE-KGQB9PP6uq4wErMO0Xbxmz4FWxy3Q&libraries=places&language=th','link');
			$this->template->add_js('assets/gmaps/js/locationpicker.jquery.min.js');
			$this->template->add_css($this->load->view('css/map.css',null,TRUE),'embed',TRUE);
			$this->template->add_js($this->load->view('js/place-search.js',null,TRUE),'embed',TRUE);
			//
			$this->template->add_js($this->load->view('js/select-box.js',null,TRUE),'embed',TRUE);
			
			$data['edit_item']=$this->study_place_rest->get_by_id($place_id);
			$data['action']=base_url('staff/put/place_rest/'.$place_id);
			$data['Province']=$this->province->get_province_of_place();
			$data['content']=array('color'=>'success',
									'toolbar'=>'<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>',
								  'detail'=>$this->load->view('frm_place_rest',$data,TRUE));
			$this->template->write_view('content','contents',$data);
			$this->template->write('page_header','<a href="'.base_url('staff/place_rest').'">สถานที่พักค้างคืน</a><i class="fa fa-fw fa-angle-double-right"></i>แก้ไข');
		
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
				$filter['study_place_rest.province_id']=$this->input->post('province_id');
				$filter['study_place_rest.amphur_id']=$this->input->post('amphur_id');
				$filter['study_place_rest.district_id']=$this->input->post('district_id');
				//$filter['study_place_major_list.subject_major_id']=$this->input->post('subject_major_id');
				//exit(print_r($this->input->post('knowledge_id')));
				//$filter['khowledge_items.id']=$this->input->post('knowledge_id');
			}
			$limit=5;
			$data['place_rest']=$this->study_place_rest->get_all($filter,$limit,$this->input->get('page'));
			$config['total_rows'] = count($this->study_place_rest->get_all($filter));
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
								'title'=>'จำนวนทั้งหมด '.count($this->study_place_rest->get_all()).' สถานที่',
								'toolbar'=>'<a class="btn icon-btn btn-success add-new" href="'.base_url('staff/place_rest/new').'"><span class="btn-glyphicon fa fa-plus img-circle text-success"></span>เพิ่มใหม่</a>',
								'detail'=>$this->load->view('place_rest_items',$data,TRUE));
	$this->template->write_view('content','contents',$data);
	// prepare data for fillter 
	$this->template->add_js($this->load->view('js/select-box.js',null,TRUE),'embed',TRUE);
	$this->template->add_js($this->load->view('js/modal.js',null,TRUE),'embed',TRUE);
	$data['provice_list']=$this->province->get_province_of_place();
	//$data['Subject_major']=$this->ftps->get_subject_major();
	//$data['Knowledge_item']=$this->study_place->get_knowledge_group_by_name();
	$data['content']=array('title'=>"<i class='fa fa-filter fa-fw'></i>ตัวกรองข้อมูล",
							'size'=>3,
							'color'=>'success',
							'detail'=>$this->load->view('place_rest_filter',$data,TRUE));
	$this->template->write_view('content','contents',$data);
	$this->template->write('page_header','สถานที่พักค้างคืน');
	}
	$this->template->render();
}
function place_rest_detail($place_id=null)
{

	// render for modal
	$data['item']=$this->study_place_rest->get_by_id($place_id);
	$data['content']=array('color'=>'primary',
							'title'=>'<h3 class="text-success thai-webfont"><i class="fa fa-fw fa-home"></i>'.$this->study_place_rest->get_by_id($place_id)->place_name.'</h3>',
							'detail'=>$this->load->view('place_rest_details',$data,TRUE));
	
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
	function post($action=null,$id=null)
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
			case 'place_rest':					
					if($this->study_place_rest->post())
					redirect(base_url('staff/'.$action));
					else show_error('ไม่สามารถบันทึกได้');
			break;			
			case 'knowledge':
				if($this->study_place->post_knowledge($id))
				redirect(base_url('staff/place/'.$action.'/'.$id),'refresh');
				else show_error('ไม่สามารถบันทึกได้');
			
			break;
			case 'trip':
			//exit(print_r($this->input->post()));
			 if(!empty($this->input->post('subject_major_selected'))&&!empty($this->input->post('knowledge_selected'))&&!empty($this->input->post('subject_list_id'))&&!empty($this->input->post('start_date')))
				{
					$trip_id=$this->study_trip->post_trip();	
					if($trip_id)
							redirect(base_url('staff/'.$action.'/waypoint/'.$trip_id));
						else show_error('ไม่สามารถบันทึกได้');
				}
			else show_error('กรอกข้อมูลยังไม่สมบูรณ์');
			break;
			case 'schedule':
			//print_r($this->input->post('schedule_json'));
				$data=array();
				$data['schedule_json']=json_encode($this->input->post('schedule_json'));
				$data['period_trip_id']=$id;
				if($this->study_trip->post_schedule($data)) print "ok";
				//else print 'no';			
			break;
			case 'student':
					$data=$this->input->post();
					$data['period_trip_id']=$id;
					if($this->study_trip->post_student_list($data))
					 redirect(base_url('staff/trip/student/'.$id));
					else show_error('ไม่สามารถบันทึกได้');
				//	print_r($data);

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
			case 'place_rest':
			if($this->study_place_rest->put($id))
			redirect(base_url('staff/'.$action));
			else show_error('ไม่สามารถบันทึกได้');
		break;
			case 'knowledge':
				if($this->study_place->put_knowledge($id))
					redirect(base_url('staff/place/'.$action.'/'.$this->study_place->get_knowledge_by_id($id)->study_place_id));
				else show_error('ไม่สามารถบันทึกได้');

			break;
			case 'trip':
			if(!empty($this->input->post('subject_major_selected'))&&!empty($this->input->post('knowledge_selected'))&&!empty($this->input->post('subject_list_id'))&&!empty($this->input->post('start_date')))
				if($this->study_trip->put_trip($id))
				//redirect(base_url('staff/'.$action.'/waypoint/'.$id));
				redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถบันทึกได้');
			else show_error('กรอกข้อมูลยังไม่สมบูรณ์');
			break;
			case 'place_selected':
				print $this->study_trip->put_place_selected($id);
			break;
			case 'place_ordering':
			print $this->study_trip->place_ordering($id);
		break;
			case 'trip_routing':
				print $this->study_trip->put_trip_routing($id);
	
			break;
			case 'schedule':
			
				$data=array();
				$data['schedule_html']=$this->input->post('schedule_html');
				$data['period_trip_id']=$id;
				if($this->study_trip->put_schedule($data)) print "success";
				else print 'fail';

			break;

			case 'student':
				$data=$this->input->post();
				$period_trip_id=$this->study_trip->get_student_list_by_id($id)->period_trip_id;
				if($this->study_trip->put_student_list($data,$id))
					redirect(base_url('staff/trip/student/'.$period_trip_id));
				else show_error('ไม่สามารถบันทึกได้');
			break;

			case 'car_record_json':
					$data=$this->input->post();
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
			case 'place_rest':
			if($this->study_place_rest->delete($id))
				redirect(base_url('staff/'.$action));
			else show_error('ไม่สามารถลบได้');
		break;
			case 'knowledge':
				$study_place_id=$this->study_place->delete_knowledge($id);
				if($study_place_id)
					redirect(base_url('staff/place/'.$action.'/'.$study_place_id));
				else show_error('ไม่สามารถลบได้');
			break;
			case 'trip':
				if($this->study_trip->delete($id)) 
					redirect(base_url('staff/'.$action));
				else show_error('ไม่สามารถลบได้');
			break;
			case 'student':
			$is_delete=$this->study_trip->delete_student_list_by_id($id);
				if($is_delete) 
					redirect(base_url('staff/trip/'.$action.'/'.$is_delete));
				else show_error('ไม่สามารถลบได้');
			break;			
			default;
			show_error('ไม่สามารถดำเนินการได้');
		}

	}
}