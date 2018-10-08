<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
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
      <table class="account_modal_table table">
      	<thead></thead>
      	<tr></tr>
      </table>
       
      </div>
      <div class="modal-footer">
      	<form id="pay_amount" action='<?php echo base_url();?>account/payment/' method='post' name='accountpayamount'>
			<!-- ajax script generated button -->
		</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>