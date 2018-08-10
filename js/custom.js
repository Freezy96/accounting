// Menu Toggle Script

$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});

setTimeout(function() {
    $('.showstate').fadeOut('fast');
}, 2500);

$('#accountpackagecheck').change(function(){
    if ($(this).is(':checked'))
    {
      $('#accountamount').prop("disabled", true);
      $('#accountpayment').prop("disabled", true);
      $('#accountpackage').prop("disabled", false);
    }
 });

$('#accountcustomcheck').change(function(){
    if ($(this).is(':checked'))
    {
      $('#accountpackage').prop("disabled", true);
      $('#accountamount').prop("disabled", false);
      $('#accountpayment').prop("disabled", false);
    }
 });

  
$(document).ready(function() {

  // Modal get data in Account
  $(".accountmodal").click(function(event) {
    event.preventDefault();
    var accountid = $(this).val();
  // console.log(accountid);
  $.ajax({
  type: "POST",
  url: 'account/modal',
  dataType: 'json',
  data: {'accountid': accountid},
  success: function(res) {
      if (res)
      { 
        console.log(res);
        // empty html
        $(".account_header_append").remove(); 
        $(".account_trtd_append").remove(); 
        // empty html

        $("#account_modal_title").html(res[1].customername +" - RM "+ res[1].oriamount); 
        $("#account_modal_customer").html(res[1].customerid +" - "+ res[1].customername); 
        $("#account_modal_refid").html(res[1].refid); 
        $("#account_modal_oriamount").html(res[1].oriamount); 
        $("#account_modal_package").html(res[1].packageid +" - "+ res[1].name); 
        $("#account_modal_agent").html(res[1].agentid +" - "+ res[1].agentname); 
          var $tr = $('<tr class=\'account_header_append\'/>');
          $tr.append($('<td/>').html("Amount"));
          $tr.append($('<td/>').html("Payment"));
          $tr.append($('<td/>').html("Start Date"));
          $tr.append($('<td/>').html("Due Date"));
          $tr.append($('<td/>').html("Interest"));
          $('.account_modal_table tr:last').before($tr);

        for (var i = 0; i < res.length; i++) {
          var $tr = $('<tr class=\'account_trtd_append\'/>');
          $tr.append($('<td/>').html(res[i].amount));
          $tr.append($('<td/>').html(res[i].payment));
          $tr.append($('<td/>').html(res[i].datee));
          $tr.append($('<td/>').html(res[i].duedate));
          $tr.append($('<td/>').html(res[i].interest));
          $('.account_modal_table tr:last').before($tr);
        }
        
       
      // alert("work");
      // $("#account_modal_title").html(res.refid); 
      
      // $("#account_modal_title").html(res.refid); 
      // $("#account_modal_title").html(res.refid); 
      // Show Entered Value
      // console.log("1");
      }
    }
    });
  });

  // Package insert total amount identify

  $('.weekamount').on('change, keyup', function(){
    var $totalamount = parseFloat($('#totalamount').val());
    var $week1 = $('#week1').val();
    var $week2 = $('#week2').val();
    var $week3 = $('#week3').val();
    var $week4 = $('#week4').val();
    var $total4week = parseFloat($week1) + parseFloat($week2) + parseFloat($week3) + parseFloat($week4);
    if ($week1!="" && $week2!="" && $week3!="" && $week4!="" && $totalamount!="") {
      if ($totalamount.toFixed(2) !== $total4week.toFixed(2)) 
      {
        $('#package_1000_1300_message').html("Total Amount and Amount for 4 week are not the same!");
        $('#package_1000_1300_btn').prop("disabled", true);
      }
      else
      {
        $('#package_1000_1300_message').html("");
        $('#package_1000_1300_btn').prop("disabled", false);
      }
    } 
  });


});