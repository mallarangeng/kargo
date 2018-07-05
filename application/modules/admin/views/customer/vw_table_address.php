<div class="row">
	<div class="col-xs-12">
	<h3 class="header smaller lighter red">List Address</h3>
	<!-- <a class="btn btn-xs btn-success" href="#modal-form" data-toggle="modal" role="button" title="Add New Address" onclick="ajaxModal('<?php echo base_url(MODULE.'/'.$class.'/form_address/add')?>','<?php echo $id_customer?>','modal-form')"><i class="glyphicon glyphicon-plus"></i> Add New Address</a>-->
	<div class="space-6"></div>
	<table class="df-tables table table-striped">
		<thead>
			<tr><th>#</th>
				<th>Alias Address Name</th>
				<th>Receiver Name</th>
				<th>Phone</th>
				<th>Company</th>
				<th>Address</th>
				<th>Country</th>
				<th>Province</th>
				<th>City</th>
				<th>Districts</th>
				<th>Post Code</th>
				<th>Default</th>				
				<th>Actions</th>
		</thead>
		<tbody>
			<?php 
			$no=1;			
			foreach ($rowaddress as $row){		
			$actions='';
			$actions .= '<a class="btn btn-xs btn-info" href="#modal-form" data-toggle="modal" role="button" title="Edit Address" onclick="ajaxModal(\''.base_url(MODULE.'/'.$this->class.'/form_address/edit').'\',\''.$row->id_address.'\',\'modal-form\')">'.icon_action('edit').'</a>';							
			if (count($rowaddress) > 1){
				$actions .= '<a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete_address').'\',\''.$row->id_address.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';
			}
			$check_dfl = ($row->default == 1) ? 'checked' : '';
			$disabled = ($row->default == 1) ? 'disabled' : '';
			$default = '<label>
							<input class="ace ace-switch ace-switch-2" '.$check_dfl.' '.$disabled.' type="checkbox" onchange="ajaxcheck(\''.base_url(MODULE.'/'.$this->class.'/defaults/'.$row->id_customer).'\',\''.$row->id_address.'#default'.'\',this)">
							<span class="lbl"></span>
						</label>';
				echo '<tr><td>'.$no++.'</td>
						  <td>'.$row->alias_name.'</td>
						  <td>'.$row->name_received.'</td>
						  <td>'.$row->phone_addr.'</td>
						  <td>'.$row->company.'</td>
						  <td>'.$row->address.'</td>
						  <td>'.$row->country_name.'</td>
						  <td>'.$row->province_name.'</td>
						  <td>'.$row->cities_name.'</td>
						  <td>'.$row->districts_name.'</td>
						  <td>'.$row->postcode.'</td>
						  <td>'.$default.'</td>
						  <td>'.$actions.'</td>
			';
			}?>
		</tbody>
	</table>
	</div>
</div>
