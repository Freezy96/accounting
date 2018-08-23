<?php $this->load->view('template/sidenav'); ?>
<div class="pull-right">
    <a class="btn btn-default" href="<?php echo site_url('customer/insert/AccountNewCustomer'); ?>">Add New Customer</a>
</div>
<div>
<form action='<?php echo base_url();?>account/insertdb' method='post' name='accountinsert'>
  
  <div class="form-group">
    <label for="">Reference ID</label>
    <?php 
    foreach ($refid as $key => $value) 
    {
      $refid = $value['refid']+1; //auto increment
    }
     ?>
     <input type="text" class="form-control" id="" placeholder="" name="date" value="<?php echo $refid; ?>" required readonly>
  </div>

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
          <optgroup label="30% / 4 Week">
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
          </optgroup>




          <optgroup label="25% / 1 Month">
        <?php foreach ($package_25_month as $key => $value): ?>
          <!-- 注意：value里的前缀 30_4week 代表的是 package_30_4week 的 package -->
            <option value="<?php echo "package_25_month".$value['packageid']; ?>">
              
              <?php echo "Lent: RM ".$value['lentamount']; ?> 
               
              <?php echo "Pay: RM ".$value['totalamount']; ?> 
              
              <?php echo "(Fine for each day: X 1".$value['interest']." %)"; ?>

            </option>
            <!-- 其他package -->
         
        <?php endforeach ?>
          </optgroup>

<optgroup label="20% / Week">
         <?php foreach ($package_20_week as $key => $value): ?>
          <!-- 注意：value里的前缀 30_4week 代表的是 package_30_4week 的 package -->
            <option value="<?php echo "package_20_week".$value['packageid']; ?>">
              
              <?php echo "Lent: RM ".$value['lentamount']; ?> 
               
              <?php echo "Pay: RM ".$value['totalamount']; ?> 
              
              <?php echo "(Fine for each day: RM ".$value['interest']; ?>

            </option>
            <!-- 其他package -->
         
        <?php endforeach ?>
          </optgroup>
          <optgroup label="15% / Week">
         <?php foreach ($package_15_week as $key => $value): ?>
          <!-- 注意：value里的前缀 30_4week 代表的是 package_30_4week 的 package -->
            <option value="<?php echo "package_15_week".$value['packageid']; ?>">
              
              <?php echo "Lent: RM ".$value['lentamount']; ?> 

              <?php echo "Guaranty Item: RM ".$value['guarantyitem']; ?>
               
              <?php echo "Pay: RM ".$value['totalamount']; ?> 
              
              <?php echo "(Fine for each day: RM ".$value['interest']; ?>

            </option>
            <!-- 其他package -->
         
        <?php endforeach ?>
          </optgroup>
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
  <div class="form-group" id="guarantyitemcol">
  <label for="">Guaranty Item</label>
<input type="text" name="guarantyitem" id="input_option" style="display:none" disabled="disabled"> 
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
</div>