<div class="widget-header">
<h4 class="widget-title lighter"><?php echo $page_title?><?php echo isset($sub_title) ? ' <small><i class="ace-icon fa fa-angle-double-right"></i> '.$sub_title.'</small>' : '';?></h4>	
	<div class="widget-toolbar">															
		<button type="submit" class="btn btn-white btn-info btn-bold ace-icon fa fa-floppy-o bigger-120 btnSubmit" data-rel="tooltip" data-placement="top" title="Save"></button>	
		<?php if (isset($id_form)){
			if ($id_form == 'formmodal'){
				echo '<button class="btn btn-white btn-danger btn-bold ace-icon fa fa-times bigger-120" data-rel="tooltip" data-placement="top" title="Cancel" type="button" data-dismiss="modal"></button>';
			}else{
				echo '<button class="btn btn-white btn-danger btn-bold ace-icon fa fa-times bigger-120" data-rel="tooltip" data-placement="top" title="Cancel" type="button" onclick="javascript:window.location.href=\''.base_url(MODULE.'/'.$class).'\'"></button>';
			}
		}else{
				echo '<button class="btn btn-white btn-danger btn-bold ace-icon fa fa-times bigger-120" data-rel="tooltip" data-placement="top" title="Cancel" type="button" onclick="javascript:window.location.href=\''.base_url(MODULE.'/'.$class).'\'"></button>';
			}?>
		<div class="space-4"></div>	
																								
	</div>
	<?php if (isset($btn_refresh)){?>
	<div class="center">
		<button class="btn btn-sm btn-primary btn-white btn-round" type="button" onclick="javascript:window.location.href='<?php echo base_url($this->session->userdata('links'))?>'">
			<i class="ace-icon fa fa-refresh bigger-150 middle orange2"></i>
			<span class="bigger-110">Refresh &amp; New</span>				
		</button>
		<button class="btn btn-sm btn-primary btn-white btn-round" type="button" onclick="ajaxcall('<?php echo base_url(MODULE.'/transaction/print_invoice')?>')">
			<i class="ace-icon fa fa-print bigger-150 middle green"></i>
			<span class="bigger-110">Print Invoice</span>				
		</button>
	</div>	
	
	<div class="space-4"></div>	
	<?php }?>
</div>