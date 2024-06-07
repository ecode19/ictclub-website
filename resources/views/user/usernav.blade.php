<nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top" style="background: linear-gradient(to right, #031a47, #4a649b);">
    <div class="container">
        <a href="{{ route('member.dashboard') }}" class="navbar-brand text-warning"><img
                class="img-fluid ms-auto rounded-circle d-none d-sm-block" src="../../img/logo.jpg"
                style="width: 100px; heig"></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
            Menu<span class="navbar-toggler-ico"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav fs-6 mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('member.dashboard') }}">Profile</a></li>
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('event') }}">Events</a></li>--}}
                <li class="nav-item"><a class="nav-link" href="{{ route('announcement') }}">Announcements</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('resourcesView') }}">Resources</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('discusion_forum') }}">Discussion Forum</a></li>
            </ul>
            {{--    laravel default login script--}}
            <a  href="{{ route('logout') }}" class="text-decoration-none text-light " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 {{'Logout'}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>
    </div>
</nav>
