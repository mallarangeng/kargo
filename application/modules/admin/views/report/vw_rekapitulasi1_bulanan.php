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
      <table>
        <thead>
          <tr>
            <th class="no" rowspan=2>#</th>
            <th class="desc" rowspan=2>Tanggal</th>
            <th class="qty" rowspan=2>Qty</th>
            <th class="total" colspan=3>Pendapatan</th>   
             <th class="unit" rowspan="2">TOTAL</th>          
            <th class="unit" rowspan=2>PPn</th>
            <th class="total" rowspan=2>Total incl PPn</th>
          </tr>          
          <tr>
          	<th class="qty">Shift 1</th>
          	<th class="qty">Shift 2</th>
          	<th class="qty">Shift 3</th>
         </tr>
        </thead>        
		<tbody class="body">
			<?php 			
			$i=0;			
			$no=1;
			foreach ($rekap as $row){
				echo '<tr><td class="desc">'.$no++.'</td>
     	  				   <td class="desc">'.short_date($row->date_add).'</td>
          				   <td class="qty">'.$row->total_qty.'</td>';
				$countshift = count($detail[$i]);				
					if ($countshift > 2){
						foreach ($detail[$i] as $x){
							echo '<td class="unit">'.ISOCODE.' '.number_format($x->total_price).'</td>';								
						}
					}else if($countshift == 2){
						echo '<td class="unit"></td>';
						foreach ($detail[$i] as $x){							
							echo '<td class="unit">('.$x->shift_name.') '.ISOCODE.' '.number_format($x->total_price).'</td>';						
						}													
					}else if($countshift == 1){
						echo '<td class="unit"></td>';
						echo '<td class="unit"></td>';
						foreach ($detail[$i] as $x){							
							echo '<td class="unit">('.$x->shift_name.') '.ISOCODE.' '.number_format($x->total_price).'</td>';					
						}														
					}else{
						echo '<td class="unit"></td>
        				   	  <td class="unit"></td>
        				      <td class="unit"></td>';
					}					       			
        		    echo '<td class="unit">'.ISOCODE.' '.number_format($row->total_price).'</td>
          		 		  <td class="unit">'.ISOCODE.' '.number_format($row->total_amount_tax).'</td>
            			  <td class="total">'.ISOCODE.' '.number_format($row->total_price_tax).'</td>
        				</tr>';
        		    $i++;
			}?>
		</tbody>
		<tfoot>
			<tr>			
				<td colspan=2 class="unit">TOTAL</td>
				<td class="qty"><?php echo $total_qty?></td>
				<?php foreach ($byshift as $v){
					echo '<td class="qty">'.ISOCODE.' '.number_format($v->total_price).'</td>';
				}?>				
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