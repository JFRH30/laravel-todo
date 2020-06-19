<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <div class="nav-header">
            <a href="{{ url('home') }}"  class="navbar-brand h1">
                <span>
                    Exercise Project
                </span>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#login-nav" aria-controls="login-nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="login-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ url('appointment') }}" class="nav-link">Appointment</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('contact') }}" class="nav-link">Contacts</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('task') }}" class="nav-link">Task list</a>
                </li>

                <li class="nav-item">
                    <form id="logout-form" action="{{ url('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="nav-link">Logout</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
