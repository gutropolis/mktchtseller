<template>
   <div id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--outer">
                     <div class="dashboard__content--description">
                        <hr>
                        <h3 class="box-title m-b-20">Add Product</h3>
                        <form class="form-horizontal form-material" id="productform" @submit.prevent="submit1">
                           <div class="form-group ">
                              <label class="login__element--box--label">ASIN</label>
                              <input type="text" name="keywords" class="login__element--box--input"  placeholder="ASIN" v-model="productform.keywords">
                           </div>
                           <div class="form-group text-center">
                              <input type="Submit" placeholder="" value="Search" class="btn btn-bg-orange login__element--box--button">
                           </div>
                        </form>
                        <form class="form-horizontal form-material" id="items" @submit.prevent="submit">
                           <div class="form-group ">
                              <label class="login__element--box--label">Title</label>
                              <input type="text" name="title" class="login__element--box--input"  placeholder="Title" v-model="items.name">
                           </div>
                           <input type="hidden" name="organisation_id" v-model="items.organisation_id"   class="login__element--box--input" />
                           <div class="form-group ">
                              <label class="login__element--box--label">ASIN</label>
                              <input type="text" name="asin" class="login__element--box--input"   placeholder="ASIN" v-model="items.ASIN">
                           </div>
						 
                           <div class="form-group">
                              <label class="login__element--box--label">Description</label>
                              <textarea  type="text" v-html="items.bulletPoints" v-model="items.bulletPoints"  rows="7" placeholder="BulletPoints" class="login__element--box--input"></textarea>
                           
                           </div>
                           <div class="form-group ">
                              <label class="login__element--box--label">Image</label>
                              <input type="hidden" name="image" class="login__element--box--input" placeholder="image" v-model="items.image">
							
							<img v-bind:src="items.image"  height="100px" width="50px">
                           </div>
						   
                           <div class="form-group ">
                              <label class="login__element--box--label">How Many Units do you want to donate?</label>
                              <input type="text" name="units" class="login__element--box--input"  placeholder="units" v-model="items.units">
                           </div>
						   <div class="form-group ">
                              <label class="login__element--box--label">Tags</label>
                              <input type="text" name="units" class="login__element--box--input"  placeholder="tags" v-model="items.tags">
                           </div>
                           <div class="form-group text-center">
                              <input type="Submit" placeholder="" value="Save" class="btn btn-bg-orange login__element--box--button">
                           </div>
                        </form>
						 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</template>
<script>
   import AppSidebar from '../users/sidebar.vue'
   export default {
    components: {
              AppSidebar 
          },
          data() {
              return {
   				items:[],
   					productform:{
   					 keywords: '',
   					},
   			bulletpoints:[]
                 
          }
      },
          
          mounted(){
          },
          methods: {
		  
   	
   		
              submit1(e){
			   const vm = this;
                  axios.post('/api/product/search',this.productform).then(response =>  {
                     
					 this.items=response.data; 
					
					 console.log(this.items);
					 console.log(this.items.bulletPoints);
					  console.log(this.items.bulletPoints[0]);
					  console.log(this.items.bulletPoints[1]);
					  console.log(this.items.bulletPoints[2]);
					  console.log(this.items.bulletPoints[3]);
					   
					   this.bulletpoints=this.items.bulletPoints;
					    let listBullet=[];
					  let txtBullet='<ul>';
					   $.each(response.data.bulletPoints, function(value, key) {
						 listBullet.push(key);
						  txtBullet=txtBullet+'<li>'+key+'</li>';
					   });
					   
					     txtBullet=txtBullet+'</ul>';
						 console.log(txtBullet);
					   console.log(listBullet);
					   
						vm.items.bulletPoints=txtBullet;
					 
					 
					
					  
					//	this.items.push();
                      this.$router.push('/product');
                  }).catch(error => {
                     // toastr['error'](error.response.data.message);
                  });
              },
   		 submit(e){
                  axios.post('/api/gs_seller_product',this.items).then(response =>  {
                      toastr['success'](response.data.message);
                      this.$router.push('/product_list');
                  }).catch(error => {
				      if(error.response.data){
						toastr['error'](error.response.data.message);
					  }
                  });
              },
   		   
          }
      }
</script>