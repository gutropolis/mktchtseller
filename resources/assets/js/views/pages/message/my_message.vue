<template>
<div>
 <div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
	
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                    <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Messages</h3>
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
                    <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                            <div class="notification__element-bottom">
                                <div class="notification__element--mark">
                                    <input type="checkbox" value="mark" class="notification__element--mark--check">
                                    <label class="notification__element--mark--value">Mark All</label>
                                </div>
                                <div class="notification__element--button clearfix">
                                    <button type="button" class="btn">Mark as Read</button>
                                    <button type="button" class="btn"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="408.483px" height="408.483px" viewBox="0 0 408.483 408.483" style="enable-background:new 0 0 408.483 408.483;"
                                    xml:space="preserve">
                                   <g>
                                       <path d="M87.748,388.784c0.461,11.01,9.521,19.699,20.539,19.699h191.911c11.018,0,20.078-8.689,20.539-19.699l13.705-289.316
                                           H74.043L87.748,388.784z M247.655,171.329c0-4.61,3.738-8.349,8.35-8.349h13.355c4.609,0,8.35,3.738,8.35,8.349v165.293
                                           c0,4.611-3.738,8.349-8.35,8.349h-13.355c-4.61,0-8.35-3.736-8.35-8.349V171.329z M189.216,171.329
                                           c0-4.61,3.738-8.349,8.349-8.349h13.355c4.609,0,8.349,3.738,8.349,8.349v165.293c0,4.611-3.737,8.349-8.349,8.349h-13.355
                                           c-4.61,0-8.349-3.736-8.349-8.349V171.329L189.216,171.329z M130.775,171.329c0-4.61,3.738-8.349,8.349-8.349h13.356
                                           c4.61,0,8.349,3.738,8.349,8.349v165.293c0,4.611-3.738,8.349-8.349,8.349h-13.356c-4.61,0-8.349-3.736-8.349-8.349V171.329z"/>
                                       <path d="M343.567,21.043h-88.535V4.305c0-2.377-1.927-4.305-4.305-4.305h-92.971c-2.377,0-4.304,1.928-4.304,4.305v16.737H64.916
                                           c-7.125,0-12.9,5.776-12.9,12.901V74.47h304.451V33.944C356.467,26.819,350.692,21.043,343.567,21.043z"/>
                                   </g>
                               
                               </svg>Delete</button>
                                </div>
                            </div>
							<div class="notification__element--view">
							<div class=" my-2 my-lg-0 ">
							<router-link to="/create_message" class="btn join_btn"> Create Message</router-link>
							</div>
							</div>
                            <div class="notification__element--view">
                                <div class="notification__element--mark">
                                    <input type="checkbox" value="mark" class="notification__element--mark--check">
                                </div>
								
                                <div class="notification__element--listing">
								
                                    <figure class="notification__element--listing--figure">
                                        <img src="images/download.jpg" class="notification__element--listing--figure--image">
                                    </figure>
									
                                    <div class="notification__element--listing--content">
                                        <h4>Charity Life</h4>
                                        <p>Contrary to popular belief, Lorem Ipsum.</p>
                                        <p><strong>Unit:</strong> 5 <strong>Location:</strong> Delhi, India</p>
                                    </div>
                                </div>
                                <div class="notification__element--view--button">
                                    <button class="btn notification__element--view--button--content">View More</button>
                                </div>
                            </div>
                            <div class="notification__element--view">
                                <div class="notification__element--mark">
                                    <input type="checkbox" value="mark" class="notification__element--mark--check">
                                </div>
                                <div class="notification__element--listing">
                                    <figure class="notification__element--listing--figure">
                                        <img src="images/download.jpg" class="notification__element--listing--figure--image">
                                    </figure>
                                    <div class="notification__element--listing--content">
                                        <h4>Charity Life</h4>
                                        <p>Contrary to popular belief, Lorem Ipsum.</p>
                                        <p><strong>Unit:</strong> 5 <strong>Location:</strong> Delhi, India</p>
                                    </div>
                                </div>
                                <div class="notification__element--view--button">
                                    <button class="btn notification__element--view--button--content">View More</button>
                                </div>
                            </div>
                            <div class="notification__element--view">
                                <div class="notification__element--mark">
                                    <input type="checkbox" value="mark" class="notification__element--mark--check">
                                </div>
                                <div class="notification__element--listing">
                                    <figure class="notification__element--listing--figure">
                                        <img src="images/download.jpg" class="notification__element--listing--figure--image">
                                    </figure>
                                    <div class="notification__element--listing--content">
                                        <h4>Charity Life</h4>
                                        <p>Contrary to popular belief, Lorem Ipsum.</p>
                                        <p><strong>Unit:</strong> 5 <strong>Location:</strong> Delhi, India</p>
                                    </div>
                                </div>
                                <div class="notification__element--view--button">
                                    <button class="btn notification__element--view--button--content">View More</button>
                                </div>
                            </div>

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
import AppNavbar from '../users/navbar.vue' 
 import AppSidebar from '../users/sidebar.vue'
 import Vue from 'vue'
    export default {
    components: {
            AppNavbar,  AppSidebar 
        },
		data() {
            return {
				
                 
            }
        },
        mounted(){
        },
		 
		 methods: {
            },
			
        }
		
</script>