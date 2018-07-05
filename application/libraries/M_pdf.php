<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class M_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        #log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($param == NULL)
        {
            //$param = '"en-GB-x","A4","","",10,10,10,10,6,3';          
            $param = "A4";
        }
        
        return new mPDF($mode='',$param);
    }
}
//- See more at: https://arjunphp.com/generating-a-pdf-in-codeigniter-using-mpdf/#sthash.RlwMh7F5.dpuf


