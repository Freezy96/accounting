<?php $this->load->view('template/sidenav'); ?>
<?php foreach ($result as $key => $value): ?>
  <?php 
    $item = $value['expensesitem'];
    $id = $value['expensesid'];
    $fee = $value['expensesfee'];
   ?>
<?php endforeach ?>
<div>
<form action='<?php echo base_url();?>expenses/updatedb' method='post' name=''>
<h2>Expenses ID: <?php echo $id; ?></h2>
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
          <input type="text" class="form-control" id="" placeholder="Expenses Item" name="itemname" value="<?php echo $item; ?>">
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" step="0.01" class="form-control" id="contactnum" placeholder="RM..." name="fee" value="<?php echo $fee; ?>">
        </div>
      </td>
    </tr>
  </table>
  <button type="submit" class="btn btn-default pull-right" name="expensesidedit" value="<?php echo $id; ?>">Submit</button>
</form>
</div>