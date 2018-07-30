<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>employee/insertdb' method='post' name='employeeinsert'>
  <div class="form-group">
    <label for="">Employee Name</label>
    <input type="text" class="form-control" id="employeename" placeholder="Employee Name" name="employeename">
  </div>
  <div class="form-group">
    <label for="">Salary</label>
    <textarea type="text" class="form-control" id="salary" placeholder="salary" name="salary"></textarea>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="contactnum" placeholder="Phone No." name="contactnum">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>