<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Super Admin</title>
	
	{{-- FAVICON --}}
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('superadmintheme/img/favicon.png') }}">

    <!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
{{-- <body background="{{ asset('images/superadmin_bg.jpg') }}" style="background-repeat: no-repeat;background-size: 100% 100%;height: 100vh;"> --}}
<body style="background-color:#fff;">
	<div id="app">
		<nav class="navbar navbar-expand-md" style="background-color:#fff; color:#212b35;">
			<div class="container">
				<a class="navbar-brand" href="{{ route('superadmin') }}">
					<img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive logo" style="height: 70px;margin-left:20px;">
					{{-- {{ config('app.name') }} --}}
				</a>
			</div>
		</nav>

		<main class="py-4">
			@yield('content')
		</main>
	</div>
</body>
</html>
