
<div id="table_year">
	

<table class="table table-condensed" border="1" width="100%">

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
	<?php if(is_array($year) && $year){ ?>
	<?php foreach ($year as $key => $val): ?>
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
	<?php if ($year_lent_loss!==0): ?>
		<tr>
			<td>
				Lent to customer
			</td>
			<td>
				<?php echo number_format($year_lent_loss, 2, '.', ''); ?>
			</td>
		</tr>
		<?php $loss+=$year_lent_loss; ?>
	<?php endif ?>

	<?php if(is_array($agent_payment_year) && $agent_payment_year){ ?>
	<?php foreach ($agent_payment_year as $key => $val): ?>
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

	<?php if(is_array($expenses_year) && $expenses_year){ ?>
	<?php foreach ($expenses_year as $key => $val): ?>
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

	<?php if ($year_employee_loss!==0): ?>
		<tr>
			<td>
				Employee Salary
			</td>
			<td>
				<?php echo number_format($year_employee_loss, 2, '.', ''); ?>
			</td>
		</tr>
		<?php $loss+=$year_employee_loss; ?>
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
	<?php if(is_array($year_discount) && $year_discount){ ?>
	<?php foreach ($year_discount as $key => $val): ?>
		<?php if ($val['SUM(payment)'] != 0): ?>
			<tr>
				<td>
					Payment from customer (Discount)
				</td>
				<td>
					<?php echo "- ".$val['SUM(payment)']; ?>
				</td>
			</tr>	
		<?php endif ?>
	<?php endforeach ?>
	<?php } ?>

	<?php if ($pi_year > 0): ?>
			<tr>
				<td>
					Pure Interest
				</td>
				<td>
					<?php echo $pi_year; ?>
				</td>
			</tr>	
		<?php endif ?>
	<!-- additional---------------------------------------------------------------------------- -->	
	<tr>
		<td>
			<h3>Net</h3>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>	
	<!-- net profit -->
	<?php $net_profit = number_format($profit-$loss-$additional_minus, 2, '.', ''); ?>
	<?php $employee_bonus = number_format(($net_profit*110/100)-$net_profit, 2, '.', ''); ?>
	<!-- 10% employee---------------------------------------------------------------------------- -->	
	<?php if ($employee_bonus>=0): ?>
		<tr>
			<td>
				Bonus 10% for employee 
			</td>
			<td>
				<?php echo $employee_bonus; ?>
			</td>
		</tr>
	<?php endif ?>
	<!-- 10% employee---------------------------------------------------------------------------- -->	
	<!-- net---------------------------------------------------------------------------- -->	
	<tr>
		<td align="right">
			Net:
		</td>
		<td>
			<?php if ($employee_bonus>=0): ?>
				<?php echo $net_profit-$employee_bonus; ?>
			<?php else: ?>
				<?php echo $net_profit; ?>
			<?php endif ?>
			
		</td>
	</tr>
	<!-- net---------------------------------------------------------------------------- -->
	</tbody>
</table>
</div>
<input name="b_print" type="button" class="ipt"   onClick="printdiv('table_year');" value=" Print ">
<script type="text/javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title>    <link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap-theme.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/simple-sidebar.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/datatables.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/chosen.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/custom.css\"><!-- JS / JQUERY --><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/jquery-3.3.1.min.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/bootstrap.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/npm.js\"></\script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/datatables.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.proto.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.jquery.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/custom.js\"><\/script></head><body>";

var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>