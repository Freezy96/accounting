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
	<?php if(is_array($main_30_4week) && $main_30_4week){ ?>
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
					<!-- <form action='<?php echo base_url();?>package/update_30_4week' method='post' name='packageedit'>
					<button class="btn btn-primary" value="<?php echo $val["packageid"]; ?>" name="agentidedit">Edit</button>
					</form> -->
					<form action='<?php echo base_url();?>package/delete_30_4week' method='post' name='packagedelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["packageid"]; ?>" name="packagedelete">Delete</button>
					</form>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
</table>