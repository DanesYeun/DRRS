<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCare extends Model
{
    use HasFactory;

    protected $table = 'patient_care_report'; 

    protected $primaryKey = 'patientCareID';

    public $timestamps = false;

    protected $fillable = [
        'patientName',
        'patientAddress',
        'patientAge',
        'patientGender',
        'patientCase',
        'significantOtherOrPersonToBeContacted',
        'contactNumber',
        'incidentPlace',
        'incidentTime',
        'vitalSign_BP',
        'vitalSign_TEMP',
        'vitalSign_HR',
        'vitalSign_SPo2',
        'vitalSign_RR',
        'date'

    ];
}
