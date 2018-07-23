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
		</tr>
	<?php endforeach ?>
</table>