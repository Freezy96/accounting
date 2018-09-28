<?php $this->load->view('template/sidenav'); ?>
<table class="table livesearch">
		<thead>
			<tr>
				<td>
					NAME
				</td>
				<td>
					Lent
				</td>
				<td>
					Return
				</td>
				<!-- <td>
					PAYMENT
				</td> -->
				<td>
					START DATE
				</td>
				<!-- <td>
					DUEDATE
				</td> -->
				<!-- <TD>
					INTEREST
				</TD> -->
				<TD>
					PACKAGE
				</TD>
				<TD>
					AGENT
				</TD>
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
	<?php foreach ($result as $key => $val):
	$status=$val['status'];
	if($status !=="baddebt"){?>
		<tr>
			<td>
				<?php echo $val['customername']; ?>
			</td>
			<td>
				<?php foreach (${'p' . $val['packageid']} as $key => $value): ?>
					<?php echo $value['lentamount']; ?>
				<?php endforeach ?>
			</td>
			<td>
				<?php echo $val['oriamount']; ?>
			</td>
			<!-- <td>
				<?php echo $val['payment']; ?>
			</td> -->
			<td>
				<?php echo $val['datee']; ?>
			</td>
			<!-- <td>
				<?php echo $val['duedate']; ?>
			</td> -->
			<!-- <td>
				<?php echo $val['interest']; ?>
			</td> -->
			<td>
				<?php echo $val['packageid']; ?> - <?php echo $val['packagetypename']; ?>
			</td>
			<td>
				<?php if ($val['agentname']!=""): ?>
				<?php echo $val['agentname']; ?>	
				<?php else: ?>
				<?php echo "-"; ?>	
				<?php endif ?>
			</td>
		
			<td>
				<div class="row">
					<!-- <form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
					<button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
					</form> -->
					<!-- <form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["accountid"]; ?>" name="accountid">Delete</button>
					</form> -->
						<button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button>
						<form action='<?php echo base_url();?>account/set_baddebt' method='post'>
						<button class="btn btn-default" value="<?php echo $val["accountid"]; ?>" name="set_baddebt">baddebt</button>
						</form>
				</div>
			</td>
		</tr>
	<?php } endforeach ?>
<?php } ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('account/insert'); ?>">Insert New Account</a></li>

