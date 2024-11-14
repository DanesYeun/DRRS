@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Family Assistance Form</h3>
              <!-- Display success or error message -->
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
            <form method="post" action="{{ route('store.family.assistance') }}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 px-3 pt-5 pb-2">

                    {{-- <hr class="border border-2 border-dark"> --}}
                    <h6 class="text-start mx-2 text-primary">LOCATION OF THE AFFECTED FAMILY</h6>
                    <x-input name="region" label="Region" type="text"/>
                    <x-input name="city_municipality" label="City/Municipality" type="text"/>

                    <x-input name="province" label="Province" type="text"/>
                    <x-input name="barangay" label="Barangay" type="text"/>

                    <x-input name="district" label="District" type="text"/>
                    <x-input name="evacuation_center" label="Evacuation Center" type="text"/>

                    <div class="mb-4"></div>
                    <h6 class="text-start mx-2 text-primary">HEAD OF THE FAMILY</h6>
                    <x-input name="first_name" label="First Name" type="text" mdSize="3"/>
                    <x-input name="middle_name" label="Middle Name" type="text" mdSize="3"/>
                    <x-input name="last_name" label="Last Name" type="text" mdSize="3"/>
                    <x-input name="suffix" label="Name Ext. (Jr.,Sr.)" type="text" mdSize="3"/>

                    <x-input name="birthdate" label="Birthdate" type="date" mdSize="3"/>
                    <x-input name="age" label="Age" type="number" mdSize="2"/>
                    <x-input name="birthplace" label="Birth Place" type="text" mdSize="7"/>

                    <x-select name="gender" label="Sex" :options="$genders" sizeMd="2" required="true"/>
                    <x-select name="civil_status" label="Civil Status" :options="$civil_status" sizeMd="2" required="true"/>
                    <x-input name="religion" label="Religion" type="text" mdSize="2"/>
                    <x-input name="occupation" label="Occupation" type="text" mdSize="3"/>
                    <x-input name="monthly_family_net_income" label="Monthly Family Net Income" type="number" mdSize="3"/>
                    
                    <x-input name="primary_contact_no" label="Primary Contact Number" type="number" mdSize="2"/>
                    <x-input name="alternate_contact_no" label="Alternate Contact Number" type="number" mdSize="2"/>
                    <x-input name="mother_maiden_name" label="Mother's Maiden Name" type="text" mdSize="3"/>
                    <x-input name="permanent_address" label="Permanent Address" type="text" mdSize="5"/>

                    <x-input name="id_card_presented" label="ID Card Presented" type="text" mdSize="3"/>
                    <x-input name="id_card_number" label="ID Card Number" type="text" mdSize="3"/>
                    <x-single-checkbox label="4Ps Beneficiary" name="is4PsBenef" mdSize="2"/> 
                    <x-single-checkbox label="IP" name="isIP" mdSize="2"/> 
                    <x-input name="ethnicity" label="Type of Ethnicity" type="text" mdSize="2"/>

                    <x-input name="total_older_person" label="No. of Older Person" type="number" mdSize="2"/>
                    <x-input name="total_preg_women" label="No. of Pregnant Women" type="number" mdSize="2"/>
                    <x-input name="total_lactating_women" label="No. of Lactating Women" type="number" mdSize="2"/>
                    <x-input name="total_PWD" label="No. of PWDs due to Medical Condition" type="number" mdSize="2"/>
                    <x-select name="house_ownership" label="House Ownership" :options="$house_ownership" sizeMd="2" required="true"/>
                    <x-select name="shelter_damage" label="Shelter Damage" :options="$shelter_damage" sizeMd="2" required="true"/>

                    <div class="mb-4"></div>
                    <h6 class="text-start mx-2 text-primary">FAMILY INFORMATION</h6>
                    
                    <table class="table table-bordered" id="familyTable">
                        <thead>
                            <tr>
                                <th>Family Member</th>
                                <th>Relation To Head Member</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Highest Educational Attainment</th>
                                <th>Occupation</th>
                                <th>Remarks</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
            
                    <button class="btn btn-success mb-3" id="addRowBtn" type="button">
                        + Add Member
                    </button>
                    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Function to add a new row to the table
    document.getElementById("addRowBtn").addEventListener("click", function() {
        let table = document.getElementById("familyTable").getElementsByTagName('tbody')[0];
        let newRow = table.insertRow(table.rows.length);
        
        let rowIndex = table.rows.length - 1;
        let genders = @json($genders);

        // Create cells and append to the row
        for (let i = 0; i < 8; i++) {
            let cell = newRow.insertCell(i);

            if (i === 4) { 
                // Create the select dropdown for gender
                cell.innerHTML = `<select name="family_member[${rowIndex}][${i}]" class="form-control">` + 
                    genders.map(gender => `<option value="${gender.id}">${gender.name}</option>`).join('') + 
                    '</select>';
            }else if(i === 2){
                cell.innerHTML = `<input type="date" name="family_member[${rowIndex}][${i}]" class="form-control">`;
            }else {
                // General input for other cells
                cell.innerHTML = `<input type="text" name="family_member[${rowIndex}][${i}]" class="form-control">`;
            }
        }
        
        let deleteCell = newRow.insertCell(8); 
        deleteCell.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm deleteBtn">
                Delete
            </button>
        `;
        
        // Add event listener for delete button
        deleteCell.querySelector(".deleteBtn").addEventListener("click", function() {
            newRow.remove(); // Remove the row from the table
        });
    });
</script>
@endsection