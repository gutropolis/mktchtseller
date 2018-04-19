<div class="container">
    <div class="row">
        <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
<div style="border:1px solid #fff;width:1000px;height:40px;padding:10px;margin-left:200px;background-color:lightgray"><h1 style="color:blue;font-size:20px; text-align:center">Charity Fba!</h1></div>
</div>
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			   <h2 style="margin-left:100px">Status of Donated Product </h2>
			   <h4 style="margin-left:100px;color:blue;font-size:20px">Hello! {{ $reciever_user->full_name }}</h4>
			  
                   <h4 style="font-size:15px;margin-left:100px">
			 {{ $charity_detail->title }} are Accepted Your Product It Will Very thankful to You.</h4><br />
			<h4 style="font-size:15px;margin-left:100px">Here Inform Your status progress Report</h4>
				 <h4 style="font-size:15px;margin-left:100px">Progress Status :- {{ $donation_detail->progress }} % </h4>
				
			<a href= "{{url('users_detail')}}"><button> Click To Communicate</button> </a>
				
</div>
</div>
</div>
</div>
</div>