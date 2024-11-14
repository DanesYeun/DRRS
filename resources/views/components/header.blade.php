<div class="m-0 p-0">
   <nav id="navbar-example2" class="navbar navbar-light bg-white px-3 align-items-center shadow">
        <div class="container-fluid">
            <a class="navbar-brand text-primary d-flex align-items-center navbar-brand-responsive" href="/">
                <span>DRRS <span class="d-none d-sm-inline">: Disaster Response & Recovery System</span></span>
            </a>

            @guest
                <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('loginPage') }}">
                    Login
                </a>
            @endguest
            @auth
                <small class="text-primary">{{ Auth::user()->firstname. ' ' . Auth::user()->lastname}}</small>
            @endauth
        </div>
   </nav>
</div>  