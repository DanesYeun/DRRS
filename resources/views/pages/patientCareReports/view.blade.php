@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Patient Care Reports</h3>
        <!-- Display success or error message -->
        <x-alert response="error"/>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-file-earmark-medical p-2"></i>
                        Add Patient Care Report
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" action="{{ route('patient_care.store') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="container row">
                                <h4 class="py-2 text-primary text-start">Patient Care Report</h4>
                                <x-input name="patientName" label="Patient Name" type="text" mdSize="12" required="true"/>

                                <x-input name="patientAge" label="Age" type="text" mdSize="2" required="true"/>
                                <x-select name="patientGender" label="Gender" :options="$genders" required="true" sizeMd="4"/>
                                <x-input name="patientAddress" label="Patient Address" type="text" mdSize="6" required="true"/> 

                                <x-input name="patientContactPerson" label="Contact Person" type="text" mdSize="6"/>
                                <x-input name="contactNumber" label="Contact Number" type="number" mdSize="6"/>
                                          
                                <x-input name="incidentPlace" label="Place of Incident" type="text" mdSize="6" required="true"/>
                                <x-input name="incidentDate" label="Date of Incident" type="date" mdSize="4" required="true"/>
                                <x-input name="incidentTime" label="Time of Incident" type="time" mdSize="2"/>

                                <x-select name="case" label="Case" :options="$cases" required="true"/>
                                <div class="d-none d-sm-inline col-6"></div>

                                <div class="text-start text-primary">
                                    <div class="row px-2">
                                        <x-checkbox label="Alertness" :datas="$alertnessData" namePrefix="alertness"/>
                                        <x-small-input-group label="SAMPLE History" :datas="$sample" namePrefix="sample"/>
                                    </div>
                                </div>

                                <div class="text-start text-primary">
                                    <div class="row px-2">
                                        <x-small-input-group label="Pain Assessment" :datas="$painAssessmentData" namePrefix="painAssessment"/>
                                        <x-radio-hybrid label="Injury Type" :datas="$injuryTypes" name="injury_type" />      
                                    </div>
                                </div>

                                <div class="text-start text-primary">
                                    <div class="row px-2">
                                        <x-checkbox label="DCAP - BTLS" :datas="$dcapbtls" namePrefix="dcapbtls"/>
                                        <x-bfast label="Spot Stroke" :datas="$spotStroke" namePrefix="spotStroke"/>      
                                    </div>
                                </div>

                                <div class="text-start text-primary" id="injury">
                                    <div class="row px-2">
                                    <x-small-input-group label="Vital Signs" :datas="$vitals" namePrefix="vitals"/>
                                        <div class="col-12 col-md-6 mb-2 pt-4">
                                            <x-input name="others" label="Others" type="text" mdSize="12"/>
                                            <x-input name="responder" label="Responder" value="{{ Auth::user()->firstname.' '.Auth::user()->lastname }}" type="text" mdSize="12" required="true" readOnly/>
                                            <x-input name="recievedBy" label="Recieved By" type="text" mdSize=12/>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">   
                                    <button type="submit" class="btn btn-success mx-2">
                                        <i class="bi bi-file-earmark-medical p-2"></i>
                                        Add Patient Record
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/formValidation.js') }}"></script>
@endsection
