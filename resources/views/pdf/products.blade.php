<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
</head>
<body>
	<div class="text-center">
	<div class="row align-data-center">
                        <div class="col-md-12 text-center">
                           <h3 class="dashboard__content--head--heading">{{ $data->charity }}</h3>
                           <p>{{ $data->address }} {{  $data->postal_code }}</p>
                           <p class="text-center">{{ $data->website }}</p>
                        </div>
                        <div class="col-md-12">
						<div class=" signature_box">
                            <p style="font-family: 'Roboto Condensed', sans-serif;"><b>Description:- </b> {{ $data->description }} </p>
							<p style="font-family: 'Roboto Condensed', sans-serif;"><b>Mission:- </b> {{ $data->mission_statement }} </p>
							<p style="font-family: 'Roboto Condensed', sans-serif;"><b>Vision:- </b> {{ $data->vision_statement }} </p>
						  
                        
							<div class="signature_content" style="text-align:right;">
							

								<img src="{{ public_path("images/signature/".$data->signature) }}" alt="" style="">
							
                           
                           <div style="font-family: 'Roboto Condensed', sans-serif;">All About {{ $data->charity }}</div>
						   </div>
						   </div>
                        </div>
                        <hr>
                        <div class="signature_box">
                          <h5 style="font-family: 'Roboto Condensed', sans-serif;">Donation By:</h5>
                           <p style="font-family: 'Roboto Condensed', sans-serif;">This will the acknowledge reciept of deal of units of <b>{{ $data->units }} </b>units of  <b>{{ $data->product }}</b> donated to <b>{{ $data->charity }}</b> for use as date <b>{{ $data->created_at }}</b></p>
                           <p style="font-family: 'Roboto Condensed', sans-serif;">Doners  may deduct contributions only to the  extent the contribution are gifts,with no considerations recieved. </p>
                           <p style="font-family: 'Roboto Condensed', sans-serif;">All About Seller  Tax I.D.:- <b>{{ $data->tax_id }}</b>.</p>
                        </div>
                     </div>
	</div>
	</body>
</html>