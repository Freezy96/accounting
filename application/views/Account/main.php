<?php $this->load->view('template/sidenav'); ?>
<table class="table">
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
					<!-- <div class="row">
						<form action='<?php echo base_url();?>customer/update' method='post' name='customeredit'>
						<button class="btn" value="<?php echo $val["customerid"]; ?>" name="customerid">Edit</button>
						</form>
						<form action='<?php echo base_url();?>customer/delete' method='post' name='customerdelete'>
							<button class="btn" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["customerid"]; ?>" name="customerid">Delete</button>
						</form>
					</div> -->
				</td>
		</tr>
	<?php endforeach ?>
</table>