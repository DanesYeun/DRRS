<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\ResponseRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentReportController extends Controller
{

    public function showAllReports()
    {
        $incidentReports = IncidentReport::all();

        return view('incidentReports.index', compact('incidentReports'));
    }

    // Deleteincident report
    public function delete($id)
    {
        $incidentReport = IncidentReport::findOrFail($id);
        $incidentReport->delete();

        return response()->json(['message' => 'Incident report deleted successfully.']);
    }

   // display a specific incident report
    public function showReport(Request $request, $id)
    {
       
        $incidentReport = IncidentReport::find($id);

        if (!$incidentReport) {
            return response()->json(['error' => 'Incident report not found'], 404);
        }

        return view('incidentReports.show', compact('incidentReport'));
    }
}
