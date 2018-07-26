<?php $this->load->view('template/sidenav'); ?>
<table class="table">

	<!-- get session success = true / fail = false -->
	<?php $return = $this->session->flashdata('return'); ?>
	<!-- <?php print_r($return); ?> -->
	<?php if (isset($return) && $return!="") { ?>
	<CENTER class="showstate">
		<h3 style="color:
		<?php 
		if($return['return'] == "delete")
		{
			echo "green";
			$message = "Data Deleted Successfully";
		}
		elseif($return['return'] == "insert")
		{
			echo "green";
			$message = "Data Inserted Successfully";
		} 
		elseif($return['return'] == "update")
		{
			echo "green";
			$message = "Data Updated Successfully";
		}
		else
		{
			echo "red";
			$message = "Data Process Failed";
		} 
		?>

		;">
			<?php echo $message; ?>
		</h3>
	</CENTER>
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
						<form action='<?php echo base_url();?>customer/update' method='post' name='customeredit'>
						<button class="btn" value="<?php echo $val["customerid"]; ?>" name="customeridedit">Edit</button>
						</form>
						<form action='<?php echo base_url();?>customer/delete' method='post' name='customerdelete'>
							<button class="btn" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["customerid"]; ?>" name="customeriddelete">Delete</button>
						</form>
					</div>
				</td>
		</tr>
	<?php endforeach ?>
</table>