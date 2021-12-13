                                <div class="row">
                                    <div class="col-sm-3"> 
                                        
                                    </div>
                                    <div class="col-sm-3"> 
                                        
                                    </div>
                                    <div class="col-sm-3"> 

                                    </div>
                                    <div class="col-sm-3"> 
                                        <input type="text" class="keywords form-control" id="keywords" name="keywords" v-model="keywords" placeholder="Type keywords to filter posts" v-on:keyup.enter="search_content(1)" />
                                    </div>
                                </div>
                                <br>
                                <div class="datatable" id="datatable_div">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>FullName</th>
                                                <th>Email Address</th>
                                                <th>Designation</th>
                                                <th>Account Status</th>
                                                <th >Option</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr id='loading_div'>
                                                <td colspan="7"><center><img src="<?php echo base_url()?>assets/img/loading.gif"></center></td>
                                            </tr>
                                            <tr id='nodata_div' style="display: none;" >
                                                <td colspan="7"><center>No Record Available</center></td>
                                            </tr>
                                            <tr id='data_div'  v-for="list_content,key in reporttable">
                                                <td>{{++key}}</td>
                                                <td>{{ list_content.Username }}</td>
                                                <td v-if="list_content.Middlename === null || list_content.Middlename === '' ">
                                                    {{ list_content.Lastname }}, {{ list_content.Firstname }} 
                                                </td>
                                                <td v-else>
                                                    {{ list_content.Lastname }}, {{ list_content.Firstname }} {{ list_content.Middlename[0] }}.
                                                </td>
                                                <td>{{ list_content.Email }}</td>

                                                <td>{{ list_content.Designation }}</td>
                                                <td v-if="list_content.Status == 1" align="center">                                                    
                                                    <!-- <a class="btn btn-success" disabled>Active</a> -->
                                                    <h5><span class="badge badge-success">Active</span></h5> 
                                                </td>
                                                <td v-else-if="list_content.Status == 0" align="center">    
                                                    <!-- <a class="btn btn-warning" disabled>Inactive</a> -->
                                                    <h5><span class="badge badge-warning">Inactive</span></h5>
                                                </td>
                                                <td v-else>
                                                    <a class="btn btn-danger" disabled>Deleted</a>
                                                </td>
                                                <td  v-if="list_content.Status == 1 || list_content.Status == 0">          
                                                    <button class="btn btn-info  btn-sm" v-on:click="updateform(list_content.Username,key)"><i class="fa fa-edit"></i></button>                                         
                                                    <button class="btn btn-danger btn-sm" v-on:click="deleteprompt(list_content.Username,key)"><i class="fa fa-trash"></i></button>
                                                </td>
                                                <td v-else>
                                                    
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-3"> 
                                        <select class="page form-control" name="page" id="page" v-model='page' @change="search_content(1)">
                                            <option v-for="list_content in pagelist" :value="list_content.value">{{ list_content.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <select class="sort form-control" name="sort" id="sort" v-model='sort' @change="search_content(1)">
                                            <option v-for="list_content in sortlist" :value="list_content.value">{{ list_content.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <select class="order form-control" name="order" id="order" v-model='order' @change="search_content(1)">
                                            <option v-for="list_content in orderlist" :value="list_content.value">{{ list_content.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3"> 
                                        
                                    </div>
                                </div>