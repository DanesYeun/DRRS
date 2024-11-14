<div class="sidebar bg-light p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <ul class="nav flex-column">
        <li class="nav-item py-1">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-house-fill' : 'bi-house' }} fs-5 p-2"></i>
                Home
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role == 1)
            <li class="nav-item py-1">
                <a class="nav-link" href="{{ route('users') }}">         
                    <i class="bi {{ Route::currentRouteName() == 'users' ? 'bi-people-fill' : 'bi-people' }} fs-5 p-2"></i> 
                    Users
                </a>
            </li>
        
            <li class="nav-item py-1">
                <a class="nav-link" href="{{ route('response_records.index') }}">         
                    <i class="bi {{ Route::currentRouteName() == 'response_records.index' ? 'bi-credit-card-2-front-fill' : 'bi-credit-card-2-front' }} fs-5 p-2"></i>
                    Response Records
                </a>
            </li>
        @endif
        @if(Auth::check() && in_array(Auth::user()->role, [1, 2]))
            <li class="nav-item py-1">
                <a class="nav-link" href="{{ route('patient_care.index') }}">         
                    <i class="bi bi-clipboard2-pulse fs-5 p-2"></i>
                    Patient Care Reports
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link" href="{{ route('map') }}">         
                    <i class="bi {{ Route::currentRouteName() == 'map' ? 'bi-pin-map-fill' : 'bi-pin-map' }} fs-5 p-2"></i>
                    Hazard Map
                </a>
            </li>
        @endif
        @if(Auth::check() && in_array(Auth::user()->role, [1, 3]))
            <li class="nav-item py-1">
                <a class="nav-link" href="{{ route('donations') }}">         
                    <i class="bi {{ Route::currentRouteName() == 'donations' ? 'bi-clipboard2-fill' : 'bi-clipboard2' }} fs-5 p-2"></i>
                    Manage Donations
                </a>
            </li>
        @endif
        <li class="nav-item py-1">
            <a class="nav-link" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi bi-door-closed p-2"></i> 
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>