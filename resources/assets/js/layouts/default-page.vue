<template> 
	<div id="main-wrapper">
		<Header></Header>
				<router-view></router-view>
			<Footer></Footer>
	</div>
</template>

<script>
 import Header from './header.vue' 
 import Footer from './footer.vue'
    export default {
        components: {
            Header,  Footer 
        } 
    }
</script>