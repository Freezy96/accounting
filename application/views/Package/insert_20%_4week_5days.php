<br>
<form action='<?php echo base_url();?>package/insert_20_4week_5days' method='post' name=''>
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
  <div class="form-group">
    <label for="">Interest Per Day Late</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Interest Per Day Late " name="interest" required>
  </div>
  <div id="package_20_5days_message" style="color: red;"></div>
  <div class="form-group">
    <label for="">Total Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount_20_5days" id="totalamount_20_5days" placeholder="Collect Amount" name="totalamount" required>
  </div>
  <div class="form-group">
    <label for="">1st Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount_20_5days" id="week1_20_5days" placeholder="Collect Amount Week 1" name="week1" required>
  </div>
  <div class="form-group">
    <label for="">2nd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount_20_5days" id="week2_20_5days" placeholder="Collect Amount Week 2" name="week2" required>
  </div>
  <div class="form-group">
    <label for="">3rd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount_20_5days" id="week3_20_5days" placeholder="Collect Amount Week 3" name="week3" required>
  </div>
  <div class="form-group">
    <label for="">4th Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount_20_5days" id="week4_20_5days" placeholder="Collect Amount Week 4" name="week4" required>
  </div>
  <button type="submit" class="btn btn-default" id="package_20%_4week_5days_btn">Submit</button>
</form>