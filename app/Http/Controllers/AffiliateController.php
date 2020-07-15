<?php

namespace App\Http\Controllers;

use App\Affiliates;
use App\Club;
use App\Association;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // AJAX REQUEST
    public function autoCompleteAffiliates(Request $request) {

        $search = $request->search;
        // return response()->json($search);

        if($search == '') {
            $affiliates = Affiliates::orderBy('name','asc')->select('name')->limit(5)->get();
        } else {
            $affiliates = Affiliates::orderby('name','asc')->select('name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($affiliates as $affiliate){
            $response[] = array("label"=>$affiliate->name);
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Club $club)
    {
        // dd($request->all(), $club);
        $data = $request->all();
        $affiliate = Affiliates::where('name',$data['name'])->first();
        // dd($affiliate);
        if( !$affiliate || $affiliate->count() ===0 ){
            // dd('Novo');
            $affiliate = Affiliates::create($data);
        }   
        // dd($affiliate);
        $association['affiliate_id'] = $affiliate->id;
        $association['club_id'] = $club->id;
        $today = Carbon::now('America/Sao_Paulo');
        $association['associeted'] = date_format($today, 'Y-m-d');

        Association::create($association);

        return redirect(route('clubs.show', $club->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affiliates  $affiliates
     * @return \Illuminate\Http\Response
     */
    public function show(Affiliates $affiliates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affiliates  $affiliates
     * @return \Illuminate\Http\Response
     */
    public function edit(Affiliates $affiliates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affiliates  $affiliates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affiliates $affiliates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affiliates  $affiliates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affiliates $affiliates, Club $club)
    {
        $association = Association::where('affiliate_id',$affiliates->id)->where('club_id',$club->id);
        $association->delete();

        return redirect(route('clubs.show', $club->id));
    }
}
