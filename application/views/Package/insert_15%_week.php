<br>
<form action='<?php echo base_url();?>package/insert_1000_1150_4week_insert' method='post' name='employeeinsert'>
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
    <div class="form-group">
    <label for="">Guaranty Item</label>
    <input type="text" class="form-control" id="" placeholder="Guaranty Item" name="Guaranty Item" required>
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
    <label for="">If Late 2nd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week2" placeholder="Collect Amount" name="week2" required>
  </div>
  <div class="form-group">
    <label for="">If Late 3rd Week Collect Amount</label>
    <input type="number" step="0.01" class="form-control weekamount" id="week3" placeholder="Collect Amount" name="week3" required>
  </div>
  <button type="submit" class="btn btn-default" id="package_1000_1300_btn">Submit</button>
</form>