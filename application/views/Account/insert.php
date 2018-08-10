<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>account/insertdb' method='post' name='accountinsert'>
  
  <div class="form-group">
    <label for="">Customer</label>
    <select class="form-control" name="customerid">
    <?php foreach ($result as $key => $value): ?>
      
        <option value="<?php echo $value['customerid']; ?>"><?php echo $value['customername']; ?></option>
     
    <?php endforeach ?>
     </select>
  </div><br>
  <div class="radio">
  <label>
    <input type="radio" name="packagecustom" id="accountpackagecheck" value="option1" checked="checked" required>
      <div class="form-group">
        <label for="">Package</label>
        <select class="form-control" name="packageid" id="accountpackage">
         <?php foreach ($package as $key => $value): ?>
          
            <option value="<?php echo $value['packageid']; ?>">
              <?php echo $value['name']; ?> 
              / 
              RM <?php echo $value['amount']; ?> 
              / 
              <?php echo $value['percent']; ?> %
              / 
              <?php echo $value['days']; ?> Days
            </option>
         
        <?php endforeach ?>
        </select>
      </div>
  </label>
</div>
  <div class="radio">
    <label>
      <input type="radio" name="packagecustom" id="accountcustomcheck" value="option1" required>
        <div class="form-group">
          <label for="">Custom Amount</label>
          <input type="number" class="form-control" id="accountamount" placeholder="Amount" name="amount" disabled="" required>
        </div>
        <!-- <div class="form-group">
          <label for="">Custom Payment</label>
           <input type="number" class="form-control" id="accountpayment" placeholder="Payment" name="payment" disabled="">
        </div> -->
    </label>
  </div>
  

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