<template>
<div id="main-wrapper">
<app-navbar></app-navbar>
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>

            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--head">
                        
                       
                            
                      <h3>List of the Product</h3> 
	
						
			 <div class="panel-body">
                <div class="table-responsive">
					
						<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">			  
                    
						<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Description</th>
						<th>Asin_url</th>
						<th>Images</th>
						<th>Reviews</th>
						<th>Created_at</th>
						<th>Action</th>
					 </tr>
					 <tr v-for="item in items">
					 <td>{{item.id}}</td>
					 <td>{{item.title}}</td>
					 <td>{{item.description}}</td>
					 <td>{{item.asin_url}}</td>
					 <td>{{item.images}}</td>
					 <td>{{item.reviews}}</td>
					 <td>{{item.created_at}}</td>
					 <td><router-link :to="{name: 'edit_product', params: { id: item.id }}" class="btn btn-success" >Edit</router-link> <button class="btn btn-danger " @click.prevent="deleteTask(item)" data-toggle="tooltip" title="Delete task">Delete</button></td>
					 </tr>
					 </table>
			
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


import AppNavbar from '../users/navbar.vue' 
 import AppSidebar from '../users/sidebar.vue'
 export default {
 components: {
            AppNavbar,  AppSidebar 
        },

        data() {
            return {
              loaded: false,
			  items: []
            }
        },
       
        
        mounted(){
        },
		 created: function()
        {
            this.fetchItems();
        },
        methods: {
		
			deleteTask(item){
                axios.delete('/api/task/'+item.id).then(response => {
                    toastr['success'](response.data.message);
					this.loaded = true;
					this.fetchItems();
                  
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
		 
	 fetchItems()
		 {
              axios.get('/api/product_list').then((response) => {
                 this.items=response.data;
					
              }) 
			  
            },
        }
    }
</script>