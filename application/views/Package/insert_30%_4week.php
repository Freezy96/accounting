<br>
<form action='<?php echo base_url();?>package/insert_30_4week' method='post' name=''>
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
  <div class="form-group">
    <label for="">Interest Per Day Late</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="interest" required>
  </div>
  <div id="package_1000_1300_message" style="color: red;"></div>
  <div class="form-group">
    <label for="">Total Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="totalamount" placeholder="Collect Amount" name="totalamount" required>
  </div>
  <div class="form-group">
    <label for="">1st Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week1" placeholder="Collect Amount" name="week1" required>
  </div>
  <div class="form-group">
    <label for="">2nd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week2" placeholder="Collect Amount" name="week2" required>
  </div>
  <div class="form-group">
    <label for="">3rd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week3" placeholder="Collect Amount" name="week3" required>
  </div>
  <div class="form-group">
    <label for="">4th Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week4" placeholder="Collect Amount" name="week4" required>
  </div>
  <button type="submit" class="btn btn-default" id="package_1000_1300_btn">Submit</button>
</form>