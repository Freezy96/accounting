<?php $this->load->view('template/sidenav'); ?>
<p>
	<a class="btn btn-default btn-lg btn-block" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Debt Collect Reminder <span class="caret"></a>
</p>

<div class="collapse" id="collapseExample" aria-expanded="true" style=""> 
	<div class="well"> 
		<table class="table">
			<thead>
				<tr>
					<td>
						CUSTOMER ID - NAME
					</td>
					<td>
						ORIGINAL AMOUNT
					</td>
					<td>
						PAYMENT
					</td>
					<td>
						START DATE
					</td>
					<td>
						DUEDATE
					</td>
					<td>
						DAYS LEFT
					</td>
					<TD>
						INTEREST
					</TD>
					<TD>
						PACKAGE
					</TD>
					<TD>
						AGENT
					</TD>
					<td>
						Phone No.
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
			
			<?php foreach ($result as $key => $val): ?>
				<?php 
					$date1 = date("Y-m-d");
					$date2 = date("Y-m-d",strtotime($val['duedate']));

					$diff = abs(strtotime($date2) - strtotime($date1));

					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				 ?>
				<?php if (strtotime($val['duedate']) <= strtotime("+4 day", strtotime($date1)) && $date2 > $date1): ?>
				<tr>
					<td>
						<?php echo $val['customerid']; ?> - <?php echo $val['customername']; ?>
					</td>
					<td>
						<?php echo $val['oriamount']; ?>
					</td>
					<td>
						<?php echo $val['payment']; ?>
					</td>
					<td>
						<?php echo $val['datee']; ?>
					</td>
					<td>
						<?php echo $val['duedate']; ?>
					</td>
					<td>
						<span style="color: 
							<?php if ($days == 1): $msg = "1 day left"; ?>
								red
							<?php elseif ($days == 2): $msg = "2 day left"; ?>	
								orange
							<?php elseif ($days == 3): $msg = "3 day left"; ?>
								green
							<?php elseif ($days == 4): $msg = "4 day left"; ?>
								green
							<?php endif ?>
						;">
						<?php echo $msg; ?>
						</span>
					</td>
					<td>
						<?php echo $val['interest']; ?>
						
					</td>
					<td>
						<?php echo $val['packageid']; ?> - <?php echo $val['name']; ?>
					</td>
					<td>
						<?php echo $val['agentname']; ?>
					</td>
					<td>
						<?php echo $val['phoneno']; ?>
					</td>
					<td>
						<div class="row">
							<form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
							<button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
							</form>
							<form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
								<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["accountid"]; ?>" name="accountid">Delete</button>
							</form>
						</div>
					</td>
				</tr>
				<?php endif ?>
				
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account/insert'">Insert New Account</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>customer/insert'">Insert New Customer</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>package/insert'">Insert New Package</button>
</div>