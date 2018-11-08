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
    <div role="tabpanel" class="tab-pane" id="shareall"><?php $this->load->view('agent/first_account_interest'); ?></div>
  </div>

</div>
<!-- <a class="btn btn-default" href="<?php echo site_url('agent/insert'); ?>">Insert New Account</a></li> -->