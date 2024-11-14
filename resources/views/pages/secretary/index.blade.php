@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Donation Records</h3>
        
        <x-select name="donation_type" label="Donation Type" :options="$type" sizeMd="3" required="true" onchange="toggleFields(this.value)"/> 

        <!-- Cash Fields -->
        <div id="1-fields" class="donation-fields d-none">
            <div class="row">
                <x-donations-table label="Cash Donations" :datas="$cashDonations" :type="1"/>
            </div>
        </div>
        
        <!-- Inkind Fields -->
        <div id="2-fields" class="donation-fields d-none">
            <div class="row">
                <x-donations-table label="Inkind Donations" :datas="$inkindDonations" :type="2"/>
            </div>
        </div>

        <a href="{{ route('response_records.create') }}" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i> Create Response Record</a>
    </div>
@endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incidentTypeSelect = document.getElementById('donation_type');
        const incidentFields = document.querySelectorAll('.donation-fields');
 
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