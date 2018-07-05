<main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $complete_name?></h2>         
        </div>
        <div id="invoice">
          <h1>#<?php echo $id_order?></h1>
          <div class="date">Date of Invoice: <?php echo long_date($date_add)?></div>         
        </div>
      </div>
      <table>
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">LABEL CODE</th>
            <th class="desc">NO. MAWB/SMU</th>
            <th class="desc">HAWB</th>            
            <th class="qty">KOLI</th>
            <th class="qty">QTY</th>            
          </tr>
        </thead>        
		<tbody class="body">
			<?php 
			$no=1;
			foreach ($detail as $row){							
				echo '<tr>
						<td class="no">'.$no++.'</td>	
          				<td class="desc">'.$row->id_label_dest.'</td>							 
						<td class="desc">'.substr_awb($row->awb_no)['subnumber1'].' '.substr_awb($row->awb_no)['subnumber2'].'</td>
						<td class="desc">'.$row->hawb_no.'</td>          				
          				<td class="qty">'.$row->hawb_pcs.'</td>
						<td class="qty">'.$row->qty_print.'</td>						
					</tr>';							
			}
		?>			
		</tbody>													
        <tfoot>        
          <tr>          	      	
          	<td colspan=4 rowspan=3 style="text-align:center"><?php echo 'TOTAL KOLI : '.$total_koli.' <br>TOTAL QTY : '.$total_qty?></td>        
          	          
            <td>SUBTOTAL</td>
            <td><?php echo ISOCODE.' '.number_format($total_price)?></td>
          </tr>
          <tr>          	         
            <td>TAX 10%</td>
            <td><?php echo ISOCODE.' '.number_format($total_amount_tax)?></td>
          </tr>
          <tr>            
            <td>GRAND TOTAL</td>
            <td><?php echo ISOCODE.' '.number_format($total_price_tax)?></td>
          </tr>
        </tfoot>
      </table>      
      <div id="notices">
        <div>Thank you!</div>
        <div class="notice">Cashier : <?php echo $this->session->userdata('first_name')?></div>
      </div>
    </main>