<?php

namespace App\Http\Controllers;

use App\Models\Hazard;
use App\Models\Shelter;
use Illuminate\Http\Request;

class HazardMapController extends Controller
{
    public function index()
    {
        $hazards = Hazard::all();
        $shelters = Shelter::all();

        return view('pages.hazardMap.view', compact('hazards', 'shelters'));
    }

    public function create()
    {

        return view('pages.hazardMap.add');
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validation = $request->validate([
            'hazardName' => 'required|string|max:255',
            'coordinates' => 'required|string|min:1',
        ]);
 
        // Create the danger zone
        $zone = Hazard::create([
            'hazardName' => $request->hazardName,
            'hazardStatus' => 1,
            'coordinates' => json_encode($request->coordinates),
        ]);

        return redirect()->intended(route('map'));   
    }

    public function shelterIndex()
    {
        return view('pages.hazardMap.add-shelter');
    }

    public function shelterStore(Request $request)
    {
        // Validate incoming data
        $validation = $request->validate([
            'shelterName' => 'required|string|max:255',
            'shelterCoordinates' => 'required|string|min:1',
        ]);
 
        // Create the danger zone
        $zone = Shelter::create([
            'shelterName' => $request->shelterName,
            'shelterCoordinates' => json_encode($request->shelterCoordinates),
        ]);

        return redirect()->intended(route('map'));   
    }

    public function view()
    {
        $hazards = Hazard::all();
        return view('pages.hazardMap.viewSheltersHazards', compact('hazards'));
    }
}
