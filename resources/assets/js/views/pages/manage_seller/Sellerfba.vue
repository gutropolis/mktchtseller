<template>
<div>
 <section class="page__head">
 
		<div class="container">
			<div class="page__head--content">
				<h2 class="page__head--content--heading">Product listing</h2>
				<router-link to="/"><a href="#" class="page__head--content--menu">Home </a> ></router-link>
				<a href="#" class="page__head--content--menu">SellerPost</a>
				
			</div>
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
							<label class="charity__element--block--content--box--label">Product Name</label>
							<input type="text" placeholder="Location Select" name="title" v-model="sellersearch.title" class="charity__element--block--content--box--input">
						</div>
						<div class="form-group charity_element--block--content--box">
							<label class="charity__element--block--content--box--label">Area Range</label>
							<div class="range-slider">
								<input class="range-slider__range" type="range" value="250" min="0" max="500" step="50">
								<span class="range-slider__value">0</span>
							</div>
						</div>
						<div class="form-group charity_element--block--content--box">
							<label class="charity__element--block--content--box--label">Seller / Organisation</label>
							<select class="charity__element--block--content--box--select">
								<option value="1">Organisation 1</option>
								<option value="1">Organisation 2</option>
								<option value="1">Organisation 3</option>
								<option value="1">Organisation 4</option>
								<option value="1">Organisation 5</option>
							</select>
							
						</div>
						<div class="form-group charity__element--block--content--box">
							<label class="charity__element--block--content--box--label">ASIS</label>
							<select class="charity__element--block--content--box--select">
								<option value="1">Organisation 1</option>
								<option value="1">Organisation 2</option>
								<option value="1">Organisation 3</option>
								<option value="1">Organisation 4</option>
								<option value="1">Organisation 5</option>
							</select>
						</div>
						<div class="form-group charity__element--block--content--box">
							<label class="charity__element--block--content--box--label">Units</label>
							<select class="charity__element--block--content--box--select">
								<option value="1">Organisation 1</option>
								<option value="1">Organisation 2</option>
								<option value="1">Organisation 3</option>
								<option value="1">Organisation 4</option>
								<option value="1">Organisation 5</option>
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
			
				 <tr v-for="item in items">

                 
                  
                   
                
				<div class="charity__listing row">
				
						<figure class="charity__listing--figure col-md-3">
							<img  class="charity__listing--figure--image" v-bind:src="item.images">
							
						</figure>	
						
						<div class="col-md-9 charity__listing--content">	
							<div class="charity__listing--content--icon"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></div>
							
							<div class="charity__listing--content--box">
												 
								<router-link :to="{name: 'seller_details', params: { id: item.id }}" ><h4 class="charity__listing--content--box--heading">{{item.title}}</h4></router-link>
								<h6 class="charity__listing--content--box--subheading">Contrary to popular belief, Lorem Ipsum.</h6>
								<p class="charity__listing--content--box--pera">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
							</div>
							<div class="charity__listing--content--address row">
								<div class="charity__listing--content--address--location col-md-4 "><p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Reviews:</span>{{item.reviews}}</p></div>
								<div class="charity__listing--content--address--location col-md-3 "><p><i class="fa fa-briefcase" aria-hidden="true"></i><span>ASIN:</span> {{item.asin_url}}</p></div>
								<div class="charity__listing--content--address--location col-md-2 "><p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Unit:</span> {{item.units}}</p></div>
								<div class="charity__listing--content--address--location col-md-3 "><p><a href="#" class="btn btn-bg-orange btn-donate">Donate</a></p></div>
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
                sellersearch: {},
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
		 
            submit(e){
			this.items=[];
                axios.post('/api/productsearch', this.sellersearch).then(response =>  {
                    toastr['success'](Search);
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
      }, 10000);
    },
			
			fetchItems()
			 {
             
              axios.get('/api/productsearch',this.sellersearch).then((response) => {
                 
				    this.items=response.data;
              });
            },
        }
    }
</script>