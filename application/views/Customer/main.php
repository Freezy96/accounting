<?php $this->load->view('template/sidenav'); ?>
<table class="table livesearch">

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
				Wechat Name
				</td>
				<td>
					ADDRESS
				</td>
				<td>
					GENDER
				</td>
				<td>
					PHONE NO.
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
				<?php echo $val['customerid']; ?>
			</td>
			<td>
				<?php echo $val['customername']; ?>
			</td>
						<td>
				<?php echo $val['wechatname']; ?>
			</td>
			<td>
				<?php echo $val['address']; ?>
			</td>
			<td>
				<?php echo $val['gender']; ?>
			</td>
			<td>
				<?php echo $val['phoneno']; ?>
			</td>
				<td>
					<div class="row">
						<form action='<?php echo base_url();?>customer/update' method='post' name='customeredit'>
						<button class="btn btn-primary" value="<?php echo $val["customerid"]; ?>" name="customeridedit">Edit</button>
						</form>
						<form action='<?php echo base_url();?>customer/delete' method='post' name='customerdelete'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["customerid"]; ?>" name="customeriddelete">Delete</button>
						</form>
					</div>
				</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
	</tbody>
</table>
<a class="btn btn-default" href="<?php echo site_url('customer/insert'); ?>">Insert New Account</a></li>