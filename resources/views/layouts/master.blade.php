<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	   <title>CharityFba</title>
	 <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link href="/css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
  <link href="/css/toastr.min.css" rel="stylesheet" type="text/css">
    
 </head>
 <body >
     <div id="root">
         <router-view></router-view>
	</div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBybmNGcXcsC2ChADSIPX0kGMUiPBqs1v0&libraries=places"></script>
	 <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
       <script src="/js/bundle.min.js"></script>
</body>
</html>