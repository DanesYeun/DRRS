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

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const incidentTypeSelect = document.getElementById('incident_type');
    const incidentFields = document.querySelectorAll('.incident-fields');

    // Function to show/hide fields based on selected incident type
    function toggleFields(selectedType) {
        // Hide all fields
        incidentFields.forEach(field => field.classList.add('d-none'));
        // Show the selected field
        if (selectedType) {
            const selectedField = document.getElementById(`${selectedType}-fields`);
            if (selectedField) {
                selectedField.classList.remove('d-none');
            }
        }
    }

    // Initialize field visibility based on the current value of incident_type
    toggleFields(incidentTypeSelect.value);

    // Bind onchange event to the incident type select
    incidentTypeSelect.addEventListener('change', function () {
        toggleFields(this.value);
    });

    // Add event listeners for adding/removing rows for patient fields
document.querySelectorAll('.add-patient-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        const containerId = e.target.dataset.containerId;
        const container = document.getElementById(containerId);

        const type = e.target.dataset.type;

        const patientRows = container.querySelectorAll('.patient-row');
        const newIndex = patientRows.length; // Get the next index

        // Clone the first row and update the field names
        const firstRow = container.querySelector('.patient-row');
        const clonedRow = firstRow.cloneNode(true);

        // Update the input names for the new row
        clonedRow.querySelectorAll('input').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${newIndex}]`);

            // If the input is a checkbox, uncheck it
            if (input.type === 'checkbox') {
                input.checked = false;  // Uncheck the checkbox
            }
        });

        // Clear the input fields in the cloned row
        clonedRow.querySelectorAll('input').forEach(input => {
            input.value = '';
            
     
            if (input.type === 'checkbox') {
                input.checked = false; 
            }
        });

        container.appendChild(clonedRow);

       
        updateDeleteButtonState(container);
        });
    });

      document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-patient-btn') || 
            e.target.closest('.remove-patient-btn')) {
            const rowToRemove = e.target.closest('.patient-row'); 
            const container = rowToRemove.parentNode; 

            // Remove the row
            container.removeChild(rowToRemove);

            // Update delete button states
            updateDeleteButtonState(container);
        }
    });


    function updateDeleteButtonState(container) {
    const rows = container.querySelectorAll('.patient-row');
    rows.forEach(row => {
        const deleteButton = row.querySelector('.remove-patient-btn');
        if (rows.length > 1) {
        deleteButton.removeAttribute('disabled'); 
        } else {
        deleteButton.setAttribute('disabled', 'disabled'); 
        }
    });
    }
});

</script>

<script>
    // Function to get the user's coordinates
    function getUserCoordinates() {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(
                function(position) {

                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                },
                function(error) {
                    // Error: handle geolocation failure
                    alert("Error: " + error.message);
                },
                {
                    enableHighAccuracy: true,  // Use GPS for higher accuracy
                    maximumAge: 0            
                }
            );
        } else {
         
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Event listener for the "Get My Coordinates" button
    document.getElementById('locate-button').addEventListener('click', function(event) {
        event.preventDefault(); 
        getUserCoordinates();    
    });
</script>

@endsection
