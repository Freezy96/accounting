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
    <li role="presentation" class="active"><a href="#30_4week" aria-controls="30_4week" role="tab" data-toggle="tab">30% / 4 Week</a></li>
    <li role="presentation"><a href="#20_4week_5days" aria-controls="20_4week" role="tab" data-toggle="tab">20% / 4 Week / 5 days</a></li>
    <li role="presentation"><a href="#pay_per_day" aria-controls="15_week" role="tab" data-toggle="tab">Pay Each Day for X Days</a></li>
    <li role="presentation"><a href="#20_week" aria-controls="20_week" role="tab" data-toggle="tab">20% /  Week</a></li>
    <li role="presentation"><a href="#15_week" aria-controls="15_week" role="tab" data-toggle="tab">15% /  Week</a></li>
    <li role="presentation"><a href="#10_week" aria-controls="10_week" role="tab" data-toggle="tab">10% /  Week</a></li>
    <li role="presentation"><a href="#15_5days" aria-controls="15_5days" role="tab" data-toggle="tab">15% /  5days</a></li>
    <li role="presentation"><a href="#10_5days" aria-controls="10_5days" role="tab" data-toggle="tab">10% /  5days -guaranty</a></li>
       <li role="presentation"><a href="#10_5days2" aria-controls="10_5days2" role="tab" data-toggle="tab">10% /  5days</a></li>
    <li role="presentation"><a href="#25_month" aria-controls="25_month" role="tab" data-toggle="tab">25% / 1 Month</a></li>
  </ul>

  <!-- Tab panes -->
   <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="30_4week"><?php $this->load->view('package/main_30%_4week'); ?></div>
    <div role="tabpanel" class="tab-pane" id="20_week"><?php $this->load->view('package/main_20%_week'); ?></div>
    <div role="tabpanel" class="tab-pane" id="15_week"><?php $this->load->view('package/main_15%_week'); ?></div>
    <div role="tabpanel" class="tab-pane" id="10_week"><?php $this->load->view('package/main_10%_week'); ?></div>
    <div role="tabpanel" class="tab-pane" id="pay_per_day"><?php $this->load->view('package/main_manual_payeveryday_manualdays'); ?></div>
    <div role="tabpanel" class="tab-pane" id="20_4week_5days"><?php $this->load->view('package/main_20_4week_5days'); ?></div>
    <div role="tabpanel" class="tab-pane" id="15_5days"><?php $this->load->view('package/main_15_5days'); ?></div>
    <div role="tabpanel" class="tab-pane" id="10_5days"><?php $this->load->view('package/main_10_5days'); ?></div>
    <div role="tabpanel" class="tab-pane" id="10_5days2"><?php $this->load->view('package/main_10_5days2'); ?></div>
    <div role="tabpanel" class="tab-pane" id="25_month"><?php $this->load->view('package/main_25%_month'); ?></div>
  </div>
<a class="btn btn-default" href="<?php echo site_url('package/insert'); ?>">Insert New Account</a></li>