<template>
    <section id="wrapper">
       
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="savesellerform" @submit.prevent="submit">
                    <h3 class="box-title m-b-20">Add Seller</h3>
					<select name="business_type"  v-model="savesellerform.business_type">
					 <option value="">Select Business Type</option>
					 <option value="T.V.">Tv</option>
					 <option value="Fridge">Fridge</option>
					 </select>
						
					
					
					
                    <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="title"  placeholder="Title" v-model="savesellerform.title">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="description"  placeholder="Description" v-model="savesellerform.description">
                        </div>
                    </div>
                     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="location"  placeholder="Location" v-model="savesellerform.location">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="year_in_business"  placeholder="Year in business" v-model="savesellerform.year_in_business">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="date" name="start_up_year"  placeholder="Start up year" v-model="savesellerform.start_up_year">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="business_type"  placeholder="Business type" v-model="savesellerform.business_type">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <textarea name="address"  placeholder="Address" v-model="savesellerform.address"></textarea>
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="number" name="phone_number"  placeholder="Phone Number" v-model="savesellerform.phone_number">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="keyword"  placeholder="keyword" v-model="savesellerform.keyword">
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <textarea name="vision_statement"  placeholder="Vision" v-model="savesellerform.vision_statement"></textarea>
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <textarea name="mission_statement"  placeholder="Mission" v-model="savesellerform.mission_statement"></textarea>
                        </div>
                    </div>
     <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="number" name="tax_id"  placeholder="tax_id" v-model="savesellerform.tax_id">
                        </div>
                    </div>
					   

                    <div class="form-group text-center m-t-20">
                        <div class="col-sm-4">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-4 text-center">
                            <p>Already have an account? <router-link to="/login" class="text-info m-l-5"><b>Sign In</b></router-link></p>
                        </div>
                    </div>
                </form>
            </div>
            
          </div>
      

    </section>
</template>

<script>
 export default {
        data() {
            return {
                savesellerform: {
                    title: '',
                    description: '',
                   location: ''
                    
                }
            }
        },
       
        
        mounted(){
        },
        methods: {
            submit(e){
                axios.post('/api/gs_seller_organisation', this.savesellerform).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
        }
    }
</script>