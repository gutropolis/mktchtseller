<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donations</h3>
                  </div>
                  <div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                              <tr>
                                 <th>ID</th>
								 <th>Product Name</th>
                                 <th>Seller</th>
                                 <th>Charity</th>
								 <th>Units</th>
								 <th>Progress</th>
                                 <th>Certify</th>
								 <th>Status</th>
                                 <th>Change Status</th>
                              </tr>
                              <tr v-for="(item,index) in items.data">
                                 <td>{{index+1}}</td>
								  <td>{{item.product}}</td>
                                 <td>{{item.seller}}</td>
								 <td>{{item.charity}}</td>
                                 <td>{{item.units}}</td>
								 <td>{{ item.progress }} %</td>
                                
                                 <td>
								  <click-confirm yes-class="btn btn-success" no-class="btn btn-danger">
                                    <button v-if="item.is_certify==0" class="btn btn-danger btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as complete"><i class="fa fa-times"></i></button>
                                    <button v-if="item.is_certify==1" class="btn btn-success btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as Incomplete"><i class="fa fa-check"></i></button>
									  </click-confirm>
                                 </td>
								 <td v-if="item.status== 0">Pending</td>
								 <td v-if="item.status== 1">Accept</td>
								 <td v-if="item.status== 2">Decline</td>
								 
                                 <td>
								 <router-link :to="{name: 'change_status', params: { id: item.id }}">
								Click Here
								 </router-link>
                                 </td>
                              </tr>
							   <tr>
								 <td v-if="itemslength == 0" colspan="9">
									<h4  style="text-align:center;" >No results</h4>
										</td>
										</tr>
                           </table>
						  
                        </div>
                     </div>
					   <div class="row">
                                <div class="col-md-12 pagination_box">
                                    <pagination :data="items" :limit=3 v-on:pagination-change-page="fetchItems"></pagination>
									<select name="pageLength" class="page_option" v-model="filterUserForm.pageLength" @change="fetchItems" v-if="items.total">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                </div>
                                
                            </div>
					 
					 
					 
					 
					 
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</template>
<script>
   import pagination from 'laravel-vue-pagination'
    import ClickConfirm from 'click-confirm'
    import helper from '../../services/helper'
    import AppSidebar from '../pages/users/sidebar.vue' 
       export default {
           components: {
              AppSidebar ,ClickConfirm,pagination
           },
   
   
           data() {
   		
               return {
			   itemslength:{},
			   filterUserForm: {
                   // sortBy : 'title',
                    order: 'desc',
                    status: '',
                    title: '',
                    pageLength: 5
                },
			   name:{},
					item:
					{
						status: '',
						},
   			
   			items:{},
                      
                   }
               },
   			
   			created: function()
           {
		   this.fetchItems();
           },
           mounted(){
           },
           methods: {
   		status(id){
   			axios.post('api/status/'+id,this.item).then(response=>{
   			toastr['success']("Success");
   			
   			
   			});
   		
   		
   		},
   		fetchItems(page)
   			{
			if (typeof page === 'undefined') {
                    page = 1;
                }
				let url = helper.getFilterURL(this.filterUserForm);
   			axios.get('api/donaters_list?page=' + page + url).then(response=>{
   			
   			this.items=response.data.data1;
			this.itemslength=response.data.data2;
			console.log(this.itemslength);
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   			});
   			},
               
               toggleTaskStatus(id){
                   axios.post('api/certify/'+id).then((response) => {
                       this.fetchItems();
                   });
               }
   			
   			}
   			
           
   		
       }
</script>