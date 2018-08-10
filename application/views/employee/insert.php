<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>employee/insertdb' method='post' name='employeeinsert'>
  <div class="form-group">
    <label for="">Employee Name</label>
    <input type="text" class="form-control" id="employeename" placeholder="Employee Name" name="employeename" required>
  </div>
  <div class="form-group">
    <label for="">Salary</label>
    <input type="number" step="0.01" class="form-control" id="salary" placeholder="salary" name="salary" required>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="contactnum" placeholder="Phone No." name="contactnum" required>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>