<template>
<div>
     <!-- banner element Start -->
    <section class="banner_element">
        <div class="row">
            <div class="col-md-6 banner_element--left">
                <div  class="banner_element--content row">
                    <h2 class="banner_element--content--heading">I am Seller</h2>
                    <p class="banner_element--content--pera col-md-12">I would like to give my Poduct to charity in need.</p>
                    <div v-if="loginCheck" class="banner_element--content--linkbox col-md-12"><router-link to ="/charityfba" class="banner_element--content--btn btn btn-border-white">Post My Products</router-link></div>
					<div v-else class="banner_element--content--linkbox"><router-link to ="/login" class="banner_element--content--btn btn btn-border-white">Post My Products</router-link></div>
                </div>
				
            </div>
            <div class="col-md-6 banner_element--right">
                <div class="banner_element--content banner_element--right--content row">
                    <h2 class="banner_element--content--heading col-md-12">I am Charity</h2>
                    <p class="banner_element--content--pera col-md-12">We are need of Amazon Products to Help Our Cause.</p>
					 <div v-if="loginCheck" class="banner_element--content--linkbox col-md-12"><router-link to ="/sellerfba" class="banner_element--content--btn btn btn-border-white">Post My Products</router-link></div>
                  <div v-else class="banner_element--content--linkbox"> <router-link to ="/login" class="banner_element--content--btn btn btn-border-white">Post Charity Needs</router-link></div>
                </div>
            </div>

        </div>
    </section>
	<section class="equal search_section">
        <div class="container">
            <div class="search__form">
                <h4 class="search__form--heading">Search Products or Find a Charity</h4>
                <p class="search__form--sub_heading">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <form id="searchform" class="search__form--outer">
                   
                    <div class="search__form--outer--box">
                        <div class="form-group">
                            <select placeholder="Search Keywords" v-model="searchform.selectcategory" class="search__form--outer--box--area">
                                    <option value="">Types</option>
                                    <option value="product"> Products</option>
                                    <option value="charity"> Charity</option>
                                    
                                </select>
                        </div>
                    </div>
                    <div class="search__form--outer--box">
                        <div class="form-group">
                            <input type="text"  name="keyword" placeholder="Search Keywords"  v-model="searchform.keyword" class="search__form--outer--box--area">
                        </div>
                    </div>
						
                    <div class="search__form--outer--box_btn">
                        <div class="form-group">
                            <a href="javascript:void()" class="search__form--outer--box_btn--btn btn btn-primary " v-on:click="submit(searchform.selectcategory)" >Submit</a></td>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
	<div>
		<section class="recent__post">
        <div class="container">
            <b-card no-body>
  <b-tabs card>
    <b-tab title="Charity" active>
        <h1 class="tab_heading_top "> Recent Charity Posts</h1>
        <div class="post_contant_inner clearfix">
        <div v-for="item in charity" class="recent__post--tab--content row">
            
                            <div class="recent__post--tab--content--img_box">
                                <figure class="recent__post--tab--content--img_box--figure"><img :src="'/images/charity/'+ item.images" class="recent__post--tab--content--img_box--figure--images"></figure>
                            </div>
                            <div class="recent__post--tab--content--detail_box">
                                <article class="recent__post--tab--content--detail_box--block">
                                    <h6 class="recent__post--tab--content--detail_box--block--heading">{{item.title}}</h6>
                                    <p class="recent__post--tab--content--detail_box--block--pera">{{item.description}}</p>
                                    <p class="recent__post--tab--content--detail_box--block--pera_box"><span><strong>Purpose:</strong> {{item.business_purpose}} </span>  <span><strong>Location:</strong> {{item.location}}</span></p>
                                </article>
                            </div>
							 <div class="recent__post--tab--content--btn_outer">
                            <div class="recent__post--tab--content--btn_outer--donate_btn"> 
                             <router-link :to="{name: 'charity_details', params: { id: item.id }}" class="btn btn-border-orange">View Info</router-link>
                            </div>
							</div>
							
						</div>
                    </div>
						  <div class="text-center equal">
                            <router-link to="/charityfba" class="btn btn-border-orange">View More</router-link>
                        </div>
						
    </b-tab>
    <b-tab title="Products" active>
        <h1 class="tab_heading_top "> Recent Sellers Posts</h1>
        <div class="post_contant_inner clearfix">
        <div v-for="product in products" class="recent__post--tab--content row">
            
                            <div class="recent__post--tab--content--img_box">
                                <figure class="recent__post--tab--content--img_box--figure"><img v-bind:src="product.images" class="recent__post--tab--content--img_box--figure--images"></figure>
                            </div>
                            <div class="recent__post--tab--content--detail_box">
                                <article class="recent__post--tab--content--detail_box--block">
                                    <h6 class="recent__post--tab--content--detail_box--block--heading">{{product.title}}</h6>
                                    <p class="recent__post--tab--content--detail_box--block--pera_box"><span><strong>Unit: </strong>{{product.units}} </span>  <span><strong>ASIN:</strong> {{product.asin_url}}</span></p>
                                </article>
                            </div>
                             <div class="recent__post--tab--content--btn_outer">
                            <div class="recent__post--tab--content--btn_outer--donate_btn"> 
                             <router-link :to="{name: 'seller_details', params: { id: product.id }}" class="btn btn-border-orange">View Product</router-link>
                            </div>
                            </div>
                           
                        </div>
                    </div>
                          <div class="text-center equal">
                            <router-link to="/sellerfba" class="btn btn-border-orange">View More</router-link>
                        </div>
                        
    </b-tab>
  </b-tabs>
</b-card>

        </div>
    </section>
	</div>
	<section class="equal awesome__solution">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="awesome__solution--heading">Creating A Win Solution For Both Amazon FBA <span class="block_content">SELLERS & CHARITIES IN NEED</span></h4>
                </div>
                <div class="col-md-3">
                    <div class="awesome__solution--content">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.699px" height="122.699px" fill="#faa41a" viewBox="0 0 122.699 122.699" xml:space="preserve">
                        <g>
                            <circle cx="19.5" cy="12.2" r="12.1"/>
                            <path d="M6,66.699h1.2v24c0,3.301,2.7,6,6,6h12.6c3.3,0,6-2.699,6-6V89.3c-1.1-2.101-1.8-4.5-1.8-7v-31.4c0-6.1,3.7-11.4,9-13.7
                                v-2.4c0-3.3-2.7-6-6-6H6c-3.3,0-6,2.7-6,6v25.9C0,64,2.6,66.699,6,66.699z"/>
                            <circle cx="103.3" cy="12.2" r="12.1"/>
                            <path d="M83.699,34.7v2.4c5.301,2.3,9,7.6,9,13.7v31.3c0,2.5-0.6,4.9-1.799,7v1.4c0,3.3,2.699,6,6,6h12.6c3.3,0,6-2.7,6-6v-24
                                h1.199c3.301,0,6-2.7,6-6V34.7c0-3.3-2.699-6-6-6h-27C86.4,28.7,83.699,31.399,83.699,34.7z"/>
                            <path d="M39.1,50.899L39.1,50.899v9.8v21.6c0,3.3,2.7,6,6,6h2.3v28.3c0,3.3,2.7,6,6,6h16.1c3.3,0,6-2.7,6-6v-28.4h2.3
                                c3.3,0,6-2.699,6-6V60.7v-9.8l0,0c0-3.3-2.7-6-6-6H45.1C41.7,44.899,39.1,47.6,39.1,50.899z"/>
                            <circle cx="61.4" cy="26" r="13.9"/>                       
                        </g>
                        </svg>
                        <h4 class="awesome__solution--content--heading">1500</h4>
                        <p class="awesome__solution--content--sub"> members</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="awesome__solution--content">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30.928px" height="30.928px" fill="#faa41a" viewBox="0 0 30.928 30.928" style="enable-background:new 0 0 30.928 30.928;"
                            xml:space="preserve">
                            <g>
                                <path d="M24.791,4.451c0.02-0.948-0.016-1.547-0.016-1.547l-9.264-0.007l0,0h-0.047h-0.047l0,0L6.152,2.904
                                    c0,0-0.035,0.599-0.015,1.547H0v1.012c0,0.231,0.039,5.68,3.402,8.665C4.805,15.373,6.555,15.999,8.618,16
                                    c0.312,0,0.633-0.021,0.958-0.049c1.172,1.605,2.526,2.729,4.049,3.289v4.445H9.154v2.784H7.677v1.561h7.74h0.094h7.74V26.47
                                    h-1.478v-2.784h-4.471v-4.445c1.522-0.56,2.877-1.684,4.049-3.289C21.678,15.98,21.999,16,22.311,16
                                    c2.062-0.002,3.812-0.627,5.215-1.873c3.363-2.985,3.402-8.434,3.402-8.665V4.451H24.791z M4.752,12.619
                                    c-1.921-1.7-2.489-4.61-2.657-6.144h4.158c0.176,1.911,0.59,4.292,1.545,6.385c0.175,0.384,0.359,0.748,0.547,1.104
                                    C6.912,13.909,5.706,13.462,4.752,12.619z M26.176,12.619c-0.953,0.844-2.16,1.29-3.592,1.345c0.188-0.355,0.372-0.72,0.547-1.104
                                    c0.955-2.093,1.369-4.474,1.544-6.385h4.158C28.665,8.008,28.098,10.918,26.176,12.619z"/>
                            </g>
                            
                            </svg>
                        <h4 class="awesome__solution--content--heading">2869</h4>
                        <p class="awesome__solution--content--sub"> Donations</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="awesome__solution--content">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="478.512px" height="478.512px" fill="#faa41a" viewBox="0 0 478.512 478.512" style="enable-background:new 0 0 478.512 478.512;"
                            xml:space="preserve">
                                <g>
                                    <g id="icons_2_">
                                        <g>
                                            <polygon points="269.784,70.73 276.471,70.73 273.253,59.671 "/>
                                            <path d="M177.491,54.892c-0.833-0.853-1.75-1.454-2.729-1.786c-1.018-0.346-1.955-0.521-2.787-0.521
                                                c-0.836,0-1.774,0.175-2.792,0.521c-0.977,0.332-1.893,0.934-2.728,1.786c-0.848,0.869-1.58,2.104-2.179,3.672
                                                c-0.603,1.583-0.91,3.677-0.91,6.226c0,2.551,0.308,4.645,0.91,6.226c0.599,1.569,1.331,2.805,2.179,3.673
                                                c0.835,0.854,1.751,1.455,2.728,1.786c1.015,0.346,1.953,0.521,2.792,0.521c0.834,0,1.772-0.175,2.787-0.521
                                                c0.979-0.331,1.896-0.932,2.729-1.786c0.848-0.867,1.58-2.102,2.179-3.673c0.604-1.583,0.911-3.678,0.911-6.226
                                                c0-2.546-0.307-4.641-0.911-6.226C179.071,56.994,178.337,55.759,177.491,54.892z"/>
                                            <path d="M125.759,58.18c-0.7-1.118-1.768-2.098-3.17-2.911c-1.394-0.808-3.368-1.218-5.867-1.218h-3.808V75.53h4.874
                                                c2.1,0,3.789-0.375,5.024-1.112c1.251-0.747,2.218-1.669,2.874-2.744c0.675-1.101,1.129-2.302,1.353-3.568
                                                c0.236-1.323,0.354-2.528,0.354-3.582c0-0.708-0.097-1.684-0.289-2.898C126.923,60.48,126.471,59.321,125.759,58.18z"/>
                                            <path d="M384.987,0H93.524c-17.566,0-31.86,14.293-31.86,31.861V99.2c0,17.567,14.294,31.86,31.86,31.86
                                                c0,0,293.084-0.041,293.883-0.102c16.44-1.242,29.44-15.006,29.44-31.759V31.861C416.849,14.293,402.556,0,384.987,0z
                                                    M142.264,74.89c-1.014,3.065-2.583,5.709-4.664,7.859c-2.083,2.153-4.749,3.827-7.923,4.976
                                                c-3.146,1.139-6.876,1.717-11.088,1.717H97.394c-0.475,0-0.859-0.384-0.859-0.858V40.996c0-0.474,0.385-0.858,0.859-0.858h24.061
                                                c4.068,0,7.572,0.714,10.412,2.122c2.837,1.409,5.169,3.286,6.93,5.579c1.75,2.28,3.034,4.938,3.816,7.901
                                                c0.771,2.926,1.161,5.948,1.161,8.984C143.773,68.44,143.265,71.861,142.264,74.89z M195.17,75.125
                                                c-1.19,3.138-2.9,5.881-5.081,8.154c-2.184,2.276-4.85,4.081-7.919,5.363c-3.072,1.282-6.502,1.933-10.194,1.933
                                                c-3.696,0-7.126-0.65-10.196-1.933c-3.073-1.283-5.737-3.088-7.92-5.363c-2.182-2.272-3.892-5.016-5.081-8.154
                                                c-1.189-3.125-1.791-6.602-1.791-10.336c0-3.731,0.602-7.208,1.791-10.335c1.19-3.139,2.899-5.882,5.081-8.154
                                                c2.181-2.273,4.845-4.077,7.918-5.362c3.072-1.283,6.502-1.933,10.198-1.933c3.692,0,7.122,0.65,10.194,1.933
                                                c3.071,1.285,5.737,3.088,7.919,5.362c2.181,2.272,3.89,5.016,5.081,8.154c1.188,3.13,1.79,6.607,1.79,10.335
                                                C196.96,68.521,196.358,71.997,195.17,75.125z M246.079,88.584c0,0.475-0.384,0.858-0.858,0.858h-14.263
                                                c-0.311,0-0.596-0.167-0.748-0.438l-13.122-23.371v22.95c0,0.475-0.386,0.858-0.858,0.858h-13.864
                                                c-0.474,0-0.858-0.384-0.858-0.858V40.996c0-0.474,0.385-0.858,0.858-0.858h14.997c0.314,0,0.604,0.171,0.754,0.447
                                                l12.384,22.746V40.996c0-0.474,0.384-0.858,0.858-0.858h13.862c0.477,0,0.858,0.384,0.858,0.858V88.584z M298.443,89.076
                                                c-0.16,0.229-0.422,0.366-0.702,0.366h-15.197c-0.38,0-0.716-0.251-0.823-0.617l-1.818-6.181h-13.855l-1.943,6.197
                                                c-0.112,0.357-0.444,0.601-0.818,0.601h-14.729c-0.281,0-0.545-0.136-0.707-0.368c-0.16-0.229-0.196-0.524-0.101-0.787
                                                l17.528-47.588c0.123-0.337,0.445-0.562,0.807-0.562h14.328c0.361,0,0.686,0.226,0.809,0.564l17.328,47.588
                                                C298.644,88.553,298.604,88.846,298.443,89.076z M336.456,52.783c0,0.473-0.385,0.858-0.859,0.858h-12.471v34.533
                                                c0,0.474-0.385,0.858-0.858,0.858h-14.662c-0.475,0-0.858-0.384-0.858-0.858V53.641h-12.474c-0.474,0-0.855-0.385-0.855-0.858
                                                V40.585c0-0.473,0.383-0.857,0.855-0.857h41.323c0.476,0,0.859,0.384,0.859,0.857V52.783z M381.978,88.174
                                                c0,0.474-0.385,0.858-0.857,0.858h-40.124c-0.474,0-0.858-0.384-0.858-0.858V40.585c0-0.473,0.386-0.857,0.858-0.857h39.391
                                                c0.474,0,0.857,0.384,0.857,0.857v12.198c0,0.473-0.385,0.858-0.857,0.858h-23.869v4.215h21.604c0.475,0,0.858,0.384,0.858,0.858
                                                v11.331c0,0.474-0.385,0.858-0.858,0.858h-21.604v4.215h24.604c0.474,0,0.858,0.384,0.858,0.858v12.198H381.978z"/>
                                            <path d="M365.837,287.807c-0.592-1.295-1.783-2.221-3.186-2.473l-110.88-19.959c0,0-9.321-2.779-25.5,0.192
                                                c-16.182,2.972-107.615,19.766-107.615,19.766c-1.381,0.253-2.556,1.16-3.151,2.433l-31.419,85.996
                                                c-1.431,3.056,1.017,6.506,4.375,6.168l28.11-2.842c-0.001,0.051-0.012,0.098-0.01,0.148l1.895,73.203
                                                c0.053,2.014,1.479,3.727,3.45,4.141l109.786,23.094c5.369,1.129,10.914,1.117,16.279-0.037l110.979-23.863
                                                c2.003-0.43,3.433-2.201,3.433-4.25v-92.857l27.76-0.002c3.308,0.266,5.68-3.117,4.304-6.137L365.837,287.807z"/>
                                            <path d="M247.405,155.855h-16.298c-2.999,0-5.433,2.432-5.433,5.433v28.842H212.1c-4.184,0-6.798,4.528-4.706,8.151
                                                l27.159,47.029c2.092,3.621,7.32,3.621,9.41,0l27.156-47.031c2.088-3.621-0.525-8.149-4.706-8.149h-13.574v-28.842
                                                C252.839,158.286,250.405,155.855,247.405,155.855z"/>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                        <h4 class="awesome__solution--content--heading">1450</h4>
                        <p class="awesome__solution--content--sub"> Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="awesome__solution--content">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 482.003 482.003" fill="#faa41a" style="enable-background:new 0 0 482.003 482.003;" xml:space="preserve">
                                    <g>
                                        <path d="M209.106,118.097c32.56,0,59.049-26.489,59.049-59.049C268.155,26.489,241.665,0,209.106,0
                                            c-32.551,0-59.033,26.489-59.033,59.048C150.073,91.607,176.555,118.097,209.106,118.097z"/>
                                        <path d="M370.582,141.248c6.07-1.993,11.001-6.232,13.884-11.935c2.882-5.703,3.371-12.187,1.376-18.257
                                            c-3.233-9.846-12.364-16.461-22.721-16.461c-2.531,0-5.045,0.404-7.471,1.201l-97.699,32.097c0,0-103.868,0-104.416,0
                                            c-9.318,0-17.855,5.471-21.747,13.936l-56.84,123.64c-2.669,5.806-2.917,12.303-0.699,18.295
                                            c2.219,5.993,6.638,10.763,12.442,13.432c3.164,1.454,6.521,2.192,9.979,2.192c9.32,0,17.857-5.47,21.749-13.935l20.588-44.783
                                            v213.899c0,15.127,12.307,27.434,27.434,27.434c15.127,0,27.434-12.307,27.434-27.434v-141.8h23.984v141.8
                                            c0,15.127,12.307,27.434,27.434,27.434c15.127,0,27.434-12.307,27.434-27.434V173.396L370.582,141.248z"/>
                                        <path d="M407.284,200.301l-36.891-48.946c-1.865-2.474-4.517-3.893-7.277-3.893s-5.412,1.419-7.278,3.894L318.95,200.3
                                            c-2.699,3.579-2.042,6.24-1.41,7.508c0.632,1.268,2.361,3.394,6.844,3.394h21.733v252.404c0,9.389,7.611,17,17,17
                                            c9.389,0,17-7.611,17-17V211.201h21.732c4.482,0,6.212-2.126,6.844-3.394C409.325,206.54,409.982,203.879,407.284,200.301z"/>
                                    </g>
                                    
                                    </svg>
                        <h4 class="awesome__solution--content--heading">124</h4>
                        <p class="awesome__solution--content--sub"> Awards</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
	<div>
	 <section class="equal testimonial">
        <div class="container">
            <h3 class="testimonial__heading">Clients Testimonials</h3>
            <div class="row">
                <div class="col-md-3">
                    <figure class="testimonial__caption">
                        <img src="images/profile.jpg" class="testimonial__caption--image">
                    </figure>
                </div>
                <div class="col-md-9">
                    <div class="testimonial__content">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                        <p><strong>Harry magret,</strong> CEO of abc industry</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
	</div>
	<div>
	 <section class="equal sign__element">
        <div class="container">
            <div class="sign__element--block">
                <h3 class="sign__element--block--heading">Sign Up now!</h3>
                <p class="sign__element--block--content">There are many variations of passages of Lorem Ipsum <span class="block_content">available, but the majority have suffered alteration in some</span> form, by injected humour.</p>
                <div v-if="loginCheck" class="sign__element--block--btn">
                    <router-link to="">Seller </router-link>
                   <router-link to="">Charity</router-link>
                </div>
				<div v-else class="sign__element--block--btn">
				 <router-link to="/register">Seller </router-link>
                   <router-link to="/charityregister">Charity</router-link>
				</div>
            </div>
        </div>
    </section>
	</div>
	
  </div>   
</template>
<script>
	import helper from '../../services/helper'
	
    export default {
	        data() {
	selectcategory:'charity'
            return {
			
			charity:{},
			products:{},
				 loginCheck: helper.checkLogin(),
                searchform: {

                keyword:'',
				  selectcategory:''
                    
                }
            }
        },
		
	
        mounted() {
        },
		created(){
		this.fetchItems();
		this.fetchProducts();
		},
		methods: {
		fetchItems()
            {
			
              axios.get('/api/charities').then(response =>  {
					
                  this.charity = response.data.data1;
				  
				  
              });
            },
		
		 fetchProducts()
            {
			
              axios.get('/api/productsearch').then(response =>  {
					
                  this.products = response.data;
				
				  
              });
            },
		
		submit:function(type)
		{
			
		
		     axios.post('/api/searchform', this.searchform).then(response =>  {
                    
					
					if(type=='charity')
					{
					  this.$router.push({path:'charityfba',query:{ keyword: this.searchform.keyword}});
                     
					}
					else if (type=='product')
					{
					  this.$router.push({path:'sellerfba',query:{ keyword: this.searchform.keyword}}); 
					 
					}
					else{
					toastr['error']('Please select a Type');
					}
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
					
				
		}
		
		}
		
    }
</script>
