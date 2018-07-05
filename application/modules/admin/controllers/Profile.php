<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
class Profile extends CI_Controller{
	var $id_employee;
	var $class;
	public function __construct(){
		parent::__construct();
		$this->id_employee =  $this->session->userdata('id_employee');
		$this->class = strtolower(__CLASS__);
		$this->load->model('m_admin');
	}
	function form($setting=false){		
		$data['class'] = $this->class;
		$data['id_form'] = 'formmodal';
		$sql = $this->m_admin->get_employee(array('A.id_employee'=>$this->id_employee));
		foreach ($sql as $result)
			foreach ($result as $row=>$val){
			$data[$row] = $val;
		}
		if ($setting){
			$data['page_title']='Change Password';
			$modal = $this->load->view($this->class.'/vw_setting',$data,true);
		}else{
			$data['page_title']='Data Profile';			
			$modal = $this->load->view($this->class.'/vw_modal_profile',$data,true);
		}		
		echo json_encode(array('csrf_token'=>csrf_token()['hash'],'modal'=>$modal));
	}
	function save_setting(){
		$token = $this->input->post('token',true);
		$oldpass = $this->input->post('oldpassword',true);
		$newpass = $this->input->post('newpass',true);
		$repass = $this->input->post('repass',true);
		if (password_verify($oldpass, $token)){
			if ($newpass == $repass){
				$newpass = hash_password($newpass);
				$res = $this->m_admin->editdata('tb_employee',array('password'=>$newpass),array('id_employee'=>$this->id_employee));
				if ($res){
					$this->session->unset_userdata('admin_login');
					$this->session->set_flashdata('success','Change password success full, please login use new password');
					echo json_encode(array('error'=>0,'type'=>'redirect','url'=>base_url(MODULE.'/login')));
				}
			}else{
				echo json_encode(array('error'=>1,'type'=>'error','msg'=>'New password & Re Password not match'));
			}
		}else{
			echo json_encode(array('error'=>1,'type'=>'error','msg'=>'Old password invalid'));
		}
	}
	
}
