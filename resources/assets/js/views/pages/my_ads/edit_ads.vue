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
                                 <label class="login__element--box--label">Organisation</label>
                                 <select name="charity_organisation" v-model="create_ads.charity_organisation" class="login__element--box--input">
                                    <option value="select" >Select .. </option>
                                    <option v-for="item in items"  v-bind:value="item.id" >{{item.title}}</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label class="login__element--box--label">Title</label>
                                 <input type="text" name="title" v-model="create_ads.title"  v-validate="'required'" class="login__element--box--input">
								 <i v-show="errors.has('title')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
                              </div>
                              <div class="form-group">
                                 <label class="login__element--box--label">What types of items is your charity seeking?</label>
                                 <textarea  type="text" name="description" v-model="create_ads.description"  v-validate="'required'" rows="5"  class="login__element--box--input"></textarea>
								 <i v-show="errors.has('description')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('description')" class="help is-danger">{{ errors.first('description') }}</span>
                              </div>
                             <!-- <div class="form-group">
                                 <label class="login__element--box--label">Image</label>
                                 <input type="file" name="image"  class="login__element--box--input">
                              </div>-->
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
   			items:[],
   			charity_organisation:{},
                  create_ads: {},
   			charity:{},
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
   			axios.get('/api/charity_name').then((response) => {
   			 this.items=response.data;
   			
   			});
   		},
   	fetchItems(){
                  axios.get('/api/charityads/'+this.$route.params.id).then(response=>{
                      this.create_ads = response.data.data1;
					
   				this.charity = response.data.data2;
                  }).catch(error=>{
   		toastr['error'](error.response.data.message);
   		});
   		},
                update(){
				 this.$validator.validateAll().then((result) => {
			  if(result)
			  {
				
                  axios.post('/api/charityads/'+this.$route.params.id,this.create_ads).then(response =>  {
                      toastr['success'](response.data.message);
                      this.$router.push('/my_ads');
                  }).catch(error => {
                      toastr['error'](error.response.data.message);
                  });
				   
				}
				})
              },
   		
          }
      }
   
</script>