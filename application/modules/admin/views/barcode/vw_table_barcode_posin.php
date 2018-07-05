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
					FLIGHT NO
					<br>
					<div class="center"><span class="text1"><?php echo $row->flight_no?></span></div>
				</td>				
			</tr>	
			<tr>
				<td colspan=2 class="td-default">
					DATE
					<br>
					<span class="text1"><?php echo $row->date_flight?></span>
				</td>				
			</tr>	
			<tr>
				<td colspan=2 class="td-default">
					BC 1.1
					<br>
					<div class="center"><span class="text1"><?php echo $row->bc_1_1?></span></div>
				</td>				
			</tr>
			<tr>
				<td colspan=2 class="td-default">
					POS NO
					<br>
					<div class="center"><span class="text1"><?php echo $row->pos_no?></span></div>
				</td>				
			</tr>		
		</tbody>
	</table>	
<?php 	
	echo '<footer></footer>';
	$w++;
}?>	