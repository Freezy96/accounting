<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>agent/insertdb' method='post' name='agentinsert'>
  <div class="form-group">
    <label for="">Agent Name</label>
    <input type="text" class="form-control" id="" placeholder="Customer Name" name="name" required>
  </div>
  <div class="form-group">
    <label for="">Charge %</label>
    <input type="number" step="0.01" class="form-control" name="charge" required>
  </div>
  <div class="form-group">
    <label for="">Type</label>
   	<select name="agent_type" required class="form-control">
        <option value="" selected disabled>------------</option>
        <option value="first_account_interest">First Account Interest</option>   
        <option value="share_all_interest">Share All Interest</option>
    </select>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>