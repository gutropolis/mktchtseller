<template> 
	<div id="main-wrapper">
		<app-header></app-header>
	
		<router-view></router-view>
		<app-footer></app-footer>
	</div>
</template>

<script>
 import AppHeader from './header.vue' 

 import AppFooter from './footer.vue'
  import helper from '../services/helper'
    export default {
	 methods : {
            notification(){
                toastr.options = {
                    "positionClass": "toast-top-right"
                };

                $('[data-toastr]').on('click',function(){
                    var type = $(this).data('toastr'),message = $(this).data('message'),title = $(this).data('title');
                    toastr[type](message, title);
                });
            },
			
            getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            },
        },
        components: {
            AppHeader,AppFooter 
        }, 
		 mounted() {
		if(!this.getAuthUser('email')){
                helper.authUser().then(response => {
                    this.$store.dispatch('setAuthUserDetail',{
                        first_name: response.user.first_name,
                        last_name: response.user.last_name,
                        email: response.user.email,
                        avatar:response.user.avatar,
						role:response.user.role,
                    });
                });
            }
			
    }
	}
</script>