<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                           <h3 class="dashboard__content--head--heading">{{items.charity}}</h3>
                           <p>{{items.address}} {{items.postal_code}}</p>
                           <p class="text-center">{{items.website}}</p>
                        </div>
                        <div class="col-md-12">
						<div class=" signature_box">
                           <p><b>Description:- </b> {{items.description}}
                           </p>
							<p><b>Mission:- </b> {{items.mission_statement}}
						   </p>
							<p><b>Vision:- </b> {{items.vision_statement}}
						   </p>
						  
                        
							<div class="signature_content">
							
                           <VueSignaturePad class="signature_pad"   ref="signaturePad"/>

                           <button @click="submit">Submit</button>
                           <button @click="undo">Clear</button>
                           <div>All About {{items.charity}}</div>
						   </div>
						   </div>
                        </div>
                        <hr>
                        <div class="signature_box">
                          <h5>Donation By:</h5>
                           <p>This will the acknowledge reciept of deal of units of <b>{{items.units}} </b>units of  <b>{{items.product}}</b> donated to <b>{{items.charity}}</b> for use as date <b>{{items.created_at | moment("Do MMMM YYYY") }}</b></p>
                           <p>Doners  may deduct contributions only to the  extent the contribution are gifts,with no considerations recieved. </p>
                           <p>All About Seller  Tax I.D.:- <b>{{items.tax_id}}</b>.</p>
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
   import VueSignaturePad from 'vue-signature-pad'
   import Vue from 'vue'
   Vue.use(VueSignaturePad)
   import AppSidebar from '../pages/users/sidebar.vue' 
          export default {
              components: {
                 AppSidebar          },
      
      
              data() {
      		
                  return {
   			    name: 'MySignaturePad',
   			    items:{},
   				  
                      }
                  },
      			
      			created: function()
              {
					this. fetchdata();
              },
              mounted(){
              },
              methods: {
			  	 submit(){
					const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
					let data1=this.$route.params.id;
                   axios.post('/api/certify',{data1,data}).then((response) => {
				   toastr['success'](response.data.message);
                      this.$router.push('/donaters');
                   });
               },
			  
   			
			  fetchdata()
			  {
				axios.get('/api/certifydata/'+this.$route.params.id).then(response=>{
						this.items=response.data;
						console.log(this.items);
			  });
			  },
   		    undo() {
        this.$refs.signaturePad.undoSignature();
      },
   		  save() {
        const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
        console.log(isEmpty);
        console.log(data);
		console.log( this.$refs.signaturePad.saveSignature());
      }
      			
              
      		
          },
   	   }
</script>