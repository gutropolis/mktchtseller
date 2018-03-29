<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donaters List</h3>
                  </div>
                  <div>
                     <div class="panel-body">
                        <div class="">
                        <div class="donator_status">  
						   <form id="item" @submit.prevent="update" class="form-horizontal">
						  
						    <fieldset>

                             <div class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Seller Name</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{items.seller}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							

                            <div class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Product</label>
                                <div class="donator_status--form_group--control_data">
                                     <div v-for="product in name" class="donator_status--form_group--control_data--lineup">{{product}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							
							<div v-for="prod in product" class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Product Image</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup"><figure class="charity__listing--figure col-md-3">
							<a v-bind:href="prod.description_url"><img  class="charity__listing--figure--image" v-bind:src="prod.images"></a>
							
						</figure>	</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                            <div v-for="prod in product" class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">ASIN</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{prod.asin_url}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							 <div v-for="prod in product" class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Units</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{prod.units}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                            <div class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Charity Name</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{items.charity_organisation}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                           

                            <div class="donator_status--form_group">
                                <label for="status_id" class="donator_status--form_group--control_label">Status</label>
                                <div class="donator_status--form_group--control_data">
									<select name="status" v-model="items.status" class="donator_status--form_group--control_data--select">
									<option value="select" class="donator_status--form_group--control_data--select--option">Select .. </option>
									<option value="0" class="donator_status--form_group--control_data--select--option">Pending..</option>
                                   <option value="1" class="donator_status--form_group--control_data--select--option">Accept..</option>
								   <option value="2" class="donator_status--form_group--control_data--select--option">No Thanks..</option>
								   </select>

                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->



                            <div class="donator_status--form_group">
                                <div class="donator_status--form_group--button_box">
                                    <div class="donator_status--form_group--button_box--button_outer">
                                        <button type="submit" class="btn btn-success">Update Status</button>
                                    </div> <!-- /form-actions -->
                                </div>
                            </div>

                        </fieldset>

                    </form>
                    </div>
					
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
   
    import AppSidebar from '../pages/users/sidebar.vue' 
       export default {
           components: {
              AppSidebar 
           },
   
   
           data() {
   		
               return {
			   name:{},
			   product:[],
					     items:{
						  status:'select'},   
						 item:{
						
						 }
                   }
               },
   			
   			created: function()
           {
				this.fetchproductname();
               this.fetchItems();
           },
           mounted(){
           },
           methods: {
   		status(id){
   			axios.post('api/status/'+id,this.items).then(response=>{
   			
			toastr['success']("Success");
			
   			
   			     
   			});
   		
   		
   		},
		fetchproductname()
		{
			axios.get('api/product_name').then(response=>{
					this.name=response.data;
			
			
			})
		
		},
		 update()
            {
              axios.post('api/edit_status/'+this.$route.params.id,this.items).then(response =>  {
                    toastr['success'](response.data.message);
					this.$router.push('/donaters');
                 
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                },
   		fetchItems()
			{
			axios.get('api/edit_status/'+this.$route.params.id).then(response=>{
			
			this.items=response.data.data1;
			this.product=response.data.data2;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
   			
   			}
   			
           
   		
       }
</script>