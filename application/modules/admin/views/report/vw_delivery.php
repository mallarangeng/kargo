<section>
		<div class="details clearfix">
			<div class="client left">
				<p>DELIVERY TO:</p>
				<p class="name"><?php echo $name_received?></p>
				<p>
					<?php echo 					
						$address.'<br>';
						if ($country_code == 'IDR'){
						  echo $districts_name.', '.$cities_name.' '.$postcode.'<br>
						  	  '.$province_name.','.$country_name.'<br>';
						}else{
							echo $postcode.', '.$country_name.'<br>';
						}
						echo 'Phone : '.$phone_addr;
					?>
				</p>
				<?php echo '<a href="mailto:'.$email.'">'.$email.'</a>';?>
				
			</div>
			<div class="data right">
				<p><?php
					$no_resi = ($awb_delivery == '') ? '....' : $awb_delivery;
				 echo 'ID Order #'.$id_order.'<br>
							Order Date: '.long_date_time($date_add_order).'<br>							
							Shipp Via: '.$name_courier.'<br>
							No Resi: '.$no_resi.'<br>
							Pay Methods: '.$method_name.'<br>';							
					?>
				</p>
			</div>
		</div>
		<div class="container">
			<div class="table-wrapper">
				<table>
					<tbody>
						<tr>
							<th class="no">#</th>
							<th class="desc"><div>PRODUCT</div></th>
							<th class="qty"><div>QUANTITY</div></th>							
						</tr>
					</tbody>
					<tbody class="body">
						<?php 
						$no=1;
						foreach ($detail as $row){
							$unit_price = ($row->iso_code == 'IDR') ? number_format($row->unit_price,0,'.','.') : $row->unit_price;
							$subtotal_price = ($row->iso_code == 'IDR') ? number_format($row->total_price,0,'.','.') : $row->total_price;
							$cancel = ($row->active == 0) ? '<span class="label label-important arrowed-in-right arrowed">Cancel</label>':'<span class="label label-success arrowed-in-right arrowed">Active</span>';
							echo '<tr>
								  <td class="no">'.$no++.'</td>								 
								  <td class="desc">'.$row->name.'<br> '.$row->name_group.': '.$row->name_attribute.'</td>
								  <td class="qty">'.$row->product_qty.'</td>								  
						  		</tr>';							
						}
						?>
												
					</tbody>
				</table>
			</div>
			<div class="no-break">
				<table class="grand-total">
					<tbody>
						<tr>							
							<td class="qty"></td>
							<td class="qty"></td>
							<td class="qty"></td>							
							<td class="unit">TOTAL QTY:</td>
							<td class="total"><?php echo $total_qty?></td>
						</tr>						
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">			
			<div class="notice">
				<div>NOTE TO SELLER:</div>
				<div><?php echo $notes?></div>
			</div>
			<div class="thanks">Thank you!</div>
			<div class="end">Delivery Slip was created on a computer and is valid without the signature and seal.</div>
		</div>
	</footer>