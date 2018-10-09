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
<th colspan="3" style="text-align: center;">Debit</th>
</tr>
<tr>
<th>Date</th>
<th>Description</th>
<th>Amount</th>
</tr>
</thead>
<tbody>

	<?php 
	$debit=0;
	if(is_array($result) && $result){ 
		$debit=0;
	 foreach ($result as $key => $val): 
	$type=$val['type'];
// echo $date_month;
		?>
		<?php 

	if ($balance<0) {?>
		<td colspan="2" align="right">
			<?php
			echo "Balance b/f:Credit ".$balance;
			?>
		</td><?php
	}elseif ($balance>0) {
		?>
		<td colspan="2" align="left">
		<?php
		echo "Balance b/f:Debit ".$balance;
		?>
		</td>
	<?php
	}?>
<?php if ($type=="receive"){?>
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td align="right"><?php echo $val['amount']; $debit+= $val['amount'];?></td>
</tr>
<?php } ?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
<td width="50%" style="vertical-align: top;">
<table  class="table table-condensed">
<thead>
<tr>
<th colspan="3" style="text-align: center;">Credit</th>
</tr>
<tr>
<th>Date</th>
<th>Description</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
	<?php $credit=0;
	if(is_array($result) && $result){ 
	$credit=0;
	 foreach ($result as $key => $val): 
	$type=$val['type'];
		?>
		 <?php if ($type=="payment"){?>
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td align="right"><?php echo $val['amount'];$credit+= $val['amount']; ?></td>
</tr>
<?php }?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
</tr>
<tr>

	<?php 
	$balancec = abs($debit-$credit);
	if ($debit>$credit) {?>
		<td colspan="2" align="right">
			<?php
			echo "Balance c/f:Credit ".$balancec;
			?>
		</td><?php
	}elseif ($credit>$debit) {
		?>
		<td colspan="2" align="left">
		<?php
		echo "Balance c/f:Debit ".$balancec;
		?>
		</td>
	<?php
	}?>


</tr>
<h3>
<?php 
	$balance = abs($debit-$credit);
	if ($debit>$credit) {
		echo "Balance:Credit ".$balance;
	}elseif ($credit>$debit) {
		echo "Balance:Debit ".$balance;
	}else{

	}
	 ?>
	 </h3>
</table>
<a class="btn btn-default" href="<?php echo site_url('book/insertbank'); ?>" >Insert</a>
