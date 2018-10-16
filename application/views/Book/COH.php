<?php $this->load->view('template/sidenav'); ?>

<h1>Cash On Hand</h1>
<form action="<?php echo base_url();?>book/coh" method="post" name="">
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date </label>
	    <input type="date" class="form-control date_book" id="date" placeholder="" name="date">
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
<th>Amount</th>
<th>Total</th>
</tr>
</thead>
<tbody>

	<tr>
<?php if(is_array($result) && $result){
	 foreach ($result as $key => $val): 
	$debit=0;
$date = $this->input->post('date');
 ?>
<td><?php echo $date; ?></td>
<td>Balance forward</td>
<td></td>
<td ><?php  echo $balance; $debit=$balance;?></td>
</tr>
<?php endforeach ?>
	<?php
	 foreach ($result as $key => $val): 
	$type=$val['type'];
// echo $date_month;
		?>
	
<?php if ($type=="receive"){?>
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>

<td ><?php echo $val['amount'];$debit+= $val['amount']; ?></td>
<td><?php echo $debit;?></td>
</tr>
<?php }elseif ($type=="payment"){?> 
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td ><font color="red">echo $val['amount'];$debit-= $val['amount'];?></font></td>
<td><?php echo $debit;?></td>
</tr>
<?php }?> 
<?php endforeach ?>
<?php } ?>
</table>

<br>
<br>
<br>
<table width="100%">
<form action='<?php echo base_url();?>Book/insertcohdata' method='post' name='insert' enctype="multipart/form-data">
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
 	<label for="">Type:</label>
    <select name="type" required>
        <option value="" selected disabled>------------</option>
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




