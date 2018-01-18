<template>
<div align="center">

<div >
<table border="2px" cellpadding=4 height="200px" width="400px">
<tr>
<th  colspan="2" class="charity__listing--content--box--heading"> Seller Details is here</th>
</tr>
<tr>
<th>Title</th><td>{{items.title}}</td>
</tr>
<tr>
<th>Description</th><td>{{items.description}}</td>
</tr>
<tr>
<th>Location</th><td>{{items.location}}</td>
</tr>
<tr>
<th>Address</th><td>{{items.address}}</td>
</tr>
<tr>
<th>Year in business</th><td>{{items.year_in_business}}</td>
</tr>
<tr>
<th>Start up Year</th><td>{{items.start_up_year}}</td>
</tr>
<tr>
<th>Business Purpose</th><td>{{items.business_purpose}}</td>
</tr>
<tr>
<th>Phone Number</th><td>{{items.phone_number}}</td>
</tr>
<tr>
<th>Keyword</th><td>{{items.keyword}}</td>
</tr>
<tr>
<th>Charity Type</th><td>{{items.charity_type}}</td>
</tr>





</table>
</div>
</div>

</template>

<script>

export default {
	
  
        data() {
		
            return {
			items:{}
			

                  
				   
                    
                }
            },
       
		
		created: function()
        {
            this.fetchItems();
        },
       
        
        mounted(){
        },
        methods: {
		
			 fetchItems()
            {
			
             axios.get('api/seller_details/'+this.$route.params.id).then(response=>{
			
			this.items=response.data;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
				  
              });
            }
			
			}
			}
</script>

