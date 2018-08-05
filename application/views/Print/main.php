<?php $this->load->view('template/sidenav'); ?>
<table class="table">

	<!-- get session success = true / fail = false -->
	<?php $return = $this->session->flashdata('return'); ?>
	<!-- <?php print_r($return); ?> -->

		<thead>
			<tr>
				<td>
				ID
				</td>
				<td>
					NAME
				</td>
				<td>
					ADDRESS
				</td>
				<td>
					GENDER
				</td>
				<td>
					PHONE NO.
				</td>
				<td>
					ACTION
				</td>
			</tr>
		</thead>
		<tbody>
	<!-- foreach (ResultGetFromModel  as  indexNumber  =>  allInformation) -->
		<!-- foreach(allInformation  as  Fieldname  =>  Value) -->
	<!-- <?php print_r($result); ?>	       Show this for understanding -->
	<?php foreach ($result as $key => $val): ?>
		<tr>
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
				<?php echo $val['gender']; ?>
			</td>
			<td>
				<?php echo $val['phoneno']; ?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<input type="button" value="Print" onclick="printpage()" />
​<script>
function printpage(){
	window.print();
}
</script>