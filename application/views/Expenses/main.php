<?php $this->load->view('template/sidenav'); ?>
<table class="table livesearch">
		<thead>
			<tr>
				<td>
					Expenses ID
				</td>
				<td>
					Item
				</td>
				<td>
					Fee
				</td>
				<td>
					Date
				</td>
				<td>
					Action
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['expensesid']; ?>
			</td>
			<td>
				<?php echo $val['expensesitem']; ?>
			</td>
			<td>
				<?php echo $val['expensesfee']; ?>
			</td>
			<td>
				<?php echo $val['expensesdate']; ?>
			</td>
			<td>
				<div class="btn-group">
					<form action='<?php echo base_url();?>expenses/update' method='post' name='expensesedit'>
					<button class="btn btn-primary" value="<?php echo $val["expensesid"]; ?>" name="expensesidedit">Edit</button>
					</form>
					<form action='<?php echo base_url();?>expenses/delete' method='post' name='expensesdelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["expensesid"]; ?>" name="expensesiddelete">Delete</button>
					</form>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
</table>

<a class="btn btn-default" href="<?php echo site_url('expenses/insert'); ?>">Insert New Account</a></li>