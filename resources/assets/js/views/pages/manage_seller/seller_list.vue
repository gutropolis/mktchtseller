<template>

<div  id="main-wrapper">
		
			
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
						<table id="example" class="table table-striped table-bordered table-box" width="100%" cellspacing="0">
						
						<tr>
						<th>ID</th><th>TITLE</th><th>DESCRIPTION</th><th>LOCATION</th><th>ACTION</th>
						</tr>
						<tr v-for="item in items">
						<td>{{item.id}}</td>
						<td>{{item.title}}</td>
						<td>{{item.description}}</td>
						<td>{{item.location}}</td>
						<td><router-link :to="{name: 'edit_seller', params: { id: item.id }}" class="table-icon" ><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="485.219px" height="485.22px" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;"
	 xml:space="preserve">
<g>
	<path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897
		C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436
		c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44
		c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421
		c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z
		 M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919
		c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703
		c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986
		C147.097,447.637,146.36,447.193,145.734,446.572z"/>
</g>

</svg></router-link> <b-link class="table-icon" v-on:click="deleteItem(item.id)"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="774.266px" height="774.266px" viewBox="0 0 774.266 774.266" style="enable-background:new 0 0 774.266 774.266;"
	 xml:space="preserve">
	<g>
		<path d="M640.35,91.169H536.971V23.991C536.971,10.469,526.064,0,512.543,0c-1.312,0-2.187,0.438-2.614,0.875
			C509.491,0.438,508.616,0,508.179,0H265.212h-1.74h-1.75c-13.521,0-23.99,10.469-23.99,23.991v67.179H133.916
			c-29.667,0-52.783,23.116-52.783,52.783v38.387v47.981h45.803v491.6c0,29.668,22.679,52.346,52.346,52.346h415.703
			c29.667,0,52.782-22.678,52.782-52.346v-491.6h45.366v-47.981v-38.387C693.133,114.286,670.008,91.169,640.35,91.169z
			 M285.713,47.981h202.84v43.188h-202.84V47.981z M599.349,721.922c0,3.061-1.312,4.363-4.364,4.363H179.282
			c-3.052,0-4.364-1.303-4.364-4.363V230.32h424.431V721.922z M644.715,182.339H129.551v-38.387c0-3.053,1.312-4.802,4.364-4.802
			H640.35c3.053,0,4.365,1.749,4.365,4.802V182.339z"/>
		<rect x="475.031" y="286.593" width="48.418" height="396.942"/>
		<rect x="363.361" y="286.593" width="48.418" height="396.942"/>
		<rect x="251.69" y="286.593" width="48.418" height="396.942"/>
	</g>
</svg></b-link></td>
					
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


 import AppSidebar from '../users/sidebar.vue'
    export default {
        components: {
             AppSidebar 
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