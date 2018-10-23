<?php $this->load->view('template/sidenav'); ?>
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
						NAME
					</td>
					<td>
						CHARGE %
					</td>
					<td>
						SALARY
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
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['agentid']; ?>
			</td>
			<td>
				<?php echo $val['agentname']; ?>
			</td>
			<td>
				<?php echo $val['charge']; ?>
			</td>
			<td>
				<?php $salary = $val['salary']; ?>
				<?php foreach ($payment as $key => $value): ?>
					<?php if ($value['agentid'] == $val['agentid']): ?>
						<?php $salary -= $value['SUM(payment)']; ?>
					<?php endif ?>
				<?php endforeach ?>
				<?php echo $salary; ?>
			</td>
			<td>
				<div class="btn-group">
					<form action='<?php echo base_url();?>agent/update' method='post' name='agentedit'>
						<button class="btn btn-primary" value="<?php echo $val["agentid"]; ?>" name="agentidedit">Edit</button>
					</form>
					<form action='<?php echo base_url();?>agent/delete' method='post' name='agentdelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["agentid"]; ?>" name="agentiddelete">Delete</button>
					</form>
					<form action="javascript:void(0);">
						<a class="btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_agent_<?php echo $val['agentid']; ?>" aria-expanded="true" aria-controls="collapseOne">View Payment</a>
					</form>
					<form action="javascript:void(0);">
						<a class="btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_agent_customer_<?php echo $val['agentid']; ?>" aria-expanded="true" aria-controls="collapseOne">View Customer</a>
					</form>

				</div>
			</td>
		</tr>
		<!-- collapse agent -->
		<tr id="collapse_agent_<?php echo $val['agentid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
			<td colspan="5" >
				<!-- collapse show customer match the agentid -->
				<div>
			      <div class="panel-body">
			      	<table class="table">
			      		<tr>
			      			<td>
			      				Account ID
			      			</td>
			      			<td>
			      				Customer Name
			      			</td>
			      			<td>
			      				Wechat Name
			      			</td>
			      			<td>
			      				Salary
			      			</td>
			      			<td>
			      				Action
			      			</td>
			      		</tr>
			      		<?php
			      		// get from agent controller
			      		if(is_array($salary_completed) && $salary_completed){
			      			foreach ($salary_completed as $key => $value_completed) {
						    
							    if($value_completed['agentid_completed'] == $val['agentid']){
				        			?>
				        			<?php 
					        			$salary_paid = 0; 
					        			$show = 1;
				        			?>
		        					<?php foreach ($payment_not_grouped as $key => $value_not_grouped): ?>
		        						<?php $salary_paid += $value_not_grouped['SUM(payment)']; ?>
										<?php if ($value_not_grouped['refid'] == $value_completed['refid']): ?>
											<?php 
												$days_minus_15 = strtotime('-15 days',strtotime(date("Y-m-d")));
												$days_minus_15 = date("Y-m-d",$days_minus_15);
												echo $days_minus_15;
											 ?>
											<?php if ($value_not_grouped['MAX(paymentdate)']<$days_minus_15 && number_format((float)$value_completed['salary']-$salary_paid, 2, '.', '')<= 0.10): ?>
												<?php $show = 0;?>
											<?php endif ?>
											
										<?php endif ?>
									<?php endforeach ?>
									<?php if ($show != 0): ?>
										<tr>
				        					<td>
					        					<?php echo $value_completed['refid']; ?>
					        				</td>
					        				<td>
					        					<?php echo $value_completed['customername']; ?>
					        				</td>
					        				<td>
					        					<?php echo $value_completed['wechatname']; ?>
					        				</td>
					        				<td>
					        					
					        					<?php echo "(".$value_completed['totalamount']."-".$value_completed['lentamount'].") * ".$value_completed['agent_charge']." - ".$salary_paid."( Paid ) = RM ".number_format((float)$value_completed['salary']-$salary_paid, 2, '.', ''); ?>
					        				</td>
					        				<td>
					        					<form action="javascript:void(0);">
					        						<button class="btn btn-default agent_modal" data-toggle="modal" data-target="#agentModal" data-agentid="<?php echo $value_completed['agentid_completed']; ?>" data-refid="<?php echo $value_completed['refid']; ?>" name="accountid">Payment</button>
					        					</form>
					        				</td>
					        			</tr>
									<?php endif ?>
				        				
				        			<?php
				        		}
							}
			      		}?>
						
					</table>
			      </div>
			    </div>
			</td>
		</tr>
		<!-- collapse agent -->

		<!-- collapse agent customer -->
		<tr id="collapse_agent_customer_<?php echo $val['agentid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
			<td colspan="5" >
				<!-- collapse show customer match the agentid -->
				<div>
			      <div class="panel-body">
			      	<table class="table">
			      		<tr>
			      			<td>
			      				Account ID
			      			</td>
			      			<td>
			      				Customer Name
			      			</td>
			      			<td>
			      				Wechat Name
			      			</td>
			      			<td>
			      				Package
			      			</td>
			      			<td>
			      				Amount To Be Pay
			      			</td>
<!-- 			      			<td>
			      				Action
			      			</td> -->
			      		</tr>
			      		<?php
			      		// get from agent controller
			      		if(is_array($customer) && $customer){
			      			foreach ($customer as $key => $val_customer) {
						    
							    if($val_customer['agentid'] == $val['agentid']){
				        			?>
				        			
				        				<tr>
				        					<td>
					        					<?php echo $val_customer['refid']; ?>
					        				</td>
					        				<td>
					        					<?php echo $val_customer['customername']; ?>
					        				</td>
					        				<td>
					        					<?php echo $val_customer['wechatname']; ?>
					        				</td>
					        				<td>
					        					<?php echo $val_customer['packagetypename']; ?>
					        				</td>
					        				<td>
					        					<?php echo $val_customer['SUM(a.totalamount)']; ?>
					        				</td>
					        				<!-- <td>
					        					<form action="javascript:void(0);">
					        						<button class="btn btn-default agent_modal" data-toggle="modal" data-target="#agentModal" data-agentid="<?php echo $value_completed['agentid_completed']; ?>" data-refid="<?php echo $value_completed['refid']; ?>" name="accountid">Payment</button>
					        					</form>
					        				</td> -->
					        			</tr>
				        			<?php
				        		}
							}
			      		}?>
						
					</table>
			      </div>
			    </div>
			</td>
		</tr>
		<!-- collapse agent customer -->
	<?php endforeach ?>
<?php } ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('agent/insert'); ?>">Insert New Account</a></li>
<br><br>
<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form id="" action='<?php echo base_url();?>agent/payment/' method='post' name='agentpayamount'>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="account_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
       <div class="form-group">
       	<label for="">Pay Agent Salary</label>
     	<input type="text" name="agentpayment" class="form-control">
       </div>
      	
       	<input type="hidden" name="agentid" id="agentid_payment_hidden">
       	<input type="hidden" name="refid" id="refid_payment_hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Pay</button>
      </div>
    </div>
    </form>
  </div>
</div>

    
 
