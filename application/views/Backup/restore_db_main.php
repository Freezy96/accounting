<?php $this->load->view('template/sidenav'); ?>

<form action='<?php echo base_url();?>backup/restore_db' method='post' name='' enctype="multipart/form-data">

  <div class="form-group">
    <label for="">Sql File</label>
    <input type="file" class="" name="sqlfile" accept=".sql" id="sqlfile" required />
  </div>

  <button type="submit" class="btn btn-default" id="customer_insert_submit_btn">Submit</button>
</form>
