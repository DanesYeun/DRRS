<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InKindDonation extends Model
{
    protected $table = 'inkind_donations';

    protected $primaryKey = 'donationID';

    public $timestamps = true;

    protected $fillable = [
        'fullname',
        'category',
        'itemName',
        'quantity',
        'contactno',
        'donationMode',
        'isPickUp'
    ];

    public static function  get_data($id = null){

        $query = InKindDonation::leftJoin('donation_mode', 'inkind_donations.donationMode', '=', 'donation_mode.id')
                ->leftJoin('donation_category', 'inkind_donations.category', '=', 'donation_category.id')
                ->select('inkind_donations.*', 'donation_mode.description as donationModeDesc', 'donation_category.description as categoryDesc');
        
        if (!is_null($id)) {
            $query->where('inkind_donations.donationID', $id);
        }
    
        return $query->get()->toArray();
        
    }
}
