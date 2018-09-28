<?php $this->load->view('template/sidenav'); ?>

<h1>Cash On Hand</h1>

<table width="100%">
<tr>
<td width="50%" style="vertical-align: top;">
<table  class="table table-condensed">
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
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td align="right"><?php echo $val['amount']; ?></td>
</tr>
<?php } ?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
<td width="50%" style="vertical-align: top;">
<table  class="table table-condensed">
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
<td><?php echo $val['datee']; ?></td>
<td><?php echo $val['description']; ?></td>
<td align="right"><?php echo $val['amount']; ?></td>
</tr>
<?php }?>
<?php endforeach ?>
<?php } ?>
</tbody>
</table>
</td>
</tr>
</table>
<a class="btn btn-default" href="<?php echo site_url('book/insertcoh'); ?>" >Insert</a>
