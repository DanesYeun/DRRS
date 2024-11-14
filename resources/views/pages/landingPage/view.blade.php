@extends('layouts.layout')

@section('content')
    <div class=" border d-flex flex-column m-md-2">
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

    <div class="border d-flex flex-column flex-md-row m-md-2 py-2">
        <div class="col-12 col-md-6 text-start px-3">
            <h3 class="text-primary">Donate</h3>
            <p class="">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt molestiae eos accusamus delectus architecto dicta esse voluptatibus veniam magnam? Repellendus sapiente error laudantium illum nihil.
            </p>
        </div>
        <div class="d-flex justify-content-center align-items-center px-5 col-12 col-md-6">
            <a class="btn btn-outline-primary flex-fill btn-lg" href="{{ route('create.donation') }}">
                Donate
            </a>
        </div>
    </div>

    <div class=" border d-flex flex-column flex-md-row m-md-2 py-2">
        <div class="col-12 col-md-6 px-3">
            <h3 class="text-primary">Report Incident</h3>
            <a class="btn btn-outline-success" href="{{ route('create-incident-report') }}">
                Report Incident
            </a>
        </div>
        <div class="col-12 col-md-6 px-3">
            <h3 class="text-primary">Request Relief Goods</h3>
            <a class="btn btn-outline-secondary" href="{{ route('request.family.assistance') }}">
                Request Relief Goods
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