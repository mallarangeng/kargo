<?php if (!defined('BASEPATH')) exit('No Direct script access allowed');
class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->m_admin->maintenance();
	}
	function index(){
		(!$this->session->userdata('admin_login')) ? '' : redirect($this->session->userdata('url_sess'));
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required|callback_check_login');
		if ($this->form_validation->run() == false){
			$this->load->view('vw_login');
		}
	}	
	function check_login($str){
		$email = $this->input->post('email',true);
		$password = $str;		
		$captcha = $this->input->post('g-recaptcha-response',true);		
		$cek = $this->m_admin->cek_login(array('email'=>$email));				
		if (count($cek) > 0){
			foreach ($cek as $row){
				$hash = $row->password;
				if (password_verify($password, $hash)){					
					$sess_data = array(
							'admin_login'=>true,
							'id_employee'=>$row->id_employee,
							'first_name'=>$row->first_name,
							'last_name'=>$row->last_name,
							'email'=>$row->email,
							'group'=>$row->name_group,
							'code_dep' => $row->code_group,
							'photo'=>$row->photo,
							'shift_name'=>$row->shift_name,
							'time_from'=>$row->time_from,
							'time_to'=>$row->time_to,
							'id_shift'=>$row->id_shift,
					);
					$this->session->set_userdata($sess_data);
					$sess_url = $this->session->userdata('url_sess');
					$redirect_url = (!$sess_url) ? 'admin' : $sess_url;
					redirect($redirect_url);
				}else{
					$this->form_validation->set_message('check_login','Password invalid, Try Again');
					return false;
				}
			}
		}else{
			$this->form_validation->set_message('check_login','Email invalid Or Shift Schedule not set, Try Again!');
			return false;
		}
	}
	function logout(){		
		$this->m_admin->destroy_sess();
		redirect('admin');
	}
}