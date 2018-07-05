<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function alert_public($notif,$alert){
	$ci =& get_instance();
	$state = array('warning'=>$ci->lang->line('warning'),
				  'success'=>$ci->lang->line('success'),
				  'danger'=>$ci->lang->line('danger'),
				  'info'=>$ci->lang->line('info'));
	
	return '<div class="alert alert-'.$alert.' alert-dismissable">
						<button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
						<strong>'.$state[$alert].'</strong><br>'.$notif.'
			</div>';
}
function permalink_sess($url='')
{
	$ci =&get_instance();
	$ci->session->set_userdata('permalink_sess',$url);
	return true;
}
function image_fo($file){
	$image = 'no-image.jpg';
	if (!empty($file)){
		$image = $file;
	}
	return $image;
}
function badge($val){
	$badge = '<span class="new-rect">'.$val.'</span>';
	return $badge;
}
function lang($name){
	$ci =&get_instance();
	return $ci->lang->line($name);
}
function months(){
	$months = array('',
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July ',
			'August',
			'September',
			'October',
			'November',
			'December',
	);
	return $months;
}
function formatnum($num){
	return number_format($num,0,'.','.');
}
