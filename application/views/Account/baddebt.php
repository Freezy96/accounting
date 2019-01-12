<?php $this->load->view('template/sidenav'); ?>

<table class="table livesearch">
		<thead>
			<tr>
				<td>
					NAME(WECHAT)
				</td>
				<td>
					LENT
				</td>
				<td>
					RETURN
				</td>

				<td>
					DUEDATE
				</td> 
				<TD>
					PACKAGE
				</TD>
				<td>
					GUARANTEE ITEM
				</td>
				<TD>
					TOTAL AMOUNT
				</TD>
				<td>
					ACTION
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['customername']; ?>	<?php echo "(".$val['wechatname'].")"; ?>
			</td>
			<td>
				<?php foreach (${'p' . $val['packageid']} as $key => $value): ?>
					<?php echo $value['lentamount']; ?>
				<?php endforeach ?>
			</td>
			<td>
				<?php echo $val['oriamount']; ?>
			</td>
			<!-- <td>
				<?php echo $val['payment']; ?>
			</td> -->
			<td>

				<?php echo $val['MAX(a.duedate)']; ?>
			</td> 

			<td>
				<?php echo $val['packageid']; ?> - <?php echo $val['packagetypename']; ?>
			</td>
			<td>
				<?php if ($val['guarantyitem'] == ""): ?>
					-
				<?php else: ?>
					<?php echo $val['guarantyitem']; ?>
				<?php endif ?>
				
			</td>
			<td>
				<?php if( $val['SUM(a.totalamount)']=="0.00"){ ?>   <font size="3" color="red"> BAD<font> <?php }else {echo $val['SUM(a.totalamount)']; }?>
			</td>	
			<td>
				<div class="row">
					<!-- <form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
					<button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
					</form> -->
					<!-- <button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button> -->
					<form  action='<?php echo base_url();?>account/payment/' method='post' name='accountpayamount'>
			<!-- ajax script generated button -->
			<button class="btn btn-default "  value="<?php echo $val["refid"]; ?>" name="account_refid">Payment</button>
		</form>
	
			<form action='<?php echo base_url();?>account/set_stop' method='post'>
				<button class="btn btn-default" onclick="return confirm('Are you sure you want to stop this interest?');" value="<?php echo $val["accountid"]; ?>" name="set_stop">STOP</button>
			</form>
			<form action='<?php echo base_url();?>account/set_start' method='post'>
				<button class="btn btn-default" onclick="return confirm('Are you sure you want to start this interest?');" value="<?php echo $val["accountid"]; ?>" name="set_start">START</button>
			</form>


			</td>

		</tr>
		</tr>
	<?php endforeach ?>
<?php } ?>
</table>


<div id="div_print_baddebt" style="display: none;">
<table class="table">
		<thead>
			<tr>
				<td>
					NAME
				</td>
				<td>
					LENT
				</td>
				<td>
					RETURN
				</td>

				<td>
					DUEDATE
				</td> 
				<TD>
					PACKAGE
				</TD>
				<td>
					GUARANTEE ITEM
				</td>
				<TD>
					TOTAL AMOUNT
				</TD>
				<td>
					ACTION
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['customername']; ?>
			</td>
			<td>
				<?php foreach (${'p' . $val['packageid']} as $key => $value): ?>
					<?php echo $value['lentamount']; ?>
				<?php endforeach ?>
			</td>
			<td>
				<?php echo $val['oriamount']; ?>
			</td>
			<!-- <td>
				<?php echo $val['payment']; ?>
			</td> -->
			<td>

				<?php echo $val['MAX(a.duedate)']; ?>
			</td> 

			<td>
				<?php echo $val['packageid']; ?> - <?php echo $val['packagetypename']; ?>
			</td>
			<td>
				<?php if ($val['guarantyitem'] == ""): ?>
					-
				<?php else: ?>
					<?php echo $val['guarantyitem']; ?>
				<?php endif ?>
				
			</td>
			<td>
				<?php echo $val['SUM(a.totalamount)']; ?>
			</td>	
			<td>
				<div class="row">
					<!-- <form action='<?php echo base_url();?>account/update' method='post' name='accountedit'>
					<button class="btn btn-primary" value="<?php echo $val["accountid"]; ?>" name="accountid">Edit</button>
					</form> -->
					<!-- <button class="btn btn-default accountmodal" data-toggle="modal" data-target="#myModal" value="<?php echo $val["accountid"]; ?>" name="accountid">View</button> -->
					<form  action='<?php echo base_url();?>account/payment/' method='post' name='accountpayamount'>
			<!-- ajax script generated button -->
			<button class="btn btn-default "  value="<?php echo $val["refid"]; ?>" name="account_refid">Payment</button>
		</form>

			</td>
		</tr>
		</tr>
	<?php endforeach ?>
<?php } ?>
</table>
</div>

<input name="b_print" type="button" class="ipt"   onClick="printdiv('div_print_baddebt');" value=" Print ">
<script type="text/javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
