<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyAssistance extends Model
{
    public $timestamps = true;  
    
    protected $table = 'family_assistance';

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'suffix', 'birthdate', 'age', 'birthplace', 
        'gender', 'permanent_address', 'civil_status', 'religion', 'occupation', 'primary_contact_no', 
        'alternate_contact_no', 'mother_maiden_name', 'monthly_family_net_income', 'id_card_presented', 
        'id_card_number', 'is4PsBenef', 'isIP', 'ethnicity', 'region', 'province', 'district', 
        'city_municipality', 'barangay', 'evacuation_center', 'total_older_person', 'total_preg_women', 
        'total_lactating_women', 'total_PWD', 'house_ownership', 'shelter_damage'
    ];
}
