<?php $this->load->view('template/sidenav'); ?>
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
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php $count=0; ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<?php if($count<2){ ?>
			<?php foreach ($val as $fieldname => $value): ?>
				<td>
					<?php echo $fieldname; ?>
				</td>
				<?php $count++; ?>
			<?php endforeach ?>
			<?php } ?>
		</tr>
		<tr>
			<?php foreach ($val as $fieldname => $value): ?>
				<td>
					<?php echo $value; ?>
				</td>
			<?php endforeach ?>
				<td>
					<div class="row">
						<form action='<?php echo base_url();?>employee/update' method='post' name='employeeedit'>
						<button class="btn btn-primary" value="<?php echo $val["employeeid"]; ?>" name="employeeidedit">Edit</button>
						</form>
						<form action='<?php echo base_url();?>employee/delete' method='post' name='employeedelete'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["employeeid"]; ?>" name="employeeiddelete">Delete</button>
						</form>
					</div>
				</td>
		</tr>
	<?php endforeach ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('employee/insert'); ?>">Insert New Account</a></li>