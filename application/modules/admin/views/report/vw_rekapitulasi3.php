<main>
      <div id="details" class="clearfix">
        <div id="client">         
     	  <div class="to"><?php echo strtoupper($title)?></div>
          <h2 class="name"><?php echo $title2?></h2>
        </div> 
        <div id="invoice">         
     	  <div class="to">Create Date :<?php echo date('d/m/Y')?></div>
     	   <div class="to">Create By :<?php echo $this->session->userdata('first_name')?></div>         
        </div>       
      </div>
      <table border="1" cellspacing="1" cellpadding="1">
        <thead>
          <tr>
            <th class="no" rowspan=2>#</th>
            <th class="unit" rowspan=2>Shift</th>
            <th class="unit" rowspan=2>No Invoice</th>
            <th class="unit" rowspan=2>Tgl. Invoice</th>
            <th class="unit" colspan=4>Pembayaran</th>   
            <th class="unit">Keterangan</th>                    
          </tr> 
          <tr><th class="unit">Customer</th>
          	  <th class="unit">Total</th>
          	  <th class="unit">PPn 10%</th>
          	  <th class="unit">Grand Total</th>
          	  
          	  <th class="qty">Qty Print</th>  
          	         	  
          </tr>         
        </thead>        
		<tbody class="body">
			<?php 
			$no=1;
			foreach ($order as $row){
				echo '<tr>
        				<td class="desc">'.$no++.'</td>
        				<td class="desc">'.$row->shift_name.'</td>
						<td class="desc">'.$row->id_order.'</td>
						<td class="desc">'.short_date_time($row->date_add).'</td>
						<td class="desc">'.$row->complete_name.'</td>
						<td class="unit">'.ISOCODE.' '.number_format($row->total_price).'</td>
						<td class="unit">'.ISOCODE.' '.number_format($row->total_amount_tax).'</td>
						<td class="unit">'.ISOCODE.' '.number_format($row->total_price_tax).'</td>
						<td class="qty">'.$row->total_qty.'</td>
						
		      		</tr>';
			}?>
			
		</tbody>
		<tfoot>
			<tr><td colspan=5 class="unit"> TOTAL</td>
				<td><?php echo ISOCODE.' '.number_format($total_price)?></td>
				<td><?php echo ISOCODE.' '.number_format($total_amount_tax)?></td>
				<td><?php echo ISOCODE.' '.number_format($total_price_tax)?></td>
				<td><?php echo $total_qty?></td>								
			</tr>
		</tfoot>											       
      </table>        
      	 
    </main>