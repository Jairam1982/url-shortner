<div class="header">
    <div class="header-left">
        <h1>My App</h1>
        @auth
            <a href="{{ route(auth()->user()->getDashboardRoute()) }}">Dashboard</a>
        @endauth
    </div>

    <div class="header-right">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>

</div>