<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller{
	var $class;
	var $table;
	var $datenow;
	var $addby;
	var $access_code;
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->class = strtolower(__CLASS__);
		$this->table = 'tb_company';
		$this->datenow = date('Y-m-d H:i:s');
		$this->addby = $this->session->userdata('first_name');
		$this->access_code = 'CMPY';
		$this->m_admin->maintenance();
	}	
	function index(){
		$this->m_admin->sess_login();
		$priv = $this->m_admin->get_priv($this->access_code,'view');
		$body= (empty($priv)) ? $this->class.'/vw_company' : $priv['error'];				
		links(MODULE.'/'.$this->class);
		url_sess(base_url(MODULE.'/'.$this->class));//only use in index for sidebar open
		$sql = $this->m_admin->get_table($this->table,'*',array('deleted'=>0));
		foreach ($sql as $row)
			foreach ($row as $key=>$val){
			$data[$key] = $val;
		}
		$data['page_title']='Index '.__CLASS__;
		$data['body']=$body;
		$data['class']= $this->class;
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];			
		$this->load->view('vw_header',$data);
	}
	function proses(){		
		$priv = $this->m_admin->get_priv($this->access_code,'add');		
		if (empty($priv)){
			$id_company = $this->input->post('id_company');		
			$input['station_code'] = $this->input->post('statcode',true);
			$input['company_name'] = $this->input->post('name',true);
			$input['address_company'] = replace_freetext($this->input->post('address',true));
			$input['homephone_company'] = $this->input->post('homephone',true);
			$input['mobilephone_company'] =  $this->input->post('mobilephone',true);
			$input['email_company'] =  $this->input->post('email',true);
			$filename = $_FILES['logo']['name'];
			if ($filename != '')
			{
				//proses upload gambar
				$setting['upload_path'] = './assets/images/logo/';
				$setting['file_name'] = $filename;
				$setting['var_name'] = 'logo';
				$this->m_admin->upload_image($setting);
				$input['logo_company'] = str_replace(" ", "_", $filename);
			}
			if(!empty($id_company)){
				//edit
				$res = $this->m_admin->editdata($this->table,$input,array('id_company'=>$id_company));
				$notif = 'Edit '.__CLASS__.' successfull';
			}else{
				//add
				$res = $this->m_admin->insertdata($this->table,$input);
				$notif = 'Add new '.__CLASS__.' successfull';
			} 
			if ($res){
				$this->session->set_flashdata('success',$notif);
				echo json_encode(array('error'=>0,'type'=>'save','msg'=>$notif,'redirect'=>base_url($this->session->userdata('links'))));
			}
			
		}else{
			echo json_encode(array('error'=>1,'type'=>'error','msg'=>$priv['notif']));
		}
	}
}
