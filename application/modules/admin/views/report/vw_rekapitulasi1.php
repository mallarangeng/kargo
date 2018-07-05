<main>
      <div id="details" class="clearfix">
        <div id="client">         
     	  <div class="to"><?php echo strtoupper($title)?></div>
          <h2 class="name"><?php echo $title2?></h2>
        </div>  
        <div id="invoice">         
     	  <div class="to">Create Date :<?php echo date('d/m/Y')?></div>         
        </div>      
      </div>
      <table border="1" cellspacing="1" cellpadding="1">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">Tanggal</th>
            <th class="qty">Qty</th>
            <th class="qty">Pendapatan</th>   
             <th class="unit">TOTAL</th>          
            <th class="unit">PPn</th>
            <th class="total">Total incl PPn</th>
          </tr>          
        </thead>        
		<tbody class="body">
			<?php 			
			$i=0;			
			$no=1;
			foreach ($rekap as $row){
				echo '<tr><td class="no">'.$no++.'</td>
        				  <td class="desc">'.short_date($row->date_add).'</td>
     	  				  <td class="qty">'.$row->total_qty.'</td>
        				  <td class="desc">';												
						foreach ($detail[$i] as $x){					
							echo '('.$x->shift_name.') '.ISOCODE.' '.number_format($x->total_price).' | ';
							
						}						
          			echo '</td>
            			  <td class="unit">'.ISOCODE.' '.number_format($row->total_price).'</td>
          		 		  <td class="unit">'.ISOCODE.' '.number_format($row->total_amount_tax).'</td>
            			  <td class="total">'.ISOCODE.' '.number_format($row->total_price_tax).'</td>
     	  			  </tr>';
		          		  
           	 $i++;
			}?>
		</tbody>
		<tfoot>
			<tr>			
				 <td colspan=2" class="unit">TOTAL</td>
				 <td class="qty"><?php echo $total_qty?></td>
				 <td class="desc"><?php echo $byshift?></td>
				 <td class="unit"><?php echo ISOCODE.' '.number_format($total_price)?></td>
				 <td class="unit"><?php echo ISOCODE.' '.number_format($total_amount_tax)?></td>
				 <td class="total"><?php echo ISOCODE.' '.number_format($total_price_tax)?></td>
			</tr>
		</tfoot>											       
      </table>      
     <div class="left">
		 <h3>Cashier</h3>
		<hr><h3><?php echo $this->session->userdata('first_name')?></h3>
	  </div> 
      <div class="right">
		 <h3>Supervisor Cashier</h3>
		<hr>
	  </div>
    </main>