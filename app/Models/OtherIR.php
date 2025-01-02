<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherIR extends Model
{
    protected $table = 'other_ir';

    
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'reportID',
        'fullName',
        'shortnessOfBreath',
        'paleness',
        'heartRate',
    ];

    public function incidentReports()
    {
        return $this->hasMany(IncidentReport::class, 'reportID', 'reportID');
    }
}
