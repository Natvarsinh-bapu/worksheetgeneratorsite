<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand" style="padding: 0;">
        <a href="{{ route('superadmin') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive logo" style="height: 80px;margin-left:20px;">
            {{-- {{ config('app.name') }} --}}
        </a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    
                </div>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="assets/img/user.png" class="img-circle" alt="">  --}}
                        <span>
                            {{ Auth::guard('superadmin')->user()->name }}
                        </span>
                         &nbsp; <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('/superadmin/change-password') }}"><i class="fa fa-key"></i> <span>Change Password</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('superadmin.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="lnr lnr-exit"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>