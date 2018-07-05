<?php 
$w=1;
foreach ($x as $row){?>
	<table class="table-france1">		
		<tbody>
			<tr>
				<td colspan=2 class="td-france1"><img class="logo" src="<?php echo base_url()?>assets/images/airline_logo/<?php echo $row->logo?>"></td>				
			</tr>
			<tr>
				<td colspan=2 class="td-france1">
					<img class="barcode-center" src="<?php echo base_url(MODULE.'/tesprint/bikin_barcode1/'.$row->barcode_no);?>">
					<div class="text5 center"><?php echo $row->barcode_no?></div>
				</td>				
			</tr>	
		</tbody>
	</table>
	<table class="table-default">
		<tbody>			
			<tr>
				<td colspan=2 class="td-default">
					AIR WAYBILL NUMBER
					<br>
					<div class="center"><span class="text1"><?php echo substr_awb($row->awb_no)['subnumber1'].substr_awb($row->awb_no)['subnumber2']?></span></div>
				</td>				
			</tr>
			<tr>
				<td class="right-border td-default">
					DESTINATION		
					<br>			
					<span class="text4"><?php echo $row->awb_dest?></span>
				</td>	
				<td class="td-default">
					TOTAL NO OF PIECES	
									
					<span class="text4"><?php echo $row->awb_pcs?></span>
				</td>				
			</tr>
			<tr>
				<td class="right-border hide-bottom td-default">
					WEIGHT
					<br>					
					<span class="text4"><?php echo $row->weight?></span>
				</td>	
				<td class="hide-bottom td-default">
					HAWB NO
					<br>
					<span class="text5"><?php echo $row->hawb_no?></span>
				</td>				
			</tr>
		</tbody>
	</table>	
<?php 	
	echo '<footer></footer>';
	$w++;
}?>	