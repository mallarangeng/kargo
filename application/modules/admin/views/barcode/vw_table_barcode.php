<?php 
$w=1;
foreach ($x as $row){?>
	<table class="table-default">		
		<tbody>
			<tr>
				<td colspan=2 class="td-default"><img class="logo" src="<?php echo base_url()?>assets/images/airline_logo/<?php echo $row->logo?>"></td>				
			</tr>
			<tr>
				<td colspan=2 class="td-default">
					<img class="barcode-center" src="<?php echo base_url(MODULE.'/tesprint/bikin_barcode1/'.$row->barcode_no);?>">
					<div class="text5 center"><?php echo $row->barcode_no?></div>
				</td>				
			</tr>
			<tr>
				<td colspan=2 class="td-default">
					AIR WAYBILL NUMBER
					<br>
					<span class="text1"><?php echo substr_awb($row->awb_no)['subnumber1']?></span><span class="text2"> <?php echo substr_awb($row->awb_no)['subnumber2']?></span>
				</td>				
			</tr>
			<tr>
				<td class="right-border td-default">
					DESTINATION					
					<span class="text4"><?php echo $row->awb_dest?></span>
				</td>	
				<td class="td-default">
					TOTAL NO OF PIECES					
					<span class="text4"><?php echo $row->awb_pcs?></span>
				</td>				
			</tr>
			<tr>
				<td colspan=2 class="td-default">
					ORIGIN STATION					
					<span class="text3"><?php echo $row->origin_station?></span>
				</td>									
			</tr>
			<tr>
				<td colspan=2 class="td-default">
					<?php 
					if (!empty($row->hawb_no)){?>
						<div style="font-size:14px">HAWB No : <?php echo $row->hawb_no?></div><img class="barcode-center" src="<?php echo base_url(MODULE.'/tesprint/bikin_barcode2/'.$row->hawb_no);?>">
					<?php }?>
				</td>				
			</tr>
			<tr>
				<td class="right-border hide-bottom td-default">
					DESTINATION				
					<span class="text4"><?php echo $row->hawb_dest?></span>
				</td>	
				<td class="hide-bottom td-default">
					TOTAL NO OF PIECES
					<br>
					<span class="text4"><?php echo $row->hawb_pcs?></span>
				</td>				
			</tr>
		</tbody>
	</table>	
<?php 	
	echo '<footer></footer>';
	$w++;
}?>	