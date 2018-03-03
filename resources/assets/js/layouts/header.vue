<template>
    <!-- header element start -->
    
    <header class="header_element">

        <nav class="navbar navbar-toggleable-md navbar-light bg-light navbar-expand-md">
    
            <div class="container">
    
                <router-link to="/" class="navbar-brand" href="#"><img src="images/logo.png"></router-link>
    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    
                  <span class="navbar-toggler-icon"></span>
    
                </button>
    
    
    
                <div class="collapse navbar-collapse main-nav" id="navbarSupportedContent">
    
                    <ul class="navbar-nav mr-auto main-nav-box">
    
                        <li class="nav-item active">
    
                            <router-link to="/" class="nav-link" href="#">Home <span class="sr-only">(current)</span></router-link>
    
                        </li>
    
                        <li class="nav-item">
    
                            <router-link to="/aboutus">
    
                                <a class="nav-link" href="#"> About</a></router-link>
    
                        </li>
    
                        <li class="nav-item">
    
                            <router-link to="/charityfba">
    
                                <a class="nav-link " href="#">Charity</a></router-link>
    
    
    
                        </li>
    
                        <li class="nav-item">
    
                            <router-link to="/sellerfba" class="nav-link">Seller</router-link>
    
                        </li>
    
                        <li class="nav-item">
    
                            <router-link to="/contact" class="nav-link">Contact Us </router-link>
							
                        </li>
    
                    </ul>
    
    
    
                    <div class=" my-2 my-lg-0 user_profile_dropdown">
    
							 <div v-if="loginCheck">




						<b-navbar-nav> 

                            <b-nav-item-dropdown right>
                                <!-- Using button-content slot -->
                                <template slot="button-content">
                                  <em>
                                    <div class="profile_notification_icon">
                                      
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 31.012 31.012" style="enable-background:new 0 0 31.012 31.012;" xml:space="preserve">
                                        <g>
                                            <path d="M28.512,26.529H2.5c-1.378,0-2.5-1.121-2.5-2.5V6.982c0-1.379,1.122-2.5,2.5-2.5h26.012c1.378,0,2.5,1.121,2.5,2.5v17.047
                                                C31.012,25.408,29.89,26.529,28.512,26.529z M2.5,5.482c-0.827,0-1.5,0.673-1.5,1.5v17.047c0,0.827,0.673,1.5,1.5,1.5h26.012
                                                c0.827,0,1.5-0.673,1.5-1.5V6.982c0-0.827-0.673-1.5-1.5-1.5H2.5z"/>
                                            <path d="M15.506,18.018c-0.665,0-1.33-0.221-1.836-0.662L0.891,6.219c-0.208-0.182-0.23-0.497-0.048-0.705
                                                c0.182-0.21,0.498-0.23,0.706-0.049l12.778,11.137c0.64,0.557,1.72,0.556,2.358,0L29.46,5.466c0.207-0.183,0.522-0.162,0.706,0.049
                                                c0.182,0.208,0.16,0.523-0.048,0.705L17.342,17.355C16.836,17.797,16.171,18.018,15.506,18.018z"/>
                                        </g>
                                        </svg>
                                        
                                     
                                      <span>3</span>
                                  </div>

                                  </em>
                                </template>
                                
                                 <div class="admin__list--box">
                                 <ul class="admin__lsit" id="dashboard-menu">
                                
    
                                </ul>
                            </div>
                              </b-nav-item-dropdown>


                        <b-nav-item-dropdown right>
                                <!-- Using button-content slot -->
                                <template slot="button-content">
                                  <em>
                                    <div class="profile_notification_icon">
                                      
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    
                                width="auto" height="auto" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                                
                               <g id="notifications">
    
                                   <path d="M255,510c28.05,0,51-22.95,51-51H204C204,487.05,226.95,510,255,510z M420.75,357V216.75
    
                                       c0-79.05-53.55-142.8-127.5-160.65V38.25C293.25,17.85,275.4,0,255,0c-20.4,0-38.25,17.85-38.25,38.25V56.1
    
                                       c-73.95,17.85-127.5,81.6-127.5,160.65V357l-51,51v25.5h433.5V408L420.75,357z"/>
                                </g>   
                           </svg>    
                                     
                                       <span>3</span>
                                      </div>

                                  </em>
                                </template>
                                
                                 <div class="admin__list--box">
                                 <ul class="admin__lsit" id="dashboard-menu">
                                <li class="admin__lsit--content--name"><div class="admin__lsit--content--notification"><img src="../../svg/notifications-button.svg" alt="user" class="profile-pic"></div> <h5>Notification</h5></li>
                                
                                    <li class="admin__lsit--content">
                                        <div class="notification">
                                            <figure class="notification__profile"><img src="../../images/profile.jpg"></figure>
                                            <div class="notification__content">
                                                <h6 class="notification__content--heading">Jim Gray</h6>
                                                <p class="notification__content--pera">Just see the my admin!</p>
                                                <p><span class="notification__content--time">9:30 AM</span>
                                                <span class="notification__content--ago">10 min ago</span></p>
                                            </div>
                                        </div>
                                       
                                    </li>
    
                                    <li class="admin__lsit--content">
    
                                        <div class="notification">
                                            <figure class="notification__profile"><img src="../../images/profile.jpg"></figure>
                                            <div class="notification__content">
                                                <h6 class="notification__content--heading">Jim Gray</h6>
                                                <p class="notification__content--pera">Just see the my admin!</p>
                                                <p><span class="notification__content--time">9:30 AM</span>
                                                <span class="notification__content--ago">10 min ago</span></p>
                                            </div>
                                        </div>
    
                                    </li>
    
                                    <li class="admin__lsit--content">
    
                                        <div class="notification">
                                            <figure class="notification__profile"><img src="../../images/profile.jpg"></figure>
                                            <div class="notification__content">
                                                <h6 class="notification__content--heading">Jim Gray</h6>
                                                <p class="notification__content--pera">Just see the my admin!</p>
                                                <p><span class="notification__content--time">9:30 AM</span>
                                                <span class="notification__content--ago">10 min ago</span></p>
                                            </div>
                                        </div>
    
                                    </li>
    
                                    <li class="admin__lsit--content">
        
                                       <div class="notification">
                                            <figure class="notification__profile"><img src="../../images/profile.jpg"></figure>
                                            <div class="notification__content">
                                                <h6 class="notification__content--heading">Jim Gray</h6>
                                                <p class="notification__content--pera">Just see the my admin!</p>
                                                <p><span class="notification__content--time">9:30 AM</span>
                                                <span class="notification__content--ago">10 min ago</span></p>
                                            </div>
                                        </div>
    
                                    </li>
    
                                </ul>
                            </div>
                              </b-nav-item-dropdown>


                              <b-nav-item-dropdown right>
                                <!-- Using button-content slot -->
                                <template slot="button-content">
                                  <em>
                                    <div class="admin__element">
                                      <figure class="admin__element--figure"><img :src="getAvatar" alt="user" class="profile-pic" />

                                      </figure>
                                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
    
                                <g>
    
                                  <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
    
                                </g>
    
                              </svg>
                                </div>
                                  </em>
                                </template>
                                 <div class="admin__list--box">
                                <ul class="admin__lsit" id="dashboard-menu">
    
                                    <li class="admin__lsit--content--name">
    
                                        <div class="admin__lsit--content--profile">
    
                                            <img :src="getAvatar" alt="user" class="profile-pic" />
    
                                        </div>
    
                                        <h5>{{getAuthUserFullName()}}</h5>  
                                    </li>
    
                                    <li class="admin__lsit--content">
    
                                        <div class="admin__lsit--content--detail">
    
                                            <router-link to = "my_account" class="admin__lsit--content--detail--link">
                                            <img src="../../svg/user.svg">
                                                My Account
                                                </router-link>
    
                                        </div>
    
                                    </li>
    
                                    <li class="admin__lsit--content">
    
                                        <div class="admin__lsit--content--detail">
    
                                            <router-link to="/edit_account"  class="admin__lsit--content--detail--link">
                                            <img src="../../svg/settings-gears.svg">
                                               Account Settings
    
                                           </router-link>
    
                                        </div>
    
                                    </li>
    
                                    <li class="admin__lsit--content">
    
                                        <div class="admin__lsit--content--detail">
                                        
                                            <a href="#"  @click.prevent="logout" class="admin__lsit--content--detail--link">
                                            <img src="../../svg/logout.svg">    
                                               Logout    
                                           </a>
    
                                        </div>
    
                                    </li>
    
                                </ul>
                            </div>
                              </b-nav-item-dropdown>

                        </b-navbar-nav>
						
							</div>
				<div v-else>
    
                        <router-link to="/register" class="btn join_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Join Us </router-link>
    
                        <router-link to="/login" class="btn sign_btn"><img src="images/sign-arrow.png">Sign In </router-link>
    
    
    
						</div>
						
    
    
                       
    
                    </div>
    
                </div>
    
            </div>
    
        </nav>
    
    </header>
    
    <!-- header element End -->
</template>
<script>
    import helper from '../services/helper'
    
    
    
    export default {
    
        data() {
    
    
            return {
				items: [],
				
                loginCheck: helper.checkLogin()
    
            }
    
    
    
        },
    
        mounted() {},
		
		  created: function() {
    
            this.fetchItems();
    
        },
    
    
        methods: {
    
    
    
            logout() {
    
                helper.logout().then(() => {
    
                    this.$store.dispatch('resetAuthUserDetail');
                    this.$router.replace('/');
					window.location.reload();
    
                })
    
            },
			fetchItems() {
    
                axios.get('/api/auth/user').then((response) => {
    
    
                    this.items = response.data;
    
    
                });
    
    
    
            },
			
    
            getAuthUserFullName() {
    
                return this.$store.getters.getAuthUserFullName;
    
            },
    
            getAuthUser(name) {
    
                return this.$store.getters.getAuthUser(name);
    
            }
    
        },
    
         computed: {
			
            getAvatar(){
                return '/images/user/'+this.getAuthUser('avatar');
            }
			
        }
    
    }
</script>