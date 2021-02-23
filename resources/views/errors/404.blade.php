{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
 --}}

<!DOCTYPE HTML>
<html>
	<head>
		<title>How to Create a Custom 404 Page in Laravel 7</title>
		<meta name="keywords" content="404 iphone web template, Android web template, Smartphone web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
		<link href="{{ asset('css/404.css') }}" rel="stylesheet" type="text/css"  media="all" />

	</head>
	<body>
		<!--start-wrap--->
		<div class="wrap">
			<!---start-header---->
				<div class="header">
					<div class="logo">
						<h1><a href="#">Ohh</a></h1>
					</div>
				</div>
			<!---End-header---->
			<!--start-content------>
			<div class="content">
				<img src="https://p.w3layouts.com/demos/ohh/web/images/error-img.png" title="error" />
				<p><span><label>O</label>hh.....</span>You Requested the page that is no longer There.</p>
				<a href="/">Back To Home</a>
   			</div>
			<!--End-Cotent------>
		</div>
		<!--End-wrap--->
	</body>
</html>