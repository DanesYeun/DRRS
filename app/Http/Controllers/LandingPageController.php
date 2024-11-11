<?php

namespace App\Http\Controllers;

use App\Models\Hazard;
use App\Models\Shelter;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $hazards = Hazard::where('hazardStatus', 1)->get();
        $shelters = Shelter::all();

        return view('pages.landingPage.view', compact('hazards', 'shelters'));
    }
}
