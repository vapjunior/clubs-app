<?php

namespace App\Http\Controllers;

use App\Club;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::orderBy('name','asc')->get();

        return view('clubs.index', ['clubs' => $clubs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        Club::create($data);

        $clubs = Club::orderBy('name','asc')->get();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        $affiliates = array();
        foreach($club->associations as $association) {
            $association->affiliate['associeted'] = $association->associeted;
            $affiliates[] = $association->affiliate;
        }

        $affiliates = collect($affiliates)->sortBy('name');

        return view('clubs.show', ['club' => $club, 'affiliates' => $affiliates]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        $club->delete();

        return redirect('/');
    }
}
