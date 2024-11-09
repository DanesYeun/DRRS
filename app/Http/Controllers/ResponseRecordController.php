<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResponseRecord;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF;

class ResponseRecordController extends Controller
{
    public function index()
    {
        $responseRecords = ResponseRecord::all();

        return view('response_records.index', compact('responseRecords'));
    }
  
    public function create()
    {
        return view('response_records.create');
    }

    public function store(Request $request)
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

        ResponseRecord::create($request->all());

        return redirect()->route('response_records.index')->with('success', 'Response Record created successfully.');
    }

    //display specific record
    public function edit($id)
    {
        $record = ResponseRecord::findOrFail($id);
        return view('response_records.edit', compact('record'));
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
