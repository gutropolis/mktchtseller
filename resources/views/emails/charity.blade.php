<div class="container">
   <div class="row">
      <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div style="border:1px solid #fff;text-align:center;padding:10px;background-color:#e8870b;">
               <h1 style="color:blue;font-size:20px;padding:0px;margin:0px;color:#fff;">A New Charity Organisation Register in CharityFba</h1>
            </div>
            <p style="font-size:13px;"><strong>User Name:-</strong> {{ $user->full_name }}</p>
            <p style="font-size:13px;"><strong>Email ID:-</strong> {{ $user->email }}</p>
            <p style="font-size:13px;"><strong>Organisation_Name:-</strong> {{ $charity->title }}</p>
            <p style="font-size:13px;"><strong>Location:-</strong> {{ $charity->location }}</p>
            <p style="font-size:13px;"><strong>Contact:-</strong> {{$charity->area_code}}{{ $charity->phone_number }}</p>
         </div>
         <p><a href= "{{url('admin/charity/'.$charity->id.'/edit')}}" style="font-size: 14px;
            background: #e8870b;
            border: 1px solid #e8870b;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;">Click To See That Charity</a></p>
      </div>
   </div>
</div>
</div>
</div>