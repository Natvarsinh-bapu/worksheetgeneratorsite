<!DOCTYPE html>
<html lang="en">

<head>
   @include('user.include.head')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    @include('user.include.header')
  </header><!-- End Header -->

   @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    @include('user.include.footer')
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  @include('user.include.scripts')

</body>

</html>