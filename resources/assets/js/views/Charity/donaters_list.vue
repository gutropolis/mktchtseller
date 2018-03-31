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
								 <th>Product Name</th>
                                 <th>Seller</th>
                                 <th>Charity</th>
								 <th>Units</th>
                                 <th>Certify</th>
								 <th>Status</th>
                                 <th>Change Status</th>
                              </tr>
                              <tr v-for="(item,index) in items">
                                 <td>{{index+1}}</td>
								  <td>{{item.product_name}}</td>
                                 <td>{{item.seller}}</td>
								 <td>{{item.charity_organisation}}</td>
                                 <td>{{item.units}}</td>
                                
                                 <td>
                                    <button v-if="item.is_certify==0" class="btn btn-danger btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as Incomplete"><i class="fa fa-times"></i></button>
                                    <button v-if="item.is_certify==1" class="btn btn-success btn-sm" @click.prevent="toggleTaskStatus(item.id)" data-toggle="tooltip" title="Mark as Complete"><i class="fa fa-check"></i></button>
                                 </td>
								 <td v-if="item.status== 0">Pending</td>
								 <td v-if="item.status== 1">Accept</td>
								 <td v-if="item.status== 2">Decline</td>
								 
                                 <td>
								 <router-link :to="{name: 'change_status', params: { id: item.id }}">
								Click Here
								 </router-link>
                                 </td>
                              </tr>
                           </table>
						   <infinite-loading @infinite="infiniteHandler"></infinite-loading>
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
   import InfiniteLoading from 'vue-infinite-loading';
    import helper from '../../services/helper'
    import AppSidebar from '../pages/users/sidebar.vue' 
       export default {
           components: {
              AppSidebar ,InfiniteLoading
           },
   
   
           data() {
   		
               return {
			   name:{},
					item:
					{
						status: '',
						},
   			
   			items:{},
               image:{},        
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
   			axios.post('api/status/'+id,this.item).then(response=>{
   			toastr['success']("Success");
   			
   			
   			});
   		
   		
   		},infiniteHandler($state) {
      setTimeout(() => {
        const temp = [];
        for (let i = this.items.length + 1; i <= this.items.length + 4; i++) {
          temp.push(i);
        }
        this.items = this.items.concat(temp);
        $state.loaded();
      }, 90000);
    },
	
   		fetchItems()
   			{
			
   			axios.get('api/donaters_list').then(response=>{
   			
   			this.items=response.data.data1;
			this.image=response.data.data2
   			
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