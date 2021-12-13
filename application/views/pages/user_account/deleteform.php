                                <div class="modal fade" id="deleteusermodal" tabindex="-1" role="dialog" aria-labelledby="deleteusermodal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageboxdelete">Message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click='closeprompt()'>
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group has-feedback"  id="loading-del"  style="display: none;"  >
                                                    <div >
                                                      <strong> <center>
                                                          <img src="<?php echo base_url() ?>assets/img/loading.gif" alt="CMULOGO" style="width:100px;height:100px;"></center>
                                                      </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group has-feedback messagebox-del"  style="display: none;" >
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
                                                Are you sure you want to delete this user info? <br>
                                                <b>Username: </b><b id="tempusername"></b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click='closeprompt()'>Close</button>
                                                <button type="button" class="btn btn-primary deletetransaction" @click='deletetransaction()'>Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>