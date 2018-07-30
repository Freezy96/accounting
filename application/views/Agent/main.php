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
			<thead>
				<tr>
					<td>
						ID
					</td>
					<td>
						NAME
					</td>
					<td>
						CHARGE %
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
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['agentid']; ?>
			</td>
			<td>
				<?php echo $val['agentname']; ?>
			</td>
			<td>
				<?php echo $val['charge']; ?>
			</td>
			<td>
				<div class="row">
					<form action='<?php echo base_url();?>agent/update' method='post' name='agentedit'>
					<button class="btn btn-primary" value="<?php echo $val["agentid"]; ?>" name="agentidedit">Edit</button>
					</form>
					<form action='<?php echo base_url();?>agent/delete' method='post' name='agentdelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["agentid"]; ?>" name="agentiddelete">Delete</button>
					</form>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('agent/insert'); ?>">Insert New Account</a></li>