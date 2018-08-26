<h2>Profit & Loss</h2>
<table class="table">

	<!-- get session success = true / fail = false -->
	<?php $return = $this->session->flashdata('return'); ?>
	<!-- <?php print_r($return); ?> -->
	<?php if (isset($return) && $return!="") { ?>
		<?php 
		if($return['return'] == "delete")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Deleted Successfully</div>";
		}
		elseif($return['return'] == "insert")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Inserted Successfully</div>";
		} 
		elseif($return['return'] == "update")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Updated Successfully</div>";
		}
		else
		{
			echo "<div class=\"alert alert-danger showstate\" role=\"alert\">Process Fail !</div>";
		} 
		?>
	<br>
	<?php } ?>

		<thead>
			
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->

	
	<!-- profit---------------------------------------------------------------------------- -->
	<?php $profit = 0; ?>
	<?php if(is_array($day) && $day){ ?>
	<?php foreach ($day as $key => $val): ?>
		<tr>
			<td>
				Payment from customer
			</td>
			<td>
				<?php echo $val['SUM(payment)']; ?>
			</td>
		</tr>
		<?php $profit+=$val['SUM(payment)']; ?>
	<?php endforeach ?>
	<?php } ?>

	<?php if(is_array($day_discount) && $day_discount){ ?>
	<?php foreach ($day_discount as $key => $val): ?>
		<tr>
			<td>
				Payment from customer (Discount)
			</td>
			<td>
				<?php echo $val['SUM(payment)']; ?>
			</td>
		</tr>
		<?php $profit+=$val['SUM(payment)']; ?>
	<?php endforeach ?>
	<?php } ?>

		<tr>
			<td align="right">
				Total:
			</td>
			<td>
				<?php echo number_format($profit, 2, '.', ''); ?>
			</td>
		</tr>

	<!-- profit---------------------------------------------------------------------------- -->	
	<tr>
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<!-- Loss---------------------------------------------------------------------------- -->	
	<?php $loss = 0; ?>
	<?php if ($day_lent_loss!==0): ?>
		<tr>
			<td>
				Lent to customer
			</td>
			<td>
				<?php echo number_format($day_lent_loss, 2, '.', ''); ?>
			</td>
		</tr>
		<?php $loss+=$day_lent_loss; ?>
	<?php endif ?>
		
	</tbody>
</table>