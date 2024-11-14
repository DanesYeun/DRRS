@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Donation Form</h3>
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
            <form method="post" action="{{ route('store.donation') }}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 px-3 pt-5 pb-2">

                
                    <x-input name="fullname" label="Complete Name" type="text" required="true"/>
                    <x-input name="contactno" label="Contact Number" type="number"/>
                    <x-select name="donationMode" label="Donation Mode" :options="$donation_mode" required="true"/> 


                    <x-select name="donation_type" label="Donation Type" :options="$type" required="true" onchange="toggleFields(this.value)"/> 

                    <!-- Cash Fields -->
                    <div id="1-fields" class="donation-fields d-none">
                        <div class="row">
                            <x-input name="amount" label="Amount" type="number" />
                        </div>
                    </div>
                 
                    <!-- Inkind Fields -->
                    <div id="2-fields" class="donation-fields d-none">
                        <div class="row">
                            <x-select name="category" label="Category" :options="$categories"/>
                            <x-input name="itemName" label="Item Name" type="text" />
                            <x-input name="quantity" label="Quantity" type="number" />
                        </div>
                    </div>

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