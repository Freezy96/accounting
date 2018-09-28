
<div id="table_month">
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
	<tr>
		<td>
			<h3>Profit</h3>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<?php $profit = 0; ?>
	<?php if(is_array($month) && $month){ ?>
	<?php foreach ($month as $key => $val): ?>
		<?php if ($val['SUM(payment)'] != 0): ?>
			<tr>
				<td>
					Payment from customer
				</td>
				<td>
					<?php echo $val['SUM(payment)']; ?>
				</td>
			</tr>
		<?php endif ?>
		
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
			<h3>Loss</h3>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<!-- Loss---------------------------------------------------------------------------- -->
	<?php $loss = 0; ?>
	<?php if ($month_lent_loss!==0): ?>
		<tr>
			<td>
				Lent to customer
			</td>
			<td>
				<?php echo number_format($month_lent_loss, 2, '.', ''); ?>
			</td>
		</tr>
		<?php $loss+=$month_lent_loss; ?>
	<?php endif ?>

	<?php if(is_array($agent_payment_month) && $agent_payment_month){ ?>
	<?php foreach ($agent_payment_month as $key => $val): ?>
		<?php if ($val['SUM(payment)'] != 0): ?>
			<tr>
				<td>
					Payment to agent
				</td>
				<td>
					<?php echo $val['SUM(payment)']; ?>
				</td>
			</tr>	
		<?php endif ?>
		
		<?php $loss+=$val['SUM(payment)']; ?>
	<?php endforeach ?>
	<?php } ?>


	<?php if(is_array($expenses_month) && $expenses_month){ ?>
	<?php foreach ($expenses_month as $key => $val): ?>
		<?php if ($val['SUM(expensesfee)'] != 0): ?>
			<tr>
				<td>
					Expenses
				</td>
				<td>
					<?php echo $val['SUM(expensesfee)']; ?>
				</td>
			</tr>	
		<?php endif ?>
		
		<?php $loss+=$val['SUM(expensesfee)']; ?>
	<?php endforeach ?>
	<?php } ?>


	<?php if ($month_employee_loss!==0): ?>
		<tr>
			<td>
				Employee Salary
			</td>
			<td>
				<?php echo number_format($month_employee_loss, 2, '.', ''); ?>
			</td>
		</tr>
		<?php $loss+=$month_employee_loss; ?>
	<?php endif ?>

	<tr>
		<td align="right">
			Total:
		</td>
		<td>
			<?php echo number_format($loss, 2, '.', ''); ?>
		</td>
	</tr>

	<!-- Loss---------------------------------------------------------------------------- -->
	<tr>
		<td>
			<h3>Additional</h3>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<?php $additional_minus = 0; ?>
	<!-- additional---------------------------------------------------------------------------- -->	
	<?php if(is_array($month_discount) && $month_discount){ ?>
	<?php foreach ($month_discount as $key => $val): ?>
		<?php if ($val['SUM(payment)'] != 0): ?>
			<tr>
				<td>
					Payment from customer (Discount)
				</td>
				<td>
					<?php echo "- ".$val['SUM(payment)']; ?>
				</td>
			</tr>
			<?php $additional_minus+=$val['SUM(payment)']; ?>	
		<?php endif ?>
	<?php endforeach ?>
	<?php } ?>
	<!-- additional---------------------------------------------------------------------------- -->	
	<tr>
		<td>
			<h3>Net</h3>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>	
	<!-- net---------------------------------------------------------------------------- -->	
	<tr>
		<td align="right">
			Net:
		</td>
		<td>
			<?php echo number_format($profit-$loss-$additional_minus, 2, '.', ''); ?>
		</td>
	</tr>
	<!-- net---------------------------------------------------------------------------- -->	
	</tbody>
</table>
</div>
<input name="b_print" type="button" class="ipt"   onClick="printdiv('table_month');" value=" Print ">
<script type="text/javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>