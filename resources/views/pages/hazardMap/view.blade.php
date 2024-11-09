@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Hazard Map</h3>
        <div class="mx-2 mb-3 p-2">
            <div id="hazard-map" class="border border-success" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/togglePassword.js') }}"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('hazard-map').setView([10.000, 125.000], 13); // Set coordinates and zoom level

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    </script>
@endsection