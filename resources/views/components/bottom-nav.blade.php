<nav class="bottom-nav d-sm-none border text-primary bg-white">
    <div class="d-flex justify-content-around p-2">
        <a class="text-decoration-none text-center" href="#Home">
            <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-house-fill' : 'bi-house' }} fs-5 p-2"></i>
        </a>
        <a class="text-decoration-none text-center" href="#Users">         
            <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-people-fill' : 'bi-people' }} fs-5 p-2"></i> 
        </a>
        <a class="text-decoration-none text-center" href="#Settings">         
            <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-credit-card-2-front-fill' : 'bi-credit-card-2-front' }} fs-5 p-2"></i>
        </a>
        <a class="text-decoration-none text-centerk" href="#">         
            <i class="bi {{ Route::currentRouteName() == 'home' ? 'bi-pin-map-fill' : 'bi-pin-map' }} fs-5 p-2"></i>
        </a>
    </div>
</nav>