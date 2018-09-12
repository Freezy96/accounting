<table class="table livesearch">

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
						INTEREST PER DAY LATE (RM)
					</td>
					<td>
						AMOUNT EVERYDAY
					</td>
					<td>
						PAY HOW MANY DAY
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
	<?php if(is_array($main_manual_payeveryday_manualdays) && $main_manual_payeveryday_manualdays){ ?>
	<?php foreach ($main_manual_payeveryday_manualdays as $key => $val): ?>
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
				<?php echo $val['amounteveryday']; ?>
			</td>
			<td>
				<?php echo $val['days']; ?>
			</td>
			<td>
				<div class="btn-group">
					<!-- <form action='<?php echo base_url();?>package/update_30_4week' method='post' name='packageedit'>
					<button class="btn btn-primary" value="<?php echo $val["packageid"]; ?>" name="agentidedit">Edit</button>
					</form> -->
					<form action='<?php echo base_url();?>package/delete_manual_payeveryday_manualdays' method='post' name='packagedelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["packageid"]; ?>" name="packagedelete">Delete</button>
					</form>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
</table>