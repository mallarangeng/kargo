<?php 
$w=1;
foreach ($x as $row){?>
	<table class="table-france2">		
		<tbody>
			<tr>
				<td colspan=3 class="td-default"><img class="logo" src="<?php echo base_url()?>assets/images/airline_logo/<?php echo $row->logo?>"></td>				
			</tr>
			<tr>
				<td colspan=3 class="td-default">
					<img class="barcode-center" style="margin-bottom:5px;margin-top:15px" src="<?php echo base_url(MODULE.'/tesprint/bikin_barcode1/'.$row->barcode_no);?>">
					<div class="text5 center"><?php echo $row->barcode_no?></div>
				</td>				
			</tr>
			<tr>
				<td colspan=3 class="td-default">
					AIR WAYBILL NUMBER
					<br>
					<span class="text2"><?php echo substr_awb($row->awb_no)['num1-klm1']?></span><span class="text1"><?php echo substr_awb($row->awb_no)['num2-klm1']?></span>
				</td>				
			</tr>
			<tr>
				<td class="right-border td-default">
					DESTINATION	
					<br>				
					<div class="center text1"><?php echo $row->awb_dest?></div>
				</td>	
				<td class="right-border td-default">
					TOTAL PIECES	
					<br>			
					<div class="center text1"><?php echo $row->awb_pcs?></div>
				</td>
				<td class="td-default">
					TOTAL WEIGHT		
					<br>		
					<div class="center text1"><?php echo $row->weight?></div>
				</td>				
			</tr>
			<tr>
				<td class="right-border td-default">
					VIA
					<br>				
					<div class="center text5"><?php echo $row->via?></div>
				</td>	
				<td class="right-border td-default">
					OFFLOAD	
					<br>			
					<div class="center text1"><?php echo $row->offload?></div>
				</td>
				<td class="td-default hide-bottom" rowspan=2>							
					<img style="width:110px" src="<?php echo base_url().'assets/images/logo/equation.png'?>">
				</td>
			</tr>
			<tr>
				<td class="right-border td-default hide-bottom" colspan=2>
					SPECIAL HANDLING CODES
					<br>				
					<div class="center text1"><?php echo $row->spc_handling_code?></div>
				</td>					
			</tr>
		</tbody>
	</table>	
<?php 	
	echo '<footer></footer>';
	$w++;
}?>	