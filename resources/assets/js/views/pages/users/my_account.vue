<template>
    <div>
    <div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
       
    
                <div class="col-md-9 dashboard">
    
    
    
                    <div class="dashboard__content clearfix">
    
    
    
                        <div class="dashboard__content--head">
    
    
    
                            <h3 class="dashboard__content--head--heading">My Profile</h3>
    
    
    
                            <a href="#" class="dashboard__content--head--link"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    
        
    
                                    width="460.298px" height="460.297px" viewBox="0 0 460.298 460.297" style="enable-background:new 0 0 460.298 460.297;"
    
        
    
                                    xml:space="preserve">
    
        
    
                                   <g>
    
        
    
                                       <path d="M230.149,120.939L65.986,256.274c0,0.191-0.048,0.472-0.144,0.855c-0.094,0.38-0.144,0.656-0.144,0.852v137.041
    
        
    
                                           c0,4.948,1.809,9.236,5.426,12.847c3.616,3.613,7.898,5.431,12.847,5.431h109.63V303.664h73.097v109.64h109.629
    
        
    
                                           c4.948,0,9.236-1.814,12.847-5.435c3.617-3.607,5.432-7.898,5.432-12.847V257.981c0-0.76-0.104-1.334-0.288-1.707L230.149,120.939
    
        
    
                                           z"/>
    
        
    
                                       <path d="M457.122,225.438L394.6,173.476V56.989c0-2.663-0.856-4.853-2.574-6.567c-1.704-1.712-3.894-2.568-6.563-2.568h-54.816
    
        
    
                                           c-2.666,0-4.855,0.856-6.57,2.568c-1.711,1.714-2.566,3.905-2.566,6.567v55.673l-69.662-58.245
    
        
    
                                           c-6.084-4.949-13.318-7.423-21.694-7.423c-8.375,0-15.608,2.474-21.698,7.423L3.172,225.438c-1.903,1.52-2.946,3.566-3.14,6.136
    
        
    
                                           c-0.193,2.568,0.472,4.811,1.997,6.713l17.701,21.128c1.525,1.712,3.521,2.759,5.996,3.142c2.285,0.192,4.57-0.476,6.855-1.998
    
        
    
                                           L230.149,95.817l197.57,164.741c1.526,1.328,3.521,1.991,5.996,1.991h0.858c2.471-0.376,4.463-1.43,5.996-3.138l17.703-21.125
    
        
    
                                           c1.522-1.906,2.189-4.145,1.991-6.716C460.068,229.007,459.021,226.961,457.122,225.438z"/>
    
        
    
                                   </g>
    
        
    
                               </svg>Home</a>
    
    
    
                        </div>
    
    
    
                        <div class="dashboard__content--outer">
    
    
    
                            <div class="dashboard__content--box clearfix">
    
    
    
                                <div class="dashboard__content--box--upload ">
    
    
    
                                    <div class="dashboard__content--box--upload--profile">
    
    
    
                                        <figure><img :src="getAvatar" alt="user" class="dashboard__content--box--upload--box-image"></figure>
    
    
    
                                       
    
    
    
                                    </div>
    
    
    
    
    
    
    
                                </div>
    
    
    
    
    
    
    
                                <div class="dashboard__content--box--list">
    
    
    
                                    <div v-for="item in items">
    
    
    
                                        <ul class="dashboard__content--box--list--content">
    
    
    
                                            <li class="dashboard__content--box--list--content--item"><span><b>First Name:</b></span> {{item.first_name}}</li>
    
    
    
    
    
    
    
    
    
    
    
                                            <li class="dashboard__content--box--list--content--item"><span>Last Name:</span> {{item.last_name}}</li>
    
    
    
                                            <li class="dashboard__content--box--list--content--item"><span>Email:</span> {{item.email}}</li>
    
    
    
                                        </ul>
    
    
    
                                    </div>
    
    
    
                                </div>
    
    
    
                                <div class="dashboard__content--box--editbtn">
    
    
    
                                    <router-link to="/edit_account" type="button" class="btn btn-bg-orange"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
    
                                            xml:space="preserve">
    
        
    
                                        <g>
    
        
    
                                            <path d="M448,177.14V448c0,35.344-28.656,64-64,64H64c-35.344,0-64-28.656-64-64V128c0-35.344,28.656-64,64-64h270.844l-63.969,64   H64v320h320V241.156L448,177.14z M398.875,45.25L376.25,67.875l67.875,67.891l22.625-22.625L398.875,45.25z M444.125,0   L421.5,22.625l67.875,67.891L512,67.875L444.125,0z M150,294.188l67.875,67.875L421.5,158.406l-67.875-67.891L150,294.188z    M128,384h64l-64-64V384z" fill="#FFFFFF"/>
    
        
    
                                        </g>
    
        
    
                                        </svg> Edit</router-link>
    
    
    
                                </div>
    
    
    
                            </div>
    
    
    
                            <div class="dashboard__content--description">
    
    
    
                                <hr>
    
    
    
                                <h3 class="dashboard__content--description--heading">Discreption:</h3>
    
    
    
                                <p class="dashboard__content--description--content">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed
    
                                    to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover
    
                                    many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
    
    
    
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
import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
 import Vue from 'vue'
    export default {
    components: {
            AppNavbar,  AppSidebar 
        },
    
    
        data() {
    
    
    
            return {
    
    
    
    
    
    
    
                items: []
    
    
    
            }
    
    
    
        },
    
    
    
        mounted() {},
    
    
    
        created: function() {
    
    
    
            this.fetchItems();
    
    
    
        },
    
    
    
        methods: {
    
    
    
            logout() {
    
    
    
                axios.post('/api/auth/logout').then(response => {
    
    
    
                    localStorage.removeItem('auth_token');
    
    
    
                    axios.defaults.headers.common['Authorization'] = null;
    
    
    
                    toastr['success'](response.data.message);
    
    
    
                    this.$router.push('/');
    
    
    
                }).catch(error => {
    
    
    
                    console.log(error);
    
    
    
                });
    
    
    
            },
			 getAuthUserFullName(){
                return this.$store.getters.getAuthUserFullName;
            },
            getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            },
    
    
            fetchItems() {
    
                axios.get('/api/auth/user').then((response) => {
    
    
                    this.items = response.data;
    
    
                });
    
    
    
            },
    
    
    
        },
		 computed: {
            getAvatar(){
                return '/images/user/'+this.getAuthUser('avatar');
            }
        }
    
    
    
    }
</script>

