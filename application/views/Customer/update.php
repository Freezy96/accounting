<?php $this->load->view('template/sidenav'); ?>
<?php foreach ($result as $key => $value): ?>
  <?php 
    $customerid = $value['customerid'];
    $customername = $value['customername'];
    $address = $value['address'];
    $phoneno = $value['phoneno'];
    $gender = $value['gender'];
   ?>
<?php endforeach ?>
<form action='<?php echo base_url();?>customer/updatedb' method='post' name='customerinsert'>
  <div class="form-group">
    <label for="">Customer Name</label>
    <input type="text" class="form-control" id="" placeholder="Customer Name" name="name" value="<?php echo $customername; ?>" required>
  </div>
     <div class="form-group">
    <label for="">Wechat Name</label>
    <input type="text" class="form-control" id="" placeholder="Wechat Name" name="wechatname" required>
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <textarea type="text" class="form-control" id="" placeholder="Address" name="address" required><?php echo $address; ?></textarea>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="" placeholder="Phone No." name="phoneno" value="<?php echo $phoneno; ?>" required>
  </div>
  <div class="form-group">
  <label for="exampleInputEmail1">Gender</label>
  <div class="radio">
  <label>
    <?php if ($gender == "Male"): ?>
      <input type="radio" name="gender" id="" value="Male" required="required" checked="checked">
    <?php else: ?>
      <input type="radio" name="gender" id="" value="Male" required="required">
    <?php endif ?>
    Male
  </label>
</div>
<div class="radio">
  <label>
    <?php if ($gender == "Female"): ?>
      <input type="radio" name="gender" id="" value="Female" required="required" checked="checked">
    <?php else: ?>
      <input type="radio" name="gender" id="" value="Female" required="required">
    <?php endif ?>
    Female
  </label>
</div>
</div>
  <button type="submit" class="btn btn-default" name="customeridedit" value="<?php echo $customerid; ?>">Submit</button>
</form>