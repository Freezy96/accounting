<?php $this->load->view('template/sidenav'); ?>

<form action='<?php echo base_url();?>Print_Expired/' method='post' name='customerinsert'>
	<div class="form-group">
	    <label for="exampleInputEmail1">Choose Date (Please Provide Complete Format Date)</label>
	    <input type="date" class="form-control" id="" placeholder="" name="date">
  	</div>
  	<button class="btn btn-default pull-right" id="submit_profit">Submit</button>
</form>
<div id="div_print">
<link rel="stylesheet" type="text/css" media="print" href="print.css">
<table class="table table-condensed" border="1" width="100%">

	<!-- get session success = true / fail = false -->
	<?php $return = $this->session->flashdata('return'); ?>
	<!-- <?php print_r($return); ?> -->

		<thead>
			<tr>
				<td>
					REF ID
				</td>
				<td>
					CUSTOMER ID
				</td>
				<td>
					NAME
				</td>
				<td>
					ADDRESS
				</td>

				<td>
					PHONE NO.
				</td>
				<td>
					PACKAGE NAME
				</td>				
				<td>
					AMOUNT
				</td>
				<td>
					DUEDATE
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->

		<!-- $count post from data['count'] -->
	<?php for ($i=0; $i < $count; $i++) { ?> 
		<?php foreach (${'result'.$i} as $key => $val): ?>
		<tr>
			<td>
				<?php echo $val['refid']; ?>
			</td>
			<td>
				<?php echo $val['customerid']; ?>
			</td>
			<td>
				<?php echo $val['customername']; ?>
			</td>
			<td>
				<?php echo $val['address']; ?>
			</td>
			<td>
				<?php echo $val['phoneno']; ?>
			</td>
			<td>
				<?php echo $val['packagetypename']; ?>
			</td>
			<td>
				<?php echo number_format((float)${'totalamount'.$val['refid']}, 2, '.', ''); ?>
			</td>
			<td>
				<?php echo ${'min_duedate'.$val['refid']}; ?>
			</td>
		</tr>
		<?php endforeach ?>
	<?php	} ?>
	
	</tbody>
</table>

</div>
<input name="b_print" type="button" class="ipt"   onClick="printdiv('div_print');" value=" Print ">

<script type="text/javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title>    <link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/bootstrap-theme.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/simple-sidebar.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/datatables.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/chosen.css\"><link rel = \"stylesheet\" type = \"text/css\" href = \"<?php echo base_url(); ?>css/custom.css\"><!-- JS / JQUERY --><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/jquery-3.3.1.min.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/bootstrap.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/npm.js\"></\script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/datatables.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.proto.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/chosen.jquery.js\"><\/script><script type = 'text/javascript' src = \"<?php echo base_url(); ?>js/custom.js\"><\/script></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();

document.body.innerHTML = oldstr;
return false; 
}
</script>