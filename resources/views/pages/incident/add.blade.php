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
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{  route('landingPage') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>

        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('incident_report.store') }}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 px-3 pt-5 pb-2">

                    <x-select name="incident_type" label="Type of Incident" :options="$cases" required="true" onchange="toggleFields(this.value)"/> 

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
                        <div class="row">
                            <x-input name="medical_full_name" label="Patient Full Name" type="text" />
                            <x-input name="medical_shortness_breath" label="Shortness of Breath" type="text" />
                            <x-input name="medical_paleness" label="Paleness" type="text" />
                            <x-input name="medical_heart_rate" label="Heart Rate (BPM)" type="number" />
                        </div>
                    </div>

                    <!-- Injury/Trauma Fields -->
                    <div id="3-fields" class="incident-fields d-none">
                        <div class="row">
                            <x-input name="injury_trauma_full_name" label="Patient Full Name" type="text" />
                            <x-input name="injury_trauma_shortness_breath" label="Shortness of Breath" type="text" />
                            <x-input name="injury_trauma_paleness" label="Paleness" type="text" />
                            <x-input name="injury_trauma_heart_rate" label="Heart Rate (BPM)" type="number" />
                        </div>
                    </div>

                    <!-- Cardia Fields -->
                    <div id="4-fields" class="incident-fields d-none">
                        <div class="row">
                            <x-input name="cardia_full_name" label="Patient Full Name" type="text" />
                            <x-input name="cardia_shortness_breath" label="Shortness of Breath" type="text" />
                            <x-input name="cardia_paleness" label="Paleness" type="text" />
                            <x-input name="cardia_heart_rate" label="Heart Rate (BPM)" type="number" />
                        </div>
                    </div>

                    <!-- Disaster Fields -->
                    <div id="5-fields" class="incident-fields d-none">
                        <x-input name="disaster_type" label="Type of Disaster" type="text" sizeMd="12"/>
                    </div>

                    <hr class="border border-2 border-dark">

                    <x-input name="date" label="Date" type="date"/>
                    <x-input name="time" label="Time" type="time"/>
                    <x-input name="place" label="Place of Incident" type="text"/>
                    <x-input name="landmark" label="Landmark" type="text"/>
                    <x-input name="number_casualties" label="Number of Casualty" type="number"/>
                    <x-input name="reporter_name" label="Reporter FullName" type="text"/>
                    <x-input name="reporter_contactno" label="Reporter Contact Number" type="number"/>

                    <div class="d-flex justify-content-end">   
                        <button id="submit-btn" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i>  Send Report
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incidentTypeSelect = document.getElementById('incident_type');
        const incidentFields = document.querySelectorAll('.incident-fields');
 
        // Function to show/hide fields based on selected incident type
        function toggleFields() {
            incidentFields.forEach(field => field.classList.add('d-none')); // Hide all fields
            const selectedType = incidentTypeSelect.value;
            if (selectedType) {
                const selectedField = document.getElementById(`${selectedType}-fields`);
                if (selectedField) selectedField.classList.remove('d-none'); // Show selected field
            }
        }
 
        // Initial load
        toggleFields();
 
        // On change of select
        incidentTypeSelect.addEventListener('change', toggleFields);
    });
 </script>
 
@endsection