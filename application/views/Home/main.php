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
					$now = strtotime(date("Y-m-d")); // or your date as well
		            $due_date = strtotime($val['MAX(a.duedate)']);
		            $timeDiff = abs($now - $due_date);
		            $days = $timeDiff/86400; 
					// $now = time(); // or your date as well
		   //          $due_date = strtotime($val['duedate']);
		   //          $datediff = $now - $due_date;
		   //          $days = round($datediff / (60 * 60 * 24));

		            // $dayleft = round(($due_date - $now) / (60 * 60 * 24));
				 ?>
				<?php if (strtotime($val['MAX(a.duedate)']) <= strtotime("+4 day", time()) && $due_date >= time()-86400): ?>
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
						<?php echo $val['MIN(a.datee)']; ?>
					</td>
					<td>
						<?php echo $val['MAX(a.duedate)']; ?>
					</td>
					<td>
						<span style="color: 
							<?php if ($days == 1): $msg = "1 day left"; ?>
								red
							<?php elseif ($days == 0): $msg = "today"; ?>	
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
						<?php echo $val['packageid']; ?> - <?php echo $val['packagetypename']; ?>
					</td>
					<td>
						<?php echo $val['agentname']; ?>
					</td>
					<td>
						<?php echo $val['phoneno']; ?>
					</td>
					<td>

						<?php if ($val['MAX(a.homeremind)'] == "checked"): ?>
							<input type="checkbox" class="home_check" name="" value="<?php echo $val['MAX(a.accountid)']; ?>" checked>
						<?php else: ?>
							<input type="checkbox" class="home_check" name="" value="<?php echo $val['MAX(a.accountid)']; ?>">
						<?php endif ?>
					</td>
				</tr>
				<?php endif ?>
				
			<?php endforeach ?>
		<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account/insert'">New Account</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account'">View Account/Payment</button>
</div>

</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>profit'">Profit & Loss</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>backup'">Backup Database</button>
</div>

</div>
<br>

<div class="row">

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>customer'">View Customer</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>package'">View Package</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>agent'">View Agent</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>account/baddebt'">View Baddebt</button>
</div>

</div>

<br>
<div class="row">

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>customer/insert'">New Customer</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>package/insert'">New Package</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>agent/insert'">New Agent</button>
</div>

<div class="col-sm-3">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>register'">New Company</button>
</div>

</div>
