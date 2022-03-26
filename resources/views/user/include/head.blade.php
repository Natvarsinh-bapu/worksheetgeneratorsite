<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ env('APP_NAME') }}</title>
<meta name="description" content="worksheet generator worksheetgenerator worksheet generate worksheets school student work pdf">
<meta name="author" content="worksheet generator">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('front_theme/assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('front_theme/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<link href="{{ asset('front_theme/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('front_theme/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
<link href="{{ asset('front_theme/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('front_theme/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('front_theme/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet"> --}}

<link href="{{ asset('front_theme/assets/css/style.css') }}" rel="stylesheet">

{{-- custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/user/user.css') }}">