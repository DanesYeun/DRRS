<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\IncidentCase;
use App\Models\ResponseRecord;
use App\Models\ObstetricsIR;
use App\Models\MedicalIR;
use App\Models\InjuryTraumaIR;
use App\Models\CardiaIR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentReportController extends Controller
{

    public function showAllReports()
    {
        $incidentReports = IncidentReport::with('incidentCase')->get();

        return view('pages.incident.view', compact('incidentReports'));
    }

    public function create(){

        $cases = map_options(IncidentCase::class, 'id', 'description');

        return view('pages.incident.add', compact('cases'));
    }

    public function store(Request $request){

        try{
            $case = $request->incident_type;

            $incidentReport = IncidentReport::create([
                'typeOfIncident' => $case,
                'incidentPlace' => $request->place,
                'landmark' => $request->landmark,
                'numberOfCasualties'=> $request->number_casualties,
                'reporterFullName' =>$request->reporter_name,
                'reporterContactNumber'=> $request->reporter_contactno,
                'date' => $request->date,
                'time' => $request->time
            ]);

            if($case == 1){

                ObstetricsIR::create([
                    'reportID' => $incidentReport->reportID,
                    'fullName' => $request->obstetrics_full_name,
                    'age' => $request->obstetrics_age,
                    'monthsPregnant' => $request->obstetrics_months_pregnant,
                    'numberOfBirths' => $request->obstetrics_number_births,
                    'prenatalCareLocation' => $request->obstetrics_prenatal_care_location,
                ]);
            } else if($case == 2){

                MedicalIR::create([
                    'reportID' => $incidentReport->reportID, 
                    'fullName' => $request->medical_full_name,  
                    'shortnessOfBreath' => $request->medical_shortness_breath ,
                    'paleness' => $request->medical_paleness,
                    'heartRate' => $request->medical_heart_rate,
                ]);
            }else if($case == 3){

                InjuryTraumaIR::create([
                    'reportID' => $incidentReport->reportID, 
                    'fullName' => $request->injury_trauma_full_name,  
                    'shortnessOfBreath' => $request->injury_trauma_shortness_breath ,
                    'paleness' => $request->injury_trauma_paleness,
                    'heartRate' => $request->injury_trauma_heart_rate,
                ]);
            }else if($case == 4){

                CardiaIR::create([
                    'reportID' => $incidentReport->reportID, 
                    'fullName' => $request->cardia_full_name,  
                    'shortnessOfBreath' => $request->cardia_shortness_breath ,
                    'paleness' => $request->cardia_paleness,
                    'heartRate' => $request->cardia_heart_rate,
                ]);
            }

            return redirect()->route('landingPage')->with('success', 'Successfully sent incident report!');
            // return redirect()->back()->with('success', 'Successfully sent incident report!');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Deleteincident report
    public function delete($id)
    {
        $incidentReport = IncidentReport::findOrFail($id);
        
        $incidentReport->deleteObstetrics()->delete();
        $incidentReport->deleteMedical()->delete();
        $incidentReport->deleteInjury_trauma()->delete();
        $incidentReport->deleteCardia()->delete();

        // Delete the main incident report
        $incidentReport->delete();

        return back()->with('success', 'Incident report deleted successfully.');
    }

   // display a specific incident report
    public function showReport($type, $id)
    {
        try{
            if($type == 1){ 

                $incidentReport = IncidentReport::with('obstetrics')->where('reportID', $id)->get()[0];
    
            }else if($type == 2){ 
                
                $incidentReport = IncidentReport::with('medical')->where('reportID', $id)->get()[0];
    
            }else if($type == 3) {
    
                $incidentReport = IncidentReport::with('injury_trauma')->where('reportID', $id)->get()[0];
    
            }else if($type == 4){
    
                $incidentReport = IncidentReport::with('cardia')->where('reportID', $id)->get()[0];
            }else{
                return back()->with('error', 'No data found');
            }

            return view('pages.incident.details', compact('incidentReport'));
        }catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
