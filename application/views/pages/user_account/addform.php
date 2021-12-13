                                <div class="modal fade bd-example-modal-lg" id="newuserdialogbox" tabindex="-1" role="dialog" aria-labelledby="newuserformlabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="newuserformlabel">Add new user</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <?php echo form_open('users/saveuser',array('class' => "registration-form", 'id' => "registration-form", '@submit' => "form_validation",'autocomplete'=>'off', )); ?>
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
                                                    
                                                    <div class="form-group"><label class="small text-gray-600" for="username">Username</label><input class="form-control username" id="usernameu"  name="username" type="text" v-model="username" value="@{{ username }} "   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="firstname">First Name</label><input class="form-control fname" id="fnameu"  name="firstname" type="text" v-model="fname" value="@{{ fname }} "autofocus   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="middlename">Middle Name</label><input class="form-control mname" id="mnameu"  name="middlename" type="text" v-model="mname" value="@{{ mname }}"    /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="lastname">Last Name</label><input class="form-control lname" id="lnameu"  name="lastname" type="text" v-model="lname" value="@{{ lname }}"   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="designation">Designation</label><input class="form-control designation" id="designationu"  name="designation" type="text" v-model="designation" value="@{{ designation }}"   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="email">Email address </label><input class="form-control email" id="emailu"  name="email" type="email" v-model="email" value="@{{ email }} "   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="leadCapPassword">Password</label><input class="form-control" id="leadCapPassword" type="password" name="password" v-model="password" value="@{{ password }}"    autocomplete /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="password_confirmation">Verify Password</label><input class="form-control" id="password_confirmation" type="password" name="password_confirmation" v-model="password_confirmation" value="@{{ password_confirmation }}"    autocomplete /></div>

                                                

                                                    <div class=" form-group custom-control custom-checkbox custom-control-solid">
                                                        <input class="custom-control-input" id="leadCapShowPassword" type="checkbox" @click="showpass()">
                                                        <label class="custom-control-label" for="leadCapShowPassword">Show Password</label>
                                                    </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btnmodalclose" data-dismiss="modal">Close</button>
                                                <button  class="btn btn-primary btnsubmit" type="submit" >Save User Profile</button>
                                            </div>
                                                <?php echo form_close();?>  
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> 