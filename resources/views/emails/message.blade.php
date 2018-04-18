<div class="container">
    <div class="row">
        <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
<div style="border:1px solid #fff;width:1000px;height:40px;text-align:center;padding:10px;margin-left:200px;background-color:lightgray"><h1  style="color:blue;font-size:20px;">Hello!</h1></div>
</div>
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			   <h1 style="margin-left:200px">Communicate with You </h1>
			   
			  
                   <h2 style="font-size:15px;margin-left:200px">
				  Email ID:- {{ $sender_user->email }}
				</h2><br />
				<div style="font-size:15px;margin-left:200px">User Name:- {{ $sender_user->full_name }}</div><br />
				<div style="font-size:15px;margin-left:200px">Subject:- </div><br />
				
				
			<a href= "{{url('users_detail')}}">Click To Communicate </a>
				
</div>
</div>
</div>
</div>
</div>