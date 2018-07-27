<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>agent/insertdb' method='post' name='agentinsert'>
  <div class="form-group">
    <label for="">Agent Name</label>
    <input type="text" class="form-control" id="" placeholder="Customer Name" name="name">
  </div>
  <div class="form-group">
    <label for="">Charge %</label>
    <input type="number" step="0.01" class="form-control" name="charge">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>