<?php

namespace App\Http\Controllers;

use App\Models\Hazard;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HazardMapController extends Controller
{
    public function index()
    {
        $hazards = Hazard::where('hazardStatus', 1)->get();
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
        $validator = Validator::make($request->all(),[
            'hazardName' => 'required|string|max:255',
            'coordinates' => 'required|string|min:1',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error', 'Oh no! An error occured.');
        }
 
        // Create the danger zone
        $zone = Hazard::create([
            'hazardName' => $request->hazardName,
            'hazardStatus' => 1,
            'coordinates' => $request->coordinates,
        ]);

        return redirect()->intended(route('hazard_map.index'));   
    }

    public function edit($id)
    {
        $hazard = Hazard::findOrFail($id);

        if($hazard)
        {
            return view('pages.hazardMap.editHazard', compact('hazard'));
        }

        return redirect()->back()->with('error', 'Hazard doesn\'t exist');
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validation = $request->validate([
            'hazardName' => 'required|string|max:255',
            'coordinates' => 'required|string|min:1',
        ]);

        $hazard = Hazard::findOrFail($id);
        $hazard->update($request->all());

        return redirect()->route('hazard_map.shelter');
    }

    public function updateHazardStatus(Request $request, $id)
    {
        $hazard = Hazard::findOrFail($id);

        if(!$hazard)
        {   
            return redirect()->back()->with('error', 'Hazard doesn\'t exist');
        }

        $hazard->update([
            'hazardStatus' => 2,
        ]);

        return redirect()->route('hazard_map.shelter')->with('success','Hazard status is set to inactive!');
    }
    public function shelterCreate()
    {
        return view('pages.hazardMap.add-shelter');
    }

    public function shelter_edit(Request $request, $id)
    {
        $shelter = Shelter::findOrFail($id);

        if (!$shelter)
        {
            return redirect()->back()->with('error', 'Shelter not found!');
        }

        return view('pages.hazardMap.edit-shelter', compact('shelter'));
    }

    public function shelter_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'shelterName' => 'nullable|string',
            'shelterCoordinates' => 'nullable|string'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('error', 'Oh no! An error occured.');
        }

        $shelter = Shelter::findOrFail($id);

        if (!$shelter)
        {
            return redirect()->back()->with('error', 'Shelter not found!');
        }

        $shelter->update($request->all());

        return redirect()->route('hazard_map.shelter')->with('success', 'Shelter was updated!');
    }

    public function shelterStore(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(),[
            'shelterName' => 'required|string|max:255',
            'shelterCoordinates' => 'required|string|min:1',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error', 'Oh no! An error occured.');
        }
 
        // Create the danger zone
        $shelter = Shelter::create([
            'shelterName' => $request->shelterName,
            'shelterCoordinates' => $request->shelterCoordinates,
        ]);

        return redirect()->intended(route('hazard_map.index'));   
    }

    public function shelterDelete($id)
    {
        $shelter = Shelter::findOrFail($id);

        if(!$shelter)
        {
            return redirect()->back()->with('error', 'Shelter does not exist');
        }

        $shelter->delete();
        
        return redirect()->back()->with('success', 'Shelter has been removed!.');
    }

    public function view()
    {
        $hazards = Hazard::all();
        $shelters = Shelter::all();

        return view('pages.hazardMap.viewSheltersHazards', compact('hazards', 'shelters'));
    }
}
