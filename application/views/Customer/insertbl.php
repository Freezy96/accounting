<?php $this->load->view('template/sidenav'); ?>

<form action='<?php echo base_url();?>customer/insertbldb' method='post' name='blacklistinsert' enctype="multipart/form-data">
  <?php 

  if ($this->uri->segment(3, 0) !="") {
    echo "<input type=\"hidden\" class=\"form-control\" id=\"\" placeholder=\"\" value=\"account/insert\" name=\"redirect_destination\">";
  }

  ?>

  <div class="form-group">
    <label for="">Profile Pic</label>
    <input type="file" class="image-upload" accept="image/*" name="profilePic" id="profilePic"/>
  </div>
  
  <div class="form-group">
    <label for="">Customer Name</label>
    <input type="text" class="form-control customer_check" id="customer_insert_name" placeholder="Customer Name" name="name" required>
  </div>
  <!-- <button class="btn customer_check">check</button> -->
   <div class="form-group">
    <label for="">Wechat Name</label>
    <input type="text" class="form-control" id="" placeholder="Wechat Name" name="wechatname" required>
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <textarea type="text" class="form-control" id="" placeholder="Address" name="address" required></textarea>
  </div>
  <div class="form-group">
    <label for="">Phone No.</label>
    <input type="tel" class="form-control" id="" placeholder="Phone No." name="phoneno" required>
  </div>
  <div class="form-group">
    <label for="">Passport/IC No.</label>
    <input type="text" class="form-control customer_check" id="customer_insert_passport" placeholder="Passport No." name="passport" required>
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
<div id="customer_msg">
  
</div>
</div>
  <button type="submit" class="btn btn-default" id="blacklists_insert_submit_btn">Submit</button>
</form>


