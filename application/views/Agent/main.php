<?php $this->load->view('template/sidenav'); ?>
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
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#first" aria-controls="" role="tab" data-toggle="tab">First Account</a></li>
    <li role="presentation"><a href="#shareall" aria-controls="" role="tab" data-toggle="tab">Share All</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="first"><?php $this->load->view('agent/first_account_interest'); ?></div>
    <div role="tabpanel" class="tab-pane" id="shareall"><?php $this->load->view('agent/share_all_interest'); ?></div>
  </div>

</div>
<!-- <a class="btn btn-default" href="<?php echo site_url('agent/insert'); ?>">Insert New Account</a></li> -->
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