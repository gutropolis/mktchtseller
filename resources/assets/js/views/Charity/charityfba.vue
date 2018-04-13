<template>
<div>
 <section class="page__head">
		<div class="container">
			<div class="page__head--content">
				<h2 class="page__head--content--heading">Charity listing</h2>
				
				
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
							<label class="charity__element--block--content--box--label">Keyword</label>
							 <input type="text" name="keyword" placeholder="keyword" v-model="searchform.keyword" class="login__element--box--input">
							 
								
								
							
			
						</div>
						
						        
						
						<div class="form-group charity__element--block--content--box">
							<label class="charity__element--block--content--box--label">Charity Type</label>
							 <select name="searchcategory"  v-model="searchform.searchcategory" class="login__element--box--input">
							 <option value="" disabled hidden> Select Charity Type ...</option>
							   <option  v-for= "charity_cat in charity_category" v-if="charity_cat.parent_id==0"  v-bind:value="charity_cat.id" >{{charity_cat.title}}</option>
								
								</select>
							
			
						</div>
						
						<div v-if="searchform.searchcategory !='' "  class="form-group">
                              <label class="login__element--box--label">Select SubCategory</label>
                              <select name="charity_type"  v-model="searchform.charity_type" class="login__element--box--input">
                                 <option value="" disabled hidden >Select .. </option>
                                 <option  v-for="charity_cat in charity_category" v-if="charity_cat.parent_id==searchform.searchcategory"  v-bind:value="charity_cat.id">{{ charity_cat.title }}</option>
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
							
							<div class="charity__listing--content--box">
											 
								<router-link :to="{name: 'charity_details', params: { id: item.id }}" ><h4 class="charity__listing--content--box--heading">{{item.title}}</h4></router-link>
								<h6 class="charity__listing--content--box--subheading">{{item.keyword}}</h6>
								<p class="charity__listing--content--box--pera">{{item.description}}</p>
							</div>
							<div class="charity__listing--content--address row">
								<div class="charity__listing--content--address--location col-md-12 "><p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location:</span> {{ item.location }}</p></div>
								<div class="charity__listing--content--address--location col-md-12 "><p><i class="fa fa-briefcase" aria-hidden="true"></i><span>Purpose:</span> {{item.business_purpose}}</p></div>	
							</div>
								
						</div>	
					
				</div>
				 </div>

				 
	
	<infinite-loading @infinite="infiniteHandler">
	<span slot="no-more" >There is no more records!!</span>
	
	</infinite-loading>
	
  					
					
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
			
			searchform: {  
               keyword :'',  
			 	searchcategory: '',
				charity_type:'',
					
                },
			items:[],
			
			charity_category: [],
			charity_subcategory:[],
			  temp:[]
                
            }
        },
		
		created: function()
        {
            this.fetchItems();
			this.fetchItem();
			//this.fetchresult();
        },
       
        
        mounted(){
		   this.keywords = this.$route.query.keyword;
		   this.searchform.keyword= this.keywords ;
		    axios.post('/api/search', this.searchform).then(response =>  {
                  //  toastr['success']("Search Completed");

					this.items = response.data;
					
                   
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
			
			console.log(this.$route.query.keyword);
        },
        methods: {
		
            submit(e){
			   
			   this.fetchRecords();
            },
			fetchRecords(){
			this.items=[];
			//this.page=[];
                axios.post('/api/search', this.searchform).then(response =>  {
                   

					this.items = response.data;
					
                    this.$router.push('/charityfba');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
			
			},
		 
			 
	   infiniteHandler($state) {
						  axios.get('/api/search', {
							params: {
							  page: this.list.length / 20 + 1,
							},
						  }).then(({ data }) => {
							if (data.hits.length) {
							  this.list = this.list.concat(data.hits);
							  $state.loaded();
							  if (this.list.length / 20 === 10) {
								$state.complete();
							  }
							} else {
							  $state.complete();
							}
						  });
						 
			},
			 fetchItems()
            {
			
              axios.get('/api/charities').then(response =>  {
					
                  this.items = response.data.data1;
				  this.category=response.data.data2;
				  
              });
            },
			 fetchItem()
            {
			
              axios.get('/api/charity_type').then(response =>  {
					
                  this.charity_category = response.data.data1;
				    this.charity_subcategory = response.data.data2;
				  
              });
            },
			/*fetchresult(){
				axios.get('/api/searchform').then(response =>  {
					
                  this.items = response.data;
				   
				  
              });
			
			}*/
			
			}
			}
</script>

