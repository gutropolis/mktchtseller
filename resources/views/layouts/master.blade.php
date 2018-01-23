
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
     <title>Charity</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
 
 </head>
 <body >
        
     <div id="root">
         <router-view></router-view>
     </div>
	 <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
     <script src="js/bundle.min.js"></script>
	 <script src="js/toastr.min.js"></script>
 
<script>
   $(document).ready(function(){
    $("#dropdown-menu").click(function(){
        $(".drop_menu").slideToggle();
    });
});
</script>
 </body>
</html>