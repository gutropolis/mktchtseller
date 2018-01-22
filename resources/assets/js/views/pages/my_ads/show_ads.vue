 <template>
<div>
<app-navbar></app-navbar>
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
 <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
                            <hr>
                            
                      <h3>List of the Ads</h3>     
                     <table border="1">
						<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Description</th>
						<th>Images</th>
						<th>Location</th>
						<th>Created_at</th>
						<th>Action</th>
					 </tr>
					 <tr v-for="item in items">
					 <td>{{item.id}}</td>
					 <td>{{item.title}}</td>
					 <td>{{item.description}}</td>
					 <td>{{item.images}}</td>
					 <td>{{item.location}}</td>
					 <td>{{item.created_at}}</td>
					 <td> <router-link :to="{name: 'edit_ads', params: { id: item.id }}" class="btn btn-primary" >Edit</router-link> <button class="btn btn-danger btn-sm" @click.prevent="deleteTask(item)" data-toggle="tooltip" title="Delete task">Delete</button></td>
					 </tr>
					 </table>
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
                axios.delete('/api/get_ad/'+item.id).then(response => {
                    toastr['success'](response.data.message);
					this.fetchItems();
                    
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
               fetchItems()
		 {
              axios.get('/api/get_ad').then((response) => {
                 this.items=response.data;
					
              }) 
			  
            },
			
        }
    }
	
</script>


						 

</script>
