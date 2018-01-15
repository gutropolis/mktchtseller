
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
     <title>Charity</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
	 <link rel="stylesheet" href="css/vue-form-wizard.min.css">
  <link href="css/toastr.min.css" rel="stylesheet" type="text/css">  
 </head>
 <body>
        
     <div id="root">
         <router-view></router-view>
     </div>
     <script src="/js/bundle.min.js"></script>
   <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 <script src="js/toastr.min.js"></script>
 </body>
</html>