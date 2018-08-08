<?php $this->load->view('template/sidenav'); ?>

<table class="table">
		<thead>
			<tr>
				<td>
				ID
				</td>
				<td>
					CUSTOMER ID - NAME
				</td>
				<td>
					TOTAL AMOUNT
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
					ACTION
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['accountid']; ?>
			</td>
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
				<?php echo $val['interest']; ?>
			</td>
			<td>
				<?php echo $val['packageid']; ?> - <?php echo $val['name']; ?>
			</td>
			<td>
				<?php echo $val['agentname']; ?>
			</td>
		
			<td>
				<div class="row">
					<form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
					<button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
					</form>
					<form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
						<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["accountid"]; ?>" name="accountid">Delete</button>
					</form>
						<button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('account/insert'); ?>">Insert New Account</a></li>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="aaa"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
       <?php $x = 10; ?>
       <?php for ($i=0; $i < $x; $i++) 
       	{             
       	for ($j=0; $j < $i+1; $j++) 
       		{                 
       			echo "*";            
       		}            
       		echo "<br>";        
       	} ?>        
       	<?php for ($i=$x-1; $i > 0; $i--) 
       	{             
   		for ($j=0; $j < $i; $j++) 
   			{                 
   				echo "*";            
   			}            
   			echo "<br>";        
   		} ?>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
