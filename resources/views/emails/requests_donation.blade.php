<div class="container">
   <div class="row">
 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div style="border:1px solid #fff;text-align:center;padding:10px;background-color:#e8870b;">
            <h1 style="color:blue;font-size:20px;padding:0px;margin:0px;color:#fff;">Charity Fba</h1>
         </div>
		   <h6 style="font-size:13px;">Request Charity For Donation </h6>
         <p style="font-size:13px;">Sender Email ID:- {{ $sender_user->email }}</p>
         <p style="font-size:13px;">Sender Name:- {{ $sender_user->full_name }}</p>
         <p style="font-size:13px;">Requested Product:- {{ $product->title }}</p>
         <p style="font-size:13px;">Need Units:- {{ $donation->units }}</p>
         <br />
         <p><a href= "{{url('request')}}" style="font-size: 14px;
            background: #e8870b;
            border: 1px solid #e8870b;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;">Click Here To Update Status</a></p>
			 <p style="font-size:13px;">Thank you for making a difference through Charity FBA!</p>
         <p style="font-size:13px;">Regards</p>
		   <p style="font-size:13px;"> Mike and the Charity FBA Team</p>
      </div>
	  </div>
   
</div>
</div>
</div>