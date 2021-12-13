                                <div class="modal fade bd-example-modal-lg" id="newmemberdialogbox" tabindex="-1" role="dialog" aria-labelledby="newuserformlabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-gradient-primary-to-secondary">
                                                <h5 class="modal-title text-white" id="newuserformlabel">Add New Profile</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <?php echo form_open('memberships/saveinfo/members',array('class' => "registration-form", 'id' => "registration-form", '@submit' => "form_validation",'autocomplete'=>'off', )); ?>
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
                                                    <div class="form-group"><label class="small text-gray-600" for="empno">Employee ID</label><input class="form-control empno" id="empno"  name="empno" type="text" v-model="empno" value="@{{ empno }} "autofocus   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="fname">First Name</label><input class="form-control fname" id="fname"  name="fname" type="text" v-model="fname" value="@{{ fname }} "autofocus   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="middlename">Middle Name</label><input class="form-control mname" id="mname"  name="mname" type="text" v-model="mname" value="@{{ mname }}"    /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="lname">Last Name</label><input class="form-control lname" id="lname"  name="lname" type="text" v-model="lname" value="@{{ lname }}"   /></div>
                                                    <div class="form-group"><label class="small text-gray-600" for="NameExt">Name Extension</label><input class="form-control NameExt" id="NameExt"  name="NameExt" type="text" v-model="NameExt" value="@{{ NameExt }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="bday">Birthday</label><input class="form-control bday" id="bday"  name="bday" type="date" v-model="bday" value="@{{ bday }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="gender">Gender</label>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6">               
                                                                <div class="custom-control custom-radio custom-control-solid">
                                                                    <input class="custom-control-input" id="genderm" type="radio" name="gender" value="male" v-model="gender">
                                                                    <label class="custom-control-label" for="genderm">Male</label>
                                                                </div>
                                                            </div>    
                                                            <div class="col-md-6 col-sm-6">              
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" id="genderf" type="radio" name="gender" value="female" v-model="gender">
                                                                    <label class="custom-control-label" for="genderf">Female</label>
                                                                </div>
                                                            </div>  

                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="small text-gray-600" for="civil_status">Civil Status</label>
                                                        <select class="form-control" v-model="civil_status" name="civil_status">
                                                            <option> Select Option</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Divorse">Divorse</option>   

                                                        </select>
                                                    </div>

                                                    <div class="form-group"><label class="small text-gray-600" for="position">Position</label><input class="form-control position" id="position"  name="position" type="text" v-model="position" value="@{{ position }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="officeassigned">Office Assigned</label><input class="form-control officeassigned" id="officeassigned"  name="officeassigned" type="text" v-model="officeassigned" value="@{{ officeassigned }}"   /></div>
                                                    <div class="form-group">
                                                        <label class="small text-gray-600" for="address">Address</label>
                                                        <textarea name="address" class="form-control address" v-model="address" >
                                                            
                                                        </textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-9 col-sm-9">
                                                            <div class="form-group"><label class="small text-gray-600" for="spousen">Spouse Name</label><input class="form-control spousen" id="spousen"  name="spousen" type="text" v-model="spousen" value="@{{ spousen }}"   /></div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-solid">
                                                                    <br>
                                                                    <input class="custom-control-input" id="checkspouseemp" name="checkspouseemp" type="checkbox" v-model="checkspouseemp" value="yes">
                                                                    <label class="custom-control-label" for="checkspouseemp">CMU Employee</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="small text-gray-600" for="spbday">Spouse Birthday</label><input class="form-control spbday" id="spbday"  name="spbday" type="date" v-model="spbday" value="@{{ spbday }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="spposition">Spouse Assigned</label><input class="form-control spposition" id="spposition"  name="spposition" type="text" v-model="spposition" value="@{{ spposition }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="fdatestart">Date of Work Started</label><input class="form-control fdatestart" id="fdatestart"  name="fdatestart" type="date" v-model="fdatestart" value="@{{ fdatestart }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="gsisnum">GSIS</label><input class="form-control gsisnum" id="gsisnum"  name="gsisnum" type="text" v-model="gsisnum" value="@{{ gsisnum }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="sssnum">SSS</label><input class="form-control sssnum" id="sssnum"  name="sssnum" type="text" v-model="sssnum" value="@{{ sssnum }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="phnum">PhilHealth Number</label><input class="form-control phnum" id="phnum"  name="phnum" type="text" v-model="phnum" value="@{{ phnum }}"   /></div>

                                                    <div class="form-group"><label class="small text-gray-600" for="tinnum">TIN</label><input class="form-control tinnum" id="tinnum"  name="tinnum" type="text" v-model="tinnum" value="@{{ tinnum }}"   /></div>

                                                     <div class="form-group"><label class="small text-gray-600" for="cnum">Contact No</label><input class="form-control cnum" id="cnum"  name="cnum" type="text" v-model="cnum" value="@{{ cnum }}"   /></div>
                                                    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btnmodalclose" data-dismiss="modal">Close</button>
                                                <button  class="btn btn-success btnsubmit" type="submit" >Save New Member Profile</button>
                                            </div>
                                                <?php echo form_close();?>  
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> 