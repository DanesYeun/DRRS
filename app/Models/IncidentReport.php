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
        return $this->belongsTo(ObstetricsIR::class, 'typeOfIncident', 'id');
    }

    public function medical()
    {
        return $this->belongsTo(MedicalIR::class, 'typeOfIncident', 'id');
    }

    public function injury_trauma()
    {
        return $this->belongsTo(InjuryTraumaIR::class, 'typeOfIncident', 'id');
    }

    public function cardia()
    {
        return $this->belongsTo(CardiaIR::class, 'typeOfIncident', 'id');
    }

    public function disaster()
    {
        // return $this->belongsTo(DisasterIr::class, 'typeOfIncident', 'id');
    }


}
