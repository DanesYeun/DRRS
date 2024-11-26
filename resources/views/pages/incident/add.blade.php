@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Report Incident</h3>
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ route('landingPage') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>

        @if(session('error'))
            <x-alert response="error" color="danger"/>
        @elseif(session('success'))
            <x-alert response="success" color="success"/>
        @endif

        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('incident_report.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="border bg-white rounded row mx-2 px-3 pt-5 pb-2">
                    <h3 class="text-start text-primary mb-3">Incident Report</h3>
                    <x-select name="incident_type" label="Type of Incident" :options="$cases" required="true" onchange="toggleFields(this.value)"/> 
                    <x-input name="place" label="Place of Incident" type="text"/>
                    <x-input name="date" label="Date" type="date" value="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                    <x-input name="time" label="Time" type="time" value="{{ \Carbon\Carbon::now()->format('H:i')}}"/>
                    <x-input name="landmark" label="Landmark" type="text"/>
                    <x-input name="number_casualties" label="Number of Casualties" type="number" dNone="true"/>
                    <x-input name="reporter_name" label="Reporter FullName" type="text"/>
                    <x-input name="reporter_contactno" label="Reporter Contact Number" type="number" pattern="^(09|\+639)\d{9}$" minLength="7" maxLength="15"/>
                    <div class="mb-4"></div>

                    <!-- Obstetrics Fields -->
                    <div id="1-fields" class="incident-fields d-none">
                        <div class="row">
                            <x-input name="obstetrics_full_name" label="Patient Full Name" type="text" />
                            <x-input name="obstetrics_age" label="Patient Age" type="number" />
                            <x-input name="obstetrics_months_pregnant" label="Months Pregnant" type="number" />
                            <x-input name="obstetrics_number_births" label="Number of Births" type="number" />
                            <x-input name="obstetrics_prenatal_care_location" label="Prenatal Care Location" type="text" />
                        </div>
                    </div>
                 
                    <!-- Medical Fields -->
                    <div id="2-fields" class="incident-fields d-none">
                        <div id="medical-container"></div>
                    </div>

                    <!-- Injury/Trauma Fields -->
                    <div id="3-fields" class="incident-fields d-none">
                        <div id="injury-trauma-container"></div>
                    </div>

                    <!-- Cardia Fields -->
                    <div id="4-fields" class="incident-fields d-none">
                        <div id="cardia-container"></div>
                    </div>

                    <div id="5-fields" class="incident-fields d-none">
                        <div id="disaster-container" class="patient-container">
                            <div class="row patient-row">
                                <x-select name="disaster_type" label="Type of Disaster" :options="$disaster_types" required="true"/>
                                <x-input name="disaster_image" label="Photo" type="file" accept="image/*"/>
                                <x-input name="description" label="Description" type="text" mdSize="12"/>
                                 
                                {{--
                                <x-input id="latitude" name="latitude" label="Latitude" type="text"  mdSize="5" readOnly="true"/>
                                <x-input id="longitude" name="longitude" label="Longitude" type="text"  mdSize="5" readOnly="true"/>
                                <!-- Button to  get coordinates -->
                                <div class="col-12 col-md-2 mb-3">
                                    <button id="locate-button" class="btn btn-primary w-100">
                                        <i class="bi bi-pin-map-fill p-2 d-md-none d-md-inline"></i>
                                        Get My Location
                                    </button>
                                </div> --}}
                                
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button id="submit-btn" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i> Send Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

<script src="{{ asset('js/incident-btn.js') }}"></script>
<script src="{{ asset('js/incident-geo-api.js') }}"></script>
@endsection
