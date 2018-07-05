<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class access{
	public $first_name;
	public $ci;
	public function __construct(){
		$this->ci = & get_instance();
		$this->first_name = 'putra';
	}
}
