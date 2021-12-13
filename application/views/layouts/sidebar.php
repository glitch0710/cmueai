
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Menu Heading (Account)-->
                            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                            <div class="sidenav-menu-heading d-sm-none">Account</div>
                            <!-- Sidenav Link (Alerts)-->
                            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                            <a class="nav-link d-sm-none" href="#!">
                                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                                Alerts
                                <span class="badge badge-warning-soft text-warning ml-auto">4 New!</span>
                            </a>
                            <!-- Sidenav Link (Messages)-->
                            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                            <a class="nav-link d-sm-none" href="#!">
                                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                                Messages
                                <span class="badge badge-success-soft text-success ml-auto">2 New!</span>
                            </a>
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading">Core</div>
                            <!-- Sidenav Accordion (Dashboard)-->

                            <a class="nav-link" href="<?php echo base_url() ?>dashboard">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Dashboard
                            </a>
                           
                            <div class="sidenav-menu-heading">Memberships</div>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseApplications" aria-expanded="false" aria-controls="collapseApplications">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Applications
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseApplications" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link" href="#">Job Order</a>
                                    <a class="nav-link" href="dashboard-2.html">Plantilla</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="<?php echo base_url() ?>memberships">
                                <div class="nav-link-icon"><i class="fa fa-users"></i></div>
                                Members
                            </a>

                            <div class="sidenav-menu-heading">Payroll</div>

                            <a class="nav-link" href="charts.html">
                                <div class="nav-link-icon"><i class="fa fa-tasks"></i></div>
                                Loan Application
                            </a>

                            <a class="nav-link" href="charts.html">
                                <div class="nav-link-icon"><i class="fa fa-file-invoice"></i></div>
                                Payroll
                            </a>

                            <a class="nav-link" href="charts.html">
                                <div class="nav-link-icon"><i class="fa fa-dollar-sign"></i></div>
                                Current Balances
                            </a>                            
                            
                            <div class="sidenav-menu-heading">Setup Manager</div>

                            <a class="nav-link" href="<?php echo base_url() ?>users">
                                <div class="nav-link-icon"><i class="fa fa-user"></i></div>
                                User Account Informations
                            </a>   

                            <a class="nav-link" href="<?php echo base_url() ?>users/user_rights">
                                <div class="nav-link-icon"><i class="fa fa-users-cog"></i></div>
                                User Rights
                            </a> 

                            <div class="sidenav-menu-heading">Logs</div>  

                            <a class="nav-link" href="<?php echo base_url() ?>logs/transactions">
                                <div class="nav-link-icon"><i class="fa fa-book"></i></div>
                                Transaction Logs
                            </a> 

                            <a class="nav-link" href="<?php echo base_url() ?>logs/account">
                                <div class="nav-link-icon"><i class="fa fa-book"></i></div>
                                Account logs
                            </a> 

                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title">Valerie Luna</div>
                        </div>
                    </div>
                </nav>
            </div>
