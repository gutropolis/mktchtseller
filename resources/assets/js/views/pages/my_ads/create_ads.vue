<template>
<div id="main-wrapper">
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">   
					<div class="dashboard__content--description">
                        
                            <h3 class="dashboard__content--description--heading">Create Your Ads</h3>
                     <form class="form-horizontal form-material" id="create_ads" @submit.prevent="submit">
					<div class="col-md-6">
					
					<div class="form-group">
					   
                            <label class="login__element--box--label">Select Organisation</label>
                            <select name="ads_type" v-model= "create_ads.ads_type" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option v-for="item in items"   v-bind:value="item.title">{{item.title}}</option>
							
							
							
							
							</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="create_ads.title" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">What type of item are your charity seeking?</label>
                             <textarea  type="text" name="description" v-model="create_ads.description"  rows="5"  class="login__element--box--input"></textarea>
                        </div>
                       
						<div class="form-group">
                            <label class="login__element--box--label">Image</label>
                            <input type="file"  v-on:change="onImageChange" class="login__element--box--input">
                        </div>
						
						 <div class="col-md-6" v-if="image">
                              <img :src="image" class="img-responsive" height="100" width="120">
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
				image: '',
                create_ads: {
					ads_type:'',
                    title: '',
                    description: '',
                  
				  
				   ads_type:'select'
                    
                }
            }
        },
       
        created: function()
					  {
						  this.fetchItems();
					  },
       
        methods: {
				 fetchItems()
			 {
				axios.get('/api/charities').then((response) => {
				 this.items=response.data;
				
				});
			},
		
		
		 onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
		
              submit(e){
			   let data = this.create_ads;
                axios.post('/api/create_ads',{image: this.image, data}).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/my_ads');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
			
        }
    }
	
</script>


						 