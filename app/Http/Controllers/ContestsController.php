<?php

namespace App\Http\Controllers;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'navigation' => [
                'List of Contest'
            ]
        ];

        return view('contests.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'navigation' => [
                'Contests',
                'Create Contest',
            ]
        ];

        return view('contests.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate all request
        $this->validate($request, [
            'name'           => 'required|unique:contests',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date',
            'access_level'   => 'required',
            'contest_amount' => 'required|numeric',
            'max_amount'     => 'required|numeric',
            'max_member'     => 'required|numeric'
        ]);
        
        // create contest
        $contest = auth()->user()->contests()->create([
            'name'           => $request->name,
            'start_date'     => Carbon::parse($request->start_date),
            'end_date'       => Carbon::parse($request->end_date),
            'access_level'   => $request->access_level,
            'contest_amount' => $request->contest_amount,
            'max_amount'     => $request->max_amount,
            'max_member'     => $request->max_member
        ]);

        return redirect()->route('contests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
