<?php

namespace App\Http\Controllers;

use App\Repositories\FundamentalRepository;
use Illuminate\Http\Request;
use App\Repositories\InstrumentRepository;
use Illuminate\Support\Facades\Storage;

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
				max(case when meta_key = 'last_agm_held' then meta_value end) last_agm_held,
				max(case when meta_key = 'reserve_and_surp' then meta_value end) reserve_and_surp 
				from
				 (SELECT meta_key, meta_id, meta_value, instrument_id FROM `fundamentals`   
				left join metas on metas.id = fundamentals.meta_id where  meta_key in ('total_no_securities', 'share_percentage_director', 'share_percentage_director', 'share_percentage_govt', 'share_percentage_institute', 'share_percentage_foreign', 'share_percentage_public', 'net_asset_val_per_share', 'paid_up_capital', 'authorized_capital', 'last_agm_held', 'reserve_and_surp')
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


                    if(strlen($instrument->last_agm_held) > 5 )
                    {
                        $date = \Carbon\Carbon::parse($instrument->last_agm_held)->format('d/m/Y');
                    }else{

                        $date = $instrument->last_agm_held;
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

                        FundamentalRepository::store($instrument->instrument_id, 'last_agm_held', $date );

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


    public function insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id = 21, $type = 'annual')
    {

        $sql = "select * from metas where meta_group_id=$meta_group_id";
        $existing_metas_of_this_group = \DB::select($sql);
        $existing_metas_of_this_group = collect($existing_metas_of_this_group)->keyBy('meta_key');

        foreach ($nodes as $i => $node) {

            $temp = array();

            $i = 0;
            $meta_id = 0;
            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = str_replace('%', '', $data);
                $data = trim($data);


                if ($data != '') {
                    $temp[] = $data;
                    $data = trim($data);

                    if ($i == 0) {
                        // its description/ ist column
                        $meta_key = str_slug(trim($data), '-');
                        $meta_key = "$type-sbfn-$meta_key";
                        if (isset($existing_metas_of_this_group[$meta_key])) {
                            $meta_id = $existing_metas_of_this_group[$meta_key]->id;

                        } else {

                            \DB::table('metas')->insert(
                                ['meta_group_id' => $meta_group_id, 'meta_key' => $meta_key, 'meta_description' => $data]
                            );

                            $sql = "select * from metas where meta_group_id=$meta_group_id";
                            $existing_metas_of_this_group = \DB::select($sql);
                            $existing_metas_of_this_group = collect($existing_metas_of_this_group)->keyBy('meta_key');

                            $meta_id = $existing_metas_of_this_group[$meta_key]->id;

                        }


                    } else {
                        dump("$i | meta_id=$meta_id");

                        if ($meta_id) {

                            if ($type == 'annual') {
                                if (isset($heading[$i]))
                                    $meta_date = trim($heading[$i]) . "-01-01";

                            }
                            if ($type == 'quarter') {
                                if (isset($heading[$i]))
                                    $meta_date = date('Y-m-d', strtotime($heading[$i]));
                            }


                            if ($i == 1)
                                $is_latest = 1;
                            else
                                $is_latest = 0;

                            $data = str_replace('(', '-', $data);
                            $data = str_replace(')', '', $data);

                            dump("Insert=>  instrument_id=$instrument_id meta_id=$meta_id meta_date=$meta_date meta_data=$data is_latest=$is_latest");

                            $fundamental_insert = \App\Fundamental::updateOrCreate(
                                ['instrument_id' => $instrument_id, 'meta_id' => $meta_id, 'meta_date' => $meta_date, 'meta_id' => $meta_id],
                                ['meta_value' => $data, 'is_latest' => $is_latest]
                            );

                        }
                    }

                    $i++;

                }


            }

        }

    }


    public function extract_annual_report($instrument_code = "UPGDCL")
    {

        libxml_use_internal_errors(true);

        /* Createa a new DomDocument object */

        $instrument_info = InstrumentRepository::getInstrumentsByCode(array($instrument_code));
        $instrument_id = $instrument_info->first()->id;


        ////////////////  CASH FLOW    STARTS        \\\\\\\\\\\\\\\\\\\\\\\\\

        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/annual/balance-sheet");

        /* Heading/Financial year extracting */

        $xpath = new \DomXPath($dom);
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }

        ///// Processing Balance sheet   -    Assets  Starts \\\\\\\\\\\\\\\\\\

        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');
        $meta_group_id = 21; //Balance sheet-assets

        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing Balance sheet   -    Assets  End \\\\\\\\\\\\\\\\\\


        ///// Processing Balance sheet   -    Liabilities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 22; //Balance sheet-Liabilities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing Balance sheet   -    Liabilities  Ends \\\\\\\\\\\\\\\\\\


        ////////////////  BALANCE SHEET    ENDS        \\\\\\\\\\\\\\\\\\\\\\\\\


        ////////////////  CASH FLOW    STARTS        \\\\\\\\\\\\\\\\\\\\\\\\\


        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/annual/cash-flow");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }


        ///// Processing CASH FLOW:  Operating Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 23; //CASH FLOW:  Operating Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing CASH FLOW:  Operating Activities Ends \\\\\\\\\\\\\\\\\\


        ///// Processing CASH FLOW:  Investing Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 24; //CASH FLOW:   Investing Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing CASH FLOW:   Investing Activities Ends \\\\\\\\\\\\\\\\\\


        ///// Processing CASH FLOW:  Financing Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 25; //CASH FLOW:    Financing Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[4]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing CASH FLOW:    Financing Activities Ends \\\\\\\\\\\\\\\\\\


        ////////////////  CASH FLOW    END        \\\\\\\\\\\\\\\\\\\\\\\\\


        ////////////////  INCOME STATMENTS    START        \\\\\\\\\\\\\\\\\\\\\\\\\


        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/annual/income-statement");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }


        ///// Processing  	income statement data Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 26; //income statement data
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'annual');

        ///// Processing income statement data Ends \\\\\\\\\\\\\\\\\\


        dd("income statement data");

        ////////////////  INCOME STATMENTS    END        \\\\\\\\\\\\\\\\\\\\\\\\\

    }

    public function extract_quarter_report($instrument_code = "UPGDCL")
    {

        libxml_use_internal_errors(true);

        /* Createa a new DomDocument object */

        $instrument_info = InstrumentRepository::getInstrumentsByCode(array($instrument_code));
        $instrument_id = $instrument_info->first()->id;


        ////////////////  CASH FLOW    STARTS        \\\\\\\\\\\\\\\\\\\\\\\\\

        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/quarter/balance-sheet");

        /* Heading/Financial year extracting */

        $xpath = new \DomXPath($dom);
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }


        ///// Processing Balance sheet   -    Assets  Starts \\\\\\\\\\\\\\\\\\

        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');
        $meta_group_id = 21; //Balance sheet-assets

        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing Balance sheet   -    Assets  End \\\\\\\\\\\\\\\\\\


        ///// Processing Balance sheet   -    Liabilities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 22; //Balance sheet-Liabilities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing Balance sheet   -    Liabilities  Ends \\\\\\\\\\\\\\\\\\


        ////////////////  BALANCE SHEET    ENDS        \\\\\\\\\\\\\\\\\\\\\\\\\


        ////////////////  CASH FLOW    STARTS        \\\\\\\\\\\\\\\\\\\\\\\\\


        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/quarter/cash-flow");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }


        ///// Processing CASH FLOW:  Operating Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 23; //CASH FLOW:  Operating Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing CASH FLOW:  Operating Activities Ends \\\\\\\\\\\\\\\\\\


        ///// Processing CASH FLOW:  Investing Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 24; //CASH FLOW:   Investing Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing CASH FLOW:   Investing Activities Ends \\\\\\\\\\\\\\\\\\


        ///// Processing CASH FLOW:  Financing Activities  Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 25; //CASH FLOW:    Financing Activities
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[4]/div[2]/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing CASH FLOW:    Financing Activities Ends \\\\\\\\\\\\\\\\\\


        ////////////////  CASH FLOW    END        \\\\\\\\\\\\\\\\\\\\\\\\\


        ////////////////  INCOME STATMENTS    START        \\\\\\\\\\\\\\\\\\\\\\\\\


        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/$instrument_code/financials/quarter/income-statement");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading = array();
        foreach ($heading_nodes as $i => $node) {


            foreach ($node->childNodes as $child) {
                $data = str_replace(',', '', $child->nodeValue);
                $data = trim($data);


                if ($data != '')
                    $heading[] = $data;

            }


        }


        ///// Processing  	income statement data Starts \\\\\\\\\\\\\\\\\\

        $meta_group_id = 26; //income statement data
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');
        self::insert_fundamental($heading, $nodes, $instrument_id, $meta_group_id, 'quarter');

        ///// Processing income statement data Ends \\\\\\\\\\\\\\\\\\


        dd("income statement data");

        ////////////////  INCOME STATMENTS    END        \\\\\\\\\\\\\\\\\\\\\\\\\

    }


    public function list_financial_reports()
    {

      /*  $file_path = "etc/DGENX.txt";
        if (Storage::disk('local')->exists($file_path)) {

            $today_data = Storage::get($file_path);
            $rawData = explode("\n", $today_data);

            $temp=array();
            foreach($rawData as $row)
            {
                $rowArray = explode("\t", $row);


                if(isset($rowArray[1]))
                {

                    $trade_date= $rowArray[1];
                    $trade_date = strtotime($trade_date);
                    $trade_date = date('Y-m-d', $trade_date);

                    $market = \DB::select("select id from markets where trade_date='$trade_date'");



                    $open=trim($rowArray[2]);
                    $high=trim($rowArray[3]);
                    $low=trim($rowArray[4]);
                    $close=trim($rowArray[5]);
                    $vol=trim($rowArray[6])/1000000;

                    if (isset($market[0])) {

                        $market_id= $market[0]->id;

                        $sql = "INSERT INTO `data_banks_eods` (`id`, `market_id`, `instrument_id`, `open`, `high`, `low`, `close`, `volume`, `trade`, `tradevalues`, `date`) VALUES (NULL, '$market_id', 10006, $open, $high, $low, $close, $vol, 0,$vol,'$trade_date');";

                        \DB::select($sql);
                    }



                }



            }
           // dd($rawData);
        }*/


        $instrument_list=InstrumentRepository::getInstrumentsScripOnly();

        foreach($instrument_list as $instrument)
        {
            $instrument_code= $instrument->instrument_code;

            echo" <a href='/financial-reports-extract/$instrument_code/annual' target='_blank'>$instrument_code Annual Report</a>      .....................................               <a href='/financial-reports-extract/$instrument_code/quarter' target='_blank'>$instrument_code Quarter Report</a>  <br />";
        }
    }
    public function extract_financial_reports($instrument_code,$type)
    {
        if($type=='annual')
        {
            self::extract_annual_report($instrument_code);
        }

        if($type=='quarter')
        {
            self::extract_quarter_report($instrument_code);
        }


    }


}
