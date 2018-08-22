<?php $this->load->view('template/sidenav'); ?>
<!-- <?php print_r($result); ?> -->
<?php if(is_array($result) && $result){ ?>
  <?php foreach ($result as $key => $val): ?>
    <?php 
      $customerid = $val['customerid'];
      $customername = $val['customername'];
      $refid = $val['refid'];
      $oriamount = $val['oriamount'];
      $amount = $val['amount'];
      $datee = $val['datee'];
      $interest = $val['interest'];
      $duedate = $val['duedate'];
      $packageid = $val['packageid'];
      $agentname = $val['agentname'];
      $packagetypename = $val['packagetypename'];
     ?>
  <?php endforeach ?>
<?php } ?>
<div class="">
  <h1>Payment</h1>
</div>

<div class="container">
  <table class="table">
    <tr>
      <td>
        Reference ID: 
      </td>
      <td>
        <?php echo $refid; ?>
      </td>
    </tr>
    <tr>
      <td>
        Customer: 
      </td>
      <td>
        <?php echo $customerid." - ".$customername; ?>
      </td>
    </tr>
    <tr>
      <td>
        Total Amount: 
      </td>
      <td>
        <?php echo $oriamount; ?>
      </td>
    </tr>
    <tr>
      <td>
        Package: 
      </td>
      <td>
        <?php echo $packageid." - ".$packagetypename; ?>
      </td>
    </tr>
  </table>

</div>
<br>
<form action='<?php echo base_url();?>account/payment_insert_db' method='post' name='account_payment'>
<table class="table">
    <thead>
      <tr>
        <td>
          START DATE
        </td>
        <td>
          DUEDATE
        </td>
        <td>
          AMOUNT
        </td>
        <td>
          AMOUNT TO BE PAY
        </td>
        <TD>
          INTEREST TO BE PAY
        </TD>
        <td>
          Total:
        </td>
        <td>
          PAYMENT ACTION
        </td>
      </tr>
    </thead>
    <tbody>
  <!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
    <!-- foreach(allInformation  as  Fieldname  =>  Value) -->
  <!-- <?php print_r($result); ?>        Show this for understanding -->
  <?php $account_number_count = 0; ?>
  <?php if(is_array($result) && $result){ ?>

  <?php foreach ($result as $key => $val): ?>
    <!-- 用来知道有多少个数据显示出来，拿去controller 和 model用 -->
    <?php $account_number_count+=1; ?>
    <?php $amount_paid = 0; ?>
    <?php $final_interest = number_format(0, 2, '.', ''); ?>
    <?php $final_amount = number_format(0, 2, '.', ''); ?>
    <!-- <?php $interest_paid = 0; ?> -->
    <?php foreach (${'payment_amount' . $val['accountid']} as $key => $value): ?>
      <?php 
      if ($value['paymenttype'] == 'amount') 
      {
        $amount_paid += $value['payment'];
      } 
      // if($value['paymenttype'] == 'interest')
      // {
      //   $interest_paid += $value['payment'];
      // }
      if($value['paymenttype'] == 'discount')
      {
        $amount_paid += $value['payment'];
      }
      ?>
    <?php endforeach ?>
    <?php 
      $final_interest = number_format($val['interest']-$amount_paid, 2, '.', '');
      if ($final_interest<0)
      {
        $final_amount = number_format(($val['amount']+$final_interest), 2, '.', '');
        $final_interest = "Paid";
      }
      else
      {
        $final_amount = $val['amount'];
      }
      
     ?>
    <tr>
      <td>
        <?php echo $val['datee']; ?>
      </td>
      <td>
        <?php echo $val['duedate']; ?>
      </td>
      <td>
        <?php echo $val['amount']; ?>
      </td>
      <td>
        <?php echo $final_amount; ?>
      </td>
      <td>
        <?php echo $final_interest; ?>
      </td>
      <td>
        <?php echo number_format($final_amount+$final_interest, 2, '.', ''); ?>
      </td>
    
      <td>
          Amount:<input type="number" step="0.01" name="<?php echo "amount".$account_number_count; ?>"><br>
          <!-- Interest:<input type="number" step="0.01" name="<?php echo "interest".$account_number_count; ?>"><br> -->
          Discount:<input type="number" step="0.01" name="<?php echo "discount".$account_number_count; ?>">
          <input type="hidden" value="<?php echo $val['accountid']; ?>" name="<?php echo "accountid".$account_number_count; ?>">
          
          <!-- <form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
          <button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
          </form> -->
          <!-- <form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["accountid"]; ?>" name="accountid">Delete</button>
          </form>
            <button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button> -->
      </td>
    </tr>
  <?php endforeach ?>
  <input type="hidden" value="<?php echo $account_number_count; ?>" name="account_number_count">

  
<?php } ?>
</table>

<button class="btn btn-success pull-right" type="submit">PAYMENT</button>
</form>
<br><br><br><br>