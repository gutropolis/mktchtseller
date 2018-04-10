<template>
    <div>
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
            }
        },
		 components: {
            AppHeader,AppFooter 
        }, 
        mounted() {
        	$('body').removeClass('fix-header fix-sidebar card-no-border');
            this.notification();
        },
        destroyed(){
        }
    }
</script>