<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    use HasFactory;

    protected $table = 'incident_reports';

    protected $primaryKey = 'reportID';

    public $timestamps = false;

    protected $fillable = [
        'typeOfIncident',
        'incidentPlace',
        'landmark',
        'numberOfCasualties',
        'reporterFullName',
        'reporterContactNumber',
        'date',
        'time'
    ];

    public function incidentCase()
    {
        return $this->belongsTo(IncidentCase::class, 'typeOfIncident', 'id');
    }

    public function obstetrics()
    {
        return $this->belongsTo(ObstetricsIR::class, 'reportID', 'reportID');
    }

    public function medical()
    {
        return $this->belongsTo(MedicalIR::class, 'reportID', 'reportID');
    }

    public function injury_trauma()
    {
        return $this->belongsTo(InjuryTraumaIR::class, 'reportID', 'reportID');
    }

    public function cardia()
    {
        return $this->belongsTo(CardiaIR::class, 'reportID', 'reportID');
    }

    public function disaster()
    {
        // return $this->belongsTo(DisasterIr::class, 'reportID', 'id');
    }

    

    public function deleteObstetrics()
    {
        return $this->hasOne(ObstetricsIR::class, 'reportID', 'reportID');
    }

    public function deleteMedical()
    {
        return $this->hasOne(MedicalIR::class, 'reportID', 'reportID');
    }

    public function deleteInjury_trauma()
    {
        return $this->hasOne(InjuryTraumaIR::class, 'reportID', 'reportID');
    }

    public function deleteCardia()
    {
        return $this->hasOne(CardiaIR::class, 'reportID', 'reportID');
    }


}
