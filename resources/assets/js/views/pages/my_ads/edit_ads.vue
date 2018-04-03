<template>
<div id="main-wrapper">
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">   
					<div class="dashboard__content--description">
                     <form class="form-horizontal form-material" id="create_ads" @submit.prevent="update">
					<div class="col-md-6">
					<div class="form-group">
					   
                            <label class="login__element--box--label">Ads Type</label>
                            <select  v-model="create_ads.ads_type" class="login__element--box--input">
							
							<option value="select">Select .. </option>
							<option value:="create_ads.ads_type">{{create_ads.ads_type}}</option>
							
							<option v-for="item in items" v-bind:value="item.title" >{{item.title}}</option>
								
							
							</select>
                        </div>
						
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="create_ads.title" required class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">What type of item are your charity seeking?</label>
                             <textarea  type="text" name="description" v-model="create_ads.description" required rows="5"  class="login__element--box--input"></textarea>
                        </div>
                       
						<div class="form-group">
						
                            <label class="login__element--box--label">Image</label>
                            <input type="file" name="image"  class="login__element--box--input">
                        </div>
						
						
					</div>
					
						<div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success waves-effect waves-light m-t-10">
						</div>
						  </form>
						    </div>
						  </div> 	
						 
                </div>
            </div>
			</div> 
			</section>
						   </div>
						   </template>
<script>
 import AppSidebar from '../users/sidebar.vue'
 import Vue from 'vue'
	 export default {
	  components: {
              AppSidebar 
        },
	data() {
            return {
				items:{},
                create_ads: {}
            }
        },
       created: function()
        {
            this.fetchItems();
			this.fetchItem();
        },
        
       
        methods: {
		fetchItem()
			 {
				axios.get('/api/charities').then((response) => {
				 this.items=response.data;
				
				});
			},
		fetchItems(){
                axios.get('/api/charityads/'+this.$route.params.id).then(response=>{
                    this.create_ads = response.data;    
                }).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
              update(){
                axios.post('/api/charityads/'+this.$route.params.id,this.create_ads).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/my_ads');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
        }
    }
	
</script>


						 