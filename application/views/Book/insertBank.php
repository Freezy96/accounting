<?php $this->load->view('template/sidenav'); ?>

<form action='<?php echo base_url();?>Book/insertbankdata' method='post' name='insert' enctype="multipart/form-data">
 
<div class="form-group">
    <label for="">Description:</label>
    <input type="text" class="form-control" id="" placeholder="Des" name="description" required>
  </div>
   <div class="form-group">
    <label for="">Type:</label>
    <select name="type">
        <option selected disabled>------------</option>
        <option value="payment">Payment</option>   
        <option value="receive">Receive</option>
    </select>
  </div>
  <div class="form-group">
    <label for="">Amount:</label>
<input type="number" step="0.01" class="form-control" id="" placeholder="Amount" name="amount" required>
  </div>
  <div class="form-group">
    <label for="">Date:</label>
    <input type="date" class="form-control" id="" name="datee" required>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>