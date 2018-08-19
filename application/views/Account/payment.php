<?php $this->load->view('template/sidenav'); ?>

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
  <?php if ($this->uri->segment(3, 0) == "interest"): ?>
    <h1>Interest Payment</h1>
  <?php elseif($this->uri->segment(3, 0) == "amount"): ?>
    <h1>Amount Payment</h1>
  <?php endif ?>
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
<table class="table">
    <thead>
      <tr>
        <td>
          AMOUNT
        </td>
        <td>
          PAYMENT
        </td>
        <td>
          START DATE
        </td>
        <td>
          DUEDATE
        </td>
        <TD>
          INTEREST
        </TD>
        <td>
          ACTION
        </td>
      </tr>
    </thead>
    <tbody>
  <!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
    <!-- foreach(allInformation  as  Fieldname  =>  Value) -->
  <!-- <?php print_r($result); ?>        Show this for understanding -->
  <?php if(is_array($result) && $result){ ?>
  <?php foreach ($result as $key => $val): ?>
    <tr>
      <td>
        <?php echo $val['amount']; ?>
      </td>
      <td>
        0
      </td>
      <td>
        <?php echo $val['datee']; ?>
      </td>
      <td>
        <?php echo $val['duedate']; ?>
      </td><td>
        <?php echo $val['interest']; ?>
      </td>
    
      <td>
        <div class="row">
          <!-- <form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
          <button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
          </form> -->
          <form action='<?php echo base_url();?>account/delete' method='post' name='accountdelete'>
            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $val["accountid"]; ?>" name="accountid">Delete</button>
          </form>
            <button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button>
        </div>
      </td>
    </tr>
  <?php endforeach ?>
<?php } ?>
</table>
<a class="btn btn-default" href="<?php echo site_url('account/insert'); ?>">Insert New Account</a></li>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="account_modal_title"></h4>
      </div>
      <div class="modal-body">
       <!-- body -->
      Customer: <span id="account_modal_customer"></span><br>
      Reference ID: <span id="account_modal_refid"></span><br>
      Total Amount: <span id="account_modal_oriamount"></span><br>
      Package: <span id="account_modal_package"></span><br>
      Agent: <span id="account_modal_agent"></span><br><br>
      <table class="account_modal_table table livesearch">
        <thead></thead>
        <tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
        <form id="pay_amount" action='<?php echo base_url();?>account/payment/amount' method='post' name='accountpayamount'>
      <!-- ajax script generated button -->
    </form>
    <form id="pay_interest" action='<?php echo base_url();?>account/payment/interest' method='post' name='accountpayinterest'>
      <!-- ajax script generated button -->
    </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>