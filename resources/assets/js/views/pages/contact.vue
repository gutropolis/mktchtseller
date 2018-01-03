<template>
<div>
<section class="page__head">
		<div class="container">
			<div class="page__head--content">
				<h2 class="page__head--content--heading">Contact us</h2>
				<router-link to = "/" class="page__head--content--menu">Home </router-link> 
				<a href="#" class="page__head--content--menu">Contact Us</a>
				
			</div>
		</div>
		</section>
   <section class="contact_us_sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="contact_detail">
                                    <div class="row"> 
                                        <div class="contact_detail_main"> 
                                            <div class="row">                                     
                                                <div class="col-md-3"><i class="fa fa-rocket" aria-hidden="true"></i></div>
                                                <div class="col-md-9"> <h1 class="contact_heading">OUR LOCATION</h1><p>#123, The standard chunk of Lorem Ipsum</p></div> 
                                            </div>
                                         </div>

                                        <div class="contact_detail_main">
                                            <div class="row">
                                                <div class="col-md-3"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                                <div class="col-md-9"> <h1 class="contact_heading">CALL US ON</h1><p>(+1) 517 123 4567 <br>(+1) 617 345 6789</p></div>
                                             </div>
                                        </div>

                                        <div class="contact_detail_main">
                                            <div class="row">
                                                <div class="col-md-3"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                                <div class="col-md-9"> <h1 class="contact_heading">SEND YOUR MESSAGE</h1><p>Info@charityfba.com.<br> admin@Charityfba .com</p></div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="contact_form">
                                        <div class="form-group">                                           
                                            <input type="text" class="form-control" id="name" placeholder="First Name">
                                        </div>
                                        <div class="form-group">                                            
                                            <input type="text" class="form-control" id="company" placeholder="Company">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="email" placeholder="example@email.com">
                                        </div>
                                        <div class="form-group">                                                
                                            <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Your message.."></textarea>
                                        </div>
                                        <div class="btn-container">
                                                <button type="submit" class="btn sub_button">Submit</button>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				</div>
</template>