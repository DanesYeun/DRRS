<?php

namespace App\Http\Controllers;

use App\Models\Hazard;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        $hazards = Hazard::where('hazardStatus', 1)->get();
        $shelters = Shelter::all();

        $latestHazard = Hazard::latest()->first();

        $hazardAlert = false;
        if ($latestHazard) {
            $hazardTime = Carbon::parse($latestHazard->created_at);
            $timeDifference = $hazardTime->diffInMinutes(Carbon::now());

            // Check if the time difference < 1 hour and 30 mins
            if ($timeDifference <= 90) {
                $showAlert = true;
            }
        }

        return view('pages.landingPage.view', compact('hazards', 'shelters', 'latestHazard', 'hazardAlert'));
    }
}
