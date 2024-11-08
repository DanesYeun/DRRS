<div class="sidebar bg-light p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <ul class="nav flex-column">
        <li class="nav-item py-1">
            <a class="nav-link" href="#Home">
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-house-fill' : 'bi-house' }} fs-5 p-2"></i>
                Home
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="#Users">         
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-people-fill' : 'bi-people' }} fs-5 p-2"></i> 
                Users
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="#Settings">         
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-credit-card-2-front-fill' : 'bi-credit-card-2-front' }} fs-5 p-2"></i>
                Response Records
            </a>
        </li>
        <li class="nav-item py-1">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-pin-map-fill' : 'bi-pin-map' }} fs-5 p-2"></i>
                Hazard Map
            </a>
        </li>
    </ul>
</div>