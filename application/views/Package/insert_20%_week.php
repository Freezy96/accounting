<br>
<form action='<?php echo base_url();?>package/insert_20_week' method='post' >
  <div class="form-group">
    <label for="">Lent Amount</label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Lent Amount" name="lentamount" required>
  </div>
  <div class="form-group">
    <label for="">Interest Per Day Late </label>
    <input type="number" step="0.01" class="form-control" id="" placeholder="Interest Per Day Late " name="interest" required>
  </div>

  <button type="submit" class="btn btn-default" id="insert_20_week_btn">Submit</button>
</form>