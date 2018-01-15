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
    export default {
        components: {
            AppHeader,AppFooter 
        } 
    }
</script>