    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?php echo site_url('home/'); ?>">
                        Home
                    </a>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('account/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('account/insert'); ?>" style="color: #141414;">Add New Account</a></li>
                        <li><a href="<?php echo site_url('account/baddebt'); ?>" style="color: #141414;">Baddebt</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Customer <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('customer/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('customer/insert'); ?>" style="color: #141414;">Add New Customer</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Black List <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('customer/blacklist'); ?>" style="color: #141414;">View All</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Agents <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('agent/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('agent/insert'); ?>" style="color: #141414;">Add New Agent</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Employee <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('employee/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('employee/insert'); ?>" style="color: #141414;">Add New Employee</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Expenses <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('expenses/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('expenses/insert'); ?>" style="color: #141414;">Add New Account</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                <div class="btn-group" style="width: 100%;display: unset;">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin control<span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('register/')  ?>" style="color: #141414;">Create new Admin</a></li>
                        <li><a href="<?php echo site_url('password/'); ?>" style="color: #141414;">Change password</a></li>
                      </ul>
                      </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Package <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('package/'); ?>" style="color: #141414;">View All</a></li>
                        <li><a href="<?php echo site_url('package/insert'); ?>" style="color: #141414;">Add New Package</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                   <div class="btn-group" style="width: 100%;display: unset;">
                      <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Print <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="width: 100vw;">
                        <li><a href="<?php echo site_url('Print_Expired/'); ?>" style="color: #141414;">Expired today</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                    <a href="<?php echo site_url('book/');  ?>">Book</a>
                </li>
                <li>
                    <a href="<?php echo site_url('logout/');  ?>">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- for looking good for content (in sidenav)-->
        <div class="container" style="padding-top: 3vh;">
            
       
        
    