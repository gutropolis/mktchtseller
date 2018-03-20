<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donation List</h3>
                  </div>
                  <div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                              <tr>
                                 <th>ID</th>
                                
                                 <th>Donate Product</th>
                                 <th>Units</th>
                                 <th>Charity</th>
                                 <th>Status</th>
								 <th>Created_On</th>
								 <th>Action</th>
                              </tr>
                              <tr v-for="item in items">
                                 <td>{{item.id}}</td>
                                 <td>{{item.product}}</td>
                                 <td>{{item.units}}</td>
                                 <td>{{item.charity_organisation}}</td>
                                 <td>{{item.status}}</td>
								 <td>{{item.created_at}}</td>
								 <td> <router-link :to="{name: 'edit_donation', params: { id: item.id }}" class="table-icon" >
                                          <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                                          </svg>
                                       </router-link></td>
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
   
    import AppSidebar from '../../pages/users/sidebar.vue' 
       export default {
           components: {
              AppSidebar 
           },
   
   
           data() {
   		
               return {
  
   			
   			items:[],
                       
                   }
               },
   			
   			created: function()
           {
               this.fetchItems();
           },
           mounted(){
           },
           methods: {
   		status(id){
   			axios.post('api/status/'+id,this.status).then(response=>{
   			toastr['success']("Success");
   			
   			
   			});
   		
   		
   		},
   		fetchItems()
   			{
   			axios.get('api/donation_list').then(response=>{
   			
   			this.items=response.data;
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   			});
   			},
               
               toggleTaskStatus(id){
                   axios.post('api/certify/'+id).then((response) => {
                       this.fetchItems();
                   });
               }
   			
   			}
   			
           
   		
       }
</script>