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
        
        try{
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
                    return back()->with('error', implode('<br>', $validator->errors()->all()));
                }
    
                InKindDonation::create([
                    'fullname' => $request->fullname, 
                    'contactno' => $request->contactno, 
                    'donationMode' => $request->donationMode, 
                    'category' => $request->category, 
                    'itemName' => $request->itemName, 
                    'quantity' => $request->quantity, 
                    'isPickUp' => 0
                ]);
    
                return redirect()->route('create.donation')->with('success', 'Successfully sent assistance request!');
            }
    
            CashDonation::create([
                'fullname' => $request->fullname, 
                'contactno' => $request->contactno, 
                'donationMode' => $request->donationMode, 
                'amount' => $request->amount, 
                'isPickUp' => 0 
            ]);
    
            return redirect()->route('create.donation')->with('success', 'Successfully sent assistance request!');

        }catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index(){
        
        try {
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

        }catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($type, $id){
        
        $data = $type == 1 ? CashDonation::get_data($id) : InKindDonation::get_data($id);

        $donation = $data ?? $data[0];

        return view('pages.donation.view_donation', compact('donation', 'type'));
    }

    public function pickup_donation($type, $id){
        
        try{
            $data = $type == 1 ?  CashDonation::find($id) : InKindDonation::find($id);

            $data->update([
                'isPickUp' => 1
            ]);

            return redirect()->route('donations')->with('success', 'Donation pickup successfully confirmed.');

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function print_donation_report($type, $id){
        $data = $type == 1 ? CashDonation::get_data($id) : InKindDonation::get_data($id);
        $datas = $data[0];
        // dd($datas);
        $pdf = app('dompdf.wrapper')->loadView('pages.donation.donation_report', compact('datas'))
                ->setPaper('A5', 'portrait');;

        // Download the generated PDF
        return $pdf->download('invoice_' . $datas['fullname'] . '.pdf');
    }
}
