@extends('layouts.layout')

@section('content')
    <x-toast />
    @if ($hazardAlert)
        <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-diamond-fill"></i>
            <span>Warning! {{ $latestHazard->hazardName }} occured {{ $latestHazard->updated_at->diffForHumans() }}</span> 
        </div>
    @endif
    <div class="d-flex flex-column mx-md-2">
        <h3 class="text-start mx-2 text-primary">Hazard Map</h3>
        <div class="mx-2 mb-3 p-2">
            <div id="hazard-map" class="border border-success mb-2" style="width: 100%; height: 400px;"></div>
            <div class="d-flex justify-content-around gap-2">
                <div class="alert alert-danger" role="alert">
                    Number of Hazards : {{ $hazards->count()}}
                </div>
                <div class="alert alert-success" role="alert">
                    Number of Shelters : {{ $shelters->count()}}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row m-md-2 py-2">
        <div class="col-12 col-md-6 text-start px-3">
            <h3 class="text-primary">Donate</h3>
            <p class="">               
                Your generous donation will directly support our efforts to make a positive impact in the community. Together, we can create lasting change and bring hope to those who need it most.
            </p>
        </div>
        <div class="d-flex justify-content-center align-items-center px-5 col-12 col-md-6">
            <a class="btn btn-outline-primary flex-fill btn-lg" href="{{ route('create.donation') }}">
                Donate
            </a>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/togglePassword.js') }}"></script>

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script src="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.js"></script>
    
    <!-- leaflet draw -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    <script src="{{ asset('js/hazard-map.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {          
            // pass json data 
            var hazardData = @json($hazards); 
            var shelterData = @json($shelters);
            
            initializeHazardMap(hazardData, shelterData, 'hazard-map');
        });
    </script>  
@endsection