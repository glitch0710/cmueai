            <div id="layoutSidenav_content" oncontextmenu="return false">
                <main id="app">
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="users"></i></div>
                                            User Acccount Information
                                        </h1>
                                        <div class="page-header-subtitle">Table Report of registered Users</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Main page content-->
                    <div class="container mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a class="btn btn-info" data-toggle="modal" data-target="#newuserdialogbox" @click='adduserprompt()'><i data-feather="user-plus" style="margin-right: 10px; "></i> Add New User</a> 
                                <!-- Modal form for  new user-->
                                <?php $this->load->view("pages/user_account/addform") ?>
                                <!-- End of Modal form for  new user-->


                                <!-- Modal form for  update user-->
                                <?php $this->load->view("pages/user_account/updateform") ?>

                                <!-- End of Modal form for  update user-->

                                <!-- Modal form for delete user-->
                                <?php $this->load->view("pages/user_account/deleteform") ?>
                                <!-- End of Modal form for update user-->
                            </div>
                            <div class="card-body">
                                <?php $this->load->view("pages/user_account/recordlist") ?>
                            </div>
                        </div>

                        
                    </div>
                    <!-- Main page content-->
                </main>
                <footer class="footer mt-auto footer-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small"><?php echo copyright ?></div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>


                <script type="text/javascript">
                    var session_log="<?php echo $this->encryption->encrypt("session-user-log"); ?>";
                    const form = new Vue({
                        el:"#app",
                        data:{
                            email:"",
                            password:"",
                            username:"",
                            uusername:"",
                            fname:"",
                            mname:"",
                            lname:"",                            
                            keywords:"",
                            page:"",
                            sort:"",
                            order:"",
                            varselect:"",
                            orderlist:[
                                {
                                    value: '',
                                    title: 'Order',
                                },
                                {
                                    value: 'ASC',
                                    title: 'ASC',
                                },
                                {
                                    value: 'DESC',
                                    title: 'DESC',
                                }
                            ],
                            pagelist:[
                                {
                                    value: '',
                                    title: 'Show Data By',
                                },
                                {
                                    value: '10',
                                    title: '10',
                                },
                                {
                                    value: '25',
                                    title: '25',
                                },
                                {
                                    value: '50',
                                    title: '50',
                                }
                            ],
                            sortlist:[
                                {
                                    value: '',
                                    title: 'Sort By',
                                },
                                {
                                    value: 'Username',
                                    title: 'Username',
                                },
                                {
                                    value: 'FullName',
                                    title: 'FullName',
                                },
                                {
                                    value: 'email',
                                    title: 'email',
                                }
                            ],
                           
                            password_confirmation:"",
                            upassword_confirmation:"",
                            upassword:"",
                            designation:"",
                            infodesc:"",
                            errors : [],
                            errors_del : [],
                            reporttable:[],
                        },
                        methods: {
                            form_validation_update:function(e) 
                            {
                                this.errors = [];
                                validate_info = "no error";
                                $(".messagebox").hide("slow");
                                $('#loading').fadeOut("slow");
                                if (!this.username) {
                                    validate_info = "error";
                                    this.errors.push("Username Field must not leave a blank.");
                                } 
                                else if(this.username.length < 5  )
                                {
                                    validate_info = "error";
                                    this.errors.push("Minimum length of Characters for Username is 5 characters.");
                                }
                                else if(this.username.length > 20  )
                                {
                                    validate_info = "error";
                                    this.errors.push("Maximum length of Characters for Username is limited to 20 characters.");
                                }

                                if (!this.fname) {
                                    validate_info = "error";
                                    this.errors.push("Firstname Field must not leave a blank.");
                                } 

                               
                                if (!this.lname) {
                                    validate_info = "error";
                                    this.errors.push("Lastname Field must not leave a blank.");
                                } 
                                  
                                if (!this.email) {
                                    validate_info = "error";
                                    this.errors.push("Email Address must not leave a blank.");
                                }  
                                if (!this.validEmail(this.email)) {
                                    this.errors.push('Please input valid email address.');
                                }

                                if (this.upassword !='') {
                                   
                                    if (this.upassword!=this.upassword_confirmation) {
                                        validate_info = "error";
                                        this.errors.push("Password Does Not Match.");
                                        this.password_confirmation='';
                                    }
                                    
                                } 

                                if(validate_info == "no error")
                                {
                                    $( ".session_log" ).remove();
                                    $( ".infodesc" ).remove();
                                    $input = $('<input type="text"class="session_log" name="session_log" style="display:none;">').val(session_log);
                                    $input2 = $('<input type="text"class="infodesc" name="infodesc" style="display:none;">').val(this.infodesc);


                                    var action = $('#update-form').attr('action');
                                    $('#update-form').append($input);
                                    $('#update-form').append($input2);
                                    this.uusername = this.username;
                                    var xdata  = $('#update-form').serialize();
                                    $( ".session_log" ).remove();
                                    
                                    var btn = $('.btnsubmit');
                                    btn.attr('data-loading-text','<i class="fa fa-refresh fa-spin"></i> Updating new User...');
                                    btn.button('loading');

                                    $('#loading-update').show("slow");
                                     axios.post(action, xdata, ).then(response => {
                                        $('#loading-update').fadeOut("slow");
                                        if(response.data.status=="success")
                                        {
                                            $( ".session_log" ).remove();
                                            $( ".infodesc" ).remove();
                                            this.email = "";
                                            this.password = "";
                                            this.username = "";
                                            this.fname = "";
                                            this.mname = "";
                                            this.lname = "";
                                            this.infodesc = "";
                                            this.password_confirmation = "";

                                            this.search_content(1);
                                            $('#updateuserdialogbox').modal('hide');   
                                        }
                                        else
                                        {
                                            if(response.data.message=="error registration")
                                            {
                                                msg_error = response.data.data;
                                                for (let i = 0; i < msg_error.length; i++) {
                                                    this.errors.push(msg_error[i].msg);
                                                    if(msg_error[i].field=="username")
                                                    {
                                                        this.username='';
                                                    }
                                                    else if(msg_error[i].field=="email")
                                                    {
                                                        this.email='';
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }
                                                    else if(msg_error[i].field=="password")
                                                    {
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }                                                    
                                                    else if(msg_error[i].field=="password_confirmation")
                                                    {
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }
                                                    
                                                }
                                                $('#loading').fadeOut("slow");                                                
                                                $(".messagebox").fadeIn("slow");
                                                $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                setTimeout(function(){btn.button('reset'); }, 1500);
                                            }  
                                            else
                                            {
                                                $('#loading').fadeOut("slow");
                                                this.errors.push("Something went wrong. Contact the administrator.");
                                                $(".messagebox").fadeIn("slow");
                                                $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                setTimeout(function(){btn.button('reset'); }, 1500);
                                            }
                                        }
                                    }).catch(error => {
                                        $('#loading-update').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator.");
                                        $(".messagebox-updated").fadeIn("slow");
                                        $('#updateuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                        setTimeout(function(){btn.button('reset'); }, 1500);
                                    });

                                }
                                else
                                {
                                    $(".messagebox-updated").show("slow");
                                    $('#updateuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                }
                                e.preventDefault(); 
                            },
                            adduserprompt:function()
                            {
                                this.email = "";
                                this.password = "";
                                this.username = "";
                                this.fname = "";
                                this.mname = "";
                                this.lname = "";
                                this.password_confirmation = "";
                                this.errors = [];
                                validate_info = "no error";
                                $(".messagebox").hide("slow");
                                $('#loading').fadeOut("slow");
                            },
                            form_validation:function(e) 
                            {
                                $( ".session_log" ).remove();
                                $input = $('<input type="text"class="session_log" name="session_log" style="display:none;">').val(session_log);

                                this.errors = [];
                                validate_info = "no error";
                                $(".messagebox").hide("slow");
                                $('#loading').fadeOut("slow");
                                if (!this.username) {
                                    validate_info = "error";
                                    this.errors.push("Username Field must not leave a blank.");
                                } 
                                else if(this.username.length < 5  )
                                {
                                    validate_info = "error";
                                    this.errors.push("Minimum length of Characters for Username is 5 characters.");
                                }
                                else if(this.username.length > 20  )
                                {
                                    validate_info = "error";
                                    this.errors.push("Maximum length of Characters for Username is limited to 20 characters.");
                                }

                                if (!this.fname) {
                                    validate_info = "error";
                                    this.errors.push("Firstname Field must not leave a blank.");
                                } 

                                

                                if (!this.lname) {
                                    validate_info = "error";
                                    this.errors.push("Lastname field cannot be left blank.");
                                } 
                                  
                                if (!this.email) {
                                    validate_info = "error";
                                    this.errors.push("Email Address must not leave a blank.");
                                }  
                                if (!this.validEmail(this.email)) {
                                    this.errors.push('Please input valid email address.');
                                }

                                if (!this.password) {
                                    validate_info = "error";
                                    this.errors.push("Password field must not leave a blank.");
                                    
                                } 
                                
                                if (this.password!=this.password_confirmation) {
                                    validate_info = "error";
                                    this.errors.push("Password Does Not Match.");
                                    this.password_confirmation='';
                                } 
                                if(validate_info == "no error")
                                {
                                    var action = $('#registration-form').attr('action');
                                    $('#registration-form').append($input);
                                    var xdata  = $('#registration-form').serialize();
                                    $( ".session_log" ).remove();
                                    
                                    var btn = $('.btnsubmit');
                                    btn.attr('data-loading-text','<i class="fa fa-refresh fa-spin"></i> Adding new User...');
                                    btn.button('loading');
                                    $('#loading').show("slow");

                                    axios.post(action, xdata,).then(response => {
                                        if(response.data.status=="success")
                                        {
                                            this.email = "";
                                            this.password = "";
                                            this.username = "";
                                            this.fname = "";
                                            this.mname = "";
                                            this.lname = "";
                                            this.password_confirmation = "";
                                            $('#loading').fadeOut("slow");
                                            $('.btnmodalclose').click();
                                            this.search_content(1);
                                        }
                                        else
                                        {
                                            if(response.data.message=="error registration")
                                            {
                                                msg_error = response.data.data;
                                                for (let i = 0; i < msg_error.length; i++) {
                                                    this.errors.push(msg_error[i].msg);
                                                    if(msg_error[i].field=="username")
                                                    {
                                                        this.username='';
                                                    }
                                                    else if(msg_error[i].field=="email")
                                                    {
                                                        this.email='';
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }
                                                    else if(msg_error[i].field=="password")
                                                    {
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }                                                    
                                                    else if(msg_error[i].field=="password_confirmation")
                                                    {
                                                        this.password='';
                                                        this.password_confirmation='';
                                                    }
                                                    
                                                }
                                                $('#loading').fadeOut("slow");                                                
                                                $(".messagebox").fadeIn("slow");
                                                $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                setTimeout(function(){btn.button('reset'); }, 1500);
                                            }  
                                            else
                                            {
                                                $('#loading').fadeOut("slow");
                                                this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                                $(".messagebox").fadeIn("slow");
                                                $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                setTimeout(function(){btn.button('reset'); }, 1500);
                                            }
                                        }
                                    }).catch(error => {
                                        $('#loading').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                        $(".messagebox").fadeIn("slow");
                                        $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                        setTimeout(function(){btn.button('reset'); }, 1500);
                                    });
                                }
                                else
                                {
                                    $(".messagebox").show("slow");
                                    $('#newuserdialogbox').animate({ scrollTop: 0 }, 'slow');
                                }
                                e.preventDefault();
                            },
                            showpass:function()
                            {
                                var password_li = $("#leadCapPassword").attr('type');
                                if(password_li=="password")
                                {
                                    $("#leadCapPassword").prop('type','text');
                                    $("#password_confirmation").prop('type','text');
                                }
                                else
                                {
                                    $("#leadCapPassword").prop('type','password');
                                    $("#password_confirmation").prop('type','password');
                                }
                            },
                            showpassu:function()
                            {
                                var password_li = $("#leadCapPassword_u").attr('type');
                                if(password_li=="password")
                                {
                                    $("#leadCapPassword_u").prop('type','text');
                                    $("#password_confirmation_u").prop('type','text');
                                }
                                else
                                {
                                    $("#leadCapPassword_u").prop('type','password');
                                    $("#password_confirmation_u").prop('type','password');
                                }
                            },
                            validEmail: function (email) {
                                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                return re.test(email);
                            },
                            search_content:function(page_num)
                            {
                                limitview_count = $("#entries").val()
                                this.reporttable  = [];
                                var address = base_url+"users/load_report_usersinfo/";
                                $('#nodata_div').hide();
                                let params = new URLSearchParams();
                                $('#loading_div').show("slow");
                                params.append("limitview_count", this.page);
                                params.append("session_log", session_log);
                                params.append("search_value", this.keywords);
                                axios.post(address, params,)
                                    .then(response => {
                                        $('#loading_div').fadeOut("slow");
                                        if(response.data.message == "success")
                                        {                                            
                                            count_result = response.data.data_report.length;
                                            if(count_result<=0)
                                            {
                                                $('#nodata_div').show();
                                            }
                                            else{
                                                this.reporttable = response.data.data_report;
                                            }                                           
                                        }
                                        else
                                        {
                                            $('#nodata_div').show();
                                        }
                                    })
                                    .catch(error => {
                                        alert("Something went wrong. Contact the administrator for the problem.");
                                        $('#loading_div').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                        $('html,body').animate({ scrollTop: 0 }, 'slow');
                                });
                            },

                            deleteprompt:function(Username,row)
                            {
                                $('#deleteusermodal').modal('show');      
                                $('#tempusername').html(Username);
                                this.varselect = Username;
                            },
                            deletetransaction:function()
                            {
                                var btn = $('.deletetransaction');
                                btn.attr('data-loading-text','<i class="fa fa-refresh fa-spin"></i> Deleting User...');
                                btn.button('loading');

                                var address = base_url+"users/deleteusers/";
                                $('#loading-del').show("slow");
                                let params = new URLSearchParams();
                                params.append("session_log", session_log);
                                 params.append("username", this.varselect);
                                axios.post(address, params,).then(response => {
                                    $('#loading-del').hide("slow"); 
                                    if(response.data.status=="success")
                                    {
                                        this.varselect="";
                                        $('#deleteusermodal').modal('hide');  
                                        this.search_content(1);
                                    }
                                    else
                                    {
                                        $('#loading-del').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                        $(".messagebox-del").fadeIn("slow");
                                        setTimeout(function(){btn.button('reset'); }, 1500);
                                    }
                                }).catch(error => {
                                    $('#loading-del').fadeOut("slow");
                                    this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                    $(".messagebox-del").fadeIn("slow");
                                    setTimeout(function(){btn.button('reset'); }, 1500);
                                });
                                
                            },

                            updateform:function(Username,row)
                            {
                                this.email = "";
                                this.password = "";
                                this.username = "";
                                this.fname = "";
                                this.mname = "";
                                this.lname = "";
                                this.infodesc = "";
                                this.password_confirmation = "";
                                this.errors = [];
                                
                                validate_info = "no error";
                                $(".messagebox").hide("slow");
                                $('#loading').fadeOut("slow");


                                var address = base_url+"users/showinfo/";
                                $('#nodata_div').hide();
                                let params = new URLSearchParams();
                                $('#loading_div').show("slow");
                                params.append("session_log", session_log);
                                params.append("username", Username);
                                axios.post(address, params,)
                                    .then(response => {
                                        $('#loading_div').fadeOut("slow");
                                        if(response.data.message == "success")
                                        {                             
                                            this.username = response.data.data['Username'];   
                                            this.uusername = response.data.data['Username'];  
                                            this.fname = response.data.data['Firstname'];    
                                            this.mname = response.data.data['Middlename'];    
                                            this.lname = response.data.data['Lastname'];    
                                            this.designation = response.data.data['Designation'];    
                                            this.email = response.data.data['Email'];  
                                            this.infodesc = response.data.data['infodesc'];  
                                            $('#updateuserdialogbox').modal('show');                              
                                        }
                                        else
                                        {
                                            $('#nodata_div').show();
                                        }     
                                    })
                                    .catch(error => {
                                        alert("Something went wrong. Contact the administrator for the problem.");
                                        $('#loading_div').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                        $('html,body').animate({ scrollTop: 0 }, 'slow');
                                });

                                
                            },
                            closeprompt:function()
                            {
                                $( ".session_log_delete" ).remove();
                                this.varselect="";
                            }
                        },
                        mounted()
                        {
                            this.search_content(1);
                        }
                    });
                </script>
            </div>