<template>
	<!-- header element start -->
    <header class="header_element">
        <nav class="navbar navbar-toggleable-md navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse main-nav" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                             <router-link to="/" class="nav-link" href="#">Home  <span class="sr-only">(current)</span></router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Charityfab Post</a>
                        </li>
						 <li class="nav-item">
                             <router-link to="/sellerfab" class="nav-link">Sellerfab Us </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/contact" class="nav-link">Contact Us </router-link>
                        </li>
                    </ul>
                    <div class=" my-2 my-lg-0 ">
                        <router-link to="/register" class="btn join_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Join Us </router-link>
                        <router-link to="/login" class="btn sign_btn"><img src="images/sign-arrow.png">Sign In </router-link>
						
						
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- header element End -->
</template>

<script>
    export default {
        mounted() {
        }
    }
</script>