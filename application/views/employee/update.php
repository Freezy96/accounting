<?php $this->load->view('template/sidenav'); ?>
<?php foreach ($result as $key => $value): ?>
  <?php 
    $employeeid = $value['employeeid'];
    $employeename = $value['employeename'];
    $salary = $value['salary'];
    $contactnum = $value['contactnum'];
   ?>
<?php endforeach ?>
<div>
<form action='<?php echo base_url();?>employee/updatedb' method='post' name='employeeinsert'>
  <div class="form-group">
    <label for="">Employee Name</label>
    <input type="text" class="form-control" id="" placeholder="Employee Name" name="name" value="<?php echo $employeename; ?>">
  </div>
  <div class="form-group">
    <label for="">Salary</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Salary" name="salary" value="<?php echo $salary; ?>" required>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="contactnum" placeholder="Phone No." name="contactnum" value="<?php echo $contactnum; ?>" required>
  </div>
</div>
  <button type="submit" class="btn btn-default pull-right" name="employeeidedit" value="<?php echo $employeeid; ?>">Submit</button>
</form>
</div>