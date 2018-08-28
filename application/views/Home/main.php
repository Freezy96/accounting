<?php $this->load->view('template/sidenav'); ?>
<p>
	<a class="btn btn-default btn-lg btn-block" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Debt Collect Reminder <span class="caret"></a>
</p>

<div class="collapse" id="collapseExample" aria-expanded="true" style=""> 
	<div class="well"> 
		<table class="table livesearch">
			<thead>
				<tr>
					<td>
						CUSTOMER ID - NAME
					</td>
					<td>
						AMOUNT
					</td>
					<!-- <td>
						PAYMENT
					</td> -->
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
			<?php if(is_array($result) && $result){ ?>
			<?php foreach ($result as $key => $val): ?>
				<?php 

					$now = time(); // or your date as well
		            $due_date = strtotime($val['duedate']);
		            $datediff = $now - $due_date;
		            $days = round($datediff / (60 * 60 * 24));

		            $dayleft = round(($due_date - $now) / (60 * 60 * 24));
				 ?>
				<?php if (strtotime($val['duedate']) <= strtotime("+4 day", time()) && $due_date > time()): ?>
				<tr>
					<td>
						<?php echo $val['customerid']; ?> - <?php echo $val['customername']; ?>
					</td>
					<td>
						<?php echo $val['SUM(a.totalamount)']; ?>
					</td>
<!-- 					<td>
						<?php echo $val['payment']; ?>
					</td> -->
					<td>
						<?php echo $val['datee']; ?>
					</td>
					<td>
						<?php echo $val['duedate']; ?>
					</td>
					<td>
						<span style="color: 
							<?php if ($dayleft+1 == 1): $msg = "1 day left"; ?>
								red
							<?php elseif ($dayleft+1 == 2): $msg = "2 day left"; ?>	
								orange
							<?php elseif ($dayleft+1 == 3): $msg = "3 day left"; ?>
								green
							<?php elseif ($dayleft+1 == 4): $msg = "4 day left"; ?>
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
						<?php echo $val['packageid']; ?> - <?php echo $val['packagetypename']; ?>
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
		<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account/insert'">Insert New Account</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>customer/insert'">Insert New Customer</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>package/insert'">Insert New Package</button>
</div>
</div>
<div class="row">
<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>profit/'">Profit & Loss</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>backup/'">Backup</button>
</div>

<div class="col-sm-4">
	<button class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>profit/'">Profit & Loss</button>
</div>
</div>