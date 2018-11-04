 <?php $this->load->view('template/sidenav'); ?>

<form action='<?php echo base_url();?>profit/' method='post' name='customerinsert'>
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date (Please Provide Complete Format Date)</label>
	    <input type="date" class="form-control" id="date_profit" placeholder="" name="profit_date" value="<?php echo date("Y-m-d"); ?>">
	    <input type="hidden" name="day" id="profit_day_input" value="<?php echo date("d"); ?>">
	    <input type="hidden" name="month" id="profit_month_input" value="<?php echo date("m"); ?>">
	    <input type="hidden" name="year" id="profit_year_input" value="<?php echo date("Y"); ?>">
  	</div>
  	<button class="btn btn-default pull-right" id="submit_profit">Submit</button>
</form>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profit_day" aria-controls="profit_day" role="tab" data-toggle="tab">Day</a></li>
    <li role="presentation"><a href="#profit_month" aria-controls="profit_month" role="tab" data-toggle="tab">Month</a></li>
    <li role="presentation"><a href="#profit_year" aria-controls="profit_year" role="tab" data-toggle="tab">Year</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profit_day"><?php $this->load->view('profit/main_this_day'); ?></div>
    <div role="tabpanel" class="tab-pane" id="profit_month"><?php $this->load->view('profit/main_this_month'); ?></div>
    <div role="tabpanel" class="tab-pane" id="profit_year"><?php $this->load->view('profit/main_this_year'); ?></div>
  </div>

<!-- 一个输入+3个tab（3个方程式拿回来） -->

<script type="text/javascript">
	
</script>