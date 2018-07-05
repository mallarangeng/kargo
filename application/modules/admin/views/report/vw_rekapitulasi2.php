
<main>
      <div id="details" class="clearfix">
        <div id="client">         
     	  <div class="to"><?php echo strtoupper($title)?></div>
          <h2 class="name"><?php echo $title2?></h2>
        </div>    
        <div id="invoice">         
     	  <div class="to">Create Date: <?php echo date('d/m/Y')?></div>  
     	  <div class="to">Group: <?php echo $shift_name?></div>       
        </div>    
      </div>
      <table>
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">Description</th>
            <th class="desc">Pendapatan</th>                            
            <th class="total">Total</th>
          </tr>          
        </thead>        
		<tbody class="body">
			<tr><td class="no">A.</td>
				<td class="desc" colspan=3>LABEL BARCODE</td>				
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Jumlah Pemakaian</td>		
				<td class="desc"><?php echo $qtyshift?></td>	
				<td class="total"><?php echo $total_qty?></td>			
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Label Yang Void</td>		
				<td class="desc"></td>	
				<td class="total"></td>			
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Label Yang Terpakai</td>		
				<td class="desc"><?php echo $qtyshift?></td>	
				<td class="total"><?php echo $total_qty?></td>			
			</tr>			  
			<tr><td class="no"></td>
				<td class="desc">No. Invoice</td>		
				<td class="desc" colspan=2><?php echo $id_order?></td>								
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Total Invoice</td>		
				<td class="desc" colspan=2><?php echo $total_invoice?></td>								
			</tr>
			
			<tr><td colspan=4></td>				
			</tr>
			<tr><td class="no">B.</td>
				<td class="desc" colspan=3>PENDAPATAN</td>				
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Pendapatan</td>		
				<td class="total"><?php echo $totshift?></td>	
				<td class="total"><?php echo ISOCODE.' '.number_format($total_price)?></td>			
			</tr>
			<tr><td class="no"></td>
				<td class="desc">PPn</td>		
				<td class="total"><?php echo $taxshift?></td>	
				<td class="total"><?php echo ISOCODE.' '.number_format($total_amount_tax)?></td>			
			</tr>
			<tr><td class="no"></td>
				<td class="desc">Total</td>		
				<td class="total"><?php echo $totaxshift?></td>	
				<td class="total"><?php echo ISOCODE.' '.number_format($total_price_tax)?></td>			
			</tr>
			
		</tbody>												       
      </table>      
     <div class="left">
		 <h3>Approve By:</h3><h3>SPV.Cashier</h3>
		<hr>
	  </div> 
      <div class="right">
		 <h3>Create By:</h3><h3>Cashier</h3>
		<hr><h3><?php echo $this->session->userdata('first_name')?></h3>
	  </div>
    </main>