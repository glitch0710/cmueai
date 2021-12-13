                                <div class="modal fade bd-example-modal-lg" id="updateuserdialogbox" tabindex="-1" role="dialog" aria-labelledby="updateuserformlabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateuserformlabel">Update User Info</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <?php echo form_open('users/updateuser',array('class' => "update-form", 'id' => "update-form", '@submit' => "form_validation_update",'autocomplete'=>'off', )); ?>
                                                    <ul class="parsley-error-list">
                                                        <?php echo $this->session->flashdata('message');?>
                                                    </ul>
                                                    <input style="display: none;" class="form-control uusername" id="uusername"  name="uusername" type="text" v-model="uusername" value="@{{ uusername }} "   />
                                                    <div class="form-group has-feedback"  id="loading-update"  style="display: none;"  >
                                                        <div >
                                                          <strong> <center>
                                                              <img src="<?php echo base_url() ?>assets/img/loading.gif" alt="CMULOGO" style="width:100px;height:100px;"></center>
                                                          </strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback messagebox-updated"  style="display: none;" >
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
                                                    
                                                    <div class="form-group"><label class="small text-gray-600" for="username">Username</label><input disabled class="form-control username" id="username"  name="username" type="text" v-model="username" value="@{{ username }} "   /></div>
                                                   
                                                    <div class="form-group"><label class="small text-gray-600" for="firstname">First Name</label><input class="form-control fname" id="fname"  name="firstname" type="text" v-model="fname" value="@{{ fname }} "autofocus   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="middlename">Middle Name</label><input class="form-control mname" id="mname"  name="middlename" type="text" v-model="mname" value="@{{ mname }}"    /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="lastname">Last Name</label><input class="form-control lname" id="lname"  name="lastname" type="text" v-model="lname" value="@{{ lname }}"   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="designation">Designation</label><input class="form-control designation" id="designation"  name="designation" type="text" v-model="designation" value="@{{ designation }}"   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="email">Email address </label><input class="form-control email" id="email"  name="email" type="email" v-model="email" value="@{{ email }} "   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="leadCapPassword">Password</label><input class="form-control" id="leadCapPassword_u" type="password" name="password" v-model="upassword" value="@{{ upassword }}"    autocomplete /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="password_confirmation">Verify Password</label><input class="form-control" id="password_confirmation_u" type="password" name="upassword_confirmation" v-model="upassword_confirmation" value="@{{ upassword_confirmation }}"    autocomplete /></div>

                                                

                                                    <div class=" form-group custom-control custom-checkbox custom-control-solid">
                                                        <input class="custom-control-input" id="leadCapShowPassword_u" type="checkbox" @click="showpassu()">
                                                        <label class="custom-control-label" for="leadCapShowPassword_u">Show Password</label>
                                                    </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btnmodalclose" data-dismiss="modal">Close</button>
                                                <button  class="btn btn-primary btnsubmit-updated" type="submit" >Save Updated User Profile</button>
                                            </div>
                                                <?php echo form_close();?>  
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> 