<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Purchase A MemberShip</h3>
                     </div>
                     <div class="chat_frame">
                        <div class="users_messages user_active">
                           <div class="users_messages--users_area user_active--area">
                              <div>
                                 <div  class="row membership_content">
                                    <div class="col-md-3" v-for="pack in packs">
                                       <div class="membership_content--box">
                                          <h6>{{pack.package_name}}</h6>
										  <div  v-if="active =='1' ">
										 
                                          <span  v-if="pack.id==subscription.package_id">(Your Plan Is Active Now) </span>
										  </div>
                                          <div class="membership_content--box--heading">
                                             <h3><span>$</span>{{pack.amount}}</h3>
                                          </div>
                                          <article>
                                             <p>Credit Pack Of {{pack.credit_score}} For </p>
                                             <ul>
                                                <li>1 theme included.</li>
                                                <li>1 year of theme updates & support.</li>
                                                <li>20% off future purchases.</li>
                                             </ul>
                                          </article>
										 
                                          <button v-if="active =='1' || count != '0'" disabled class="btn btn-success" style="margin-bottom:10px;">Subscribe</button>
                                          <button class="btn btn-success" v-else @click="subscribe(pack.id)" style="margin-bottom:10px;">Subscribe</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
</template>
<script>
   import AppSidebar from '../users/sidebar.vue'
   import Vue from 'vue'
    Vue.use(require('vue-moment'));
      export default {
      components: {
               AppSidebar 
          },
      data() {
              return {
			  count:{},
				   active:{},
				   stripeEmail: '',
				   stripeToken: '',
				   status: false,
				   packs:[],
				   plan_id:'',
				   subscription:[],
				   amount:'',
                     }
          },
		  
    	created: function()
                 {
					//this.fetchactivepack();
					this.fetchcredit();
					this.fetchItem();
   	
	this.stripe = StripeCheckout.configure({
                key: 'pk_test_aPA6GkIugbRHoAMNVzlQoHFl',
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
				amount: this.amount,
                panelLabel: "Subscribe For",
                email: this.getAuthUser('email'),
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = 'singla.nikhil4@gmail.com';
					this.amount = this.amount,
                   
				   axios.post('/api/subscriptions', this.$data)				
                        .then(
                            response => alert('Complete! Thanks for your payment!'),
                            response => this.status = response.body.status,
								
                        )
						location.reload();
                }
				
            });
     			 	
             },
    
          mounted(){
          },
       
       methods: {
			subscribe(id) {
					axios.post('/api/selected_plan/'+id).then(response=>
					{
					this.selected_pack=response.data;
					this.amount=this.selected_pack.amount;
					this.plan_id=response.data.id;
					 this.stripe.open({         
								name:this.selected_pack.package_name,
								zipCode: true,
								amount: this.selected_pack.amount * 100,
								});
				
   	});
   
               
            },
   
   fetchcredit()
   {
   axios.get('/api/get_credit').then(response=>
   {
   this.subscription=response.data;
   this.count=response.data.id;
	this.count=response.data.length;
   this.active=response.data.status;
   	
   })
   },
  
   fetchItem()
   	{
   		axios.get('/api/packs').then(response=>{
   		this.packs=response.data;
   		console.log(this.activity);
   		}).catch(error=>{
   	toastr['error'](error.response.data.message);
             });
                 },
        getAuthUserFullName(){
                   return this.$store.getters.getAuthUserFullName;
               },
               getAuthUser(name){
                   return this.$store.getters.getAuthUser(name);
               },
       
       },
          computed: {
               getAvatar(){
                   return '/images/user/'+this.getAuthUser('avatar');
               }
           }
   
              }
        
          
      
</script>