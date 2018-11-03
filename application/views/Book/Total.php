<?php $this->load->view('template/sidenav'); ?>

<h1>Total</h1>
<form action="<?php echo base_url();?>book/total" method="post" name="">
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date </label>
	    <input type="date" class="form-control date_book" id="date" placeholder="" name="date" value="<?php echo date("Y-m-d"); ?>">
	    <input type="hidden" name="day" class="book_day_input" value="<?php echo date("d"); ?>">
	    <input type="hidden" name="month" class="book_month_input" value="<?php echo date("m"); ?>">
	    <input type="hidden" name="year" class="book_year_input" value="<?php echo date("Y"); ?>">
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
<th>Debit</th>
<th>Credit</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
	$total=0;
	$tdebit=0;
    $tcredit=0;
	 
	
$date = $this->input->post('date');
 ?>
<td> </td>
<td>Balance forward</td>
<td><?php if($balance<0){echo $balance; $total=$balance;}else{};?></td>
<td><?php if($balance>0){echo $balance; $total=$balance;}else{};?></td>
<td><?php echo $total?></td>
</tr>

	<?php if(is_array($result) && $result){
	 foreach ($result as $key => $val): 
	$type=$val['type'];
// echo $date_month;
		?>
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>

<td><font color="red"><?php if ($type=="debit"){echo $val['amount'];$total-= $val['amount'];echo $val['bank'];$tdebit+= $val['amount']; }else{}?></font></td>
<td><?php if ($type=="credit"){echo $val['amount'];$total+= $val['amount'];echo $val['bank'];$tcredit+= $val['amount']; }else{}?></td>
<td>
    <?php echo $total?>
    &nbsp;&nbsp;&nbsp;<form action='<?php echo base_url();?>book/delete_total' method='post' name=''><button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_total_id">Del</button></form>
</td>
</tr>
<?php endforeach ?>
<?php } ?>
<tr>
<td> </td>
<td> </td>
    <td>
        Total Debit:<?php echo $tdebit;?></td>
        <td>
        Total Credit:<?php echo $tcredit;?>
    </td>
</tr>
</table>

<br>
<br>
<br>
<table width="100%">
<form action='<?php echo base_url();?>Book/inserttotaldata' method='post' name='insert' enctype="multipart/form-data">
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
        <option value="">------------</option>
        <option value="mbb">MBB</option>   
        <option value="pbb">PBB</option>
        <option value="rhb">RHB</option>   
        <option value="hlb">HLB</option>
        </select>
 	</td>
 	<td>
 	<label for="">Type:</label>
    <select name="type" required>
        <option value="" selected disabled>------------</option>
        <option value="debit" style="color:red">DEBIT</option>   
        <option value="credit" style="color:green">CREDIT</option>
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