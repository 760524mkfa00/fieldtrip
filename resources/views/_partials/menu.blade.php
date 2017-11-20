<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Trip Connect') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (! Auth::guest())

                    <li><a href="/home">My Trips</a></li>
                    <li><a href="/overtime">Offered Overtime</a></li>

                    @can('update', Fieldtrip\Trip::class)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trips <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('list_trips') }}">Trips</a>
                                </li>
                            </ul>
                        </li>

                        &nbsp;<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zones <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('list_zones') }}">Zones</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Routes <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('list_routes') }}">Routes</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('list_users') }}">Users</a></li>
                                <li><a href="{{ route('list_role') }}">Roles</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adjustments <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('list_adjustments') }}">Adjustments</a>
                                </li>
                            </ul>
                        </li>
                    @endcan



                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>