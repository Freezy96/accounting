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
				<tr>
					<td>
						ID
					</td>
					<td>
						LENT AMOUNT
					</td>
					<td>
						TOTAL AMOUNT
					</td>
					<td>
						INTEREST PER DAY LATE
					</td>
					<td>
						WEEK 1
					</td>
					<td>
						WEEK 2
					</td>
					<td>
						WEEK 3
					</td>
					<td>
						WEEK 4
					</td>
					<td>
						ACTION
					</td>
				</tr>
			</thead>
			<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php $count=0; ?>
	<?php foreach ($main_30_4week as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['packageid']; ?>
			</td>
			<td>
				<?php echo $val['lentamount']; ?>
			</td>
			<td>
				<?php echo $val['totalamount']; ?>
			</td>
			<td>
				<?php echo $val['interest']; ?>
			</td>
			<td>
				<?php echo $val['week1']; ?>
			</td>
			<td>
				<?php echo $val['week2']; ?>
			</td>
			<td>
				<?php echo $val['week3']; ?>
			</td>
			<td>
				<?php echo $val['week4']; ?>
			</td>
			<td>
				<div class="row">
					<form action='<?php echo base_url();?>package/update_30_4week' method='post' name='packageedit'>
					<button class="btn btn-primary" value="<?php echo $val["packageid"]; ?>" name="agentidedit">Edit</button>
					</form>
					<form action='<?php echo base_url();?>package/delete_30_4week' method='post' name='packagedelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["packageid"]; ?>" name="agentiddelete">Delete</button>
					</form>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
</table>