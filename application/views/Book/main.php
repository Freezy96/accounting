<?php $this->load->view('template/sidenav'); ?>

<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/bank'">Bank</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/coh'">Cash On Hand</button>
</div>

</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/emp'">Employee</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/Total'">Total</button>
</div>
</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>book/insertbank'">Insert Bank</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>book/insertcoh'">Insert Cash On Hand</button>
</div>

</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>book/insertemp'">Insert Employee</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh; font-size: 150%;" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>book/insertTotal'">Insert Total</button>
</div>
</div>
