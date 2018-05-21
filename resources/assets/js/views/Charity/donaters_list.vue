<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donations</h3>
					 <p>Click On Certify Only After the Products Have Been Dilevered to You.By Clicking On Certify You Acknowledge That the Donation is completed And you will Prompted to electronically sign off on the Donation </p>
                  </div>
                  <div>
                     <div class="panel-body">
                        <div class="table-responsive">
						<button  class="btn btn-success btn-md" @click="toggleTaskStatus()" data-toggle="tooltip" title="Mark as Incomplete">Certify</button>
                          <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                              <tr>
                                 <th>  <input type='checkbox'  v-model="selectAll"></th>
								 <th>Product Name</th>
                                 <th>Seller</th>
                                 <th>Charity</th>
								 <th>Units</th>
								 <th>Status</th>
                                
                              </tr>
                              <tr v-for= "item in items.data">
                                 <td> <input type='checkbox' v-bind:value='item.id' v-model='selected' ></td>
								  <td>{{item.product}}</td>
                                 <td>{{item.seller}}</td>
								 <td>{{item.charity}}</td>
                                 <td>{{item.units}}</td>
								 <td v-if="item.is_certify==0 && item.charity_status==1">Not Certified</td>
								 <td v-if="item.is_certify==1  && item.charity_status==1">Certified</td>
                                 
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
			   
			    
				items:{},
				itemslength:{},
				selected: [],
				filterUserForm: {
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

                      
                   }
               },
   			
   			created: function()
           {
		 this.fetchItems();
           },
           mounted(){
           },
           methods: {
		   
		   fetchItems(page)
   			{
			if (typeof page === 'undefined') {
                    page = 1;
                }
				let url = helper.getFilterURL(this.filterUserForm);
   			axios.get('/api/donaters_list?page=' + page + url).then(response=>{
   			
   			this.items=response.data.data1;
			this.itemslength=response.data.data2;
			
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   			});
   			},
               
		     
    
	 toggleTaskStatus(){
	 
                   axios.post('/api/certify/'+this.selected).then((response) => {
				   toastr['success'](response.data.message);
                       this.fetchItems();
                   });
               },
			  
   			},
			computed: {
        selectAll: {
            get: function () {
		
                return this.items.data ? this.selected.length == '5': false;
            },
            set: function (value) {
                var selected = [];

                if (value) {
                    this.items.data.forEach(function (item) {
                        selected.push(item.id);
                    });
                }

                this.selected = selected;
				console.log(this.selected);
            }
        }
    }
   			
           
   		
       }
</script>