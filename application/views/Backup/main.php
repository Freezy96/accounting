<?php $this->load->view('template/sidenav'); ?>
<div class="row">
<div class="col-sm-6">
	<button style="height: 25vh; font-size: 180%" class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>backup/backup_db'">Backup</button>
</div>

<div class="col-sm-6">
	<button style="height: 25vh; font-size: 180%" class="btn btn-block btn-primary" onclick="location.href='<?php echo base_url();?>backup/restore_db_main'">Restore</button>
</div>

</div>
<br>