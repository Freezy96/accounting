<?php $this->load->view('template/sidenav'); ?>

<h1>Bank</h1>

<table width="100%">
<tr>
<td width="50%" style="vertical-align: top;">
<table border="1" class="table table-condensed">
<thead>
<tr>
<th colspan="3" style="text-align: center;">Debit</th>
</tr>
<tr>
<th>Date</th>
<th>Description</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): 
	$type=$val['type'];
		?>
<?php if ($type=="receive"){?>
<tr>
<td>28/09/2018</td>
<td>Test</td>
<td align="right">666.67</td>
</tr>
<?php }else{ ?>
<tr>
<td></td>
<td></td>
<td align="right"></td>
</tr>
<?php	} ?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
<td width="50%" style="vertical-align: top;">
<table border="1" class="table table-condensed">
<thead>
<tr>
<th colspan="3" style="text-align: center;">Credit</th>
</tr>
<tr>
<th>Date</th>
<th>Description</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
	<?php if(is_array($result) && $result){ ?>
	<?php foreach ($result as $key => $val): 
	$type=$val['type'];
		?>
		 <?php if ($type=="payment"){?>
<tr>
<td>28/09/2018</td>
<td>Test</td>
<td align="right">666.67</td>
</tr>
<?php }else{ ?>
<tr>
<td></td>
<td></td>
<td align="right"></td>
</tr>
<?php	} ?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
</tr>
</table>