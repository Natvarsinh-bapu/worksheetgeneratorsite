<!doctype html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }}</title>

	@include('superadmin.include.head')
</head>

<body>
	{{-- WRAPPER --}}
	<div id="wrapper">
        
		{{-- NAVBAR --}}
		@include('superadmin.include.header')
        {{-- END NAVBAR --}}
        
		{{-- LEFT SIDEBAR --}}
		@include('superadmin.include.sidebar')
        {{-- END LEFT SIDEBAR --}}
        
		{{-- MAIN --}}
		<div class="main">
			{{-- MAIN CONTENT --}}
			<div class="main-content">
				<div class="container-fluid">

					{{-- alerts for messages --}}
					@include('alerts')

                    {{-- CONTENT HERE --}}
                    @yield('content')

                </div>
			</div>
			{{-- END MAIN CONTENT --}}
		</div>
        {{-- END MAIN --}}

        
        {{-- FOOTER --}}
        @include('superadmin.include.footer')
		{{-- FOOTER _END --}}
		
		@include('superadmin.include.scripts')
        
	</div>
    {{-- END WRAPPER --}}
</body>

</html>
