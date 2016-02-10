<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">Application</a>
        </div>

        <div id="navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!$currentUser)
                    <li><a href="{{ route($authLoginRoutes . 'login') }}">Login</a></li>
                    <li><a href="{{ route($authLoginRoutes . 'register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown"
                           class="dropdown-toggle" href="#">{{ $currentUser->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route($authProfileRoutes . 'show', [$currentUser->username])}}">View profile</a></li>
                            <li><a href="{{route($authProfileRoutes . 'edit', [$currentUser->username])}}">Edit profile</a></li>
                            <li><a href="{{route($authLoginRoutes . 'logout')}}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
