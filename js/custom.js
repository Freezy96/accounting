// Menu Toggle Script
 $('.agent_modal').on('click', function(){
  $('#agentid_payment_hidden').val($(this).attr('data-agentid'));
  $('#refid_payment_hidden').val($(this).attr('data-refid'));
});

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
                $("#account_modal_guarantyitem").html(res[0].guarantyitem); 
                  var $tr = $('<tr class=\'account_header_append\'/>');
                  $tr.append($('<td/>').html("Start Date"));
                  $tr.append($('<td/>').html("Due Date"));
                  $tr.append($('<td/>').html("Amount"));
                  $tr.append($('<td/>').html("Amount To Be Pay"));
                  $tr.append($('<td/>').html("Interest To Be Pay"));
                  $tr.append($('<td/>').html("Total:"));
                  // $tr.append($('<td/>').html("Action:"));
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
                  //Calculation
                  if ("payment" in res[i]) 
                  {
                    interest_to_be_pay = (parseFloat(res[i].interest) - parseFloat(res[i].payment)).toFixed(2);//-100.00
                  }
                  else
                  {
                    interest_to_be_pay = (parseFloat(res[i].interest)).toFixed(2);//200.00
                  }
                  // console.log(interest_to_be_pay);
                  if(interest_to_be_pay <= 0)
                  {
                    amount_paid = parseFloat(interest_to_be_pay * -1).toFixed(2); //100.00
                    amount_to_be_pay = (parseFloat(res[i].amount)-parseFloat(amount_paid)).toFixed(2); //250.00
                    // console.log(amount_paid);
                    interest_to_be_pay = parseFloat(0).toFixed(2);
                    var is_Paid = 1;
                  }
                  else
                  {
                    amount_to_be_pay = parseFloat(res[i].amount).toFixed(2); //350.00
                  }

                  total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);

                  /////////////////////for package_25_month///////////////////////////////////////////////////////////////////

                  if (res[0].packagetypename == "package_25_month"|| res[0].packagetypename == "package_20_week" || res[0].packagetypename == "package_15_week" || res[0].packagetypename == "package_15_5days" ||res[0].packagetypename == "package_10_5days") 
                  {
                    if (parseFloat(res[i].totalamount) <= parseFloat(res[i].amount))
                    {
                      interest_to_be_pay = parseFloat(0).toFixed(2);
                      amount_to_be_pay = parseFloat(res[i].totalamount).toFixed(2);
                      total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);
                      is_Paid = 1;
                    }
                    else
                    {
                      interest_to_be_pay = res[i].totalamount - res[i].amount;
                      interest_to_be_pay = parseFloat(interest_to_be_pay).toFixed(2);
                      amount_to_be_pay = parseFloat(res[i].amount).toFixed(2);
                      total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);
                      is_Paid = 0;
                      res[i].interest = interest_to_be_pay;
                    }
                  }


                  //Amount to be pay
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
                  //Interest to be pay
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
                  //Total
                  if (total<=0) 
                  {
                    $tr.append($('<td/>').html("Paid"));
                  }
                  else
                  {
                    $tr.append($('<td/>').html(total));
                  }
                  //Action
                  //Get baseurl path
                  var baseurl_pathname   = window.location.origin;
                  var pathname   = window.location.pathname;
                  var total_pull_nxt_period_use = total;
                  if (total_pull_nxt_period_use<=0) 
                    {
                      total_pull_nxt_period_use = 0;
                    }
                  if (i<res.length-1) 
                  {
                    $tr.append($('<td/>').html("<form id=\"pay_amount\" action=\'"+baseurl_pathname+pathname+"/pull_to_next_period/\' method=\'post\' name=\'\'><button class=\"btn btn-default\" value=\""+ res[i].accountid +"\" name=\"accountid_pull_to_next_period\" onclick=\"return confirm('Are you sure you want to PULL THE TOTAL AMOUNT TO NEXT PERIOD AND SET THIS PERIOD AS PAID?');\">Pull to next period</button><input type=\"hidden\" name=\"totalamount\" value=\""+total_pull_nxt_period_use+"\"></form>"));
                  }
                  $('.account_modal_table tr:last').before($tr);
                }
                
              }
            }
            });
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

    $(".home_check").on("change", function(event) {
      event.preventDefault();
      var accountid = $(this).val();
      var checkbox = $(this);
      var checked = checkbox.prop('checked');
      console.log(accountid);
      $.ajax({
      type: "POST",
      url: 'home/homeremind',
      dataType: 'json',
      data: {'accountid': accountid, checked:checked},
      success: function(res) {
          if (res)
          { 
            alert(res);
          }
        }
        });
    });

});


 $(document).ready(function(){
  $('#username').change(function(){
   var username = $('#username').val();
   if(username != ''){
    $.ajax({
     url: "<?php echo base_url(); ?>Search/checkUsername",
     method: "POST",
     data: {username:username},
     success: function(data){
      $('#username_result').html(data);
     }
    });
   }
  });
 });


  $(document).ready(function() {
      setInterval(timestamp, 1000);
  });

  function timestamp() {
      $.ajax({
          url: 'account/timestamp',
          success: function(data) {
              $('#timestamp').html(data);
          },
      });
  }