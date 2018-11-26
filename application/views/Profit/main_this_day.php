
<div id="table_day">

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
	<?php if(is_array($day) && $day){ ?>
	<?php foreach ($day as $key => $val): ?>
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

	<?php if(is_array($agent_payment_day) && $agent_payment_day){ ?>
	<?php foreach ($agent_payment_day as $key => $val): ?>
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

	<?php if(is_array($expenses_day) && $expenses_day){ ?>
	<?php foreach ($expenses_day as $key => $val): ?>
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
	<?php if(is_array($day_discount) && $day_discount){ ?>
	<?php foreach ($day_discount as $key => $val): ?>
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
<input name="b_print" type="button" class="ipt"   onClick="printdiv('table_day');" value=" Print ">
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