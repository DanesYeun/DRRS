<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $table = 'family_member';

    public $timestamps = false;  

    protected $fillable = [
        'family_head_id',
        'fullname',
        'relation',
        'birthdate',
        'age',
        'gender',
        'educational_attainment',
        'occupation',
        'remarks'
    ]; 
}
