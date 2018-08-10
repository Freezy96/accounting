<?php $this->load->view('template/sidenav'); ?>
<?php foreach ($result as $key => $value): ?>
  <?php 
    $agentid = $value['agentid'];
    $agentname = $value['agentname'];
    $charge = $value['charge'];
   ?>
<?php endforeach ?>
<form action='<?php echo base_url();?>agent/updatedb' method='post' name='agentupdate'>
  <div class="form-group">
    <label for="">Agent Name</label>
    <input type="text" class="form-control" id="" placeholder="Customer Name" name="name" value="<?php echo $agentname; ?>" required>
  </div>
  <div class="form-group">
    <label for="">Charge %</label>
    <input type="number" step="0.01" class="form-control" name="charge" value="<?php echo $charge; ?>" required>
  </div>
  <button type="submit" class="btn btn-default" value="<?php echo $agentid; ?>" name="agentidedit">Submit</button>
</form>