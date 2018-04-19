<div class="container">
    <div class="row">
        <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
<div style="border:1px solid #fff;width:1000px;height:40px;text-align:center;padding:10px;margin-left:200px;background-color:lightgray"><h1  style="color:blue;font-size:20px;">Hello!</h1></div>
</div>
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			   <h1 style="margin-left:200px">A New Product Added By Seller Organisation</h1>
                   <h2 style="font-size:15px;margin-left:200px">Organisation :- {{ $seller->title }} Add Product to Donate</h2>
				   <h2 style="font-size:15px;margin-left:200px">Product:- {{ $sellerproduct->title }}</h2><br />
				   <h2 style="font-size:15px;margin-left:200px">Avilable Units:- {{ $sellerproduct->units }}</h2><br />
				
				 <a href= "{{url('admin/sellerproduct/'.$sellerproduct->id.'/edit')}}">Click To See That Seller</a>
</div>
</div>
</div>
</div>
</div>