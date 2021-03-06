<?php $this->load->view('template/sidenav'); ?>
<div style="overflow-x:auto;">
<table class="table livesearch">

	<!-- get session success = true / fail = false -->
	<?php $return = $this->session->flashdata('return'); ?>
	<!-- <?php print_r($return); ?> -->
	<?php if (isset($return) && $return!="") { ?>
		<?php 
		if($return['return'] == "delete")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Deleted Successfully</div>";
		}
		elseif($return['return'] == "insert")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Inserted Successfully</div>";
		} 
		elseif($return['return'] == "update")
		{
			echo "<div class=\"alert alert-success showstate\" role=\"alert\">Data Updated Successfully</div>";
		}
		else
		{
			echo "<div class=\"alert alert-danger showstate\" role=\"alert\">Process Fail !</div>";
		} 
		?>
	<br>
	<?php } ?>

		<thead>
			<tr>
				<td>
				ID
				</td>
				<td>
					NAME (PASSPORT/IC)
				</td>
					<td>
					WECHAT
				</td>
				<td>
					ADDRESS
				</td>
				<td>
					GENDER
				</td>
				<td>
					PHONE NO.
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
	<?php foreach ($result as $key => $val): 
		$status=$val['status'];
		?>
		 <?php if ($status=="good"){?>
			<tr bgcolor="#54FF9F" width="70%">
			 <?php }elseif ($status=="baddebt") {?>
			<tr bgcolor="#EE5C42" width="70%">
			<?php  }elseif ($status=="late") {?>
			<tr bgcolor="CDCD00" width="70%">
				<?php } ?>
			
		<?php ?>
		
			<td>
				<?php echo $val['customerid']; ?><img src="<?php echo $val['photopath'];?>" height="150" width="150" /><br>
			</td>
			<td>
				<?php echo $val['customername']; ?>	<?php echo "(".$val['passport'].")"; ?>
			</td>
			<td>
				<?php echo $val['wechatname']; ?>
			</td>
			<td>
				<?php echo $val['address']; ?>
			</td>
			<td>
				<?php echo $val['gender']; ?>
			</td>
			<td>
				<?php echo $val['phoneno']; ?>
			</td>
			
				<td >
					<div class="btn-group">
						<form action="javascript:void(0);">
							<button class="btn btn-default customer_payment_view" data-toggle="modal" data-target="#customer_modal" value="<?php echo $val['customerid']; ?>" data-name="<?php echo $val['customername']; ?>" name="accountid">View Payment</button>
						</form>
						<br>
						<form action="javascript:void(0);">
							<button class="btn btn-default customer_balance_view" data-toggle="modal" data-target="#customer_balance_modal" value="<?php echo $val['customerid']; ?>" data-name="<?php echo $val['customername']; ?>" name="accountid">View Balance</button>
						</form>
						<br>
						<form action="javascript:void(0);">
							<button class="btn btn-default customer_agent_view" data-toggle="modal" data-target="#customer_agent_modal" value="<?php echo $val['customerid']; ?>" data-name="<?php echo $val['customername']; ?>" name="accountid_agent">View Agent</button>
						</form>
						<br>
						<form action='<?php echo base_url();?>customer/update' method='post' name='customeredit'>
							<button class="btn btn-primary" value="<?php echo $val["customerid"]; ?>" name="customeridedit">Edit</button>
						</form>
						<br>
						<form action='<?php echo base_url();?>customer/delete' method='post' name='customerdelete'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["customerid"]; ?>" name="customeriddelete">Delete</button>
						</form>
						<br>
						<form action='<?php echo base_url();?>customer/resets' method='post' name='customerresetstatus'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to Reset This Status (3 days)');" value="<?php echo $val["customerid"]; ?>" name="customerresetstatus">ResetStatus</button>
						</form>
						<br>
						<form action='<?php echo base_url();?>customer/blacklistbutton' method='post' name='blacklistbutton'>
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to put into Blacklist');" value="<?php echo $val["customerid"]; ?>" name="blacklistbutton">Blacklist</button>
						</form>
					</div>
				</td>
		</tr>
	<?php endforeach ?>
<?php } ?>
	</tbody>
	</div>
</table>
<a class="btn btn-default" href="<?php echo site_url('customer/insert'); ?>">Insert New Customer</a></li>
<br><br>
<!-- customer payment modal -->
<div class="modal fade" id="customer_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="customer_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
      <!-- Customer: <span id="customer_modal_customerid"></span><span id="customer_modal_customername"></span><br> -->
      <table class="customer_modal_table table livesearch">
      	<thead></thead>
      	<tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- customer agent modal -->
<div class="modal fade" id="customer_agent_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="customer_agent_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
      <!-- Customer: <span id="customer_modal_customerid"></span><span id="customer_modal_customername"></span><br> -->
      <table class="customer_agent_modal_table table livesearch">
      	<thead></thead>
      	<tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- customer balance modal -->
<div class="modal fade" id="customer_balance_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="customer_balance_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
      <!-- Customer: <span id="customer_modal_customerid"></span><span id="customer_modal_customername"></span><br> -->
      <table class="customer_balance_modal_table table livesearch">
      	<thead></thead>
      	<tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>