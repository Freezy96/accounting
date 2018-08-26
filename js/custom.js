// Menu Toggle Script

$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});

setTimeout(function() {
    $('.showstate').fadeOut('fast');
}, 2500);

$('.switch_package_button').click(function(){
  
  var package_attr_tr = $(this).attr("data-tr");
  var package_attr_cb = $(this).attr("data-cb");
  var none=$("#"+package_attr_tr).css("display");
    if (none == "none")
    {
      // $('#'+package_attr_id).prop('disabled', false);
      $('#'+package_attr_tr).show();
      // $('#'+package_attr_tr).css("display", "table-row");
    }
    else
    {
      if ($('#'+package_attr_cb).is(':checked'))
      {
        
      }
      else
      {
        // $('#'+package_attr_id).prop('disabled', true);
        $('#'+package_attr_tr).hide();
        // $('#'+package_attr_tr).css("display", "none");
      }
    }
 });

$('.switch_package_checkbox_class').change(function(){
  var package_attr_id = $(this).attr("data-id");
    if ($(this).is(':checked'))
    {
      $('#'+package_attr_id).prop("disabled", false);
    }
    else
    {
      $('#'+package_attr_id).prop("disabled", true);
    }
 });

  
$(document).ready(function() {

  // Modal get data in Account
  $(".accountmodal").click(function(event) {
    event.preventDefault();
    var accountid = $(this).val();
    console.log(accountid);
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
        // generate button
        $("#pay_amount").html("<button class=\"btn btn-success\" value=\""+ res[0].refid +"\" name=\"account_refid\">Pay Amount</button>");
       
        $("#account_modal_title").html(res[0].customername +" - RM "+ res[0].oriamount); 
        $("#account_modal_customer").html(res[0].customerid +" - "+ res[0].customername); 
        $("#account_modal_refid").html(res[0].refid); 
        $("#account_modal_oriamount").html(res[0].oriamount); 
        $("#account_modal_package").html(res[0].packageid +" - "+ res[0].packagetypename); 
        $("#account_modal_agent").html(res[0].agentid +" - "+ res[0].agentname); 
          var $tr = $('<tr class=\'account_header_append\'/>');
          $tr.append($('<td/>').html("Start Date"));
          $tr.append($('<td/>').html("Due Date"));
          $tr.append($('<td/>').html("Amount"));
          $tr.append($('<td/>').html("Amount To Be Pay"));
          $tr.append($('<td/>').html("Interest To Be Pay"));
          $tr.append($('<td/>').html("Total:"));
          $('.account_modal_table tr:last').before($tr);

        for (var i = 0; i < res.length; i++) {
          var $tr = $('<tr class=\'account_trtd_append\'/>');
          $tr.append($('<td/>').html(res[i].datee));
          $tr.append($('<td/>').html(res[i].duedate));
          $tr.append($('<td/>').html(res[i].amount));
          var interest_to_be_pay = 0;
          var amount_paid = 0;
          var amount_to_be_pay = 0;
          var total = 0;
          if ("payment" in res[i]) 
          {
            interest_to_be_pay = (parseFloat(res[i].interest) - parseFloat(res[i].payment)).toFixed(2);//-100.00
          }
          else
          {
            interest_to_be_pay = (parseFloat(res[i].interest)).toFixed(2);//200.00
          }
          // console.log(interest_to_be_pay);
          
          
          if(interest_to_be_pay < 0)
          {
            amount_paid = parseFloat(interest_to_be_pay * -1).toFixed(2); //100.00
            amount_to_be_pay = (parseFloat(res[i].amount)-parseFloat(amount_paid)).toFixed(2); //250.00
            console.log(amount_paid);
            interest_to_be_pay = parseFloat(0).toFixed(2);
            var is_Paid = 1;
          }
          else
          {
            amount_to_be_pay = parseFloat(res[i].amount).toFixed(2); //350.00
          }

          total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);

          if ("payment" in res[i]) 
          {
            if (amount_to_be_pay<=0) 
            {
              $tr.append($('<td/>').html("Paid"));
            }
            else
            {
              $tr.append($('<td/>').html(amount_to_be_pay));
            }
          }
          else
          {
            $tr.append($('<td/>').html(parseFloat(Math.round(res[i].amount * 100) / 100).toFixed(2)));
          }
          
          if ("payment" in res[i]) 
          {
            if(is_Paid == 1)
            {
              $tr.append($('<td/>').html("Paid"));
            }
            else
            {
              $tr.append($('<td/>').html(interest_to_be_pay));
            }
            
          }
          else
          {
            $tr.append($('<td/>').html(res[i].interest));
          }
          if (total<=0) 
          {
            $tr.append($('<td/>').html("Paid"));
          }
          else
          {
            $tr.append($('<td/>').html(total));
          }
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

  $('.weekamount').on('change keyup', function(){
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

  $('.livesearch').DataTable();

   $('#accountpackage').on('change', function(){
     var $string = $(this).val();
     if ($string.substring(0,15) == "package_15_week") 
    {
       $('#guarantyitemcol').show();
        $('#input_option').prop("disabled", false);
     }
     else
     {
       $('#guarantyitemcol').hide();
       $('#input_option').prop("disabled", true);
      }
 
  });


    $('.switch_package_guarantyitem').on('change', function(){
     var $string = $(this).val();
     var input = $(this).attr('data-guaranty_item');
     var input_option = $(this).attr('data-input_option');
     if ($string.substring(0,15) == "package_15_week") 
    {
        $('#'+input).show();
        $('#'+input_option).prop("disabled", false);
     }
     else
     {
       $('#'+input).hide();
       $('#'+input_option).prop("disabled", true);
      }
 
  });


    $('#date_profit').on('keyup change', function(){
      var date = new Date($(this).val());
      day = date.getDate();
      month = date.getMonth() + 1;
      year = date.getFullYear();
      $('#profit_day_input').val(day);
      $('#profit_month_input').val(month);
      $('#profit_year_input').val(year);
      alert([day, month, year].join('/'));
    });

    $('.agent_modal').on('click', function(){
      $('#agentid_hidden').val($(this).val());
    });
});