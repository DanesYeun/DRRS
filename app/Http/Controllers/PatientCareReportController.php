<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientCare;

class PatientCareController extends Controller
{

    public function index()
    {
        $patientCares = PatientCare::all();
        return view('patient_care.index', compact('patientCares'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patientName' => 'required|string|max:50',
            'patientAddress' => 'required|string|max:50',
            'patientAge' => 'required|integer',
            'patientGender' => 'required|string|max:50',
            'patientCase' => 'required|integer',
            'significantOtherOrPersonToBeContacted' => 'required|string|max:50',
            'contactNumber' => 'required|string|max:50',
            'incidentPlace' => 'required|string|max:50',
            'incidentTime' => 'required|string|max:50',
            'date' => 'required|date'
        ]);

        PatientCare::create($request->all());

        return redirect()->route('patient_care.index')->with('success', 'Patient care report created successfully.');
    }

    // displayspecific patient care report
    public function show($id)
    {
        $patientCare = PatientCare::findOrFail($id);
        return view('patient_care.show', compact('patientCare'));
    }
}
