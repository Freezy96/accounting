<?php $this->load->view('template/sidenav'); ?>
<table class="table livesearch">
		<thead>
			<tr>
				<td>
					NAME
				</td>
				<td>
					Salary
				</td>
				<td>
					Contact Num
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
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['employeename']; ?>
			</td>
			<td>
				<?php echo $val['salary']; ?>
			</td>
			<td>
				<?php echo $val['contactnum']; ?>
			</td>
		
			<td>
				<div class="btn-group">
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
<?php } ?>
</table>

<a class="btn btn-default" href="<?php echo site_url('employee/insert'); ?>">Insert New Account</a></li>