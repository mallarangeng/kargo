/**
 * Create By Putra
 */
//url current protocol
function urlprotocol(){
	return document.location.protocol + "//" + document.location.hostname + "/";	 
}
$(function(){	
	setInterval(myTimer, 1000);
	//load time picker
	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: false,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$('#timepicker2').timepicker({
		minuteStep: 1,
		showSeconds: false,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker2').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	//for dropdown multiselect
	load_dropdown_multiselect();
	//datepicker
	load_date_picker();
	
	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	//menambahkan class selected jika datatable row diklik
	 $('.dt-tables tbody').on( 'click', 'tr', function () {
	      $(this).toggleClass('selected');
	  } );
	
	//menambahkan class selected jika non datatable row diklik
	$('.df-tables tbody').on( 'click', 'tr', function () {
	      $(this).toggleClass('selected-df');
	  } );
	
	load_choosen();	
	load_form_ajax();
	textarea();
	load_input_image();
	//load input type file
	
	//autoload notif alert option
	 var x = $('.success').html();	
	 var y = $('.warning').html();
	 var z = $('.danger').html();
    if(x !=''){      	
   	 show_alert('.success','success',x);
    }
    if(y !=''){ 
    	
   	 show_alert('.warning','warning',y);
    }
    if(z !=''){       	
   	 show_alert('.danger','danger',z);
    }
    
	//tooltip
	$('[data-rel=tooltip]').tooltip();
	
	
	//sidebar main menu and submenu class active open		
	  $("a").each(function() {		  
		  var url_sess = $("#url_sess").val();	//get from session url		 
		  var current_page_URL = location.href;	//current url
		 
		  //jika anchor mempunyai link url
	     if ($(this).attr("href") !== "#"){	    	
	       var target_URL = $(this).prop("href");		      
	       //jika url anchor s/d url current session
	       if (target_URL == url_sess) {		    	  
	          $('nav a').parents('li, ul').removeClass('active');
	          $(this).parent('li').addClass('active');		          
	          //mendapatkan nama class pada anchor sub menu yg aktif
	          var getclass = $(this).parent('li').attr('class');
	         
	          if (typeof getclass == 'undefined'){	        	 
	        	  $('#main0').removeClass('open');
				  $('#main0').addClass('active open hover');
	          }else{
	        	  //melakukan split sub menu nama class anchor by spasi
		          var spl = getclass.split(' ');	 	        
		          //remove dan tambah class pada main menu sesuai id yg didapatkan pada index s
		          $('#'+spl[0]).removeClass('open');
				  $('#'+spl[0]).addClass('active open hover');
	          }
	         
	          return false;
	       }
	     }	     
	  });
})
function msp_token(){
	return $("meta[name=msp_token]").attr('content');
}
function loaddatatable(tableclass){		
	var csrf_token = {'msp_token':msp_token};	
	var dataTable = $(tableclass).DataTable({		
		//responsive table
		 /*responsive: {
	            details: {
	                display: $.fn.dataTable.Responsive.display.childRowImmediate,
	                type: ''
	            }
	        },*/ 
	     fixedColumns: true,//merapikan column
	    "sDom" : '<"top">lrtip',//hide filter global
		"columnDefs" : [{
			"targets": 'no-sort',"orderable": false,//disabled column sort
			//"className": "dt-center", "targets": "_all",	//use for center column all		         
		}],		
		"oLanguage" : {
			"sSearch": "Filter Data",
			"oPaginate" : {
				"sPrevious" : "Previous",
				"sNext" : "Next",
			},				
			"sEmptyTable" : "Data is empty",
			"sInfo" : "(Page _PAGE_ - _PAGES_) Show (_START_ s/d _END_) from Total _TOTAL_ records ",
			"sInfoEmpty": "Show (_END_ to _END_) from Total _TOTAL_ records (Page _PAGE_ to _PAGES_)",	
			"sInfoFiltered": "(Filter from total _MAX_ records)",
			"sLengthMenu": "View _MENU_ data perpage",
			"sProcessing": "Prosess data...",
			"sLoadingRecords": "Please Wait - loading...",
			"sZeroRecords": "Not data show"
		},
		"iDisplayLength": 10,
		"lengthMenu": [ 10, 25, 50, 75, 100,200,500,1000,1500,3000,5000,10000,15000,20000,25000 ],
		"order": [[ 0, "desc" ]],//set default order sortir		
		"ordering": true,//order sortir is true
		"processing": true,
		"serverSide": true,		
		"searchHighlight": true,
		"ajax": {
		  "url": $(tableclass).attr('value'),
		  "dataType" : "json",
		  "type":'POST',		 
		  "data" : {'msp_token':msp_token},		 
		  dataSrc: function (json) {	
			  /*put value diferent token in class msp_token*/
              if(json.csrf_token !== undefined) 
              $('meta[name=msp_token]').attr("content", json.csrf_token);
              $('.msp_token').attr("value", json.csrf_token);
              return json.data;//back to reload data 
          },
         
		}
	});
	//dijalankan hanya untuk primari table agar tidak terjadi duplikasi button	
		//export datatables js function
		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';	
		new $.fn.dataTable.Buttons(dataTable, {
			buttons: [					  
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: ''
					  }		  
			   ]
		} );
		
		dataTable.buttons().container().appendTo( $('.btn-export') );
		//copy all row datatable
		var defaultCopyAction = dataTable.button(1).action();
		dataTable.button(1).action(function (e, dt, button, config) {
			defaultCopyAction(e, dt, button, config);
			$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
		});	

		//tooltip btn export datatable
		setTimeout(function() {
			$($('.btn-export')).find('a.dt-button').each(function() {
				var div = $(this).find(' > div').first();
				if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
				else $(this).tooltip({container: 'body', title: $(this).text()});
			});
		}, 500);
	
	
	//search text column table
	$('.search-input').on( 'keyup click change', function (e) {   
		var i =$(this).attr('id');  // getting column index
		var v =$(this).val();  // getting search input value		
		dataTable.columns(i).search(v).draw();
	});
	
	// Date range filter for datatable use
	   $(".date-picker").on('keyup click change', function () {
	    	var id = $(this).attr('id');//mengambil id ketika input text tanggal dimasukan
	    	var value = $(this).val();//mengambil value ketika input text tanggal dimasukan
	    	//mengirim dan mengembalikan data yang diinput dari client ke server side dikirim menggunakan draw untuk memastikan value yg direquest
	    	if (value != ""){
	    		dataTable.columns(id).search(value).draw();
	    	}	    	
	   });
	 
}
function get_content_textarea(){
	/*
	 * mendapatkan jumlah textarea by ID dalam 1 form yg sama
	 * lalu mendapatkan nama ID setiap textarea, dan diload sesuai ID yg didapat
	 */
	var id_length = $(".textareas").length;		
	for (var i=0;i < id_length; i++){		
		var get_id = $(".textareas")[i].id;
		if (get_id != null || get_id != undefined){
			var textarea = $('#' + get_id).html(tinymce.get(get_id).getContent());//load freetext			
		}
	}
	
}

function openWin(url)
{
	var w = 600;
	var h = 500;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	myWindow=window.open(url,'Print Out','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left); 
 
	myWindow.print(); //DOES NOT WORK
	myWindow.onafterprint = function(){
	 // myWindow.close();
  }
  
 
}
function ajaxform(url,div,form){
	get_content_textarea();	
	loading(true);				
	var formData = new FormData(form);
	$.ajax ({
		url		: url,
		type	: 'post',
		mimeType : 'multipart/form-data',
		data	: formData,
		contentType: false,
		processData: false,
		cache	: false,
		async:false,
		timeout : 600000,
		success	: function (param)
		{			
			var json = eval('('+param+')');
			if(json.csrf_token !== undefined)
			$('meta[name=msp_token]').attr("content", json.csrf_token);
			$('.msp_token').attr("value", json.csrf_token);
			//sukkses
			if (json.error == 0 && json.type == 'save')
			{
				bootbox_alert(true,json.msg);
				window.location.href = json.redirect;	
					
			}
			else if (json.error == 0 && json.type == 'save_print')
			{
				//barcodeprint
				bootbox_alert(true,json.msg);					
				//window.location.href = json.redirect;
				openWin(json.print);	
				
					
			}
			else if (json.error == 0 && json.type == 'modal')
			{
				show_alert('.success','success',json.msg);
				bootbox_alert(true,json.msg);
				$("#"+div).html(json.content);
				clear_field();
			}
			else if (json.error == 0 && json.type == 'alert')				
			{
				show_alert('.success','success',json.msg);
				$("#"+div).html(json.content);				
				//show dialog popup
				bootbox_alert(true,json.msg);
				clear_field();
				
			}	
			else if (json.error == 0 && json.type == 'summary')				
			{
				//used for create summary add new order
				show_alert('.success','success',json.msg);
				$("#"+div).html(json.content);				
				//show dialog popup
				bootbox_alert(true,json.msg);
				clear_field();
			}	
			else if (json.error == 0 && json.type == 'addresses')				
			{				
				//use for save new address and edit address in new order
				show_alert('.success','success',json.msg);
				$("#"+div).html(json.vwaddress);	
				$("#shipping").html(json.vwshipping);	
				//show dialog popup
				bootbox_alert(true,json.msg);			
			}
			else if (json.error == 1 && json.type == "error")
			{				
				//show dialog popup
				bootbox_alert(false,json.msg);
				show_alert('.danger','danger',json.msg);
			}			
			else if (json.error == 1 && json.type == "error_loop")
			{				
				//proses looping notif
				var msg = json.msg;
				for(var i=0; i < msg.length; i++){
					//show dialog popup
					bootbox_alert(false,msg[i]);
					//alert(msg[i]);						
				}					
			}	
			loading(false);					
            return json.data;//back to reload data 
		},
		error : function(jqXHR, status, errorThrown){			
			if (jqXHR.status == 403){
				alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
			}else{
				alert(status+': '+errorThrown);
			}
		}
	});
}
function load_form_ajax(){
	//save form submit required
	$("#form-ajax").on('submit',function(e){			
		e.preventDefault();		
		get_content_textarea();				
		var spl = $(this).attr('value').split("#");			
		var url = spl[0];
		var div = spl[1];						
		ajaxform(url,div,this);
	})
}
//for ajax actions
function loading(is_show){	
	//get url protocol current 
    if(is_show == true){
    	$("#loading").html("<img src=\""+urlprotocol()+"assets/images/gif/loading.gif\" />").fadeIn('slow');
    	$(".btnSubmit").prop("disabled", true);
	}
    if(is_show == false){
        $("#loading").html("<img src=\""+urlprotocol()+"assets/images/gif/loading.gif\" />").fadeOut('slow');
        $(".btnSubmit").prop("disabled", false);		
	}
}
function show_alert(div,status,msg){	
	$(div).removeClass("alert alert-block alert-danger");
	$(div).removeClass("alert alert-block alert-success");
	$(div).removeClass("alert alert-block alert-warning");
	$(div).addClass("alert alert-block alert-"+status);
	if(status == 'warning')
		var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-warning">WARNING!</strong><br>';
	else if (status == 'success')
		var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-success">CONGRATULATIONS!</strong><br>';
	else if (status == 'danger')
		var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-important">ERROR!</strong><br>';
    //$(div).html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+"<b>"+msg+"</b>").show(500);
    $(div).html(span+msg).slideDown();//slideDown(500);
// 	$(div).removeClass('hide');
    //$(div).slideUp();
	setTimeout(function(){ $(div).slideUp(500); },100000);
}

function clear_field(){
	$('.clear').prop("selected", "selected");
	$('.clear').val('');
	$('.clear').val('');	
	$(".clear").prop("checked", false);	
	$(".clear").val('').trigger("liszt:updated");
}
function textarea()	{
	/*texarea load*/
	tinymce.init({
	    selector: "textarea",
	    theme: "modern",
	    plugins: [
	        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	        "searchreplace wordcount visualblocks visualchars code fullscreen",
	        "insertdatetime media nonbreaking save table contextmenu directionality",
	        "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    toolbar2: "print preview media | forecolor backcolor emoticons",
	    image_advtab: true,
	    templates: [
	        {title: 'Test template 1', content: 'Test 1'},
	        {title: 'Test template 2', content: 'Test 2'}
	    ]
	});		
}
function ajaxcall(url,val,div)
{			
	loading(true);			 
	var datax = {'value':val,'div':div,'msp_token':msp_token};
	$.ajax({
		url 	: url,
		type	: 'post',
		data	: datax,
		cache	: false,
		success	: function (param){		
			 var json = eval('('+param+')');
			 	if(json.csrf_token !== undefined) 
				 $('meta[name=msp_token]').attr("content", json.csrf_token);
				 $('.msp_token').attr("value", json.csrf_token);				
			 if (json.error == 0){
				 if (json.printinvoice == true){					 
						openWin(json.url);
				 }else if(json.showform == true){							
					 $("#formpos").html(json.pos);
					 $("#formawb").html(json.awb);
					 $("#formhawb").html(json.hawb);
					 $("#formother").html(json.other);					 
					 load_number();
					
				 }else{
					 $("#"+div).html(json.element);
					 load_input_image();
				 }			 				 		 
			 }else if (json.error == 1){
				 //show value input post use for add valeu input type
				 bootbox_alert(false,json.msg);
			 }		
			 loading(false);			
	         return json.data;//back to reload data 
			
		},error : function(jqXHR, status, errorThrown){			
			if (jqXHR.status == 403){
				alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
			}else{
				alert(status+': '+errorThrown);
			}
		}
	})
}

function ajaxcheck(url,val,obj,div=''){		
	loading(true);	
	var cb = document.getElementsByTagName('input');
	var spl = val.split('#');
	var access = spl[1];
	if (obj.checked){
		var check = 1;
		/*jika melakukan check all sesuai access*/
		if (url == 'bo/mpgroup/check_all'){					
			for (var i=0; i < cb.length; i++)
			{
				if (cb[i].className == access)
				{
					cb[i].checked = true;
				}
			}
		}
	}else{
		var check = 0;
		/*jika melakukan check all sesuai access*/
		if (url == 'bo/mpgroup/check_all'){
			for (var i=0; i < cb.length; i++)
			{
				if (cb[i].className == access)
				{
					cb[i].checked = false;
				}
			} 
		}
	}		
	var datax = {'value':val,'check':check,'msp_token':msp_token};
	$.ajax({
		url 	: url,
		type	: 'post',
		data	: datax,
		cache	: false,
		success	: function (param){
			var json = eval('('+param+')');
			if (json.error == 0){
				//jika ada element yang direplace
				if (json.element != null){
					$("#"+div).html(json.element);
					//use for share customer to employee
					$("#tbltele").html(json.table);
				}else if (json.defaults != null){
					//used for check default and redirect page
					bootbox_alert(true,json.msg);
					window.location.href = json.redirect;
					return false;
				}
				show_alert('.success','success',json.msg);
				bootbox_alert(true,json.msg);
				
			}else if (json.error == 1){
				show_alert('.danger','danger',json.msg);
				bootbox_alert(false,json.msg);
				
			}
			loading(false);
			if(json.csrf_token !== undefined) $('meta[name=msp_token]').attr("content", json.csrf_token);
            return json.data;//back to reload data 
			
		},error : function(jqXHR, status, errorThrown){			
			if (jqXHR.status == 403){
				alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
			}else{
				alert(status+': '+errorThrown);
			}
		}
	})
}
function DeleteConfirm(url,val,div){
	bootbox.confirm("Are you sure delete this data ?", function(result) {
		if(result) {
			//actions
			loading(true);
			var datax = {'value':val,'msp_token':msp_token};
			$.ajax({
				url 	: url,
				type	: 'post',
				data	: datax,
				cache	: false,
				success	: function (param){
					var json = eval('('+param+')');
					if (json.error == 0){						
						if (json.table == 'dt'){
							//jika datatable
							$(".selected").fadeOut('slow');																		
						}else{
							$(".selected-df").fadeOut('slow');	
						}
						
						if (div != ""){
							if (json.cart != null){
								//used for delete in cart
								$("#"+div).html(json.cart);
								$("#shipping").html(json.shipping);
							}else if (json.mgm != null){
								$("#"+div).html(json.stock);
								document.getElementById('global').value = json.global;//show stock global
							}else{
								$("#"+div).html(json.content);
							}							
						}
						show_alert('.success','success',json.msg);
						bootbox.alert('<div class="alert alert-success bigger-150 center"><i class="ace-icon fa fa-check-square-o"></i> CONGRATULATIONS! <div class="space-6"></div>'+json.msg+'<div>');
					}else{
						//return proses false
						bootbox.alert('<div class="alert alert-danger bigger-150 center"><i class="ace-icon fa fa-remove"></i> ERROR! <div class="space-6"></div>'+json.msg+'<div>');
						show_alert('.danger','danger',json.msg);
					}					
					loading(false);
					if(json.csrf_token !== undefined) $('meta[name=msp_token]').attr("content", json.csrf_token);
		            return json.data;//back to reload data 
				},error : function(jqXHR, status, errorThrown){			
					if (jqXHR.status == 403){
						alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
					}else{
						alert(status+': '+errorThrown);
					}
				}
			})
		}
	});
}
function bootbox_alert(alert,msg){
	if (alert === true){
		bootbox.alert('<div class="alert alert-success bigger-150 center"><i class="ace-icon fa fa-check-square-o"></i> CONGRATULATIONS! <div class="space-6"></div>'+msg+'<div>');
	}else{
		bootbox.alert('<div class="alert alert-danger bigger-150 center"><i class="ace-icon fa fa-remove"></i> ERROR! <div class="space-6"></div>'+msg+'<div>');
	}	
}
function ajaxModal(urlx,val,div){	
	loading(true);		
	var datax = {'value':val,'msp_token':msp_token};
	$.ajax({
		url : urlx,
		type : 'post',
		data : datax,
		cache	: false,
		success	: function(param){		
			var json = eval('('+param+')');
			if(json.csrf_token !== undefined) 
			$('meta[name=msp_token]').attr("content", json.csrf_token);
			$('.msp_token').attr("value", json.csrf_token);
			$('#'+div).html(json.modal);			
			loading(false);		
			textarea();
			load_form_modal();
			load_choosen();
			load_input_image();			
			return json.data;//back to reload data 
		},error : function(jqXHR, status, errorThrown){			
			if (jqXHR.status == 403){
				alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
			}else{
				alert(status+': '+errorThrown);
			}
		}
	})
}
function load_input_image(){
	$('input[type=file]').ace_file_input({
		style:'well',
		btn_choose:'Drop files here or click to choose',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		thumbnail:'large'
	})
}
function load_input_file(){
	$('.input-file').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:false //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		//blacklist:'exe|php'
		//onchange:''
		//
	});
}
function load_date_picker(){
	//daterane filter
	$('.input-daterange').datepicker({
		autoclose:true,
		
	});
	
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	$('.date-picker-sub').datepicker({
		autoclose: true,
		todayHighlight: true
	})
}
function load_choosen(){
	$('.chosen-select').chosen(); 	
}
function load_dropdown_multiselect(){
	$('.multiselect').multiselect({
		 enableFiltering: true,
		 enableHTML: true,
		 buttonClass: 'btn btn-white btn-primary',
		 templates: {
			button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
			ul: '<ul class="multiselect-container dropdown-menu"></ul>',
			filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
			filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
			li: '<li><a tabindex="0"><label></label></a></li>',
	        divider: '<li class="multiselect-item divider"></li>',
	        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
		 }
	});
}
function load_form_modal(){
	//save form submit required
	$("#formmodal").on('submit',function(e){		
		e.preventDefault();		
		get_content_textarea();				
		var spl = $(this).attr('value').split("#");			
		var url = spl[0];
		var div = spl[1];	
		var formData = 	new FormData(this);				
		loading(true);				
		$.ajax ({
			url		: url,
			type	: 'post',
			mimeType : 'multipart/form-data',
			data	: formData,
			contentType: false,
			processData: false,
			cache	: false,
			async:false,
			timeout : 600000,
			success	: function (param)
			{			
				var json = eval('('+param+')');
				if(json.csrf_token !== undefined)
				$('meta[name=msp_token]').attr("content", json.csrf_token);
				$('.msp_token').attr("value", json.csrf_token);					
				if (json.error == 0 && json.type == 'modal')
				{									
					//show_alert('.success','success',json.msg);
					bootbox_alert(true,json.msg);					
					$("#"+div).html(json.content);
					$("#modal-form").modal('toggle');
					clear_field();
				}else if (json.error == 0 && json.type == 'print_barcode'){
					openWin(json.url);
				}	
				else if (json.error == 0 && json.type == 'redirect'){					
					window.location=json.url;
				}	
				else if (json.error == 1 && json.type == "error")
				{				
					//show dialog popup
					bootbox_alert(false,json.msg);
					show_alert('.danger','danger',json.msg);
				}			
				else if (json.error == 1 && json.type == "error_loop")
				{				
					//proses looping notif
					var msg = json.msg;
					for(var i=0; i < msg.length; i++){
						//show dialog popup
						bootbox_alert(false,msg[i]);
						//alert(msg[i]);						
					}					
				}	
				loading(false);					
	            return json.data;//back to reload data 
			},
			error : function(jqXHR, status, errorThrown){			
				if (jqXHR.status == 403){
					alert("CSRF session is expired Or The action you have requested is not allowed, try process again!");
				}else{
					alert(status+': '+errorThrown);
				}
			}
		});
	})
}
var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};
function myTimer() {
    var d = new Date();  
    var curr_date = d.getDate();
    var curr_month = d.getMonth() + 1; //Months are zero based
    var curr_year = d.getFullYear();
    var datenow = curr_date+'/'+curr_month+'/'+curr_year;
    var localeTime = d.toLocaleTimeString('it-IT');   
    document.getElementById("timerun").innerHTML = datenow+' '+localeTime;
    
}
function load_number(){
	$("#noawb").on('keyup',function(){
		document.getElementById('noawb-print').style.display = 'block';
		var value = $(this).val();
		var noformat = awbformat(value);		
		document.getElementById('noawb-print').innerHTML = '<br>'+noformat;
	})
	$("#nohawb").on('keyup',function(){
		document.getElementById('nohawb-print').style.display = 'block';
		var value = $(this).val().toUpperCase();
		$(this).val(value);		
		document.getElementById('nohawb-print').innerHTML = '<br>'+value;
	})
}
