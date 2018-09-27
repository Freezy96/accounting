<?php $this->load->view('template/sidenav'); ?>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account/insert'">Bank</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>account'">Cash On Hand</button>
</div>

</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>profit'">Employee</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>backup'">Total</button>
</div>

</div>
<br>
