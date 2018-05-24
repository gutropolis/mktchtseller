<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donation List</h3>
                  </div>
                  <div class="donation_top_tab">
                  <b-tabs>
                     <b-tab title="Pending" active>
                        <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                                    <tr>
                                       <th>ID</th>
                                       <th>Product</th>
                                       <th>Units</th>
                                       <th>Charity</th>
                                       <th>Status</th>
                                       <th>Created On</th>
                                       <th>Action</th>
                                      
                                    </tr>
                                    <tr v-for="(item,index) in pending.data">
                                       <td>{{index+1}}</td>
                                       <td>{{item.product}}</td>
                                       <td>{{item.units}}</td>
                                       <td>{{item.charity}}</td>
                                       <td v-if="item.charity_status == 0">Pending</td>
                                       <td v-if="item.charity_status == 1">Accept</td>
                                       <td v-if="item.charity_status == 2">Decline</td>
                                       <td>{{item.created_at |  moment("MMMM Do YYYY")}}</td>
                                      
                                       <td> <b-link class="table-icon" @click.prevent="deleteTask(item.id)">
                                          <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             width="774.266px" height="774.266px" viewBox="0 0 774.266 774.266" style="enable-background:new 0 0 774.266 774.266;"
                                             xml:space="preserve">
                                             <g>
                                                <path d="M640.35,91.169H536.971V23.991C536.971,10.469,526.064,0,512.543,0c-1.312,0-2.187,0.438-2.614,0.875
                                                   C509.491,0.438,508.616,0,508.179,0H265.212h-1.74h-1.75c-13.521,0-23.99,10.469-23.99,23.991v67.179H133.916
                                                   c-29.667,0-52.783,23.116-52.783,52.783v38.387v47.981h45.803v491.6c0,29.668,22.679,52.346,52.346,52.346h415.703
                                                   c29.667,0,52.782-22.678,52.782-52.346v-491.6h45.366v-47.981v-38.387C693.133,114.286,670.008,91.169,640.35,91.169z
                                                   M285.713,47.981h202.84v43.188h-202.84V47.981z M599.349,721.922c0,3.061-1.312,4.363-4.364,4.363H179.282
                                                   c-3.052,0-4.364-1.303-4.364-4.363V230.32h424.431V721.922z M644.715,182.339H129.551v-38.387c0-3.053,1.312-4.802,4.364-4.802
                                                   H640.35c3.053,0,4.365,1.749,4.365,4.802V182.339z"/>
                                                <rect x="475.031" y="286.593" width="48.418" height="396.942"/>
                                                <rect x="363.361" y="286.593" width="48.418" height="396.942"/>
                                                <rect x="251.69" y="286.593" width="48.418" height="396.942"/>
                                             </g>
                                          </svg>
                                       </b-link></td>
                                     
                                    </tr>
                                    <tr>
                                    
                                 <td v-if="pendingLength == 0" colspan="8    ">
                                    <h4  style="text-align:center;" >No results</h4>
                                        </td>
                                        </tr>
                                 </table>
                                
                              </div>
                           </div>
                           <div class="row">
                                <div class="col-md-12 pagination_box">
                                    <pagination :data="accept" :limit=3 v-on:pagination-change-page="fetchItems"></pagination>
                                    <select name="pageLength" class="page_option" v-model="filterUserForm.pageLength" @change="fetchItems" v-if="accept.total">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                </div>
                                
                            </div>
                           
                           
                           
                           
                           
                        </div>
                     </b-tab>
                     <b-tab title="Accepted" >
                        <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                                    <tr>
                                       <th>ID</th>
                                       <th>Product</th>
                                       <th>Units</th>
                                       <th>Charity</th>
                                       <th>Status</th>
                                       <th>Created On</th>
                                       
                                    </tr>
                                    <tr v-for="(item,index) in accept.data">
                                       <td>{{index+1}}</td>
                                      <td>{{item.product}}</td>
                                       <td>{{item.units}}</td>
                                      <td> <b-link v-b-modal.modal1 class="btn-text" @click="charity_info(item.id)">{{item.charity}}</b-link></td>
                                     
                                       <td v-if="item.charity_status == 0">Pending</td>
                                       <td v-if="item.charity_status == 1">Accepted</td>
                                       <td v-if="item.charity_status == 2">Decline</td>
                                       <td>{{item.created_at |  moment("MMMM Do YYYY")}}</td>
                                     
                                    </tr>
                                    <tr>
                                 <td v-if="acceptLength == 0" colspan="7">
                                    <h4  style="text-align:center;" >No results</h4>
                                        </td>
                                        </tr>
                                 </table>
                                  <b-modal id="modal1" hide-footer title="Charity Detail">
 
                                  <div class="charity_accept-detail">
                                    <div class="col-md-4">
                                        <figure class="charity_accept-detail--figure"><img :src="'/images/charity/'+charity_detail.images" ></figure>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="charity_accept-detail--content">
                                            <p><span>Name:</span>{{charity_detail.first_name}} {{charity_detail.last_name}}</p>
                                            <p><span>Contact No:</span> {{charity_detail.phone_number}}</p>
                                            <p><span>Address:</span>{{charity_detail.address}}</p>
                                            
                                        
                                        </div>
                                    </div>
                                  </div>
                                   </b-modal>
                              </div>
                           </div>
                            <div class="row">
                                <div class="col-md-12 pagination_box">
                                    <pagination :data="accept" :limit=3 v-on:pagination-change-page="fetchItems"></pagination>
                                    <select name="pageLength" class="page_option" v-model="filterUserForm.pageLength" @change="fetchItems" v-if="accept.total">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                </div>
                                
                            </div>
                        </div>
                     </b-tab>
                     <b-tab title="Declined">
                        <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                                    <tr>
                                       <th>ID</th>
                                       <th>Product</th>
                                       <th>Units</th>
                                       <th>Charity </th>
                                      
                                       <th>Status</th>
                                       <th>Created On</th>
                                      
                                    </tr>
                                    <tr v-for="(item,index) in decline.data">
                                       <td>{{index+1}}</td>
                                        <td>{{item.product}}</td>
                                       <td>{{item.units}}</td>
                                      <td>{{item.charity}}</td>
                                     
                                       <td v-if="item.charity_status == 0">Pending</td>
                                       <td v-if="item.charity_status == 1">Accepted</td>
                                       <td v-if="item.charity_status == 2">Decline</td>
                                       <td>{{item.created_at |  moment("MMMM Do YYYY")}}</td>
                                      
                                    </tr>
                                    <tr>
                                 <td v-if="declineLength == 0" colspan="7">
                                    <h4  style="text-align:center;" >No results</h4>
                                        </td>
                                        </tr>
                                 </table>
                                 
                              </div>
                           </div>
                           <div class="row">
                                <div class="col-md-12 pagination_box">
                                    <pagination :data="decline" :limit=3 v-on:pagination-change-page="fetchItems"></pagination>
                                    <select name="pageLength" class="page_option" v-model="filterUserForm.pageLength" @change="fetchItems" v-if="decline.total">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                </div>
                                
                            </div>
                        </div>
                     </b-tab>
                      <b-tab title="Completed">
                      <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                                    <tr>
                                       <th>ID</th>
                                       <th>Product</th>
                                       <th>Units</th>
                                       <th>Charity </th>
                                       
                                       <th>Status</th>
                                       <th>Tax Document</th>
                                       <th>Created On</th>
                                       <th>Report Detail</th>
                                    </tr>
                                    <tr v-for="(item,index) in completed.data">
                                       <td>{{index+1}}</td>
                                        <td>{{item.product}}</td>
                                       <td>{{item.units}}</td>
                                      <td> <b-link v-b-modal.modal2 class="btn-text" @click="charity_info(item.id)">{{item.charity}}</b-link></td>
                                     
                                       <td v-if="item.charity_status == 0">Pending</td>
                                       <td v-if="item.charity_status == 1">Accepted</td>
                                       <td v-if="item.charity_status == 2">Decline</td>
                                       <td></td>
                                       <td>{{item.created_at |  moment("MMMM Do YYYY")}}</td>
                                       <td> 
                                      <i class="fa fa-file-pdf-o" aria-hidden="true" @click="fetchreport(item.id)"></i>
                                  </td>
                                       
                                    </tr>
                                    <tr>
                                 <td v-if="completeLength <= 0" colspan="8">
                                    <h4  style="text-align:center;" >No results</h4>
                                        </td>
                                        </tr>
                                 </table>
                                  <b-modal id="modal2" hide-footer title="Charity Detail">
 
                                  <div class="charity_accept-detail">
                                    <div class="col-md-4">
                                        <figure class="charity_accept-detail--figure"><img :src="'/images/charity/'+charity_detail.images" ></figure>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="charity_accept-detail--content">
                                            <p><span>Name:</span>{{charity_detail.first_name}} {{charity_detail.last_name}}</p>
                                            <p><span>Contact No:</span> {{charity_detail.phone_number}}</p>
                                            <p><span>Address:</span>{{charity_detail.address}}</p>
                                            
                                        
                                        </div>
                                    </div>
                                  </div>
                                   </b-modal>
                              </div>
                           </div>
                           <div class="row">
                                <div class="col-md-12 pagination_box">
                                    <pagination :data="completed" :limit=3 v-on:pagination-change-page="fetchItems"></pagination>
                                    <select name="pageLength" class="page_option" v-model="filterUserForm.pageLength" @change="fetchItems" v-if="completed.total">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                </div>
                                
                            </div>
                        </div>
                      </b-tab>
                     
                  </b-tabs>
               </div>
               </div>
            </div>
            
         </div>
      </section>
   </div>
</template>
<script>
import helper from '../../../services/helper'
import pagination from 'laravel-vue-pagination'
import Vue from 'vue'
Vue.use(require('vue-moment'));
  
   import AppSidebar from '../../pages/users/sidebar.vue' 
      export default {
          components: {
             AppSidebar,pagination
          },
   
   
          data() {
       
              return {
              charity_detail:{},
              user_info:{},
              filterUserForm: {
                   
                    order: 'desc',
                    status: '',
                    title: '',
                    pageLength: 5
                },
   
           name:{},
			    pending:{},
			    accept:{},
			    decline:{},
			    completed:{},
				pendingLength:{},
				acceptLength:{},
				declineLength:{},
				completeLength:{},
       
                  }
              },
           
           created: function()
          {
            this.fetchreport();
              this.fetchItems();
          },
          mounted(){
          this.charity_info()
          },
          methods: {
		   fetchreport(id)
               {
					
                 axios.get('/api/report_donation/'+id).then(response =>  {
   			
   				
                 });
               },
          charity_info(id)
         {
            axios.get('/api/charity_info/'+id).then(response=>{
                this.charity_detail=response.data;
                
            
            });
          
          },
       status(id){
           axios.post('/api/status/'+id,this.status).then(response=>{
           toastr['success']("Success");
           
           
           });
       
       
       },
    
       fetchItems(page)
           {
        if (typeof page === 'undefined') {
                    page = 1;
                }
                let url = helper.getFilterURL(this.filterUserForm);
           axios.get('/api/donation_list?page=' + page + url).then(response=>{
           
           this.pending=response.data.data1;
        console.log(this.pending);
        this.accept=response.data.data2;
        this.decline=response.data.data3;
        this.completed=response.data.data4;
        this.pendingLength=response.data.data5;
        this.acceptLength=response.data.data6;
        this.declineLength=response.data.data7;
        this.completeLength=response.data.data8;
           
           }).catch(error=>{
           toastr['error'](error.response.data.message);
           });
           },
        deleteTask(id){
                  axios.delete('/api/delete_donation/'+id).then(response => {
                      toastr['success'](response.data.message);
                   this.loaded = true;
                   this.fetchItems();
                    
                  }).catch(error => {
                      toastr['error'](error.response.data.message);
                  });
              },
        
         toggleTaskStatus(id){
                  axios.post('/api/certify/'+id).then((response) => {
                      this.fetchItems();
                  });
              }
           
           }
           
          
       
      }
</script>