<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PollingUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve data using a join query
        $lgas = DB::table('polling_unit')
                    ->join('announced_pu_results', 'polling_unit.uniqueid', '=', 'announced_pu_results.polling_unit_uniqueid')
                    ->select('polling_unit.lga_id', 'announced_pu_results.polling_unit_uniqueid', DB::raw('SUM(announced_pu_results.party_score) as total_score'))
                    ->groupBy('polling_unit.lga_id', 'announced_pu_results.polling_unit_uniqueid')
                    ->orderBy('announced_pu_results.polling_unit_uniqueid')
                    ->get();

        // Pass the data to the view
        return view('polling_unit.index', ['lgas' => $lgas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve party data from the database
        $parties = DB::table('party')->get();
        $nextUniqueId = DB::table('polling_unit')->max('uniqueid') + 1;

        // Return the view for the form
        return view('polling_unit.create', [
            'nextUniqueId' => $nextUniqueId,
            'parties' => $parties
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'polling_unit_uniqueid' => 'required|unique:announced_pu_results,polling_unit_uniqueid',
            'party' => 'required|array',
            'party.*.party_score' => 'required|numeric',
        ]);
    
        $enteredByUser = 'Chigbu Joshua';
        $dateEntered = now();
        $userIpAddress = '192.168.1.101';
    
        // Retrieve party data from the database
        $parties = DB::table('party')->pluck('partyname', 'id')->toArray();
        
        // Store the results for all parties in the database
        foreach ($request->input('party') as $partyId => $partyData) {
            // Get the party abbreviation from the parties array using the party ID max=4 chars
            $partyAbbreviation = substr($parties[$partyId], 0, 4);

            DB::table('announced_pu_results')->insert([
                'polling_unit_uniqueid' => $request->input('polling_unit_uniqueid'),
                'party_abbreviation' => $partyAbbreviation,
                'party_score' => $partyData['party_score'],
                'entered_by_user' => $enteredByUser,
                'date_entered' => $dateEntered,
                'user_ip_address' => $userIpAddress,
            ]);
        }

        // Insert a new row into the polling_unit table
        DB::table('polling_unit')->insert([
            'uniqueid' => $request->input('polling_unit_uniqueid'),
            'polling_unit_id' => 0,
            'ward_id' => 0,
            'lga_id' => 0,
            'uniquewardid' => 0,
        ]);
    
        // Redirect the user to a success page or back to the form
        return redirect()->route('polling-unit.create')->with('success', 'Results stored successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve the result of the individual polling unit from the database
        $result = DB::table('announced_pu_results')
                    ->where('polling_unit_uniqueid', $id)
                    ->get();
        // Calculate the sum of party scores
        $totalScore = $result->sum('party_score');

        // Pass the result and total score to the view
        return view('polling_unit.show', [
            'result' => $result,
            'totalScore' => $totalScore
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
