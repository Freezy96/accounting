<br>
<form action='<?php echo base_url();?>package/insert_25_month' method='post' name=''>
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
  <div class="form-group">
    <label for="">Interest Per Day Late (%)</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Interest Per Day Late " name="interest" required>
  </div>
  <div id="package_1000_1300_message" style="color: red;"></div>
  <div class="form-group">
    <label for="">Total Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="totalamount" placeholder="Collect Amount" name="totalamount" required>
  </div>
  <button type="submit" class="btn btn-default" id="package_1000_1300_btn">Submit</button>
</form>