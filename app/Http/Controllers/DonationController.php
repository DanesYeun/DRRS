<?php

namespace App\Http\Controllers;

use App\Models\InKindDonation;
use App\Models\CashDonation;
use App\Models\DonationMode;
use App\Models\DonationCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DonationController extends Controller
{
    public function create(){

        $type = [
            ['id' => 1, 'name' => 'Cash'],
            ['id' => 2, 'name' => 'In-kind']
        ];

        $donation_mode = map_options(DonationMode::class, 'id', 'description');
        $categories = map_options(DonationCategory::class, 'id', 'description');

        return view ('pages.donation.add', compact('type', 'donation_mode', 'categories'));
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'contactno' => 'required|string|regex:/^[0-9]{10,11}$/',
            'donationMode' => 'required|integer', 
            'donation_type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with('error', implode('<br>', $validator->errors()->all()));
        }

        if(is_null($request->amount)){

            $validator = Validator::make($request->all(), [
                'category' => 'required|integer',
                'itemName' => 'required|string',
                'quantity' => 'nullable|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            InKindDonation::create($request->all());

            return redirect()->route('create.donation')->with('success', 'Successfully sent assistance request!');
        }

        CashDonation::create($request->all());

        return redirect()->route('create.donation')->with('success', 'Successfully sent assistance request!');
    }
}
