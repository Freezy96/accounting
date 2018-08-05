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
      alert("work");
      $("#aaa").html(res.accountid); 
      // Show Entered Value
      // console.log(res);
      // console.log("1");
      console.log(res.accountid);
      console.log(res.oriamount);
      }
    }
    });
  });
});