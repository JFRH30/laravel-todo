<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="nav-header">
            <span class="navbar-brand h1">Exercise Project</span>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#login-nav" aria-controls="login-nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="login-nav">

            <ul class="navbar-nav ml-auto">
                @if (!Auth::check())
                <li class="nav-item">
                    <a href="{{ url('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('register') }}" class="nav-link">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ url('appointment') }}" class="nav-link">Appointments</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('contact') }}" class="nav-link">Contacts</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('task') }}" class="nav-link">Todo List</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ url('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="nav-link">Logout</a>
                    </form>
                </li>
            @endif
            </ul>
        </div>
    </div>
</nav>
