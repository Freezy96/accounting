<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>account/insertdb' method='post' name='accountinsert'>
  <div class="form-group">
    <label for="">Amount</label>
    <input type="text" class="form-control" id="" placeholder="Amount" name="amount">
  </div>
  <div class="form-group">
    <label for="">Payment</label>
     <input type="text" class="form-control" id="" placeholder="Payment" name="payment">
  </div>
  <div class="form-group">
    <label for="">Customer</label>
    <select class="form-control" name="customerid">
    <?php foreach ($result as $key => $value): ?>
      
        <option value="<?php echo $value['customerid']; ?>"><?php echo $value['customername']; ?></option>
     
    <?php endforeach ?>
     </select>
  </div>
  <div class="form-group">
    <label for="">Date</label>
     <input type="date" class="form-control" id="" placeholder="Date" name="date">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>