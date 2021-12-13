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
                                                <th>FullName</th>
                                                <th>Gender</th>
                                                <th>Position/Designation</th>
                                                <th>Office Assigned</th>
                                                <th >Option</th>
                                                <th >Action</th>
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
                                                <td v-if="list_content.MiddleName === null || list_content.MiddleName === '' ">
                                                    {{ list_content.Lastname }}, {{ list_content.Firstname }} 
                                                </td>
                                                <td v-else>
                                                    {{ list_content.Lastname }}, {{ list_content.Firstname }} {{ list_content.MiddleName[0] }}.
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
                            