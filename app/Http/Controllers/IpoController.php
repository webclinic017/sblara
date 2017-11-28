<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ipo;

class IpoController extends Controller
{
    public function upcoming()
    {
        // dd(Ipo::first());
        return view('ipo.upcoming');
    }

    public function index(Request $request)
    {
        if($request->has('draw'))
        {
            return $this->datatable($request);
        }
        return view('ipo.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ipo $ipo)
    {
        $ipo->delete();
    }

    public function history(Request $request)
    {
        $year = $request->has('year')?$request->year:2017;
        return view('ipo.history')
                ->with(compact('year'));
    }

    public function results(Request $request)
    {
        $year = $request->has('year')?$request->year:2017;
        return view('ipo.results')
                ->with(compact('year'));
    }

    public function datatable(Request $request)
    {
        $ipos = Ipo::all();
        return datatables()->of($ipos)->make();
    }
}
