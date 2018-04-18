<div class="container">
    <div class="row">
        <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
<div style="border:1px solid #fff;width:1000px;height:40px;padding:10px;margin-left:200px;background-color:lightgray"><h1 style="color:blue;font-size:20px; text-align:center">Charity Fba!</h1></div>
</div>
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			   <h1 style="margin-left:200px">Invite To Pretake Charity </h1>
			   
			  
                   <h2 style="font-size:15px;margin-left:200px">
				Donater Email ID:- {{ $sender_user->email }}
				</h2><br />
				<h2 style="font-size:15px;margin-left:200px">Donater Name:- {{ $sender_user->full_name }}</h2><br />
				  <h2 style="font-size:15px;margin-left:200px">
				Donate Product:- {{ $product->title }}
				</h2><br />
				  <h2 style="font-size:15px;margin-left:200px">
				Want to Donate Units:- {{ $sellerproduct->units }}
				</h2><br />
				
				
				
			<a href= "{{url('donaters')}}"><button> Click Here To Update Status</button> </a>
				
</div>
</div>
</div>
</div>
</div>