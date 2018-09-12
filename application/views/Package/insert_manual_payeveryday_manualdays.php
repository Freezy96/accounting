<br>
<form action='<?php echo base_url();?>package/insert_manual_payeveryday_manualdays' method='post' name=''>
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
  <div class="form-group">
    <label for="">Pay How Many Day</label>
    <input type="number" step="0.01" class="form-control payeveryday_package_manualdays" id="payeveryday_package_manualdays_howmanyday" placeholder="Pay How Many Day" name="days" required>
  </div>
  <div class="form-group">
    <label for="">Interest Per Day Late</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Interest Per Day Late " name="interest" required>
  </div>
  <div class="form-group">
    <label for="">Total Collect Amount</label>
    <input type="number" step="0.01" class="form-control payeveryday_package_manualdays" id="payeveryday_package_manualdays_total" placeholder="Collect Amount" name="totalamount" required>
  </div>
  <div class="form-group">
    <label for="">Pay Amount Every Day</label>
    <input type="number" step="0.01" class="form-control payeveryday_package_manualdays" id="payeveryday_package_manualdays_eachday" placeholder="Amount to Pay Everyday" name="amounteveryday" required>
  </div>
  <div id="payeveryday_package_manualdays_message" style="color: red;"></div>
  
  <button type="submit" class="btn btn-default" id="payeveryday_package_manualdays_btn">Submit</button>
</form>