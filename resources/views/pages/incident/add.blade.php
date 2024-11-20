@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Report Incident</h3>
            @if(session('error'))
                <x-alert response="error" color="danger"/>
            @elseif(session('success'))
                <x-alert response="success" color="success"/>
            @endif
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ route('landingPage') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>

        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('incident_report.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-auto px-3 pt-5 pb-2">

                    <x-select id="incident_type" name="incident_type" label="Type of Incident" :options="$cases" required="true" onchange="toggleFields(this.value)"/>

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
                        <div id="medical-container" class="patient-container">
                            <div class="row patient-row">
                                <x-input name="medical[0][full_name]" label="Patient Full Name" type="text" mdSize="4"/>
                                <x-input name="medical[0][heart_rate]" label="Heart Rate (BPM)" type="number" mdSize="3"/>
                                <x-single-checkbox label="Shortness of Breath" name="medical[0][shortness_breath]" mdSize="2"/> 
                                <x-single-checkbox label="Paleness" name="medical[0][paleness]" mdSize="2"/> 
                                <div class="col-md-1 d-flex justify-content-center p-0">
                                    <button type="button" class="btn btn-danger btn-sm p-1 remove-patient-btn" style="width: 30px; height: 30px;">
                                        <i class="bi bi-x-lg fs-7"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2 mb-2 add-patient-btn" data-container-id="medical-container" data-type="medical">Add Patient</button>
                    </div>

                    <!-- Injury/Trauma Fields -->
                    <div id="3-fields" class="incident-fields d-none">
                        <div id="injury-trauma-container" class="patient-container">
                            <div class="row patient-row">
                                <x-input name="injury_trauma[0][full_name]" label="Patient Full Name" type="text" mdSize="4"/>
                                <x-input name="injury_trauma[0][heart_rate]" label="Heart Rate (BPM)" type="number" mdSize="3"/>
                                <x-single-checkbox label="Shortness of Breath" name="injury_trauma[0][shortness_breath]" mdSize="2"/> 
                                <x-single-checkbox label="Paleness" name="injury_trauma[0][paleness]" mdSize="2"/> 
                                <div class="col-md-1 d-flex justify-content-center p-0">
                                    <button type="button" class="btn btn-danger btn-sm p-1 remove-patient-btn" style="width: 30px; height: 30px;">
                                        <i class="bi bi-x-lg fs-7"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2 mb-2 add-patient-btn" data-container-id="injury-trauma-container" data-type="injury_trauma">Add Patient</button>
                    </div>

                    <!-- Cardia Fields -->
                    <div id="4-fields" class="incident-fields d-none">
                        <div id="cardia-container" class="patient-container">
                            <div class="row patient-row">
                                <x-input name="cardia[0][full_name]" label="Patient Full Name" type="text" mdSize="4"/>
                                <x-input name="cardia[0][heart_rate]" label="Heart Rate (BPM)" type="number" mdSize="3"/>
                                <x-single-checkbox label="Shortness of Breath" name="cardia[0][shortness_breath]" mdSize="2"/> 
                                <x-single-checkbox label="Paleness" name="cardia[0][paleness]" mdSize="2"/> 
                                <div class="col-md-1 d-flex justify-content-center p-0">
                                    <button type="button" class="btn btn-danger btn-sm p-1 remove-patient-btn" style="width: 30px; height: 30px;">
                                        <i class="bi bi-x-lg fs-7"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2 mb-2 add-patient-btn" data-container-id="cardia-container" data-type="cardia">Add Patient</button>
                    </div>

                    <div id="5-fields" class="incident-fields d-none">
                        <div id="disaster-container" class="patient-container">
                            <div class="row patient-row">
                                <x-select name="disaster_type" label="Type of Disaster" :options="$disaster_types" required="true"/>
                                <x-input name="disaster_image" label="Photo" type="file" accept="image/*"/>
                                <x-input name="description" label="Description" type="text" mdSize="12"/>
                                 
                                <!-- Hidden inputs to store coordinates -->
                                <x-input id="latitude" name="latitude" label="Latitude" type="text"  mdSize="5" readOnly="true"/>
                                <x-input id="longitude" name="longitude" label="Longitude" type="text"  mdSize="5" readOnly="true"/>
                                <!-- Button to  get coordinates -->
                                <div class="col-md-2">
                                    <button id="locate-button" class="btn btn-primary">Get My Location</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Other fields -->
                    <hr class="border border-1 border-dark">
                    <x-input name="date" label="Date" type="date" :value="now()->format('Y-m-d')" />
                    <x-input name="time" label="Time" type="time" :value="now()->timezone('Asia/Manila')->format('H:i')" />
                    <x-input name="place" label="Place of Incident" type="text"/>
                    <x-input name="landmark" label="Landmark" type="text"/>
                    <x-input name="number_casualties" label="Number of Casualties" type="number"/>
                    <x-input name="reporter_name" label="Reporter FullName" type="text"/>
                    <x-input name="reporter_contactno" label="Reporter Contact Number" type="number"/>

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
