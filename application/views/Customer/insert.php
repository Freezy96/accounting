<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>customer/insertdb' method='post' name='customerinsert'>
  <div class="form-group">
    <label for="">Customer Name</label>
    <input type="text" class="form-control" id="" placeholder="Customer Name" name="name" required>
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <textarea type="text" class="form-control" id="" placeholder="Address" name="address"></textarea>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="" placeholder="Phone No." name="phoneno" required>
  </div>
  <div class="form-group">
  <label for="exampleInputEmail1">Gender</label>
  <div class="radio">
  <label>
    <input type="radio" name="gender" id="optionsRadios1" value="Male" required="required" required>
    Male
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender" id="optionsRadios2" value="Female" required="required" required>
    Female
  </label>
</div>
</div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>