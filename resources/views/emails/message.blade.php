<div class="container">
   <div class="row">
      <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
	   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div style="border:1px solid #fff;text-align:center;padding:10px;background-color:#e8870b;">
            <h1 style="color:blue;font-size:20px;padding:0px;margin:0px;color:#fff;">Wants To Communicate With You</h1>
         </div>
      </div>
      <p style="font-size:13px;">Email ID:- {{ $sender_user->email }}</p>
      <p style="font-size:13px;">User Name:- {{ $sender_user->full_name }}</p>
      <p><a href= "{{url('users_detail')}}" style="font-size: 14px;
         background: #e8870b;
         border: 1px solid #e8870b;
         padding: 10px;
         display: inline-block;
         border-radius: 5px;
         color: #fff;
         text-decoration: none;">Click Here To Chat</a></p>
   </div>
   </div>
</div>
</div>
</div>
</div>