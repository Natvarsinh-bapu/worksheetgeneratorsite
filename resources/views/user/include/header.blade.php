<div class="container d-flex align-items-center">      
      <a href="{{ url('/') }}" class="logo mr-auto"><img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid"></a>
      
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          @if (!Auth::user())
            <li><a href="{{ url('/login') }}">Login</a></li>
            {{-- <li><a href="{{ url('/register') }}">Register</a></li> --}}
          @else
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
          @endif
        </ul>
      </nav>      

    </div>