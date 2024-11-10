@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Add Shelter</h3>
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ route('map') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>
        <div class="mx-2 mb-3 p-2">
            <div id="hazard-map" class="border border-success mb-2" style="width: 100%; height: 300px;" ></div>

            <!-- Shelter Form -->
            <form method="post" id="hazard-form" action="{{ route('shelter.store') }}" class="needs-validation">
                @csrf
                <!-- Display success or error message -->
                @if(session('error'))
                    <x-alert response="error"/>
                @endif

                <div class="border container bg-white rounded row mx-2 px-3 pt-2 pb-2">
                    <h4 class="py-2 text-primary text-start">Shelter Details</h4>
                    <x-input type="text" name="shelterName" label="Shelter Name" required="true"/>
                    <x-input type="text" name="shelterCoordinates" label="Shelter Coordinates" readOnly="true" required="true"/>

                    <div class="d-flex justify-content-end">   
                        <button type="submit" class="btn btn-success mx-2">
                            <i class="bi bi-geo-fill p-2"></i>
                            Add Shelter
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <!-- leaflet draw (not needed here for just pinning) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    <script src="{{ asset('js/hazard-map-pin.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeHazardMapPin('hazard-map', 'shelterCoordinates');
        });
    </script>
@endsection
