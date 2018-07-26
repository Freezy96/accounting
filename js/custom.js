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