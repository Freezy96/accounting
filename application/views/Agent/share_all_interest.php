
<table class="table livesearch">


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
		<?php if ($val['type'] == "share_all_interest"): ?>
			
		
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
			      <div class="panel-body" id="agent_div_<?php echo $val['agentid']; ?>">
			      	<table class="table" border="1" width="100%">
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
			      		$totalmoney = 0;
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
		        						
										<?php if ($value_not_grouped['refid'] == $value_completed['refid']): ?>
											<?php $salary_paid += $value_not_grouped['SUM(payment)']; ?>
											<?php 
												$days_minus_15 = strtotime('-15 days',strtotime(date("Y-m-d")));
												$days_minus_15 = date("Y-m-d",$days_minus_15);
												// echo $days_minus_15;
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
					        					
					        					<?php echo "(".$value_completed['totalamount']."-".$value_completed['lentamount'].") * ".$value_completed['agent_charge']." - ".$salary_paid."( Paid ) = RM ".number_format((float)$value_completed['salary']-$salary_paid, 2, '.', ''); 

					        					$totalmoney += number_format((float)$value_completed['salary']-$salary_paid, 2, '.', '');
					        					?>
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
										<tr>
				        					<td>
					        				</td>
					        				<td>
					        				</td>
					        				<td>
					        				</td>
					        				<td>
					        					Total: &nbsp;RM <?php echo $totalmoney; ?>
					        				</td>
					        				<td>
					        					
					        				</td>
					        			</tr>
					</table>

					<input name="b_print" type="button" class="ipt"   onClick="printdiv('agent_div_<?php echo $val['agentid']; ?>');" value=" Print ">
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
		<?php endif ?>
	<?php endforeach ?>
<?php } ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('agent/insert'); ?>">Insert New Account</a></li>
<br><br>


    
 



<script type="text/javascript">
function printdiv(printpage)
{
	
var headstr = "<html><head><title></title>    <link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap-theme.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/simple-sidebar.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/datatables.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/chosen.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/custom.css\"><!-- JS / JQUERY --><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/jquery-3.3.1.min.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/bootstrap.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/npm.js\"></\script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/datatables.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.proto.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.jquery.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/custom.js\"><\/script></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false; 
}
</script>