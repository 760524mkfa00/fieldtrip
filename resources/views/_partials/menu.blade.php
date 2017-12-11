<nav class="navbar fixed-top navbar-expand-xl navbar-dark bg-dark">
    {{--<div class="container-fluid">--}}
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Trip Connect') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if (! Auth::guest())

                    <li class="nav-item"><a class="nav-link" href="/home">My Trips</a></li>
                    <li class="nav-item"><a class="nav-link" href="/overtime">Offered Overtime</a></li>

                    @can('update', Fieldtrip\Trip::class)
                        <li class="nav-item dropdown show">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trips </a>

                            <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{ route('list_trips') }}">Trips</a>
                            </div>
                        </li>

                        &nbsp;<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zones </a>

                            <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{ route('list_zones') }}">Zones</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Routes </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{ route('list_routes') }}">Routes</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adjustments <span class="caret"></span></a>

                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{ route('list_adjustments') }}">Adjustments</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('list_users') }}">Users</a>
                                <a class="dropdown-item" href="{{ route('list_role') }}">Roles</a>
                            </div>
                        </li>
                    @endcan
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>

                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout <i class="fa fa-sign-out float-right"></i>

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    {{--</div>--}}
</nav>