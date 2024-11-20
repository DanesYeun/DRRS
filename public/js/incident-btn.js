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
