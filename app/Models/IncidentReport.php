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

    // One-to-many relationship with ResponseRecord
    public function responses()
    {
        return $this->hasMany(ResponseRecord::class, 'reportID');
    }
}
