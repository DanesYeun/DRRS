<div class="m-0 p-0">
   <nav id="navbar-example2" class="navbar navbar-light bg-white px-3 align-items-center">
        <div class="container-fluid">
            <a class="navbar-brand text-primary d-flex align-items-center border" style="width: 300px;" href="/">
                <img src="{{ asset(env('COOP_ICON')) }}" alt="LOGO" width="50" height="50">
            </a>
            <span>{{ Auth::user()->Fname. ' ' .Auth::user()->Lname }}</span>
        </div>
   </nav>
</div>  