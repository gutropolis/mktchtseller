<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Donaters List</h3>
                  </div>
                  <div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table id="example" class="table table-striped table-bordered table-box"" width="100%" cellspacing="0">
                              <tr>
                                 <th>ID</th>
                                 <th>Seller</th>
                                 <th>Donate Product</th>
                                 <th>Units</th>
                                 <th>Charity</th>
                                 <th>Certify</th>
                                 <th>Status</th>
                              </tr>
                              <tr v-for="item in items">
                                 <td>{{item.id}}</td>
                                 <td>{{item.seller}}</td>
                                 <td>{{item.product}}</td>
                                 <td>{{item.units}}</td>
                                 <td>{{item.charity_organisation}}</td>
                                 <td>
                                    <button v-if="item.is_certify==0" class="btn btn-danger btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as Incomplete"><i class="fa fa-times"></i></button>
                                    <button v-if="item.is_certify==1" class="btn btn-success btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as Complete"><i class="fa fa-check"></i></button>
                                 </td>
                                 <td>
                                 <!--  <b-dropdown id="ddown1" text="Pending" class="m-md-2">
                                    <b-dropdown-item>Pending</b-dropdown-item>
                                    <b-dropdown-item>In Progress</b-dropdown-item>
                                    <b-dropdown-item>Confirmed</b-dropdown-item>
                                  </b-dropdown> -->
                                    <select name="status" v-model="status" v-on:change="status(item.id)">
                                       <option value="pending" >
                                          Pending
                                       </option>
                                       <option value="in progress">In Progress</option>
                                       <option value="confirmed">Confirmed</option>
                                    </select>
                                 </td>
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
   
    import AppSidebar from '../pages/users/sidebar.vue' 
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
   			axios.get('api/donaters_list').then(response=>{
   			
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