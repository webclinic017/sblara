<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ipo;
use App\Attachment;
use Carbon\Carbon;

class IpoController extends Controller
{
    public function upcoming()
    {
        $ipos = Ipo::whereDate('subscription_close', '>=', date('Y-m-d'));
        return view('ipo.upcoming')->with(compact('ipos'));
               
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
        $ipo = new Ipo();
        $ipo->year                      = $request->year;
        $ipo->ipo_name                  = $request->ipo_name;
        $ipo->short_name                = $request->short_name;
        $ipo->subscription_open         = date("Y-m-d", strtotime($request->subscription_open));
        $ipo->subscription_close        = date("Y-m-d", strtotime($request->subscription_close));
        $ipo->nature_of_business        = $request->nature_of_business;
        $ipo->major_product             = $request->major_product;
        $ipo->use_of_ipo_proceeds       = $request->use_of_ipo_proceeds;
        $ipo->issue_manager             = $request->issue_manager;
        $ipo->proposed_share            = $request->proposed_share;
        $ipo->share_price               = $request->share_price;
        $ipo->premium_per_share         = $request->premium_per_share;
        $ipo->lot                       = $request->lot;
        $ipo->eps                       = $request->eps;
        $ipo->revaluation_reserve       = $request->revaluation_reserve;
        $ipo->w_revaluation_reserve     = $request->w_revaluation_reserve;
        $ipo->logo                      = $request->logo;       
        $ipo->distribution_locations    = $request->distribution_locations;
        $ipo->webaddress                = $request->webaddress;
        $ipo->address1                  = $request->address1;
        $ipo->address2                  = $request->address2;
        $ipo->address3                  = $request->address3;
        $ipo->form_address_to           = $request->form_address_to;
        $ipo->amount_in_words           = $request->amount_in_words;
        $ipo->save();
        $ipo->storeAttachments($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ipo $ipo)
    {
        if($request->ajax())
        {
            $ipo->attachments = $ipo->attachments;
            return $ipo;
        }
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
    public function update(Request $request, Ipo $id)
    {    
        $ipo->year                      = $request->year;
        $ipo->ipo_name                  = $request->ipo_name;
        $ipo->short_name                = $request->short_name;
        $ipo->subscription_open         = $request->subscription_open;
        $ipo->subscription_close        = $request->subscription_close;
        $ipo->nature_of_business        = $request->nature_of_business;
        $ipo->major_product             = $request->major_product;
        $ipo->use_of_ipo_proceeds       = $request->use_of_ipo_proceeds;
        $ipo->issue_manager             = $request->issue_manager;
        $ipo->proposed_share            = $request->proposed_share;
        $ipo->share_price               = $request->share_price;
        $ipo->premium_per_share         = $request->premium_per_share;
        $ipo->lot                       = $request->lot;
        $ipo->eps                       = $request->eps;
        $ipo->revaluation_reserve       = $request->revaluation_reserve;
        $ipo->w_revaluation_reserve     = $request->w_revaluation_reserve;
        $ipo->logo                      = $request->logo;
        $ipo->bank_list                 = $request->bank_list;
        $ipo->nrb_form                  = $request->nrb_form;
        $ipo->bank_code                 = $request->bank_code;
        $ipo->result_general            = $request->result_general;
        $ipo->result_nrb                = $request->result_nrb;
        $ipo->result_mutual_fund        = $request->result_mutual_fund;
        $ipo->result_affected_users     = $request->result_affected_users;
        $ipo->distribution_locations    = $request->distribution_locations;
        $ipo->webaddress                = $request->webaddress;
        $ipo->address1                  = $request->address1;
        $ipo->address2                  = $request->address2;
        $ipo->address3                  = $request->address3;
        $ipo->form_address_to           = $request->form_address_to;
        $ipo->amount_in_words           = $request->amount_in_words;
        $ipo->result_published          = $request->result_published;
        $ipo->alert_marker              = $request->alert_marker;
        dd($ipo);
        $ipo->save();
        return redirect('/admin/ipos')->with('message', 'IPOS info Save Successfully!');
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
        $ipos = Ipo::where('year', $year)->get();
        return view('ipo.history')
                ->with(compact('year', 'ipos'));
    }

    public function results(Request $request)
    {
        $year = $request->has('year')?$request->year:2017;
        $ipos = Ipo::where('year', $year)->get();
        return view('ipo.results')
                ->with(compact('year','ipos'));
    }

    public function datatable(Request $request)
    {
        $ipos = Ipo::orderby('id', 'desc');
        return datatables()->of($ipos)->make();
    }
}
