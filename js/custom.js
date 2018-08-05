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
        $("#account_modal_title").html(res[1].customername +" - RM "+ res[1].oriamount); 
        $("#account_modal_customer").html(res[1].customerid +" - "+ res[1].customername); 
        $("#account_modal_refid").html(res[1].refid); 
        $("#account_modal_oriamount").html(res[1].oriamount); 
        $("#account_modal_package").html(res[1].packageid +" - "+ res[1].name); 
        $("#account_modal_agent").html(res[1].agentid +" - "+ res[1].agentname); 
          var $tr = $('<tr/>');
          $tr.append($('<td/>').html("Amount"));
          $tr.append($('<td/>').html("Payment"));
          $tr.append($('<td/>').html("Start Date"));
          $tr.append($('<td/>').html("Due Date"));
          $tr.append($('<td/>').html("Interest"));
          $('.account_modal_table tr:last').before($tr);

        for (var i = 0; i < res.length; i++) {
          var $tr = $('<tr/>');
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
      console.log(res);
      console.log(res[1].customername);
      // console.log("1");
      }
    }
    });
  });
});