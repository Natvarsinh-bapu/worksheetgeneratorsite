<!doctype html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }}</title>

	@include('admin.include.head')
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
        
		<!-- NAVBAR -->
		@include('admin.include.header')
        <!-- END NAVBAR -->
        
		<!-- LEFT SIDEBAR -->
		@include('admin.include.sidebar')
        <!-- END LEFT SIDEBAR -->
        
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

					{{-- alerts for messages --}}
					@include('alerts')

                    {{-- CONTENT HERE --}}
                    @yield('content')

                </div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
        <!-- END MAIN -->

        
        {{-- FOOTER --}}
        @include('admin.include.footer')
		{{-- FOOTER _END --}}
		
		@include('admin.include.scripts')
        
	</div>
    <!-- END WRAPPER -->
</body>

</html>
