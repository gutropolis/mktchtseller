<template>

<div  id="main-wrapper">
		<app-navbar></app-navbar>
			
	<section class=" my__account">
        <div class="row">
			<app-sidebar></app-sidebar>
			  <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
				 <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Seller List</h3>
                        
                    </div>
					<div>
					<div v-if="!loaded">
            <h3 class="text-center">Loading...</h3>
            </div>
			 <div class="panel-body">
                <div class="table-responsive">
					 <div v-if="loaded">
						<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
						
						<tr>
						<th>ID</th><th>TITLE</th><th>DESCRIPTION</th><th>LOCATION</th><th>ACTION</th>
						</tr>
						<tr v-for="item in items">
						<td>{{item.id}}</td>
						<td>{{item.title}}</td>
						<td>{{item.description}}</td>
						<td>{{item.location}}</td>
						<td><router-link :to="{name: 'edit_seller', params: { id: item.id }}" class="btn btn-success" >Edit</router-link> <button class="btn btn-danger" v-on:click="deleteItem(item.id)">Delete</button></td>
					
						</tr>
					
						</table>
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
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>

<script>

import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
    export default {
        components: {
            AppNavbar,  AppSidebar 
        },


        data() {
		
            return {
			items:[],
            loaded: false,
                    
                }
            },
			
			created: function()
        {
            this.fetchItems();
        },
        mounted(){
        },
        methods: {
            
            
			fetchItems()
			{
			axios.get('api/seller_list').then(response=>{
			
			this.items=response.data;
			 this.loaded = true;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			 deleteItem(id)
            {
               axios.delete('/api/seller_list/'+id).then(response => {
                    toastr['success'](response.data.message);
                    this.fetchItems();
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
			}
        
		
    }
</script>