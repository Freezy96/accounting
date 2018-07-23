<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>register</title>
</head>
<body>
<h1>Register</h1>


<div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
             <form action='<?php echo base_url();?>register/process' method='post' name='process'>
            <div style="margin-bottom: 25px" class="input-group">
                 <label class="col-sm-4 control-label">Username:</label>
                      <div class="col-sm-8">
                                <input class="form-control" type="text" name="username" required>
                         </div>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <label class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                        </div>
                   <div style="margin-bottom: 25px" class="input-group">
                 <label class="col-sm-4 control-label">Campany:</label>
                      <div class="col-sm-8">
                                <input class="form-control" type="text" name="campany" required>
                         </div>

                         <div style="margin-top:10px" class="form-group pull-right">
                        <div class="col-sm-12 controls">
                          <button id="regBtn" type="submit" class="btn btn-success">Register</button>
                        </div>
                    </div> 
                        </div>
                         
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>