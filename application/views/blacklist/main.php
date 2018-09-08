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
					PASSPORT/IC
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
	<tr>
			<td>
				<?php echo $val['customerid']; ?><img src="<?php echo $val['photopath'];?>" height="200" width="200" /><br>
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
				<?php echo $val['passport']; ?>
			</td>
				<td>
					<div class="btn-group">
						<form action='<?php echo base_url();?>blacklist/update' method='post' name='blacklistedit'>
						<button class="btn btn-primary" value="<?php echo $val["blacklistid"]; ?>" name="blacklistidedit">Edit</button>
						</form>
						<form action='<?php echo base_url();?>blacklist/delete' method='post' name='blacklistdelete'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["blacklistid"]; ?>" name="blacklistiddelete">Delete</button>
						</form>
					</div>
				</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
	</tbody>
</table>
<a class="btn btn-default" href="<?php echo site_url('blacklist/insert'); ?>">Insert New Customer into Black List</a></li>