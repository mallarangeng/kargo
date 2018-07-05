<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_content extends CI_Model{
	function load_choosen(){
		$res ='';
		$res .='<script>load_choosen();</script>';
		return $res;
	}	
	function load_pluglin_jquery(){
		$res ='';
		$res .='<script>load_dropdown_multiselect();load_date_picker();load_form_ajax();</script>';
		return $res;
	}
	function load_date_picker(){
		$res ='';
		$res .='<script>load_date_picker();</script>';
		return $res;
	}
	
}