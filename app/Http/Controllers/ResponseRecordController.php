<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\ResponseRecord;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF;

class ResponseRecordController extends Controller
{
    public function index()
    {
        $responseRecords = ResponseRecord::all();

        return view('pages.responseRecords.view', compact('responseRecords'));
    }
  
    public function create()
    {
        $locations = [
            ['id' => 1, 'name' => 'location 1'],
            ['id' => 2, 'name' => 'location 2'],
        ];
        $cases = map_options(Cases::class, 'id', 'description');
        $genders = map_options(Gender::class, 'id', 'description');

        return view('pages.responseRecords.add', compact('locations', 'cases', 'genders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'nullable|string|max:50',
            'incidentFrom' => 'required|string|max:50',
            'takenTo' => 'nullable|string|max:50',
            'callerOrReporter' => 'nullable|integer|max:50',
            'patientName' => 'required|string|max:50',
            'patientAge' => 'nullable|integer',
            'patientAddress' => 'nullable|string|max:50',
            'patientCase' => 'required|string|max:50',
            'patientGender' => 'required|string|max:50',
            'responders' => 'required|string|max:50',
            'actionTaken' => 'nullable|string|max:50',
            'remarks' => 'nullable|string|max:50',
        ]);

        ResponseRecord::create($request->all());

        return redirect()->route('response_records.index')->with('success', 'Response Record created successfully.');
    }

    //display specific record
    public function edit($id)
    {
        $record = ResponseRecord::findOrFail($id);

        $locations = [
            ['id' => 1, 'name' => 'location 1'],
            ['id' => 2, 'name' => 'location 2'],
        ];
        $cases = map_options(Cases::class, 'id', 'description');
        $genders = map_options(Gender::class, 'id', 'description');

        return view('pages.responseRecords.edit', compact('record', 'locations', 'cases', 'genders'));
    }

    //update record
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string|max:50',
            'incidentFrom' => 'required|string|max:50',
            'takenTo' => 'required|string|max:50',
            'callerOrReporter' => 'required|string|max:50',
            'patientName' => 'required|string|max:50',
            'patientAge' => 'required|integer',
            'patientAddress' => 'required|string|max:50',
            'patientCase' => 'required|string|max:50',
            'patientGender' => 'required|string|max:50',
            'responders' => 'required|string|max:50',
            'actionTaken' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:50',
        ]);

        $record = ResponseRecord::findOrFail($id);
        $record->update($request->all());

        return redirect()->route('response_records.index')->with('success', 'Response Record updated successfully.');
    }

    //download the specified response record as a file (PDF).
    public function download($id)
    {
        $record = ResponseRecord::findOrFail($id);
        
        $pdf = app('dompdf.wrapper')->loadView('response_records.pdf', compact('record'));

        return $pdf->download("response_record_{$id}.pdf");
    }

    //generate  monthly incident report.
    public function generateMonthlyReport(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $month = $request->month;
        $records = ResponseRecord::whereYear('date', substr($month, 0, 4))
                                   ->whereMonth('date', substr($month, 5, 2))
                                   ->get();

        $pdf = app('dompdf.wrapper')->loadView('response_records.monthly_report', compact('records', 'month'));

        return $pdf->download("monthly_incident_report_{$month}.pdf");
    }
}
