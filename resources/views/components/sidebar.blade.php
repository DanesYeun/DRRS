<div class="sidebar bg-light p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <ul class="nav flex-column">
        <li class="nav-item py-1">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-house-fill' : 'bi-house' }} fs-5 p-2"></i>
                Home
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="{{ route('users') }}">         
                <i class="bi {{ Route::currentRouteName() == 'user' ? 'bi-people-fill' : 'bi-people' }} fs-5 p-2"></i> 
                Users
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="{{ route('response_records.index') }}">         
                <i class="bi {{ Route::currentRouteName() == 'responseRecords' ? 'bi-credit-card-2-front-fill' : 'bi-credit-card-2-front' }} fs-5 p-2"></i>
                Response Records
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi {{ Route::currentRouteName() == 'map' ? 'bi-pin-map-fill' : 'bi-pin-map' }} fs-5 p-2"></i>
                Hazard Map
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi bi-door-closed p-2"></i> 
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>