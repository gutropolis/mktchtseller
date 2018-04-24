<div class="container">
   <div class="row">
   <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div style="border:1px solid #fff;text-align:center;padding:10px;background-color:#e8870b;">
            <h1 style="color:blue;font-size:20px;padding:0px;margin:0px;color:#fff;">Invite To Pretake Charity Donation</h1>
         </div>
         <p style="font-size:13px;">Donater Email ID:- {{ $sender_user->email }}</p>
         <br />
         <p style="font-size:13px;">Donater Name:- {{ $sender_user->full_name }}</p>
         <br />
         <p style="font-size:13px;">Donate Product:- {{ $product->title }}</p>
         <br />
         <p style="font-size:13px;">Want to Donate Units:- {{ $sellerproduct->units }}</p>
         <br />
         <p><a href= "{{url('donaters')}}" style="font-size: 14px;
            background: #e8870b;
            border: 1px solid #e8870b;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;">Click Here To Update Status</a></p>
      </div>
	  </div>
   </div>
</div>
</div>
</div>