<?php $this->load->view('template/sidenav'); ?>
<div class="pull-right">
    <a class="btn btn-default" href="<?php echo site_url('customer/insert/AccountNewCustomer'); ?>">Add New Customer</a>
</div>
<div>
<form action='<?php echo base_url();?>account/insertdb' method='post' name='accountinsert'>
  
  <div class="form-group">
    <label for="">Customer</label>
    <select class="form-control" name="customerid">
    <?php foreach ($result as $key => $value): ?>
      
        <option value="<?php echo $value['customerid']; ?>"><?php echo $value['customername']; ?></option>
     
    <?php endforeach ?>
     </select>
  </div><br>
  
  <!-- <div class="radio"> -->
  <!-- <label> -->
    <!-- <input type="radio" name="packagecustom" id="accountpackagecheck" value="option1" checked="checked" required> -->
      <div class="form-group">
        <label for="">Package</label>
        <select class="form-control" name="packageid" id="accountpackage">
         <?php foreach ($package_30_4week as $key => $value): ?>
          <!-- 注意：value里的前缀 30_4week 代表的是 package_30_4week 的 package -->
            <option value="<?php echo "package_30_4week".$value['packageid']; ?>">
              
              <?php echo "Lent: RM ".$value['lentamount']; ?> 
               
              <?php echo "Pay: RM ".$value['totalamount']; ?> 
              
              <?php echo "(Fine for each day: RM ".$value['interest']; ?>
              
              <?php echo ") 4 week: RM ".$value['week1']; ?>

              <?php echo "/ RM ".$value['week2']; ?>

              <?php echo "/ RM ".$value['week3']; ?>

              <?php echo "/ RM ".$value['week4']; ?>

            </option>
            <!-- 其他package -->
         
        <?php endforeach ?>
        </select>
      </div>
  <!-- </label> -->
<!-- </div> -->
<!--   <div class="radio">
    <label>
      <input type="radio" name="packagecustom" id="accountcustomcheck" value="option1" required>
        <div class="form-group">
          <label for="">Custom Amount</label>
          <input type="number" class="form-control" id="accountamount" placeholder="Amount" name="amount" disabled="" required>
        </div>
        <div class="form-group">
          <label for="">Custom Payment</label>
           <input type="number" class="form-control" id="accountpayment" placeholder="Payment" name="payment" disabled="">
        </div>
    </label>
  </div> -->
  

  <div class="form-group">
    <label for="">Date</label>
     <input type="date" class="form-control" id="" placeholder="Date" name="date" required>
  </div>

  <div class="form-group">
    <label for="">Agent</label>
    <select class="form-control" name="agentid">
        <option value="0">No Agent</option>
    <?php foreach ($agent as $key => $value): ?>
      
        <option value="<?php echo $value['agentid']; ?>"><?php echo $value['agentname']; ?></option>
     
    <?php endforeach ?>
     </select>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>