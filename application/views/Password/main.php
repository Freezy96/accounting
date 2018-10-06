<?php $this->load->view('template/sidenav'); ?>
 <script>
        function checkPass(){
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('newpassword');
            var pass2 = document.getElementById('password2');

            var div = document.getElementById('confirm');
            var regBtn = document.getElementById('regBtn');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Compare the values in the password field 
            //and the confirmation field
            if(pass1.value == pass2.value){
                //The passwords match. 
                //Set the color to the good color and inform
                //the user that they have entered the correct password 
                div.className = "form-group has-success has-feedback";
                message.innerHTML = "Passwords Match!"
                regBtn.className = "btn btn-success btn-lg"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                div.className = "form-group has-error has-feedback";
                message.innerHTML = "Passwords Do Not Match!"
                regBtn.className = "btn btn-success btn-lg disabled"
            }
        }  
</script>
<h1>Change password</h1>
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
 <form action='<?php echo base_url();?>Password/update' method='post' name='process'>
<div style="margin-bottom: 25px" class="input-group">
                            <label class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="password" name="password" required>
                                <span id="username_result"></span>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-4 control-label">NewPassword*</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="newpassword" name="newpassword" required>
                            </div>
                        </div>
                        <div id="confirm" class="form-group">
                            <label class="col-sm-4 control-label">Confirm Password*</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="password2" name="password2" onkeyup="checkPass(); return false;" required>
                            </div>
                            <span id="confirmMessage" class="help-block"></span>
                        </div>
                        </div>
<div class="col-sm-12 controls">
                    <button id="regBtn" class="btn btn-success btn-lg" type="submit"><i class="fa fa-user-plus"></i>Submit</button>
                        </div>
                </form>
            </div> 
         </div>
        </div>
    </div>