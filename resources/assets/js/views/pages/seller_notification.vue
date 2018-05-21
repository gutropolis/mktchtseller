<template>
<div>
 <div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
	
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                    <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Request By Charity</h3>
                       
                    </div>
					<div class="donation_top_tab">
                  <b-tabs class="">
                     <b-tab title="Pending" active>
                        <div class="">
                           <div class="panel-body">
                              <div class="table-responsive">
                    <div class="dashboard__content--outer clearfix" >
                        <div class="notification__element clearfix">
                            <div class="notification__element-bottom">
                               
                                
                            </div>
                            <div class="notification__element--view" v-for="item in items" >
                              
                                <div class="notification__element--listing">
                                    <figure class="notification__element--listing--figure" >
                                       <img  v-bind:src="item.images" class="notification__element--listing--figure--image">
                                    </figure>
									
                                    <div   class="notification__element--listing--content"><h4>{{item.title}}</h4>

                                        
                                        <p><strong>Request By:- </strong> <router-link :to="{name: 'charity_details', params: { id: item.charity_id }}" > {{item.charity}}</router-link> </p><p><strong>Requested Units:- </strong> {{item.units}}</p>
                                    </div>
                                </div>
                                <div class="notification__element--view--button">
                                   
									 <button class="btn notification__element--view--button--content text-White  green" v-on:click="update(item.id)" >Accept</button>
									 <button class="btn notification__element--view--button--content  text-White red" v-on:click="reject(item.id)">Reject</button>
									   <router-link :to="{name: 'charity_details', params: { id: item.charity_id }}" ><button class="btn notification__element--view--button--content text-White green">Message Charity</button></router-link>
                                </div>
                            </div>
                            
                            

                        </div>
                    </div>
                </div>
            </div>
			<div v-if="items.length === 0">
								 
									<h4  style="text-align:center;" >No Result Found Here</h4>
									
										</div>
			</div>
			 </b-tab>
                     <b-tab title="Accepted" >
                        <div>
						 <div class="panel-body">
                              <div class="table-responsive">
                                  <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           
                            <div class="notification__element--view" v-for="item in accept_items">
                               
                                <div class="notification__element--listing" >
                                    <figure class="notification__element--listing--figure">
                                       <a v-bind:href="item.description_url"> <img  v-bind:src="item.images" class="notification__element--listing--figure--image"></a>
                                    </figure>
                                    <div class="notification__element--listing--content">
                                      <h4><a v-bind:href="item.description_url">{{item.title}}</a></h4></a>
                                        
                                    <p> Requested By:- {{item.charity}} </p><p>Requested Units :- {{ item.units }}</p>
									<b>Posted On:- {{item.created_at |moment("dddd,MMM-Do-YYYY")}}</b>
                                    </div>
                                </div>
                               
                            </div>
                          
                        </div>
                    </div>
								 
                              </div>
                           </div>
						    <div v-if="accept_items.length === 0">
								 
									<h4  style="text-align:center;" >No Result Found Here</h4>
									
										</div>
                        </div>
                     </b-tab>
                     <b-tab title="Declined">
                       <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                  <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           
                            <div class="notification__element--view" v-for="item in decline_items">
                               
                                <div  class="notification__element--listing" >
                                    <figure class="notification__element--listing--figure">
                                       <a v-bind:href="item.description_url"> <img  v-bind:src="item.images" class="notification__element--listing--figure--image"></a>
                                    </figure>
                                    <div class="notification__element--listing--content">
                                      <h4><a v-bind:href="item.description_url">{{item.title}}</a></h4></a>
                                        
                                    <p> Requested By:- {{item.charity}} </p>
									<b>Posted On:- {{item.created_at |moment("dddd,MMM-Do-YYYY")}}</b>
                                    </div>
                                </div>
                               
                            </div>
                          
                        </div>
                    </div>
								 
                              </div>
                           </div>
						   <div v-if="decline_items.length === 0">
								 
									<h4  style="text-align:center;" >No Result Found</h4>
									
										</div>
                        </div>
                     </b-tab>
					
					  </b-tab>
					 
                  </b-tabs>
               </div>
               </div>
            </div>
			
        </div>
    </section>

</div>
</div>
</template>
<script>
import AppNavbar from './users/navbar.vue' 
 import AppSidebar from './users/sidebar.vue'
 import Vue from 'vue'
    export default {
    components: {
            AppNavbar,  AppSidebar 
        },
		data() {
            return {
				items:{},
                 accept_items:{},
				 decline_items:{},
            }
        },
        mounted(){
        },
		 created(){
		 this.fetchItems();
		 
		 
		 },
		 methods: {
				fetchItems()
		 {
             axios.get('/api/request_charity').then((response) => {
                 this.items=response.data.data1;
				
				console.log(this.items.length);
				 this.accept_items=response.data.data2;
				 
				 this.decline_items=response.data.data3;
              }) 
			  
            },
			reject(id){
				axios.post('api/reject_request/'+id).then(response =>  {
                    toastr['success'](response.data.message);
                  this.fetchItems();
				  
                })
			 
			
			
			},
			update(id){
				axios.post('api/update_request/'+id).then(response =>  {
                    toastr['success'](response.data.message);
                    this.fetchItems();
                })
			 
			
			
			},
            },
			
        }
		
</script>