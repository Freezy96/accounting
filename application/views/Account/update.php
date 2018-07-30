<?php $this->load->view('template/sidenav'); ?>
<?php foreach ($result as $key => $value): ?>
  <?php 
    $accountid = $value['accountid'];
    $customerid = $value['customerid'];
    $packageid = $value['packageid'];
    $amount = $value['amount'];
    $payment = $value['payment'];
    $date = $value['datee'];
    $agentid = $value['agentid'];
   ?>
<?php endforeach ?>
<!-- <?php print_r($result); ?> -->
<!-- <?php print_r($customer); ?> -->
<!-- <?php print_r($package); ?> -->

<form action='<?php echo base_url();?>account/updatedb' method='post' name='accountinsert'>
  
  <div class="form-group">
    <label for="">Customer</label>
    <select class="form-control" name="customerid">
    <?php foreach ($customer as $key => $value): ?>
        <?php if($customerid == $value['customerid']){ ?>
          <option value="<?php echo $value['customerid']; ?>" selected="selected"><?php echo $value['customername']; ?></option>
        <?php }else{ ?>
          <option value="<?php echo $value['customerid']; ?>"><?php echo $value['customername']; ?></option>
        <?php } ?>
    <?php endforeach ?>
     </select>
  </div><br>
  <label>
      <div class="form-group">
        <label for="">Package</label>
        <select class="form-control" name="packageid" id="accountpackage">
         <?php foreach ($package as $key => $value): ?>
            <?php if($packageid == $value['packageid']){ ?>
            <option value="<?php echo $value['packageid']; ?>" selected="selected">
              <?php echo $value['name']; ?> 
              / 
              RM <?php echo $value['amount']; ?> 
              / 
              <?php echo $value['percent']; ?> %
              / 
              <?php echo $value['days']; ?> Days
            </option>
          <?php }else{ ?>
              <option value="<?php echo $value['packageid']; ?>">
              <?php echo $value['name']; ?> 
              / 
              RM <?php echo $value['amount']; ?> 
              / 
              <?php echo $value['percent']; ?> %
              / 
              <?php echo $value['days']; ?> Days
            </option>
          <?php } ?>
        <?php endforeach ?>
        </select>
      </div>
  </label>
  

  <div class="form-group">
    <label for="">Date</label>
     <input type="date" class="form-control" id="" placeholder="Date" name="date" value="<?php echo $date; ?>">
  </div>

  <div class="form-group">
    <label for="">Agent</label>
    <select class="form-control" name="agentid">
        <option value="0">No Agent</option>
    <?php foreach ($agent as $key => $value): ?>
        <?php if ($value['agentid'] == $agentid): ?>
         <option value="<?php echo $value['agentid']; ?>" selected><?php echo $value['agentname']; ?></option>
        <?php else: ?>
         <option value="<?php echo $value['agentid']; ?>"><?php echo $value['agentname']; ?></option>
        <?php endif ?>
    <?php endforeach ?>
     </select>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>