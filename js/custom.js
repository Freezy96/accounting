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
                $(".account_earned_append").remove(); 
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
                $("#account_modal_startdate").html(res[0].datee); 
                  var $tr = $('<tr class=\'account_header_append\'/>');
                  // $tr.append($('<td/>').html("Start Date"));
                  $tr.append($('<td/>').html("Due Date"));
                  // $tr.append($('<td/>').html("Amount"));
                  $tr.append($('<td/>').html("Amount To Be Pay"));
                  $tr.append($('<td/>').html("Interest To Be Pay"));
                  $tr.append($('<td/>').html("Total:"));
                  $tr.append($('<td/>').html("Action:"));
                  $('.account_modal_table tr:last').before($tr);


                var earned_payment = 0;
                var earned_payment_discount = 0;
                var earned_amount = 0;  
                var showed = 0;
                for (var i = 0; i < res.length; i++) 
                {
                  var $tr = $('<tr class=\'account_trtd_append\'/>');
                  // $tr.append($('<td/>').html(res[i].datee));
                  $tr.append($('<td/>').html(res[i].duedate));
                  // $tr.append($('<td/>').html(res[i].amount));
                  var interest_to_be_pay = 0;
                  var amount_paid = 0;
                  var amount_to_be_pay = 0;
                  var total = 0;
                  var ady_paid_interest_show = 0;
                  var ady_paid_amount_show = 0;
                  var ady_paid_total_show = 0;
                  if ("payment_discount" in res[i]) {
                    earned_payment_discount += parseFloat(res[i].payment_discount);
                  }
                  if ("payment" in res[i]) {
                    earned_payment += parseFloat(res[i].payment);
                  }
                  if ("lentamount" in res[i]) {
                    earned_amount = parseFloat(res[i].lentamount);
                  }
                  console.log(earned_payment);
                  // earned_amount += parseFloat(res[i].amount);
                  //Calculation
                  if ("payment" in res[i]) 
                  {
                    interest_to_be_pay = (parseFloat(res[i].interest) - parseFloat(res[i].payment)).toFixed(2);//-100.00
                    if (res[i].payment>=res[i].interest) {
                      ady_paid_interest_show = res[i].interest;
                    }else{
                      ady_paid_interest_show = res[i].payment;
                    }
                    
                  }
                  else
                  {
                    interest_to_be_pay = (parseFloat(res[i].interest)).toFixed(2);//200.00
                    ady_paid_interest_show = 0;
                  }
                  // console.log(interest_to_be_pay);
                  if(interest_to_be_pay <= 0)
                  {
                    amount_paid = parseFloat(interest_to_be_pay * -1).toFixed(2); //100.00
                    ady_paid_amount_show = amount_paid;
                    amount_to_be_pay = (parseFloat(res[i].amount)-parseFloat(amount_paid)).toFixed(2); //250.00
                    // console.log(amount_paid);
                    interest_to_be_pay = parseFloat(0).toFixed(2);
                    var is_Paid = 1;
                  }
                  else
                  {
                    amount_to_be_pay = parseFloat(res[i].amount).toFixed(2); //350.00
                    ady_paid_amount_show = 0;
                  }

                  total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);
                  ady_paid_total_show = (parseFloat(ady_paid_amount_show)+parseFloat(ady_paid_interest_show)).toFixed(2);

                  /////////////////////for package_25_month///////////////////////////////////////////////////////////////////

                  if (res[0].packagetypename == "package_25_month"|| res[0].packagetypename == "package_20_week" || res[0].packagetypename == "package_15_week" || res[0].packagetypename == "package_15_5days" ||res[0].packagetypename == "package_10_5days") 
                  {
                    if (parseFloat(res[i].totalamount) <= parseFloat(res[i].amount))
                    {
                      interest_to_be_pay = parseFloat(0).toFixed(2);
                      amount_to_be_pay = parseFloat(res[i].totalamount).toFixed(2);
                      total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);
                      is_Paid = 1;
                      ady_paid_amount_show = (parseFloat(res[i].amount)-parseFloat(amount_to_be_pay)).toFixed(2);
                      ady_paid_interest_show = (parseFloat(res[i].payment)-parseFloat(ady_paid_amount_show)).toFixed(2);
                    }
                    else
                    {
                      interest_to_be_pay = res[i].totalamount - res[i].amount;
                      interest_to_be_pay = parseFloat(interest_to_be_pay).toFixed(2);
                      amount_to_be_pay = parseFloat(res[i].amount).toFixed(2);
                      total = (parseFloat(amount_to_be_pay)+parseFloat(interest_to_be_pay)).toFixed(2);
                      is_Paid = 0;
                      res[i].interest = interest_to_be_pay;
                      ady_paid_amount_show = (0).toFixed(2);
                      if ("payment" in res[i]) {
                        ady_paid_interest_show = parseFloat(res[i].payment).toFixed(2);
                      }else{
                        ady_paid_interest_show = (0).toFixed(2);
                      }
                      
                    }
                  }


                  //Amount to be pay
                  if ("payment" in res[i]) 
                  {
                    if (amount_to_be_pay<=0) 
                    {
                      $tr.append($('<td/>').html("Paid ("+ady_paid_amount_show+")"));
                    }
                    else
                    {
                      $tr.append($('<td/>').html(amount_to_be_pay+" ("+ady_paid_amount_show+")"));
                    }
                  }
                  else
                  {
                    $tr.append($('<td/>').html(parseFloat(Math.round(res[i].amount * 100) / 100).toFixed(2)+" ("+ady_paid_amount_show+")"));
                  }
                  //Interest to be pay
                  if ("payment" in res[i]) 
                  {
                    if(is_Paid == 1)
                    {
                      if (ady_paid_interest_show<=0) 
                      {
                        ady_paid_interest_show = " - ";
                      }
                      $tr.append($('<td/>').html("Paid ("+ady_paid_interest_show+")"));
                    }
                    else
                    {
                      $tr.append($('<td/>').html(interest_to_be_pay+" ("+ady_paid_interest_show+")"));
                    }
                    
                  }
                  else
                  {
                    $tr.append($('<td/>').html(res[i].interest+" ("+ady_paid_interest_show+")"));
                  }
                  //Total
                  if (total<=0) 
                  {
                    $tr.append($('<td/>').html("Paid ("+ady_paid_total_show+")"));
                  }
                  else
                  {
                    $tr.append($('<td/>').html(total+" ("+ady_paid_total_show+")"));
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
                    if (total>0 && res[i].pullnextperiod != 1) {
                      $tr.append($('<td/>').html("<form id=\"pay_amount\" action=\'"+baseurl_pathname+pathname+"/pull_to_next_period/\' method=\'post\' name=\'\'><button class=\"btn btn-default\" value=\""+ res[i].accountid +"\" name=\"accountid_pull_to_next_period\" onclick=\"return confirm('Are you sure you want to PULL THE TOTAL AMOUNT TO NEXT PERIOD AND SET THIS PERIOD AS PAID?');\">Pull to next period</button><input type=\"hidden\" name=\"totalamount\" value=\""+total_pull_nxt_period_use+"\"></form>"));
                    }
                  }
                  //
                  $tr.append($('<td/>').html("<a class=\"btn btn-default\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\".modal_collapsible_"+res[i].accountid+"\" aria-expanded=\"true\" aria-controls=\"collapseOne\">View</a>"));

                  $('.account_modal_table tr:last').before($tr);

                  // NESTED AJAX - GET PAYMENT USING ACCOUNT ID
                  $.ajax({
                  type: "POST",
                  url: 'account/get_payment_modal',
                  dataType: 'json',
                  data: {'accid': res[i].accountid},
                  success: function(res1) {
                      if (res1)
                      { 
                        console.log(res1);
                        // $(".account_modal_collapse_append").remove(); 
                        // $(".account_modal_collapse_trtd_append").remove(); 
                        
                        if (showed == 0) 
                        {
                          var $tr = $('<tr class=\'account_header_append\'/>');
                          $tr.append($('<td/>').html(" "));
                          $('.account_modal_table tr:last').before($tr);
                          var $tr = $('<tr class=\'account_header_append\'/>');
                          $tr.append($('<td/>').html(" "));
                          $('.account_modal_table tr:last').before($tr);
                          var $tr = $('<tr class=\'account_header_append\'/>');
                          $tr.append($('<td/>').html("Date"));
                          $tr.append($('<td/>').html("Amount"));
                          $tr.append($('<td/>').html("Type"));
                          $('.account_modal_table tr:last').before($tr);
                          
                        }  
                        showed = 1;
                         for (var i = 0; i < res1.length; i++) {
                          var $tr = $('<tr id=\'\' class=\'account_header_append  panel-collapse collapse modal_collapsible_'+res1[i].accountid+'\' role=\'tabpanel\' aria-labelledby=\'headingOne\'/>');
                          $tr.append($('<td/>').html(res1[i].paymentdate));
                          $tr.append($('<td/>').html(res1[i].payment));
                          $tr.append($('<td/>').html(res1[i].paymenttype));
                          $('.account_modal_table tr:last').before($tr);
                        }
                      }
                    }
                });
                // NESTED AJAX - GET PAYMENT USING ACCOUNT ID


                } // END OF FOR LOOP

                }//END OF IF
                var $tr = $('<tr class=\'account_earned_append\'/>');
                  $tr.append($('<td/>').html(" "));
                  $tr.append($('<td/>').html(" "));
                  // $tr.append($('<td/>').html(" "));
                  // $tr.append($('<td/>').html(" "));
                  $tr.append($('<td/>').html("Earned"));
                  $tr.append($('<td/>').html((parseFloat(earned_payment) - parseFloat(earned_amount) - parseFloat(earned_payment_discount)).toFixed(2)));
                  // $tr.append($('<td/>').html("Action:"));
                  $('.account_modal_table tr:last').before($tr);

                  var $tr = $('<tr class=\'account_earned_append\'/>');
                  $tr.append($('<td/>').html(" "));
                  $tr.append($('<td/>').html(" "));
                  // $tr.append($('<td/>').html(" "));
                  // $tr.append($('<td/>').html(" "));
                  $tr.append($('<td/>').html("Discount Given"));
                  $tr.append($('<td/>').html(parseFloat(earned_payment_discount).toFixed(2)));
                  // $tr.append($('<td/>').html("Action:"));
                  $('.account_modal_table tr:last').before($tr);
                   
              } //END OF SUCCESS
            }); // END OF AJAX
          });

//Customer Payment  --- 2 ajax together one for customer one for black list
 $(".customer_payment_view").click(function(event) {
    event.preventDefault();
    var customerid = $(this).val();
    var customername = $(this).attr('data-name');
    $("#customer_modal_title").html(customerid+" - "+customername);
    console.log(customerid);
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
    type: "POST",
    url: 'customer/customer_payment_modal',
    dataType: 'json',
    data: {'customerid': customerid},
    success: function(res) {
        if (res)
        { 
          console.log(res);
          $(".customer_header_append").remove(); 
          $(".customer_trtd_append").remove(); 
          // empty html
         
          $("#customer_modal_title").html(res[0].customerid+" - "+res[0].customername);         
            var $tr = $('<tr class=\'customer_header_append\'/>');
            $tr.append($('<td/>').html("Ref ID"));
            $tr.append($('<td/>').html("Package Type"));
            $tr.append($('<td/>').html("Date"));
            $tr.append($('<td/>').html("Payment Type"));
            $tr.append($('<td/>').html("Payment"));
            // $tr.append($('<td/>').html("Action:"));
            $('.customer_modal_table tr:last').before($tr);
           for (var i = 0; i < res.length; i++) {
            var $tr = $('<tr class=\'customer_trtd_append\'/>');
             $tr.append($('<td/>').html(res[i].accountid));
            $tr.append($('<td/>').html(res[i].packagetypename));
            $tr.append($('<td/>').html(res[i].paymentdate));
            $tr.append($('<td/>').html(res[i].paymenttype));
            $tr.append($('<td/>').html(res[i].payment));
             $('.customer_modal_table tr:last').before($tr);
          }
        }
      }
    });

    $.ajax({
      type: "POST",
      url: 'customer_payment_modal',
      dataType: 'json',
      data: {'customerid': customerid},
      success: function(res) {
          if (res)
          { 
            console.log(res);
            $(".customer_header_append").remove(); 
            $(".customer_trtd_append").remove(); 
            // empty html
           
            $("#customer_modal_title").html(res[0].customerid+" - "+res[0].customername);         
              var $tr = $('<tr class=\'customer_header_append\'/>');
              $tr.append($('<td/>').html("Ref ID"));
              $tr.append($('<td/>').html("Package Type"));
              $tr.append($('<td/>').html("Date"));
              $tr.append($('<td/>').html("Payment Type"));
              $tr.append($('<td/>').html("Payment"));
              // $tr.append($('<td/>').html("Action:"));
              $('.customer_modal_table tr:last').before($tr);
             for (var i = 0; i < res.length; i++) {
              var $tr = $('<tr class=\'customer_trtd_append\'/>');
               $tr.append($('<td/>').html(res[i].accountid));
              $tr.append($('<td/>').html(res[i].packagetypename));
              $tr.append($('<td/>').html(res[i].paymentdate));
              $tr.append($('<td/>').html(res[i].paymenttype));
              $tr.append($('<td/>').html(res[i].payment));
               $('.customer_modal_table tr:last').before($tr);
            }
          }
        }
      });
  });


 //Customer Balance View
 $(".customer_balance_view").click(function(event) {
    event.preventDefault();
    var customerid = $(this).val();
    var customername = $(this).attr('data-name');
    $("#customer_balance_modal_title").html(customerid+" - "+customername);
    console.log(customerid);
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
    type: "POST",
    url: 'customer/customer_balance_modal',
    dataType: 'json',
    data: {'customerid': customerid},
    success: function(res) {
        if (res)
        { 
          console.log(res);
          $(".customer_header_append").remove(); 
          $(".customer_trtd_append").remove(); 
          // empty html
         
          $("#customer_balance_modal_title").html(res[0].customerid+" - "+res[0].customername);         
            var $tr = $('<tr class=\'customer_header_append\'/>');
            $tr.append($('<td/>').html("Ref ID"));
            $tr.append($('<td/>').html("Package Type"));
            $tr.append($('<td/>').html("Lent"));
            $tr.append($('<td/>').html("Earned"));
            $tr.append($('<td/>').html("Balance"));
            // $tr.append($('<td/>').html("Action:"));
            $('.customer_balance_modal_table tr:last').before($tr);
           for (var i = 0; i < res.length; i++) {
            if (res[i].payment == null) {res[i].payment = 0;}
            var balance = (parseFloat(res[i].payment) - parseFloat(res[i].lentamount)).toFixed(2)
            var $tr = $('<tr class=\'customer_trtd_append\'/>');
             $tr.append($('<td/>').html(res[i].refid));
            $tr.append($('<td/>').html(res[i].packagetypename));
            $tr.append($('<td/>').html(res[i].lentamount));
            $tr.append($('<td/>').html(res[i].payment));
            $tr.append($('<td/>').html(balance));
             $('.customer_balance_modal_table tr:last').before($tr);
          }
        }
      }
    });

    $.ajax({
    type: "POST",
    url: 'customer_balance_modal',
    dataType: 'json',
    data: {'customerid': customerid},
    success: function(res) {
        if (res)
        { 
          console.log(res);
          $(".customer_header_append").remove(); 
          $(".customer_trtd_append").remove(); 
          // empty html
         
          $("#customer_balance_modal_title").html(res[0].customerid+" - "+res[0].customername);         
            var $tr = $('<tr class=\'customer_header_append\'/>');
            $tr.append($('<td/>').html("Ref ID"));
            $tr.append($('<td/>').html("Package Type"));
            $tr.append($('<td/>').html("Lent"));
            $tr.append($('<td/>').html("Earned"));
            $tr.append($('<td/>').html("Balance"));
            // $tr.append($('<td/>').html("Action:"));
            $('.customer_balance_modal_table tr:last').before($tr);
           for (var i = 0; i < res.length; i++) {
            if (res[i].payment == null) {res[i].payment = 0;}
            var balance = (parseFloat(res[i].payment) - parseFloat(res[i].lentamount)).toFixed(2)
            var $tr = $('<tr class=\'customer_trtd_append\'/>');
             $tr.append($('<td/>').html(res[i].refid));
            $tr.append($('<td/>').html(res[i].packagetypename));
            $tr.append($('<td/>').html(res[i].lentamount));
            $tr.append($('<td/>').html(res[i].payment));
            $tr.append($('<td/>').html(balance));
             $('.customer_balance_modal_table tr:last').before($tr);
          }
        }
      }
    });
  });

  // View Agent in Customer
  $(".customer_agent_view").click(function(event) {
    event.preventDefault();
    var customerid = $(this).val();
    var customername = $(this).attr('data-name');
    $("#customer_agent_modal_title").html(customerid+" - "+customername);
    console.log(customerid);
    $.ajax({
    type: "POST",
    url: 'customer/customer_agent_modal',
    dataType: 'json',
    data: {'customerid': customerid},
    success: function(res) {
        if (res)
        { 
          console.log(res);
          $(".customer_agent_header_append").remove(); 
          $(".customer_agent_trtd_append").remove(); 
          // empty html
         
          $("#customer_agent_modal_title").html(res[0].customerid+" - "+res[0].customername);         
            var $tr = $('<tr class=\'customer_agent_header_append\'/>');
            $tr.append($('<td/>').html("Agent"));
            // $tr.append($('<td/>').html("Action:"));
            $('.customer_agent_modal_table tr:last').before($tr);
           for (var i = 0; i < res.length; i++) {
            var $tr = $('<tr class=\'customer_agent_trtd_append\'/>');
             $tr.append($('<td/>').html(res[i].agentid+" - "+res[i].agentname));
             $('.customer_agent_modal_table tr:last').before($tr);
          }
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
       $('.weekamount_25_5days').on('change keyup', function(){
        var $totalamount = parseFloat($('#totalamount_25_5days').val());
        var $week1 = $('#week1_25_5days').val();
        var $week2 = $('#week2_25_5days').val();
        var $week3 = $('#week3_25_5days').val();
        var $week4 = $('#week4_25_5days').val();
        var $total4week = parseFloat($week1) + parseFloat($week2) + parseFloat($week3) + parseFloat($week4);
        if ($week1!="" && $week2!="" && $week3!="" && $week4!="" && $totalamount!="") {
          if ($totalamount.toFixed(2) !== $total4week.toFixed(2)) 
          {
            $('#package_25_5days_message').html("Total Amount and Amount for 4 week are not the same!");
            $('#package_25_5days_btn').prop("disabled", true);
          }
          else
          {
            $('#package_25_5days_message').html("");
            $('#package_25_5days_btn').prop("disabled", false);
          }
        } 
      });
       //package everyday pay
      $('.payeveryday_package_manualdays').on('change keyup', function(){
        var $totalamount = parseFloat($('#payeveryday_package_manualdays_total').val());
        var $everyday = parseFloat($('#payeveryday_package_manualdays_eachday').val());
        var $how_many_day = parseFloat($('#payeveryday_package_manualdays_howmanyday').val());
        var $everyday_should_be =  $totalamount / $how_many_day;
        //偏差 <= 0.5 成功
        // console.log($totalamount);
        // console.log($everyday);
        // console.log($how_many_day);
        // console.log($everyday_should_be);
        if (!isNaN($totalamount) && !isNaN($how_many_day) && !isNaN($everyday)) 
        {
          if (Math.abs($everyday.toFixed(2) - $everyday_should_be.toFixed(2))<= 0.5) 
          {
            $('#payeveryday_package_manualdays_message').html("");
            $('#payeveryday_package_manualdays_btn').prop("disabled", false);
          }
          else
          {
            $('#payeveryday_package_manualdays_message').html("Please make sure Pay How Many Day / Total Collect Amount / Pay Amount Everyday are correct!");
            $('#payeveryday_package_manualdays_btn').prop("disabled", true);
          }
        }
          
      });
      
       $('.livesearch').DataTable();
       $(".chosen-select").chosen();
      
        $('#accountpackage').on('change', function(){
         var $string = $(this).val();
         if ($string.substring(0,15) == "package_15_week") 
        {
           $('#guarantyitemcol').show();
            $('#input_option').prop("disabled", false);
         }else if ($string.substring(0,16) == "package_10_5days") 
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
    if ($string.substring(0,15) == "package_15_week" || $string.substring(0,16) == "package_10_5days") 
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
      // alert([day, month, year].join('/'));
    });

    $('.date_book').on('keyup change', function(){
      var date = new Date($(this).val());
      day = date.getDate();
      month = date.getMonth() + 1;
      year = date.getFullYear();
      $('.book_day_input').val(day);
      $('.book_month_input').val(month);
      $('.book_year_input').val(year);
      // alert([day, month, year].join('/'));
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

  $(".account_ready_to_run").on("click", function(event) {
      event.preventDefault();
      if (confirm('Are you sure you want to delete this item?')) {
        var refid = $(this).val();
        // console.log(refid);
        $.ajax({
        type: "POST",
        url: 'account/acc_ready_to_run',
        dataType: 'json',
        data: {'refid': refid},
        success: function(res) {
            if (res)
            { 
              // alert(res);
              $("#ready_to_run_"+res).css('display', 'none');
            }
          }
          });
      } else {

      }

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