<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCareReport extends Model
{
    use HasFactory;

    protected $table = 'patient_care_reports'; 

    protected $primaryKey = 'patientCareID';


    protected $fillable = [
        'patientName',
        'patientAddress',
        'patientAge',
        'patientGender',
        'case',
        'others',
        'recordedBy',
        'recievedBy',
        'time',
        'incidentPlace',
        'contactNumber',
        'patientContactPerson'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'patientGender');
    }

    public function patientCareCase()
    {
        return $this->belongsTo(PatientCareCase::class, 'case');
    }

    public function consiousnessLevel()
    {
        return $this->hasOne(ConsiousnessLevel::class, 'patientCareID');
    }

    public function sampleHistory()
    {
        return $this->hasOne(SampleHistory::class, 'patientCareID');
    }

    public function painAssessment()
    {
        return $this->hasOne(PainAssessment::class, 'patientCareID');
    }

    public function injuryDtl()
    {
        return $this->hasOne(InjuryDtl::class, 'patientCareID');
    }

    public function dcapbtls()
    {
        return $this->hasOne(DCAPBLTS::class, 'patientCareID');
    }

    public function spotStroke()
    {
        return $this->hasOne(SpotStroke::class, 'patientCareID');
    }

    public function vitals()
    {
        return $this->hasOne(Vitals::class, 'patientCareID');
    }
}
