<?php

namespace App\Http\Controllers;

use App\Models\CashDonation;
use App\Models\InKindDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecretaryController extends Controller
{
    public function index(){
        
        $donation_mode = map_options_raw('donation_mode', 'id', 'description');
        $categories = map_options_raw('donation_category', 'id', 'description');

        $type = [
            ['id' => 1, 'name' => 'Cash'],
            ['id' => 2, 'name' => 'In-kind']
        ];

        $cashDonations = CashDonation::get_data();
        $inkindDonations = InKindDonation::get_data();
                            
        // dd($inkindDonations, $cashDonations);
        return view('pages.secretary.index', compact('type', 'donation_mode', 'categories', 'cashDonations', 'inkindDonations'));
    }

    public function view($type, $id){
        
        $data = $type == 1 ? CashDonation::get_data($id) : InKindDonation::get_data($id);

        $donation = $data[0];
        // dd($donation);
        return view('pages.donation.view_donation', compact('donation', 'type'));
    }
}
