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
            <div class="logo-wrap">
                <a style="color: #7b6448" class="navbar-brand" href="{{ url('/') }}">
                    <img src="/img/logo3.png">
                </a>
            </div>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ route('about') }}">Qui sommes-nous</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('mentions-legales') }}">Mentions legales</a></li>
            </ul>

            <form method="GET" action="{{ route('search') }}" class="navbar-form navbar-right">
                <div class="form-group">
                    <div class="input-group">
                        <input name="q" type="text" class="form-control" placeholder="Votre recherche">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li>
                        <a style="color: red" href="{{ route('home') }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                @endif

                <li>
                    <a href="{{ route('basket') }}" >
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span id="basket-count">
                            @if (Session::has('Basket'))
                                {{ array_sum(Session::get('Basket')) }}
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>