<?php $this->load->view('template/sidenav'); ?>

<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/insertbank'">Bank</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/insertcoh'">Cash On Hand</button>
</div>

</div>
<br>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/insertemp'">Employee</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh;" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>book/insertTotal'">Total</button>
</div>

</div>
