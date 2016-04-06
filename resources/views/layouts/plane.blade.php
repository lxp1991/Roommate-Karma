<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Roommate Karma</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<link rel="stylesheet" href="{{ asset("stylesheets/styles.css") }}" />
	<!-- Fonts -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <!-- Styles -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- date picker -->
    <link href=" {{ asset("datepicker/classic.css") }}" rel="stylesheet">
    <link href=" {{ asset("datepicker/classic.date.css") }}" rel="stylesheet">


</head>
<body>
	@yield('body')
	<script src="{{ asset("scripts/frontend.js") }}" type="text/javascript"></script>
	<script src="{{ asset("datepicker/picker.js") }}"></script>
    <script src="{{ asset("datepicker/picker.date.js") }}"></script>  
</body>
</html>
