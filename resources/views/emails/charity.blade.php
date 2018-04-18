<div class="container">
    <div class="row">
        <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
<div style="border:1px solid #fff;width:1000px;height:40px;text-align:center;padding:10px;margin-left:200px;background-color:lightgray"><h1  style="color:blue;font-size:20px;">Hello!</h1></div>
</div>
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			   <h1 style="margin-left:200px">A New Charity Organisation Register in CharityFba</h1>
			   <a href= "{{url('admin/charity/'.$charity->id.'/edit')}}">Click To See That Charity</a>
			  
                   <h2 style="font-size:15px;margin-left:200px">Email ID:- {{ $user->email }}</h2><br />
				<h2 style="font-size:15px;margin-left:200px">User Name:- {{ $user->full_name }}</h2><br />
								<h2 style="font-size:15px;margin-left:200px">Organisation_Name:- {{ $charity->title }}</h2><br />
								<h2 style="font-size:15px;margin-left:200px">Location:- {{ $charity->location }}</h2><br /> 
								<h2 style="font-size:15px;margin-left:200px">Contact:- {{$charity->area_code}}{{ $charity->phone_number }}</h2></div>
				
</div>
</div>
</div>
</div>
</div>