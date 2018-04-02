<template>
<div>
 <section class="page__head">
		<div class="container">
			<div class="page__head--content">
				<h2 class="page__head--content--heading">Charity listing</h2>
				<router-link to="/"><a href="#" class="page__head--content--menu">Home </a> ></router-link>
				<a href="#" class="page__head--content--menu">Charityfba Post</a>
				
			</div>
		</div>
   </section>
   <section class="equal charity__element">
	<div class="container">
		
		<div class="row">
			<div class="col-md-3">
				<div class="charity__element--block">
					<h5 class="charity__element--block--heading">Search Charity Posts</h5>
					<div class="charity__element--block--content">
			      <form  id="searchform" @submit.prevent="submit">						
						
						
						
						        
						
						<div class="form-group charity__element--block--content--box">
							<label class="charity__element--block--content--box--label">Category</label>
							 <select name="searchcategory"  v-model="searchform.searchcategory" class="login__element--box--input">
							 <option value="select"> Select Category ...</option>
							 
								<option v-for="charity in charity_type"  v-bind:value="charity.id">{{charity.title}}</option>
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
			
							  
				
					
					
    
	<div v-for="item in items" class="charity_detail_row">
			
				<div class="charity__listing row">
						<figure class="charity__listing--figure  col-md-3">
						<img :src="'/images/charity/'+ item.images" class="charity__listing--figure--image">
						</figure>	
						
						
						<div class="col-md-9 charity__listing--content">
							<div class="charity__listing--content--icon"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></div>
							
							
							
							
							<div class="charity__listing--content--box">
							
							
													 
								<router-link :to="{name: 'charity_details', params: { id: item.id }}" ><h4 class="charity__listing--content--box--heading">{{item.title}}</h4></router-link>
								<h6 class="charity__listing--content--box--subheading">{{item.keyword}}</h6>
								<p class="charity__listing--content--box--pera">{{item.description}}</p>
							</div>
							<div class="charity__listing--content--address row">
								<div class="charity__listing--content--address--location col-md-12 "><p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location:</span> {{ item.location }}</p></div>
								<div class="charity__listing--content--address--location col-md-12 "><p><i class="fa fa-briefcase" aria-hidden="true"></i><span>Category:</span> {{item.category}}</p></div>
							
								
							</div>
								
						</div>	
					
				</div>
				 </div>
	
	
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
			searchform: {  
                    searchlocation: '',
					searchcategory: 'select',
					
                },
			items:[],
			
			charity_type: '',

                
            }
        },
		
		created: function()
        {
            this.fetchItems();
			this.fetchItem();
        },
       
        
        mounted(){
        },
        methods: {
		
            submit(e){
			this.items=[];
			//this.page=[];
                axios.post('/api/search', this.searchform).then(response =>  {
                    toastr['success']("Seach Completed");
					this.items = response.data;
					//this.page=response.data.last_page;
                    this.$router.push('/charityfba');
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
      }, 60000);
    },
			 fetchItems()
            {
			
              axios.get('/api/charities').then(response =>  {
					
                  this.items = response.data;
				  //this.page=response.data.data;
				  
              });
            },
			 fetchItem()
            {
			
              axios.get('/api/charity_type').then(response =>  {
					
                  this.charity_type = response.data;
				  //this.page=response.data.data;
				  
              });
            },
			
			}
			}
</script>

