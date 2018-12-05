<?php $this->load->view('template/sidenav'); ?>

<h4>Clock: <span id="timestamp"></span></h4>
<br>
<table class="table livesearch" style="width: 100%;">
		<thead>
			<tr>
				<td>
					REFID
				</td>
				<td>
					NAME
				</td>
				<td>
					LENT
				</td>
				<td>
					RETURN
				</td>
				<td>
					START DATE
				</td>
				<td>
					PACKAGE
				</td>
				<td>
					AGENT
				</td>
				<td>
					ACTION
				</td>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($result_groupby_customername) && $result_groupby_customername){ ?>
			<?php foreach ($result_groupby_customername as $key => $val_groupby_customername): ?>
				<div>
				<tr>
					<td>
						<?php if ($val_groupby_customername['SUM(a.totalamount)']<=0): ?>
							<span style="color: red">PAID</span>
						<?php endif ?>
					</td>
					<td>
						<?php echo $val_groupby_customername['customername']; ?>	<?php echo "(".$val_groupby_customername['wechatname'].")"; ?>
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						<form action="javascript:void(0);">
							<a class="btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#account_main_<?php echo $val_groupby_customername['customerid']; ?>" aria-expanded="true" aria-controls="collapseOne">View</a>
						</form>
					</td>
				</tr>
				<tr id="account_main_<?php echo $val_groupby_customername['customerid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<td colspan="8">
						<table class="table">
							<?php if(is_array($result) && $result){ ?>
								<?php foreach ($result as $key => $val): ?>
									<?php if ($val_groupby_customername['customerid'] == $val['customerid']) { ?>
										<?php
										$status=$val['MIN(a.status)'];
										if($status !=="baddebt"){ ?>
											<tr>
												<td>
													<?php if ($val['SUM(a.totalamount)']<=0): ?>
														<span style="color: red">PAID</span>
													<?php endif ?>
													<?php echo $val['refid']; ?>
												</td>
												<td>
													<?php echo $val['customername']; ?>	<?php echo "(".$val['wechatname'].")"; ?>
												</td>
												<td>
													<?php foreach (${'p' . $val['packageid']} as $key => $value): ?>
													<?php echo $value['lentamount']; ?>
													<?php endforeach ?>
												</td>
												<td>
													<?php echo $val['oriamount']; ?>
												</td>
												<td>
													<?php echo $val['MIN(a.datee)']; ?>
												</td>
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
														<button class="btn btn-default" onclick="return confirm('Are you sure you want to Baddebt this item?');" value="<?php echo $val["accountid"]; ?>" name="set_baddebt">baddebt</button>
														</form>
														<form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
														<button class="btn btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val["refid"]; ?>" name="accountdelete">Delete</button>
														</form>
														<!-- 						<?php if ($val['readytorun'] != 1): ?>
														<button class="btn btn-warning account_ready_to_run" value="<?php echo $val['refid']; ?>" id="ready_to_run_<?php echo $val['refid']; ?>" name="ready_to_run">Ready To Run</button>
														<?php endif ?> -->

													</div>
												</td>
											</tr>
										<?php } ?>
									<?php } ?>
								<?php endforeach  ?>
							<?php } ?>
						</table>
					</td>
					<td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td>
				</tr>
				</div>
			<?php  endforeach ?>
		<?php } ?>	
		</tbody>

</table>
<a class="btn btn-default" href="<?php echo site_url('account/insert'); ?>">Insert New Account</a></li>

<br><br>
