<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permalink{
	var $ci;
	var $suff_blank;
	public function __construct(){
		$this->ci =& get_instance();
		$this->suff_blank = $this->ci->config->config['suff_blank'];//code unik halaman blank/untuk artikel
	}
	function url($value=''){			
		$sql = $this->ci->db->get('tb_employee')->result();
		foreach ($sql as $row){
			$data[$row->employee_code.$this->suff_blank][] = $row;		
		}				
		return isset($data[$value]) ? $data[$value] : array();
		
	}
}