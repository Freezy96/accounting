<?php $this->load->view('template/sidenav'); ?>

<h1>Bank</h1>
<form action="<?php echo base_url();?>book/bank" method="post" name="">
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date </label>
	    <input type="date" class="form-control date_book" id="" placeholder="" name="date">
	    <input type="hidden" name="day" class="book_day_input">
	    <input type="hidden" name="month" class="book_month_input">
	    <input type="hidden" name="year" class="book_year_input">
  	</div>
  	<button class="btn btn-default pull-right" id="submit">Submit</button>
</form>

<table width="100%">

<tr>
<td width="50%" style="vertical-align: top;">
<table  class="table table-condensed">
<thead>
<tr>

</tr>
<tr>
<th>Date</th>
<th>Description</th>
<th>MBB</th>
<th>PBB</th>
<th>RHB</th>
<th>HLB</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<tr>
<?php if(is_array($result) && $result){
	$debit=0;
 ?>
<td><?php echo $val['datee']; ?></td>
<td>Balance forward</td>
<td><?php echo $val[$mbb];?></td>
<td><?php echo $val[$pbb];?></td>
<td><?php echo $val[$rhb];?></td>
<td><?php echo $val[$hlb];?></td>
<td ><?php if ($balance>0) { echo $val[$balance];$debit=$balance;}?></td>
</tr>

		<?php
	 foreach ($result as $key => $val): 
	$type=$val['type'];
	$bank=$val['bank'];
// echo $date_month;
		?>
		
	
<?php if ($type=="receive"){?>
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td ><?php if($bank=="mbb"){echo $val['amount'];$debit+= $val['amount'];}else{ } ?></td>
<td ><?php if($bank=="pbb"){echo $val['amount'];$debit+= $val['amount'];}else{ } ?></td>
<td ><?php if($bank=="rhb"){echo $val['amount'];$debit+= $val['amount'];}else{ } ?></td>
<td ><?php if($bank=="hlb"){echo $val['amount'];$debit+= $val['amount'];}else{ } ?></td>
<td><?php echo $debit;?></td>
</tr>
<?php }elseif ($type=="payment"){?> 
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td ><font color="red"><?php if($bank=="mbb"){echo $val['amount'];$debit-= $val['amount'];}else{ } ?></font></td>
<td ><font color="red"><?php if($bank=="pbb"){echo $val['amount'];$debit-= $val['amount'];}else{ } ?></font></td>
<td ><font color="red"><?php if($bank=="rhb"){echo $val['amount'];$debit-= $val['amount'];}else{ } ?></font></td>
<td ><font color="red"><?php if($bank=="hlb"){echo $val['amount'];$debit-= $val['amount'];}else{ } ?></font></td>
<td><?php echo $debit;?></td>
</tr>
<?php }?> 
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
</tr>
</table>
<br>
<br>
<br>
<table width="100%">
<form action='<?php echo base_url();?>Book/insertbankdata' method='post' name='insert' enctype="multipart/form-data">
 <tr>
 <td>
 	<label for="">Date:</label>
    <input type="date" class="form-control" id="" name="datee" required>
 </td>
 	<td>
 		<label for="">Description:</label>
    <input type="text" class="form-control" id="" placeholder="Des" name="description" required>
 	</td>
 	<td>
 		<label for="">Bank:</label>
   <select name="bank">
        <option selected disabled>------------</option>
        <option value="mbb">MBB</option>   
        <option value="pbb">PBB</option>
        <option value="rhb">RHB</option>   
        <option value="hlb">HLB</option>
        </select>
 	</td>
 	<td>
 	<label for="">Type:</label>
    <select name="type">
        <option selected disabled>------------</option>
        <option value="payment">Payment</option>   
        <option value="receive">Receive</option>
    </select>
 	</td>
 	<td>
 	<label for="">Amount:</label>
<input type="number" step="0.01" class="form-control" id="" placeholder="Amount" name="amount" required>	
 	</td>
 	<td><button type="submit" class="btn btn-default">Submit</button></td>
 	
 </tr>
</form>
</table>



