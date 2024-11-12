<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsiousnessLevel extends Model
{
    protected $table = 'patient_care_consiousness_lvl'; 
    public $timestamps = false;

    protected $fillable = [
        'patientCareID', 'A', 'V', 'P', 'U'
    ];

    public function patientCareReport()
    {
        return $this->belongsTo(PatientCareReport::class, 'patientCareID');
    }
}
