@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Incident Report Details</h3>
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ url()->previous() }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>
        <div class="mx-2 mb-3 p-2">
            <form method="post" action="" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 px-3 pt-5 pb-2">
                    <x-input name="date" label="Date" type="date" value="{{ $report->date }}" readOnly/>
                    <x-input name="time" label="Time" type="time" value="{{ $report->time }}" readOnly/>

                    <x-input name="patientName" type="input" label="Patient Name" value="{{ $report->patientName }}" readOnly/>
                    
                    @if($report->typeDescription === 'OBSTETRICS')
                        <x-input name="patientAge" type="input" label="Patient Age" value="{{ $report->age }}" readOnly/>
                        <x-input name="monthsPregnant" type="input"    label="Months Pregnant" value="{{ $report->monthsPregnant }}" readOnly/>
                        <x-input name="numberOfBirths" type="input" label="Number of Births" value="{{ $report->numberOfBirths }}" readOnly/>
                        <x-input name="prenatalCareLocation" type="input" label="Prenatal Care Location" value="{{ $report->prenatalCareLocation }}" readOnly/>
                    @else
                        <x-input name="shortnessOfBreath" type="input" label="Shortness of Breath" value="{{ $report->shortnessOfBreath }}" readOnly/>
                        <x-input name="paleness" type="input"    label="Paleness" value="{{ $report->paleness }}" readOnly/>
                        <x-input name="heartRate" type="input" label="Heart Rate (BPM)" value="{{ $report->heartRate }}" readOnly/>
                    @endif

                    <x-input name="incidentPlace" type="input" label="Place of Incident" value="{{ $report->incidentPlace }}" readOnly/>
                    <x-input name="landmark" type="input" label="Landmark" value="{{ $report->landmark }}" readOnly/>
                    <x-input name="numberOfCasualties" type="input"  label="Number of Casualties" value="{{ $report->numberOfCasualties }}" readOnly/>
                    <x-input name="numberOfBirths" type="input" label="Number of Births" value="{{ $report->numberOfBirths }}" readOnly/>
                    <x-input name="reporterFullName" type="input" label="Reporter Name" value="{{ $report->reporterFullName }}" readOnly/>
                    <x-input name="reporterContactNumber" type="input" label="Reporter Contact Number" value="{{ $report->reporterContactNumber }}" readOnly/>
                </div>
                
            </form>
            
        </div>
        <a href="{{ route('response_records.create', ['id' => $report->reportID]) }}" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i> Create Response Record</a>
    </div>
@endsection

@section('js')
@endsection