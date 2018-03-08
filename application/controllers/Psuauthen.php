<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Psuauthen extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('userinfo');
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));	
		$data['app_name']='FTPS Application';
		$data['app_desc']='ระบบสารสนเทศบริหารจัดการการศึกษาภาคสนามด้วยกระบวนการวางแผนการเดินทางอัตโนมัติ';
		$data['app_version']='Version 1.0';
		$data['app_admin_department']='ภาควิชาพัฒนาการเกษตร';
		$data['app_admin_contact']='สุดารา คล้ายมณี';
		$data['app_admin_email']='sudara.k@psu.ac.th';
		$data['app_admin_phone']='6122';
		$data['User_info']=$this->userinfo->get_active_sign_in();
		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write_view('app_info','guest/app_info',$data);
		$this->template->write_view('menu','guest/top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
	}
function index()
	{
		$this->template->add_css($this->load->view('login/frm_login.css',null,TRUE),'embed',TRUE);
		$this->template->write_view('content','login/frm_login');
		$this->template->render();
	}

function credentail()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$response=$this->authen->credential($username,$password);
		if(!$response) show_error("Login หรือ Username ไม่ถูกต้อง",403);
		elseif(!in_array($response['fac_id'],$this->config->item('system_allow_fac')))
						show_error("ระบบนี้ใช้งานกับบุคลากรของภาควิชาพัฒนาการเกษตร คณะทรัพยากรธรรมชาติเท่านั้น",403);
		else
		{	
			$this->session->set_userdata($response);
			$system_user=$this->userinfo->get_active_sign_in();
			if($system_user) 
			 redirect(base_url($system_user->level));
			else show_error('คุณไม่ได้รับสิทธิ์ในการใช้งานระบบนี้');
		}
				
	}
function signout()
{
	$session_items=array('staff_id','username','first_name','last_name','fac_id');
	$this->session->unset_userdata($session_items);
	redirect(base_url());
}

}