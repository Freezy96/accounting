<?php $this->load->view('template/sidenav'); ?>
<form action='<?php echo base_url();?>expenses/insertdb' method='post' name='expensesinsert'>
  <table class="table">
    <tr>
      <th>
        Expenses
      </th>
      <th>
        Fee
      </th>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname1" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee1" >
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname2" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee2" >
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname3" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee3" >
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname4" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee4" >
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname5" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee5" >
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="form-group">
          <input type="text" class="form-control" id="expensesname" placeholder="Expenses Item" name="expensesname6" >
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee6" >
        </div>
      </td>
    </tr>
  </table>
  <input type="hidden" name="count_times" value="6">
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>