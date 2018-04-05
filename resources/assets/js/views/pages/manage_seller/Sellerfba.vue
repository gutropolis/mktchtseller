<template>
<div>
 <section class="page__head">
 
		<div class="container">
			
		</div>
   </section>
   <section class="equal charity__element">
	<div class="container">
		
		<div class="row">
			<div class="col-md-3">
				<div class="charity__element--block">
					<h5 class="charity__element--block--heading">Search Seller Posts</h5>
					<div class="charity__element--block--content">
					<form id="sellersearch"  @submit.prevent="submit">						
						
						<div class="form-group charity__element--block--content--box">
							<label class="charity__element--block--content--box--label">Products Category</label>
							 <select name="searchcategory"  v-model="sellersearch.searchcategory" class="login__element--box--input">
							 <option value="select"> Select ...</option>
							   <option  v-for= "cat in category"   v-bind:value="cat.id" >{{cat.title}}</option>
								
								</select>
							
			
						</div>
						
						
						
						<div class="form-group charity_element--block--content--box">							
							<input type="submit" value="SEARCH" class="charity__element--block--content--box--input btn btn-bg-orange">
						</div>
						
					</form>
					</div>
					</div>
					<div class="helping__element">
						<div class="helping__element--block">
						<h5 class="helping__element--block--heading">Helping Center</h5>
						</div>
					<p class="helping__element--pera">All the Lorem Ipsum generat on the Internet tend to repeat predefined chunks as necesa.</p>
					<h3 class="helping__element--heading">+90 777 333 11 22</h3>
					<h5 class="helping__element--subhead">support@supportcenter.com</h5>
					<p class="helping__element--btn"><a href="#" class="btn btn-bg-orange">Support Center</a> </p>
					</div>
				</div>
			
			<div class="col-md-9">
			
				 <tr v-for="item in items" class="charity_detail_row">

                 
                  
                   
                
				<div class="charity__listing row">
				
						<figure class="charity__listing--figure col-md-3">
							<img  class="charity__listing--figure--image" v-bind:src="item.images">
							
						</figure>	
						
						<div class="col-md-9 charity__listing--content">	
							
							
							<div class="charity__listing--content--box">
												 
								<router-link :to="{name: 'seller_details', params: { id: item.id }}" ><h4 class="charity__listing--content--box--heading">{{item.title}}</h4></router-link>
								<h6 class="charity__listing--content--box--subheading">Contrary to popular belief, Lorem Ipsum.</h6>
								<p class="charity__listing--content--box--pera"><span v-html="item.description"></span></p>
							</div>
							<div class="charity__listing--content--address row">
								<div class="charity__listing--content--address--location col-md-4"><p><i class="fa fa-briefcase" aria-hidden="true"></i> <span>ASIN: </span> {{item.asin_url}}</p></div>
								<div class="charity__listing--content--address--location col-md-2 "><p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Unit:</span> {{item.units}}</p></div>
								<div class="charity__listing--content--address--location col-md-3 "><p><a href="#" class="btn btn-bg-orange btn-donate">Request Units</a></p></div>
							</div>
							
</div>						
				</div>
				
				</tr>
				
			<infinite-loading @infinite="infiniteHandler"></infinite-loading>
		</div>
		
		</div>
	</div>
   </section>
<section>
	<div class="container">
	</div>
</section>
 </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
export default {
	 components: {
    InfiniteLoading,
  },
  
        data() {
		
            return {
			category:{},
			items:[],
			
                sellersearch: { 
				searchcategory:'select'			
                    
                }
            }
        },
		
		created: function()
        {
		this.fetchCategory();
            this.fetchItems();
        },
       
        
        mounted(){
        },
        methods: {
		
            submit(e){
			this.items=[];
			//this.page=[];
                axios.post('/api/productsearch', this.sellersearch).then(response =>  {
                    toastr['success']("Search Completed");
					this.items = response.data;
				
                    this.$router.push('/sellerfba');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			 infiniteHandler($state) {
      setTimeout(() => {
        const temp = [];
        for (let i = this.items.length + 1; i <= this.items.length + 4; i++) {
          temp.push(i);
        }
        this.items = this.items.concat(temp);
        $state.loaded();
      }, 90000);
    },
	 fetchCategory()
					{
					axios.get('api/product_category').then(response=>{
					
					this.category=response.data;
					
					
					}).catch(error=>{
					toastr['error'](error.response.data.message);
					});
					},
			 fetchItems()
            {
			
              axios.get('/api/productsearch').then(response =>  {
					
                  this.items = response.data;
				
				  
              });
            }
			
			}
			}
</script>

