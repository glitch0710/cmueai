            <div id="layoutSidenav_content" oncontextmenu="return false">
                <main id="app">
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="users"></i></div>
                                            Member Information
                                        </h1>
                                        <div class="page-header-subtitle">Report of Registered Members</div>
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
                                <a class="btn btn-primary bg-gradient-primary-to-secondary" data-toggle="modal" data-target="#newmemberdialogbox"><i data-feather="user-plus" style="margin-right: 10px; "></i>Add New Profile</a> 
                                <!-- Modal form for  new user-->
                                <?php $this->load->view("pages/memberships/members/addform") ?>

                                <!-- End of Modal form for  new user-->
                            </div>
                            <div class="card-body">
                                <?php $this->load->view("pages/memberships/members/recordlist") ?>
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
                    var session_log="<?php echo $this->encryption->encrypt("session-member-log"); ?>";
                    const form = new Vue({
                        el:"#app",
                        data:{
                            empno:"",
                            fname:"",
                            mname:"",
                            lname:"", 
                            NameExt:"",
                            bday:"", 
                            gender:"",
                            civil_status :"",
                            officeassigned:"", 
                            position:"", 
                            address:"", 
                            spousen:"", 
                            checkspouseemp:"",
                            fdatestart:"", 
                            spbday:"", 
                            spposition:"",
                            sssnum:"",
                            gsisnum:"",
                            tinnum:"",
                            phnum:"",
                            cnum:"",
                            spposition:"",

                            keywords:"",
                            errors : [],
                            reporttable:[],

                            page:"",
                            sort:"",
                            order:"",

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
                        },
                        methods: {
                            form_validation:function(e) 
                            {
                                $( ".session_log" ).remove();
                                $input = $('<input type="text"class="session_log" name="session_log"/ style="display:none;">').val(session_log);

                                this.errors = [];
                                validate_info = "no error";
                                $(".messagebox").hide("slow");
                                $('#loading').fadeOut("slow");

                                if (!this.fname) {
                                    validate_info = "error";
                                    this.errors.push("Firstname Field must not leave a blank.");
                                } 

                                if (!this.mname) {
                                    validate_info = "error";
                                    this.errors.push("Middlename Field must not leave a blank.");
                                } 

                                if (!this.lname) {
                                    validate_info = "error";
                                    this.errors.push("Lastname Field must not leave a blank.");
                                } 

                                 if (!this.bday) {
                                    validate_info = "error";
                                    this.errors.push("Birthday Field must not leave a blank.");
                                } 

                                if (!this.gender) {
                                    validate_info = "error";
                                    this.errors.push("Gender Field must not leave a blank.");
                                } 

                                 if (!this.civil_status) {
                                    validate_info = "error";
                                    this.errors.push("Civil Status Field must not leave a blank.");
                                } 

                                if (!this.position) {
                                    validate_info = "error";
                                    this.errors.push("Position Field must not leave a blank.");
                                } 

                                if (!this.officeassigned) {
                                    validate_info = "error";
                                    this.errors.push("Office Assigned Field must not leave a blank.");
                                } 

                               

                                if (!this.address) {
                                    validate_info = "error";
                                    this.errors.push("Address Field must not leave a blank.");
                                } 

                                if (!this.spousen) {
                                    validate_info = "error";
                                    this.errors.push("Spouse Name Field must not leave a blank.");
                                } 

                               

                                if(validate_info == "no error")
                                {
                                    var action = $('#registration-form').attr('action');
                                    $('#registration-form').append($input);
                                    var xdata  = $('#registration-form').serialize();
                                    $( ".session_log" ).remove();
                                    
                                    var btn = $('.btnsubmit');
                                    btn.attr('data-loading-text','<i class="fa fa-refresh fa-spin"></i> Adding New Profile...');
                                    btn.button('loading');
                                    $('#loading').show("slow");

                                    axios.post(action, xdata,).then(response => {
                                            if(response.data.status=="success")
                                            {
                                                this.empno = "";
                                                this.fname = "";
                                                this.mname = "";
                                                this.lname = "";
                                                this.NameExt = "";
                                                this.officeassigned= "";
                                                this.position= "";
                                                this.address= ""; 
                                                this.spousen= "";
                                                this.bday= "";
                                                this.fdatestart= "";
                                                this.spbday= "";
                                                this.spposition= "";
                                                this.phnum= "";
                                                this.sssnum= "";
                                                this.gsisnum= "";
                                                this.tinnum= "";
                                                this.cnum= "";
                                                this.spposition= "";
                                                $('#loading').fadeOut("slow");
                                                $('.btnmodalclose').click();
                                                //this.search_content(1);
                                            }
                                            else
                                            {
                                                if(response.data.message=="error registration")
                                                {
                                                    msg_error = response.data.data;
                                                    for (let i = 0; i < msg_error.length; i++) {
                                                        this.errors.push(msg_error[i].msg);                                                        
                                                    }
                                                    $('#loading').fadeOut("slow");                                                
                                                    $(".messagebox").fadeIn("slow");
                                                    $('#newmemberdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                    setTimeout(function(){btn.button('reset'); }, 1500);
                                                    console.log(response);
                                                }
                                                else
                                                {
                                                    $('#loading').fadeOut("slow");
                                                    this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                                    $(".messagebox").fadeIn("slow");
                                                    $('#newmemberdialogbox').animate({ scrollTop: 0 }, 'slow');
                                                    setTimeout(function(){btn.button('reset'); }, 1500);

                                                    console.log(response);
                                                }
                                            }
                                    }).catch(error => {
                                        $('#loading').fadeOut("slow");
                                        this.errors.push("Something went wrong. Contact the administrator for the problem.");
                                        $(".messagebox").fadeIn("slow");
                                        $('#newmemberdialogbox').animate({ scrollTop: 0 }, 'slow');
                                        setTimeout(function(){btn.button('reset'); }, 1500);
                                        console.log(error);
                                    });
                                }
                                else
                                {
                                    $(".messagebox").show("slow");
                                    $('#newmemberdialogbox').animate({ scrollTop: 0 }, 'slow');
                                }
                                  
                                e.preventDefault();
                            },
                            search_content:function(page_num)
                            {
                                limitview_count = $("#entries").val()
                                this.reporttable  = [];
                                var address = base_url+"memberships/load_report/";
                                $('#nodata_div').hide();
                                let params = new URLSearchParams();
                                $('#loading_div').show("slow");
                                params.append("limitview_count", this.page);
                                params.append("session_log", session_log);
                                params.append("search_value", this.keywords);
                                axios.post(address, params,)
                                    .then(response => {
                                        console.log(response);
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
                        },
                        mounted()
                        {
                            this.search_content(1);
                        }
                    });
                </script>
            </div>