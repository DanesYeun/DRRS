<?php

namespace App\Http\Controllers;

use App\Models\Hazard;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
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
            if ($timeDifference <= 90) {
                $hazardAlert = true;
            }
            
        }
        return view('pages.home.view', compact('hazards', 'shelters', 'latestHazard', 'hazardAlert'));
    }
}
