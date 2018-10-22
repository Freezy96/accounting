  <!-- container for looking good (in sidenav / footer) -->
  </div>
  <?php if($this->session){  ?>

                <!-- go to header -->

                  </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
  <?php } ?>  
<footer></footer>
   </div><!-- /.main-content -->
  </div><!-- /.dashboard-wrapper -->

  <!-- Core Scripts - Include with every page -->
  	 <!-- CSS -->
    
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/bootstrap.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/bootstrap-theme.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/simple-sidebar.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/datatables.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/chosen.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/custom.css">
  	<!-- JS / JQUERY -->
  	<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
  	<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/bootstrap.js"></script>
  	<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/npm.js"></script>
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/datatables.js"></script>
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/chosen.proto.js"></script>
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/chosen.jquery.js"></script>
  	<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/custom.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        $('.customer_check').on("change keyup", function(event) {
            event.preventDefault();
            var name = $('#customer_insert_name').val();
            var passport = $('#customer_insert_passport').val();
            $.ajax({
             type: "POST",
             url: "<?php echo site_url();?>customer/customer_exist_check", 
             data: {'name': $('#customer_insert_name').val(), 'passport': $('#customer_insert_passport').val()},
             dataType: "html",  
             success: function(res){
                    // alert(res);  //as a debugging message.
                    if(res == "yes"){
                      $('#customer_msg').html("<h3 style=\"color: red\">USER WITH THIS NAME / PASSPORT ID EXIST, PLEASE BE CAREFUL!</h3>");
                      $('#customer_insert_submit_btn').prop("disabled", true);
                    }else if(res == "yes_blacklist"){
                      $('#customer_msg').html("<h3 style=\"color: red\">USER WITH THIS NAME / PASSPORT ID EXIST IN BLACKLIST, PLEASE BE CAREFUL!</h3>");
                      $('#customer_insert_submit_btn').prop("disabled", true);
                    }
                    else{
                      $('#customer_msg').html("");
                      $('#customer_insert_submit_btn').prop("disabled", false);
                    }
                  }
              });


         return false;
          
        });
        //   $('.customer_check').on("change keyup", function(event) {
        //     event.preventDefault();
        //     var name = $('#customer_insert_name').val();
        //     var passport = $('#customer_insert_passport').val();
        //     $.ajax({
        //      type: "POST",
        //      url: "<?php echo site_url();?>customer/customer_exist_check_normal", 
        //      data: {'name': $('#customer_insert_name').val(), 'passport': $('#customer_insert_passport').val()},
        //      dataType: "html",  
        //      success: function(res){
        //             // alert(res);  //as a debugging message.
        //             if (res == "yes") {
        //             $('#customer_msg').html("<h3 style=\"color: red\">USER WITH THIS NAME / PASSPORT ID EXIST, PLEASE BE CAREFUL!</h3>");
        //           }else{
        //             $('#customer_msg').html("");
        //           }

        //           }
        //       });


        //  return false;
          
        // });
      });

      $(document).ready(function() {
      setInterval(timestamp, 1000);
        });
         function timestamp() {
            $.ajax({
                url: "<?php echo base_url(); ?>account/timestamp",
                success: function(data) {
                    $('#timestamp').html(data);
                },
            });
        }

    </script>
 </body>
</html>