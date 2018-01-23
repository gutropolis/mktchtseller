<template>
<div id="main-wrapper">
<app-navbar></app-navbar>
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>

            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
                            <hr>
                            
                      <h3>List of the Product</h3> 
	<div v-if="!loaded">
            <h3 class="text-center">Loading...</h3>
            </div>
					 <div v-if="loaded">					  
                     <table border="1">
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
					 <td> <router-link :to="{name: 'edit_product', params: { id: item.id }}" class="btn btn-primary" >Edit</router-link> <button class="btn btn-danger btn-sm" @click.prevent="deleteTask(item)" data-toggle="tooltip" title="Delete task"><i class="fa fa-trash"></i></button></td>
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
<script>
import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
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
                    this.getTasks();
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