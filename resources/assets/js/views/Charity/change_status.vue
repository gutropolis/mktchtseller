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
                                     <div class="donator_status--form_group--control_data--lineup">{{product.updated_by}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							

                            <div class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Product</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{product.title}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							
							<div  class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Product Image</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup"><figure class="charity__listing--figure col-md-3">
							<a v-bind:href="product.description_url"><img  class="charity__listing--figure--image" v-bind:src="product.images"></a>
							
						</figure>	</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                            <div  class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">ASIN</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{product.asin_url}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->
							 <div  class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Units</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{items.units}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                            <div class="donator_status--form_group">
                                <label class="donator_status--form_group--control_label">Charity Name</label>
                                <div class="donator_status--form_group--control_data">
                                     <div class="donator_status--form_group--control_data--lineup">{{charity.title}}</div>
                                </div> <!-- /controls -->
                            </div> <!-- /form-group -->

                            <div class="donator_status--form_group--control_data">
                    <label class="donator_status--form_group--control_label">Progress ({{items.progress}}%)</label>
					 <div class="donator_status--form_group--control_data">
                    <range-slider class="slider" min="0" max="100" step="1" v-model="items.progress" @change="sliderChange"></range-slider>
                </div>
				</div>

                           


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
	import RangeSlider from 'vue-range-slider'
	 import 'vue-range-slider/dist/vue-range-slider.css'
       export default {
           components: {
              AppSidebar,RangeSlider 
           },
   
   
           data() {
   		
               return {
			   name:{},
			   product:[],
			   charity:[],
					     items:{
						  status:'select',
						  progress:0
						  },   
						 item:{
						
						 }
                   }
               },
   			
   			created: function()
           {
				
               this.fetchItems();
           },
           mounted(){
           },
           methods: {
		   sliderChange(value){
                this.items.progress = value;
            },
   		status(id){
   			axios.post('api/status/'+id,this.items).then(response=>{
   			
			toastr['success']("Success");
			
   			
   			     
   			});
   		
   		
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
			this.charity=response.data.data3;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
   			
   			}
   			
           
   		
       }
</script>