<?php $this->load->view('template/sidenav'); ?>

<form action="<?php echo base_url();?>book/insertcohdata" method="post" name="">
<?php 
    $balance_ontop = $balance;
    if(is_array($result) && $result)
    {
        foreach ($result as $key => $value) 
        {
            if ($value['type'] == "receive") 
            {
                $balance_ontop += $value['amount'];
            }
            elseif ($value['type'] == "payment") 
            {
                $balance_ontop -= $value['amount'];
            }
        }
    }
 ?>
<h1>Bank</h1><h3>Balance = <?php echo $balance_ontop; ?></h3>

<div style = "position:relative;left:75%;"><h1 >Cash on Hand: <input type="number" step="0.01" class="form-control" id=""  name="amount" placeholder=  "<?php echo $coh?>" style="width:200px; height:30px;" value= "<?php echo $coh?>"></h1>
<button class="btn btn-default " id="submit">Submit</button>
</form>
<form action="javascript:void(0);">
    <a class="btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_coh" aria-expanded="true" aria-controls="collapseOne">View History</a>
</form>
</div>
<div id="collapse_coh" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <!-- collapse show customer match the agentid -->
                  <div class="panel-body">
                    <table class="table livesearch" width="100%">
                        <thead>
                        <tr>
                            <td>
                                Date
                            </td>
                            <td>
                                Amount
                            </td>
<!--                            <td>
                                Action
                            </td> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // get from agent controller
                        if(is_array($all_coh) && $all_coh){
                            foreach ($all_coh as $key => $val_all_coh) {

                                    ?>
                                    
                                        <tr>
                                            <td>
                                                <?php echo $val_all_coh['datee']; ?>
                                            </td>
                                            <td>
                                                <?php echo $val_all_coh['amount']; ?>

                                            </td>
                                            
                                        </tr>
                                    <?php

                            }
                        }?>
                        </tbody>
                    </table>
                  </div>
        </div>
<form action="<?php echo base_url();?>book/bank" method="post" name="">
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date </label>
	    <input type="date" class="form-control date_book" id="" placeholder="" name="date" value="<?php echo date("Y-m-d"); ?>">
	    <input type="hidden" name="day" class="book_day_input" value="<?php echo date("d"); ?>">
	    <input type="hidden" name="month" class="book_month_input" value="<?php echo date("m"); ?>">
	    <input type="hidden" name="year" class="book_year_input" value="<?php echo date("Y"); ?>">
  	</div>
  	<button class="btn btn-default pull-right" id="submit">Submit</button>
</form>
<br><br><br>

<table  class="table table-condensed livesearch">
<thead>
    <tr>
        <th>Date</th>
        <th>Description</th>
        <th>MBB</th>
        <th>PBB</th>
        <th>RHB</th>
        <th>HLB</th>
        <th>Balance</th>
    </tr>
</thead>
<tbody>
    <tr>
    <?php 
    	$debit=0;
        $tdmmb=0;
        $tcmmb=0;
        $tdpbb=0;
        $tcpbb=0;
        $tdrhb=0;
        $tcrhb=0;
        $tdhlb=0;
        $tchlb=0;
     
    $date = $this->input->post('date');
     ?>
        <td> </td>
        <td>Balance forward</td>
        <td><?php echo $mbb;$tdmmb+= $mbb; ?></td>
        <td><?php echo $pbb;$tdpbb+= $pbb; ?></td>
        <td><?php echo $rhb;$tdrhb+= $rhb; ?></td>
        <td><?php echo $hlb;$tdhlb+= $hlb; ?></td>
        <td ><?php echo $balance;$debit=$balance;?></td>
    </tr>


    <?php if(is_array($result) && $result){
	
	foreach ($result as $key => $val): 
	$type=$val['type'];
	$bank=$val['bank'];
    // echo $date_month;
		?>
		
	
<?php if ($type=="receive"){?>
    <tr>
        <td><?php echo $val['datee']; ?></td>
        <td><?php echo $val['description']; ?></td>
        <td ><?php if($bank=="mbb"){echo $val['amount'];$debit+= $val['amount'];$tdmmb+= $val['amount'];}else{ } ?>
            <?php if ($bank=="mbb"): ?>
                &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-small btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
            <?php endif ?>
        </td>
        <td ><?php if($bank=="pbb"){echo $val['amount'];$debit+= $val['amount'];$tdpbb+= $val['amount'];}else{ } ?>
            <?php if ($bank=="pbb"): ?>
                &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
            <?php endif ?>
        </td>
        <td ><?php if($bank=="rhb"){echo $val['amount'];$debit+= $val['amount'];$tdrhb+= $val['amount'];}else{ } ?>
            <?php if ($bank=="rhb"): ?>
                &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
            <?php endif ?>
        </td>
        <td ><?php if($bank=="hlb"){echo $val['amount'];$debit+= $val['amount'];$tdhlb+= $val['amount'];}else{ } ?>
            <?php if ($bank=="hlb"): ?>
                &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
            <?php endif ?>
        </td>
        <td><?php echo $debit;?></td>
    </tr>
<?php }elseif ($type=="payment"){?> 
<tr>
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td ><font color="red"><?php if($bank=="mbb"){echo $val['amount'];$debit-= $val['amount'];$tcmmb+= $val['amount'];}else{ } ?></font>
<?php if ($bank=="mbb"): ?>
        &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
    <?php endif ?></td>
<td ><font color="red"><?php if($bank=="pbb"){echo $val['amount'];$debit-= $val['amount'];$tcpbb+= $val['amount'];}else{ } ?></font>
<?php if ($bank=="pbb"): ?>
        &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
    <?php endif ?></td>
<td ><font color="red"><?php if($bank=="rhb"){echo $val['amount'];$debit-= $val['amount'];$tcrhb+= $val['amount'];}else{ } ?></font>
<?php if ($bank=="rhb"): ?>
        &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
    <?php endif ?></td>
<td ><font color="red"><?php if($bank=="hlb"){echo $val['amount'];$debit-= $val['amount'];$tchlb+= $val['amount'];}else{ } ?></font>
<?php if ($bank=="hlb"): ?>
        &nbsp;&nbsp;&nbsp;<form class="pull-right" action='<?php echo base_url();?>book/delete_bank' method='post' name=''><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this item?');" value="<?php echo $val['bookid']; ?>" name="book_bank_id">Del</button></form>
    <?php endif ?></td>
<td><?php echo $debit;?></td>
</tr>
<?php }?> 
<?php endforeach ?>
<?php } ?>

</tbody>
<!-- PUT OUTSIDE TBODY TO PREVENT DISPLAY ERROR -->
    <tr>
        <td> </td>
        <td> </td>
        <td>
            MMB:<br>
            <?php $mmb_count = $tdmmb - $tcmmb; ?>
            <?php if ($mmb_count<0): ?>
                <font style="color:red;"><?php echo $mmb_count; ?></font>
            <?php else: ?>
                <font><?php echo $mmb_count; ?></font>
            <?php endif ?>
        </td>
        <td>
            PBB:<br>
            <?php $pbb_count = $tdpbb - $tcpbb; ?>
            <?php if ($pbb_count<0): ?>
                <font style="color:red;"><?php echo $pbb_count; ?></font>
            <?php else: ?>
                <font><?php echo $pbb_count; ?></font>
            <?php endif ?>
        </td>
        <td>
            RHB:<br>
            <?php $rhb_count = $tdrhb - $tcrhb; ?>
            <?php if ($rhb_count<0): ?>
                <font style="color:red;"><?php echo $rhb_count; ?></font>
            <?php else: ?>
                <font><?php echo $rhb_count; ?></font>
            <?php endif ?>
        </td>
        <td>
            HLB:<br>
            <?php $hlb_count = $tdhlb - $tchlb; ?>
            <?php if ($rhb_count<0): ?>
                <font style="color:red;"><?php echo $hlb_count; ?></font>
            <?php else: ?>
                <font><?php echo $hlb_count; ?></font>
            <?php endif ?>
        </td>
        <td></td>
    </tr>
</table>

<br>
<br>
<br>
<table width="100%">
<form action='<?php echo base_url();?>Book/insertbankdata' method='post' name='insert' enctype="multipart/form-data">
 <tr>
 <td>
 	<label for="">Date:</label>
    <input type="date" class="form-control" id="" name="datee" required value="<?php echo date("Y-m-d"); ?>">
 </td>
 	<td>
 		<label for="">Description:</label>
    <input type="text" class="form-control" id="" placeholder="Des" name="description" required>
 	</td>
 	<td>
 		<label for="">Bank:</label>
   <select name="bank" required class="form-control">
        <option value="" selected disabled>------------</option>
        <option value="mbb">MBB</option>   
        <option value="pbb">PBB</option>
        <option value="rhb">RHB</option>   
        <option value="hlb">HLB</option>
        </select>
 	</td>
 	<td>
 	<label for="">Type:</label>
    <select name="type" required class="form-control">
        <option value="" selected disabled>------------</option>
        <option value="payment" style="color:red"><font color="red">Debit</font></option>   
        <option value="receive" style="color:green"><font color="green">Credit</font></option>
    </select>
 	</td>
 	<td>
 	<label for="">Amount:</label>
<input type="number" step="0.01" class="form-control" id="" placeholder="Amount" name="amount" required>	
 	</td>
 	<td><button type="submit" class="btn btn-default">Submit</button></td>
 	
 </tr>
</form>
</table>



<br><br>