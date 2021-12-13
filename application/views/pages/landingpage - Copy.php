		<div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    <!-- Navbar-->
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container">
                            <a class="navbar-brand text-dark" href="index.html"><?php echo title_topbar ?></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                    <li class="nav-item"><a class="nav-link" href="index.html">Home </a></li>
                                    
                                    
                                    
                                </ul>
                                <?php if(active_registration==true): ?>
                                <a class="btn font-weight-500 ml-lg-4 btn-primary" href="<?php echo base_url() ?>login">Register Now<i class="ml-2" data-feather="arrow-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </nav>
                    <!-- Page Header-->
                    <header class="page-header page-header-dark bg-img-repeat bg-primary" style="background-image: url('assets/img/backgrounds/pattern-shapes.png')">
                        <div class="page-header-content">
                            <div class="container"  id="landingpage">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        
                                        <h1 class="page-header-title"> <?php echo title_landingpage ?> </h1>
                                        <p class="page-header-text"><?php echo title_landingpage_sub ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card rounded-lg text-dark">
                                            
                                            <div class="card-body">
                                                <?php echo form_open('login/verifyuser',array('class' => "login-form", 'id' => "login-form", '@submit' => "form_validation",'autocomplete'=>'off', )); ?>
                                                    <ul class="parsley-error-list">
                                                      <?php echo $this->session->flashdata('message');?>
                                                    </ul>
                                                    <div class="form-group has-feedback"  id="loading"  style="display: none;"  >
                                                        <div >
                                                          <strong> <center>
                                                              <img src="<?php echo base_url() ?>assets/img/loading.gif" alt="CMULOGO" style="width:100px;height:100px;"></center>
                                                          </strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback messagebox"  style="display: none;" >
                                                        <div class="alert alert-danger  text-left"role="alert">
                                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                            <span class="sr-only">Error:</span>
                                                            <a style="color:black;"id="message_error" disabled v-if="errors.length">
                                                                <b>You have the following error(s):</b> 
                                                                <ul>
                                                                    <li v-for="error in errors">{{ error }}</li>
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="small text-gray-600" for="email">Username or Email address </label><input class="form-control email" id="email"  name="email" type="text" v-model="email" value="@{{ email }} autofocus required"  /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="leadCapPassword">Password</label><input class="form-control" id="leadCapPassword" type="password" name="password" v-model="password" value="@{{ password }}"  required  autocomplete /></div>

                                                

                                                    <div class=" form-group custom-control custom-checkbox custom-control-solid">
                                                        <input class="custom-control-input" id="leadCapShowPassword" type="checkbox" @click="showpass()">
                                                        <label class="custom-control-label" for="leadCapShowPassword">Show Password</label>
                                                    </div>
                                                    <button class="btn btn-primary btn-block font-weight-500 mt-4" type="submit">Login</button>
                                                <?php echo form_close();?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-angled text-white">
                            <!-- Angled SVG Border--><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor"><polygon points="0,100 100,0 100,100"></polygon></svg>
                        </div>
                    </header>
                   
                    
                </main>
            </div>
            <div id="layoutDefault_footer">
                <footer class="footer pt-10 pb-5 mt-auto bg-white footer-light">
                    <div class="container">
                        
                        <hr class="my-5" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small"><?php echo copyright ?></div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <script type="text/javascript">
            var session_log="<?php echo $this->encryption->encrypt("code_ajax_active"); ?>";
        	const form = new Vue({
                el:"#landingpage",
                data:{
                    email:"",
                    password:"",
                    errors : [],
                },
                methods: {
                    form_validation:function(e) {
                        $( ".session_log" ).remove();
                        $input = $('<input type="text"class="session_log" name="session_log"/ style="display:none;">').val(session_log);

                        this.errors = [];
                        validate_info = "no error";
                        $(".messagebox").hide("slow");
                        $('#loading').fadeOut("slow");
                        if (!this.email) {
                            validate_info = "error";
                            this.errors.push("Username / Email Address field cannot be left blank.");
                        }  
                        if (!this.password) {
                            validate_info = "error";
                            this.errors.push("Password field cannot be left blank.");
                        } 
                        if(validate_info == "no error")
                        {
                            var action = $('#login-form').attr('action');
                            $('#login-form').append($input);
                            var xdata  = $('#login-form').serialize();
                            $( ".session_log" ).remove();
                            
                            var btn = $('.btnsubmit');
                            btn.attr('data-loading-text','<i class="fa fa-refresh fa-spin"></i> Signing In...');
                            btn.button('loading');
                            $('#loading').show("slow");

                            axios.post(action, xdata,).then(response => {

                                console.log(response);
                            if(response.data=="success")
                            {
                                window.location.replace(base_url+'home');
                            }
                            else if(response.data=="no email")
                            {  
                                $('#loading').fadeOut("slow");            
                                this.errors.push("Username / Email Address  Email Address field cannot be left blank.");
                                $(".messagebox").fadeIn("slow");
                                $(".email").focus();
                                this.password='';
                            } 
                            else if(response.data=="account not found")
                            {
                                $('#loading').fadeOut("slow");
                                this.errors.push("Invalid Username / Email address and password combination or your account is not active yet.");
                                $(".messagebox").fadeIn("slow");
                                this.password='';
                                $(".email").focus();
                            }
                            else if(response.data=="invalid credentials")
                            {
                                $('#loading').fadeOut("slow");
                                this.errors.push("Invalid Username / Email address and password combination or your account is not active yet.");
                                $(".messagebox").fadeIn("slow");
                                this.password='';
                                $(".email").focus();
                            }
                            else if(response.data=="account lock")
                            {
                                $('#loading').fadeOut("slow");
                                this.errors.push("Account lock due to many attempts. Try again later after 5 minutes.");
                                $(".messagebox").fadeIn("slow");
                                this.password='';
                            }          
                            else
                            {  
                                $('#loading').fadeOut("slow");                              
                                this.errors.push("Something went wrong. Contact the administrator regarding the problem.");
                                $(".messagebox").fadeIn("slow");
                                $('html,body').animate({ scrollTop: 0 }, 'slow');
                                $('#login-form').find('.input').removeClass('state-success');
                                $('#login-form').find('.input').addClass('state-error');
                                slowetTimeout(function(){btn.button('reset'); }, 1500);
                            }

                            }).catch(error => {
                                $('#loading').fadeOut("slow");
                                this.errors.push("Something went wrong. Contact the administrator regarding the problem.");
                                $(".messagebox").fadeIn("slow");
                                $('html,body').animate({ scrollTop: 0 }, 'slow');
                                $('#login-form').find('.input').removeClass('state-success');
                                $('#login-form').find('.input').addClass('state-error');
                                setTimeout(function(){btn.button('reset'); }, 1500);
                            });
                        }
                        else
                        {
                            e.preventDefault();
                            $(".messagebox").show("slow");
                            $('html,body').animate({ scrollTop: 0 }, 'slow');
                        }
                        
                    },
                    showpass:function()
                    {
                        var password_li = $("#leadCapPassword").attr('type');
                        if(password_li=="password")
                        {
                            $("#leadCapPassword").prop('type','text');
                        }
                        else
                        {
                            $("#leadCapPassword").prop('type','password');
                        }
                    }
                },
                mounted(){
                    
                }
        	});
        </script>