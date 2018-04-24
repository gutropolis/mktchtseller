<div class="container">
   <div class="row">
      <div  class="col-lg-8 col-md-12 col-sm-12 col-xs-12"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div style="border:1px solid #fff;text-align:center;padding:10px;background-color:#e8870b;">
            <h1 style="color:blue;font-size:20px;padding:0px;margin:0px;color:#fff;">A New Product Added By Seller Organisation</h1>
         </div>
         <p style="font-size:13px;">Organisation :- {{ $seller->title }} Add Product to Donate</p>
         <p style="font-size:13px;">Product:- {{ $sellerproduct->title }}</p>
         <p style="font-size:13px;">Avilable Units:- {{ $sellerproduct->units }}</p>
         <br />
      </div>
      <p><a href= "{{url('admin/sellerproduct/'.$sellerproduct->id.'/edit')}}"  style="font-size: 14px;
         background: #e8870b;
         border: 1px solid #e8870b;
         padding: 10px;
         display: inline-block;
         border-radius: 5px;
         color: #fff;
         text-decoration: none;">Click To See That Seller</a></p>
   </div>
</div>
</div>
</div>
</div>