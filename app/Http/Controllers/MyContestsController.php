<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyContestsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show all own contests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('my_contests.index');
    }

    /**
     * Show the form for creating a new contest.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'navigation' => [
                'My Contests',
                'Create Contest',
            ]
        ];

        return view('my_contests.create', $data);
    }

    /**
     * Store a newly created contest.
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

        $portfolio = auth()->user()
                            ->contestPortfolios()
                            ->attach($contest, [
                                'approved' => true, 
                                'cash_amount' => $contest->contest_amount
                            ]);

        flash('Contest successfully created!', 'success');

        return redirect('mycontests');
    }

    /**
     * Display the specified contest.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $mycontest)
    {
        // Retrieve all contests that have at least one approved user..
        $mycontest->load('forApprovalContestUsers', 'approvedContestUsers');

        return view('my_contests.show', compact('mycontest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $mycontest)
    {
        $this->authorize('edit', $mycontest);

        $data = [
            'navigation' => [
                'Contests',
                'Edit Contest',
            ]
        ];

        return view('my_contests.edit', compact('data', 'mycontest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $mycontest)
    {
        // Only the creator can update his/here contest.
        $this->authorize('update', $mycontest);

        // validate all request
        $this->validate($request, [
            'name'           => 'required|unique:contests,id,'.$mycontest->id,
            'start_date'     => 'required|date',
            'end_date'       => 'required|date',
            'access_level'   => 'required',
            'contest_amount' => 'required|numeric',
            'max_amount'     => 'required|numeric',
            'max_member'     => 'required|numeric'
        ]);

        $mycontest->update([
            'name'           => $request->name,
            'start_date'     => Carbon::parse($request->start_date),
            'end_date'       => Carbon::parse($request->end_date),
            'access_level'   => $request->access_level,
            'contest_amount' => $request->contest_amount,
            'max_amount'     => $request->max_amount,
            'max_member'     => $request->max_member
        ]);

        flash('Contest successfully updated!', 'success');
        
        return redirect('mycontests');
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
