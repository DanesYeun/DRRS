<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\IncidentCase;
use App\Models\DisasterIR;
use App\Models\ObstetricsIR;
use App\Models\MedicalIR;
use App\Models\InjuryTraumaIR;
use App\Models\CardiaIR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class IncidentReportController extends Controller
{

    public function showAllReports()
    {
        $incidentReports = IncidentReport::with('incidentCase')->get();

        return view('pages.incident.view', compact('incidentReports'));
    }

    public function create(){

        $cases = map_options(IncidentCase::class, 'id', 'description');
        $disaster_types = map_options_raw('disaster_type', 'id', 'description');
 
        return view('pages.incident.add', compact('cases', 'disaster_types'));
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
                'time' => $request->time,
                'isConfirmed' => 0
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

                $medicalData = $request->medical;
                foreach($medicalData as $data){

                    MedicalIR::create([
                        'reportID' => $incidentReport->reportID, 
                        'fullName' => $data['full_name'],  
                        'shortnessOfBreath' => array_key_exists('shortness_breath', $data) ? 1 : 0 ,
                        'paleness' => array_key_exists('paleness', $data) ? 1 : 0,
                        'heartRate' => $data['heart_rate'],
                    ]);
                }
               
            }else if($case == 3){

                $injury_traumaData = $request->injury_trauma;
                foreach($injury_traumaData as $data){
                    InjuryTraumaIR::create([
                        'reportID' => $incidentReport->reportID, 
                        'fullName' => $data['full_name'],  
                        'shortnessOfBreath' => array_key_exists('shortness_breath', $data) ? 1 : 0 ,
                        'paleness' => array_key_exists('paleness', $data) ? 1 : 0,
                        'heartRate' => $data['heart_rate'],
                    ]);
                }
               
            }else if($case == 4){

                $cardiaData = $request->cardia;
                foreach($cardiaData as $data){
                    CardiaIR::create([
                        'reportID' => $incidentReport->reportID, 
                        'fullName' => $data['full_name'],  
                        'shortnessOfBreath' => array_key_exists('shortness_breath', $data) ? 1 : 0 ,
                        'paleness' => array_key_exists('paleness', $data) ? 1 : 0,
                        'heartRate' => $data['heart_rate'],
                    ]);
                }
               
            }else if($case == 5){

                if ($request->hasFile('disaster_image') && $request->file('disaster_image')->isValid()){

                    $request->validate([
                        'disaster_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', 
                    ]);
    
                    $file = $request->file('disaster_image');
                    $extension = $file->getClientOriginalExtension();
                    $formattedDateTime = Carbon::now()->format('Y-m-d_H-i-s');
    
                    // customized file name using date and reporter_name
                    $fileName = $formattedDateTime . '_' . $request->reporter_name . '.' . $extension;
    
                    $path = $file->storeAs('incident', $fileName, 'public');
                  
                }

                $coordinates = [$request->latitude, $request->longitude];
                
                DisasterIR::create([
                    'reportID' => $incidentReport->reportID, 
                    'photoPathFile' => $path,  
                    'description' => $request->description ,
                    'disasterTypeID' => $request->disaster_type,
                    'coordinates' => json_encode($coordinates),
                ]);

            }

            return redirect()->route('landingPage')->with('success', 'Incident report has been sent!');
            // return redirect()->back()->with('success', 'Successfully sent incident report!');

        }catch(\Exception $e){
            \Log::error('Error: '. $e->getMessage());
            return redirect()->back()->with('error', 'Oh no! An error occured.');
        }
    }

    // Deleteincident report
    public function delete($type, $id)
    {
        try{
           
            $incidentReport = IncidentReport::findOrFail($id);

            if($type == 1){ 

                $incidentReport->deleteObstetrics()->where('reportID', $id)->delete();
    
            }else if($type == 2){ 
                
                $incidentReport->deleteMedical()->where('reportID', $id)->delete();
    
            }else if($type == 3) {
    
                $incidentReport->deleteInjury_trauma()->where('reportID', $id)->delete();
    
            }else if($type == 4){
    
                $incidentReport->deleteCardia()->where('reportID', $id)->delete();
            }else if($type == 5){

                $incidentReport->deleteDisaster()->where('reportID', $id)->delete();

            }else{
                return back()->with('error', 'No data found');
            }

            $incidentReport->delete();

            return redirect()->back()->with('success', 'Incident report deleted successfully.');

        }catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


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
            
            }else if($type == 5){

                $incidentReport = IncidentReport::with(['disaster.disasterType'])->where('reportID', $id)->first();
 
            }else{
                return back()->with('error', 'No data found');
            }

            return view('pages.incident.details', compact('incidentReport'));
        }catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function confirmReport($id){

        try {
            $incident = IncidentReport::findOrFail($id);

            if($incident){
                $incident->update([
                    'isConfirmed' => 1
                ]);
            }else{
                return back()->with('error', 'No data found');
            }

            return redirect()->back()->with('success', 'The incident report has been successfully confirmed.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
}
