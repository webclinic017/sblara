<?php

namespace App\Http\Controllers;

use App\Repositories\FundamentalRepository;
use Illuminate\Http\Request;

class DataExtractController extends Controller
{
    public function sharePercentage()
    {
    	$query = "
			SELECT instruments.instrument_code, instruments.sector_list_id, fundamental.*, dse_share_percentage.* FROM instruments

			LEFT JOIN

			(select *,
				max(case when meta_key = 'total_no_securities' then  meta_value end) total_no_securities ,
				max(case when meta_key = 'share_percentage_director' then meta_value end) share_percentage_director  ,
				max(case when meta_key = 'share_percentage_govt' then meta_value end) share_percentage_govt  ,
				max(case when meta_key = 'share_percentage_institute' then meta_value end) share_percentage_institute  ,
				max(case when meta_key = 'share_percentage_foreign' then meta_value end) share_percentage_foreign  ,
				max(case when meta_key = 'share_percentage_public' then meta_value end) share_percentage_public  ,
				max(case when meta_key = 'net_asset_val_per_share' then meta_value end) net_asset_val_per_share  ,
				max(case when meta_key = 'paid_up_capital' then meta_value end) paid_up_capital,
				max(case when meta_key = 'authorized_capital' then meta_value end) authorized_capital  ,
				max(case when meta_key = 'last_agm_held_for_the_year' then meta_value end) last_agm_held_for_the_year,  
				max(case when meta_key = 'reserve_and_surp' then meta_value end) reserve_and_surp 
				from
				 (SELECT meta_key, meta_id, meta_value, instrument_id FROM `fundamentals`   
				left join metas on metas.id = fundamentals.meta_id where  meta_key in ('total_no_securities', 'share_percentage_director', 'share_percentage_director', 'share_percentage_govt', 'share_percentage_institute', 'share_percentage_foreign', 'share_percentage_public', 'net_asset_val_per_share', 'paid_up_capital', 'authorized_capital', 'last_agm_held_for_the_year', 'reserve_and_surp')
				and is_latest = '1' ) funda
				
				group by funda.instrument_id) fundamental
				                
				  on instruments.id = fundamental.instrument_id
				  LEFT JOIN dse_share_percentage on instruments.id = dse_share_percentage.instrument_id
				  WHERE instruments.active = '1'	and instruments.sector_list_id not in (5, 23, 22)
				  order by instrument_code asc
    	";

    	$instruments = \DB::select(\DB::raw($query));
    	if(request()->has('update'))
    	{
    		return $this->syncFundamentalData($instruments);
    	}    	
    	return view('admin.data-extractors.share-percentage')->with(compact('instruments'));
    }
    public function sharePercentageDseImport()
    {
    	return view('admin.data-extractors.share-percentage-dse-import');
    }


    public function syncFundamentalData($instruments)
    {
    	foreach ($instruments as $instrument) {
    			//ignore NAV
            try {
                    /*start try*/
                    if($instrument->total_no_securities != $instrument->total)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'total_no_securities', $instrument->total);
                    }
                    /*********************/
                    if($instrument->share_percentage_director != $instrument->sponsor)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'share_percentage_director', $instrument->sponsor);
                    }
                    /*********************/
                    if($instrument->share_percentage_govt != $instrument->govt)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'share_percentage_govt', $instrument->govt);
                    }
                    /*********************/
                    if($instrument->share_percentage_institute != $instrument->institute)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'share_percentage_institute', $instrument->institute);
                    }
                    /*********************/
                    if($instrument->share_percentage_foreign != $instrument->f_share)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'share_percentage_foreign', $instrument->f_share);
                    }
                    /*********************/
                    if($instrument->share_percentage_public != $instrument->public_share)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'share_percentage_public', $instrument->public_share);
                    }
                    /*********************/
                    if($instrument->paid_up_capital != $instrument->paid_up)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'paid_up_capital', $instrument->paid_up);
                    }
                    /*********************/
                    if($instrument->authorized_capital != $instrument->authorized)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'authorized_capital', $instrument->authorized);
                    }
                    /*********************/


                    if(strlen($instrument->last_agm_held_for_the_year) > 5 )
                    {
                        $date = \Carbon\Carbon::parse($instrument->last_agm_held_for_the_year)->format('d/m/Y');
                    }else{

                        $date = $instrument->last_agm_held_for_the_year;
                    }   


                    if($date != $instrument->last_agm )
                    {
                        if(strlen($instrument->last_agm) > 5)
                        {
                            
                            //data in dse site sometimes sepereted by "-" and sometimes with "/"
                          $instrument->last_agm =  str_replace('-', '/', $instrument->last_agm)  ;
                            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $instrument->last_agm)->format('M d, Y');

                        }else{
                            $date = $instrument->last_agm;
                        }

                        FundamentalRepository::store($instrument->instrument_id, 'last_agm_held_for_the_year', $date );

                    }
                    /*********************/            
                    if($instrument->reserve_and_surp != $instrument->rserve_surplus)
                    {
                        FundamentalRepository::store($instrument->instrument_id, 'reserve_and_surp', $instrument->rserve_surplus);
                    }
                    /*********************/            
                    /*end try*/
            } catch (\Exception $e) {
                dump($e);
                /*some instrument may have some excepetion need to handle it here */
                // echo "<pre>";
                // print_r($instruments);
                // die();
            }

        }
        return redirect()->back();
    }

    public function epsParsing()
    {
        return view('admin.data-extractors.eps-parsing');
    }
}
