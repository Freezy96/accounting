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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="account_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
      Customer: <span id="account_modal_customer"></span><br>
      Reference ID: <span id="account_modal_refid"></span><br>
      Total Amount: <span id="account_modal_oriamount"></span><br>
      Package: <span id="account_modal_package"></span><br>
      Agent: <span id="account_modal_agent"></span><br><br>
      <table class="account_modal_table table livesearch">
      	<thead></thead>
      	<tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
      	<form id="pay_amount" action='<?php echo base_url();?>account/payment/' method='post' name='accountpayamount'>
			<!-- ajax script generated button -->
		</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>