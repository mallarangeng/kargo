<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Print Airway Bill Barcode</title>   
    <style type="text/css"> 
   		@page
		   {
		    margin-left: 0px;
			margin-right: 0px;
			margin-top: 0px;
			margin-bottom: 0px;					
		  }
    	
    	hr{
    		height:4px;
			border:none;
			color:#333;
			background-color:#333;
			*margin-right:100px;		
    	} 	
  		.table-default{  			
  			margin-left:3px;
  			margin-right:0px;
  			margin-top:10px;
  			width:373px;
  			border : 3px solid black;
  			font-size:14px;	
  			font-weight:bold;
  			border-collapse: collapse;
  		}  		
  		.td-default{
  			padding:4px;   			 	
  			border-bottom : 3px solid black;		 			    			
  		}
  		
  		.table-france1{  			
  			margin-left:3px;
  			margin-right:30px;
  			margin-top:20px;
  			width:300px;    						
  		}
  		.td-france1{
  			padding:15px 10px 38px;  			  			 	 			    			
  		}
  		.table-france2{  			
  			margin-left:3px;
  			margin-right:0px;
  			margin-top:10px;
  			width:373px;
  			border : 3px solid black;
  			font-size:12px;	
  			font-weight:bold;
  			border-collapse: collapse;
  		}  	
  		
  		.center{
  			text-align:center;
  		}
  		.hide-bottom{
  			border-bottom : 0;
  		}
  		.logo{
  			margin-left:16px;
  			width:300px;
  			height:60px;
  		}
  		.text1{
  			font-size: 30px; font-weight:bold;
  		}
  		.text2{
  			font-size: 50px; font-weight:bold;
  			margin-left:50px;
  		}
  		.text3{
  			font-size: 30px; font-weight:bold;
  			margin-left:45px;
  		}
  		.text4{
  			font-size: 25px; font-weight:bold;
  			margin-left:80px;
  		}
  		.text5{
  			font-size: 20px; font-weight:bold;
  			
  		}
  		.right-border{
  			border-right : 3px solid black; 			  			
  		}
		footer {
			page-break-after: always;
				
		}
		.barcode2{
			*margin-left:38px;
		}
		.font-barcode{
			font-size: 20px; font-weight:bold;
			text-align:center;
		}
		.barcode-center{
			display: block;
		    margin-left: auto;
		    margin-right: auto;		    
		}
    </style>
</head>
<body>
	<div id="barcodecontainer">
		<?php 
		if ($label_dest == 'FRC1'){
			//france1 dest
			$this->load->view('barcode/vw_table_barcode_france1');
		}else if($label_dest == 'FRC2'){
			$this->load->view('barcode/vw_table_barcode_france2');
		}else if($label_dest == 'POSIN'){
			$this->load->view('barcode/vw_table_barcode_posin');
		}else{
			$this->load->view('barcode/vw_table_barcode');
		}?>
	</div>
</body>
</html>