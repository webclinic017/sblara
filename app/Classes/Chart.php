<?php 
namespace App\Classes;
use \Carbon\Carbon;
use App\Repositories\InstrumentRepository;
use App\Repositories\ChartRepository;
/**
* StockBangladesh Server Side Ta Chart
* @author Selim
*/
class Chart 
{	
	/**
	 * @var   vars
	 */
	protected $TickerSymbol = "DSEX";
	protected $Adjusted = true;
	protected $Indicators = ['RSI', 'MACD'];
	protected $TimeRange = 180;
	protected $ChartSize = "L";
	protected $Volume = 1;
	protected $ParabolicSAR = "0";
	protected $LogScale = "0";
	protected $PercentageScale = "0";
	protected $ChartType = "CandleStick";
	protected $Band = "BB";
	protected $avgType1 = "SMA";
	protected $movAvg1 = "10";
	protected $avgType2 = "SMA";
	protected $movAvg2 = "25";
	protected $CompareWith = "";
	protected $startDate = "";
	protected $endDate = "";
	protected $width = 1160;
	protected $maxWidth = 1160;
	protected $ohlcData = [];
	protected $waterMark = "";
	protected $intradayTable = false;
	protected $pe = "N/A";
	protected $eps = [];
	protected $interval = "D";
	protected $table;

	/**
	* Initializing the chart
	*
	* @return void
	*/ 
	 function __construct()
	{
		// Require Chart Library By chartDirector
		require_once(app_path() . '/ChartDirector/FinanceChart.php');

		//set values from request;
		 $this->setValues();
		 $this->loadChartData();
		 // dd($this->instrument);
		# create the finance chart
		//need to fix then  without calling getBottomLeftTitle pe is not generating
		 $this->getBottomLeftTitle();

		 
		if($this->isDesktop())
		{
			$this->maxWidth = $this->deviceWidth;
		}		

		$c = $this->drawChart();

		 $this->loadStyles();
		// Output the chart
		// $jsmodel = $c->getJsChartModel();
		// if($this->isDesktop()){
		$src = "data:image/png;base64, ". base64_encode($c->makeChart2(PNG));
	  	 $imageMap = $c->getHTMLImageMap("", "", "title='" . $c->getToolTipDateFormat() . " {value|G}'");
		// }
		 $chart = "<img src='$src'  usemap=\"#chartmap\">";
	  	 if(isset($imageMap))
	  	 {
		 	$chart .= "<map name=\"chartmap\">$imageMap</map>";
	  	 }
		 $this->html  = $chart;
		// a chart with a specific instrument
	}
	/**
	 * return the chart html 
	 * @return string $chartHtml
	 */
	public function html()
	{
		return $this->html;
	}

	/**
	 * 	check if the request device is mobile
	 *
	 * @return  bol 
	 */
	public function isMobile()
	{
		if($this->deviceWidth < 991)
		{
			return true;
		}		
		return false;
	}

	/**
	 * 	check if the device is desktop
	 *
	 * @param  boolean 
	 */
	public function isDesktop()
	{
		return !$this->isMobile();
	}

	/**
	 * load styles
	 *
	 * @return  void 
	 */
	public function loadStyles()
	{

	}

	/**
	 * Add fundamental info
	 *
	 * @return  void 			
	 */
	public function addPlotText()
	{
		if($this->isSector())
		{
	    	$this->chart->addPlotAreaTitle(TopLeft, $this->instrument->name);
	     	$this->chart->addPlotAreaTitle(BottomLeft, $this->getMiddleLeftTitle());
	     	return;
		}

	    $this->chart->addPlotAreaTitle(TopLeft, $this->getTopLeftTitle());
	    
	    if($this->width > 800){
	    	//set copyright text
	    	$this->chart->addPlotAreaTitle(BottomRight, $this->getBottomRightTitle());
	    }

	    if($this->width > 620)
	    {
	     $this->chart->addPlotAreaTitle(BottomLeft, $this->getMiddleLeftTitle().", ".$this->getBottomLeftTitle());
	    	return;
	    }	
	     $this->chart->addPlotAreaTitle(BottomLeft, $this->getMiddleLeftTitle());
	     $this->chart->addText(38, 30,  $this->getBottomLeftTitle());
	     $this->chart->setMargins(40, 46, 40, 35);
	}

	/**
	 * load chart data
	 *
	 * @return void
	 */
	public function loadChartData()
	{
		if($this->isSector())
		{
            return ;		
		}

			$instrument = InstrumentRepository::getInstrumentsById(array($this->getTickerSymbol()))->first();
			// $instrument->load('eod');

			$this->instrument = $instrument;
			//Load metas
			$this->metas = $this->instrument->metaValuesByKey(['total_no_securities', "net_asset_val_per_share", "year_end", "share_percentage_public", "net_asset_val_per_share"]);

			//load intrady info
			$this->intraday = $this->instrument->lastIntraday;

		
		$this->eps = \App\Repositories\FundamentalRepository::getAnnualizedEPS(array($this->instrument->id));
		if(isset($this->eps[$this->instrument->id]))
		{
			$this->eps = $this->eps[$this->instrument->id];
		}else{
			$this->eps = "N/A";
		}

	}

	/**
	 * check if the request id is a sector id
	 *
	 * @return  boolean 
	 */
	public function isSector()
	{
		if(isset($this->sector))
		{
			return $this->sector;
		}
		$ex = explode('_', $this->TickerSymbol);
		if(count($ex) == 2 )
		{
			$this->TickerSymbol = $ex[1];
			return $this->sector = true;
		}
		return $this->sector = false;
	}

	/**
	 * get extra points value
	 *
	 * @return  int max $movAvg
	 */
	public function getExtraPoints()
	{
		return max([$this->movAvg1,  $this->movAvg2]);
	}

	/**
	 * get the query string for retriving data from eod table
	 *
	 * @return  string  $query
	 */
	public function getEodQuery()
	{
		if($this->isSector())
		{
            $sector_info= \DB::select("select * from sector_lists where id=".$this->getTickerSymbol());
            $this->instrument=$sector_info[0];	
             $this->ohlcData = ChartRepository::getDailySectorData($this->instrument->id, $this->startDate, $this->endDate, $this->getExtraPoints());

            return false ;		
		}		
		if(request()->Adjusted == 1)
		{
			 $this->ohlcData = ChartRepository::getAdjustedDailyData($this->instrument->id, $this->startDate, $this->endDate, $this->getExtraPoints());
		}else{
			 $this->ohlcData = ChartRepository::getDailyData($this->instrument->id, $this->startDate, $this->endDate, $this->getExtraPoints());
		}
		return false;
	}

	/**
	 * get the query string for retriving data from eod table
	 *
	 * @return  string  $query
	 */
	public function getSectorIntradayQuery()
	{
		$q = " 
			SELECT `date`, `hour`, `minute`,  AVG(volume) volume, AVG(`open`) `open`, AVG(`close`) `close`, AVG(`low`) `low`, AVG(`high`) `high` FROM 
				(SELECT `date`, `hour`, `minute`, `open`, `close`, `high`, `low`, IFNULL((vol - (LAG(vol) OVER ())), vol)  volume, LAG(vol) OVER () vprev FROM (SELECT DISTINCT 
				SUBSTRING_INDEX(GROUP_CONCAT(CAST(`close_price` AS CHAR) ORDER BY `lm_date_time`), ',', 1 ) AS `open`,
				SUBSTRING_INDEX(GROUP_CONCAT(CAST(`close_price` AS CHAR) ORDER BY `lm_date_time` DESC), ',', 1 ) AS `close`, instrument_id,
				MAX(close_price) `high`, MIN(close_price) low,  MAX(total_volume) vol,  lm_date_time, DATE(lm_date_time) `date`, HOUR(lm_date_time) `hour`,  (MINUTE(lm_date_time) DIV {$this->interval})*{$this->interval} `minute`, MINUTE(lm_date_time )
				FROM data_banks_intradays 
				WHERE instrument_id IN  (SELECT id FROM instruments WHERE sector_list_id = {$this->instrument->id}) 
				and `trade_date` >= '{$this->startDate->format('Y-m-d')}'
				and `trade_date` <= '{$this->endDate->format('Y-m-d')}'
				GROUP BY  `date`, `hour`, `minute`, `instrument_id`
				
				ORDER BY `date`, `hour`, `minute` DESC
				) `data`)
				d
				GROUP BY `date`, `hour`, `minute`
			";		
		return $q;
	}

	/**
	 * get the query string for retriving data from eod table
	 *
	 * @return  string  $query
	 */
	public function getIntradayQuery()
	{
		$this->nOfCandle = 550;		
		if($this->isSector())
		{
			die("Sector minute chart not available");
			return $this->getSectorIntradayQuery();
		}
		$q = "SELECT `date`, `hour`, `minute`, `open`, `close`, `high`, `low`, IFNULL((vol - (LAG(vol) OVER (order by lm_date_time asc))), vol)  volume, LAG(vol) OVER (order by lm_date_time asc) vprev FROM (SELECT DISTINCT 
				SUBSTRING_INDEX(GROUP_CONCAT(CAST(`close_price` AS CHAR) ORDER BY `lm_date_time`), ',', 1 ) AS `open`,
				SUBSTRING_INDEX(GROUP_CONCAT(CAST(`close_price` AS CHAR) ORDER BY `lm_date_time` DESC), ',', 1 ) AS `close`,
				MAX(close_price) `high`, MIN(close_price) low,  MAX(total_volume) vol,  lm_date_time, DATE(lm_date_time) `date`, HOUR(lm_date_time) `hour`,  (MINUTE(lm_date_time) DIV {$this->interval})*{$this->interval} `minute`, MINUTE(lm_date_time )
				FROM data_banks_intradays 
				WHERE instrument_id = {$this->instrument->id} 
				and `trade_date` >= '{$this->startDate->format('Y-m-d')}'
				and `trade_date` <= '{$this->endDate->format('Y-m-d')}'
				GROUP BY `date`, `hour`, `minute`
				
				ORDER BY id DESC
				limit {$this->nOfCandle}
				) `data`
			";		
		return $q;
	}

	/**
	 * Generate and get the sql query 
	 *
	 * @return  string  $query
	 */
	public function getQuery()
	{
		if($this->interval == "D")
		{
			return $this->getEodQuery();
		}
			return $this->getIntradayQuery();
	}

	/**
	 * Get ohlcData
	 *
	 * @return  array $ohlc
	 */
	public function getOhlcData()
	{
		$q = $this->getQuery();
		// echo $q;
		// dd($q);
		if(!$q){return $this->ohlcData; }

			$data = \DB::select(\DB::raw($q));
			$ohlc = [];
			$this->intradayTable = false;
			foreach ($data as $key => $value) {
				$timestamp =  Carbon::parse($value->date);
				$timestamp->hour($value->hour);
				$timestamp->minute($value->minute);

				$ohlc['date'][] = chartTime2($timestamp->timestamp);

				$ohlc['volume'][] = $value->volume;
				$ohlc['open'][] = $value->open;
				$ohlc['high'][] = $value->high;
				$ohlc['low'][] = $value->low;
				$ohlc['close'][] = $value->close;
			}
			return $this->ohlcData = $ohlc ; 



		if($this->getTimeRange() < 30)
		{
			if($this->isSector())
			{
				//return sector 5 minute chart
				die('Under construction!');
				return $this->ohlcData = [];
			 // dd(ChartRepository::getDailySectorData($this->instrument->id, $this->startDate, $this->endDate, $this->getExtraPoints()));
			}
			//return instrument minute data
			$this->intradayTable = true;
		//	dd(\App\Repositories\DataBanksIntradayRepository::getDataForChartDirector($this->instrument->id, $this->startDate, $this->endDate, 5));
			return $this->ohlcData = \App\Repositories\DataBanksIntradayRepository::getDataForChartDirector($this->instrument->id, $this->startDate, $this->endDate, 5);
		}


	}

	/**
	 * set chart values from request
	 * @return  void
	 */
	public function setValues()
	{
		$request = request();
		foreach ($request->all() as $key => $value) {
			switch ($key) {
				case 'TimeRange':
					$dates = explode('|', $value);
					if(count($dates) != 2)
					{
						$this->TimeRange = $value;
						$this->startDate = Carbon::now()->subDays($value);
						$this->endDate = Carbon::now();
						break;
					}
					$this->startDate = Carbon::parse($dates[0]);
					$this->endDate = Carbon::parse($dates[1]);
					$this->TimeRange = $this->startDate->diffInDays($this->endDate);
					break;

				case 'Indicator1':
					$this->Indicators[0] = $value;
					break;
				
				case 'Indicator2':
					$this->Indicators[1] = $value;
					break;

				case 'Indicator3':
					$this->Indicators[2] = $value;
					break;

				case 'Indicator4':
					$i = 3;
					$values = explode(',', $value);
					foreach ($values as $key => $value) {
						$this->Indicators[$i] = $value;
						$i++;
					}
					break;
				
				default:
					$this->{$key} = $value;
					break;
			}
		}
	}

	/**
	 * Get top left title
	 *
	 * @return string top left title
	 */
	public function getTopLeftTitle()
	{
		$ticker = $this->instrument->name;
		if($this->width < 650)
		{
			$ticker = $this->instrument->instrument_code;
		}
		$data =  $ticker."<*font=arial.ttf,size=8*> CAT:".$this->getCategory().",YearEnd: ".$this->getMeta('year_end').", PE: ".$this->pe.", NOS: ".$this->getMeta('total_no_securities');
		if($this->width > 500)
		{
			$data .= ",  Public(".$this->getMeta('share_percentage_public')."%): ".(int) (((float)  $this->getMeta('share_percentage_public')/100)* (float) $this->getMeta('total_no_securities'));
		}
		return $data;
	}

	/**
	 * get category 
	 *
	 * @return  string  $category
	 */
	public function getCategory()
	{
		if(!isset($this->intraday))
		{
			return "N/A";
		}
		return @$this->intraday->quote_bases[0];
	}

	/**
	 * Get meta by key from loaded meta
	 *
	 * @return string meta value
	 */
	public function getMeta($key)
	{
		if($this->isSector())
		{
			return 'N/A';
		}
		if(isset($this->metas[$key][$this->instrument->id]->meta_value))
		{
			return $this->metas[$key][$this->instrument->id]->meta_value;
		}
		return "N/A";
	}

	/**
	 * Get top right title
	 *
	 * @return string top right title
	 */
	public function getTopRightTitle()
	{
		return $this->getTickerSymbol();
	}

	/**
	 * Get top left title
	 *
	 * @return string top left title
	 */
	public function getBottomLeftTitle()
	{
		$annualEps = isset($this->eps['annualized_eps'])?$this->eps['annualized_eps']:"N/A";
		if(isset($this->eps['meta_date']) && strlen($this->eps['meta_date']) > 5)
		{
			$date = $this->eps['meta_date']?$this->eps['meta_date']->format('d-m-Y'):"N/A";
		}else{
			$date = "N/A";
		}

		if(isset($this->intraday->close_price) && isset($this->eps['annualized_eps']))
		{
            @ $pe = $annualEps ? $this->intraday->close_price / $annualEps : 0;
            $this->pe = round($pe, 2);
		}

		$text = isset($this->eps['text'])?$this->eps['text']:"N/A";
		$data = "<*font=arial.ttf,size=8*>NAV: ".$this->getMeta('net_asset_val_per_share').", Annualized EPS: ".$annualEps.", $text at $date";
		return $data;
	}

	/**
	 * Get top left title
	 *
	 * @return string top left title
	 */
	public function getMiddleLeftTitle()
	{
		$data = sprintf("<*font=arial.ttf,size=8*>%s ",
	        $this->chart->formatValue($this->ohlcData['date'][0], "mmm dd, yyyy"));
		$data .= " Open: ".number_format($this->ohlcData['open'][0], 2).", High: ".number_format($this->ohlcData['high'][0], 2).", Low: ".number_format($this->ohlcData['low'][0], 2).", Close: ".number_format($this->ohlcData['close'][0], 2).", Volume: ".(int)$this->ohlcData['volume'][0];
		return $data;
	}

	/**
	 * Get top left title
	 *
	 * @return string top left title
	 */
	public function getBottomRightTitle()
	{
		return "<*font=arial.ttf,size=8*>(c) ".config('app.name');
	}

	/**
	* Get Ticker Symbol
	* @return string $symbol
	*/
	public function getTickerSymbol()
	{
		if(!isset($this->TickerSymbol))
		{
				$this->TickerSymbol = $_REQUEST["TickerSymbol"];
		}
		return (int) $this->TickerSymbol;
	}

	/**
	* Get CompareWith
	* @return string $CompareWith
	*/
	public function getCompareWith()
	{
		if(!isset($this->CompareWith))
		{
				$this->CompareWith = $_REQUEST["CompareWith"];
		}
		return $this->CompareWith;
	}

	/**
	* Get TimeRange
	* @return string $TimeRange
	*/
	public function getTimeRange()
	{
		if(!isset($this->TimeRange))
		{
				$this->TimeRange = $_REQUEST["TimeRange"];
		}
		return $this->TimeRange;
	}

	/**
	 * Get request indicators
	 *
	 * @param   $single Return and unset first value
	 * @return array
	 */
	public function getIndicators($single = false)
	{
		if(!$this->Indicators)
		{
			return [];
		}

		if($single)
		{
			$value = $this->Indicators[0];
			unset($this->Indicators[0]);
			return $value;
		}
		return $this->Indicators;
	}

	#/ <summary>
	#/ A random number generator designed to generate realistic financial data.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	#/ <param name="resolution">The period of the data series.</param>
	protected function generateData($ticker, $startDate, $endDate, $resolution) {

	    global $timeStamps, $volData, $highData, $lowData, $openData, $closeData;

	    // $db = new \FinanceSimulator($ticker, $startDate, $endDate, $resolution);
	    // dd(\App\Repositories\ChartRepository::getAdjustedDailyData(12, $from, $to, 21));
	    // dd($db->getTimeStamps());
	    // $timeStamps = $db->getTimeStamps();
	    // $highData = $db->getHighData();
	    // $lowData = $db->getLowData();
	    // $openData = $db->getOpenData();
	    // $closeData = $db->getCloseData();
	    // $volData = $db->getVolData();
	    $ohlcData = $this->getOhlcData();
	    // dd($ohlcData);
	    // dd($this->startDate);
	    if($this->intradayTable == false)
	    {
	        $timeStamps = array_reverse($ohlcData['date']);
	        $openData = array_reverse($ohlcData['open']);
	        $highData = array_reverse($ohlcData['high']);
	        $lowData = array_reverse($ohlcData['low']);
	        $closeData = array_reverse($ohlcData['close']);
	        $volData = array_reverse($ohlcData['volume']);	    
	    }else{
	        $timeStamps = $ohlcData['date'];
	        $openData = $ohlcData['open'];
	        $highData = $ohlcData['high'];
	        $lowData = $ohlcData['low'];
	        $closeData = $ohlcData['close'];
	        $volData = $ohlcData['volume'];	    	   	
	    }

	}	

	# Utility to compute modulus for large positive numbers. Although PHP has a built-in fmod
	# function, it is only for PHP >= 4.2.0. So we need to define our own fmod function.
	protected function fmod2($a, $b) { return $a - floor($a / $b) * $b; }

	#
	# Create a finance chart based on user selections, which are encoded as query parameters. This code
	# is designed to work with the financedemo HTML form.
	#

	# The timeStamps, volume, high, low, open and close data
	#
	# ** NOTE ** : This sample code is written assuming the time stamps are in ChartDirector chartTime
	# format. It is because this format supports dates before 1970 (which may be needed in some long
	# term charts). See the ChartDirector documentation on chartTime for details. When you retrieve the
	# time stamps from your database, please remember to convert them to chartTime.


	#/ <summary>
	#/ Get the timeStamps, highData, lowData, openData, closeData and volData.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	#/ <param name="durationInDays">The number of trading days to get.</param>
	#/ <param name="extraPoints">The extra leading data points needed in order to
	#/ compute moving averages.</param>
	#/ <returns>True if successfully obtain the data, otherwise false.</returns>
	protected function getData($ticker, $startDate, $endDate, $durationInDays, $extraPoints) {

	    global $resolution;

	    # This method should return false if the ticker symbol is invalid. In this sample code, as we
	    # are using a random number generator for the data, all ticker symbol is allowed, but we still
	    # assumed an empty symbol is invalid.
	    if ($ticker == "") {
	        return false;
	    }

	    # In this demo, we can get 15 min, daily, weekly or monthly data depending on the time range.
	    $resolution = 86400;
	    if ($durationInDays <= 10) {
	        # 10 days or less, we assume 15 minute data points are available
	        $resolution = 900;

	        # We need to adjust the startDate backwards for the extraPoints. We assume 6.5 hours trading
	        # time per day, and 5 trading days per week.
	        $dataPointsPerDay = 6.5 * 3600 / $resolution;
	        $adjustedStartDate = $startDate - $this->fmod2($startDate, 86400) - (int)($extraPoints /
	            $dataPointsPerDay * 7 / 5 + 0.9999999) * 86400 - 2 * 86400;

	        # Get the required 15 min data
	        $this->get15MinData($ticker, $adjustedStartDate, $endDate);

	    } else if ($durationInDays >= 4.5 * 360) {
	        # 4 years or more - use monthly data points.
	        $resolution = 30 * 86400;

	        # Adjust startDate backwards to cater for extraPoints
	        $YMD = getChartYMD($startDate);
	        $currentMonth = (int)($YMD / 100) % 100 - $extraPoints;
	        $currentYear = (int)($YMD / 10000);
	        while ($currentMonth < 1) {
	            $currentYear = $currentYear - 1;
	            $currentMonth = $currentMonth + 12;
	        }
	        $adjustedStartDate = chartTime($currentYear, $currentMonth, 1);

	        # Get the required monthly data
	        $this->getMonthlyData($ticker, $adjustedStartDate, $endDate);

	    } else if ($durationInDays >= 1.5 * 360) {
	        # 1 year or more - use weekly points.
	        $resolution = 7 * 86400;

	        # Adjust startDate backwards to cater for extraPoints
	        $adjustedStartDate = $startDate - $extraPoints * 7 * 86400 - 6 * 86400;

	        # Get the required weekly data
	        $this->getWeeklyData($ticker, $adjustedStartDate, $endDate);

	    } else {
	        # Default - use daily points
	        $resolution = 86400;

	        # Adjust startDate backwards to cater for extraPoints. We multiply the days by 7/5 as we
	        # assume 1 week has 5 trading days.
	        $adjustedStartDate = $startDate - $this->fmod2($startDate, 86400) - (int)(($extraPoints * 7 + 4) /
	            5) * 86400 - 2 * 86400;

	        # Get the required daily data
	        $this->getDailyData($ticker, $adjustedStartDate, $endDate);
	    }

	    return true;
	}

	#/ <summary>
	#/ Get 15 minutes data series for timeStamps, highData, lowData, openData, closeData
	#/ and volData.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	protected function get15MinData($ticker, $startDate, $endDate) {
	    #
	    # In this demo, we use a random number generator to generate the data. In practice, you may get
	    # the data from a database or by other means. If you do not have 15 minute data, you may modify
	    # the "$this->drawChart" method below to not using 15 minute data.
	    #
	    $this->generateData($ticker, $startDate, $endDate, 900);
	}

	#/ <summary>
	#/ Get daily data series for timeStamps, highData, lowData, openData, closeData
	#/ and volData.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	protected function getDailyData($ticker, $startDate, $endDate) {
	    #
	    # In this demo, we use a random number generator to generate the data. In practice, you may get
	    # the data from a database or by other means.
	    #
	    $this->generateData($ticker, $startDate, $endDate, 86400);
	}

	#/ <summary>
	#/ Get weekly data series for timeStamps, highData, lowData, openData, closeData
	#/ and volData.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	protected function getWeeklyData($ticker, $startDate, $endDate) {
	    #
	    # If you do not have weekly data, you may call "$this->getDailyData(startDate, endDate)" to get daily
	    # data, then call "convertDailyToWeeklyData()" to convert to weekly data.
	    #
	    $this->generateData($ticker, $startDate, $endDate, 86400 * 7);
	}

	#/ <summary>
	#/ Get monthly data series for timeStamps, highData, lowData, openData, closeData
	#/ and volData.
	#/ </summary>
	#/ <param name="ticker">The ticker symbol for the data series.</param>
	#/ <param name="startDate">The starting date/time for the data series.</param>
	#/ <param name="endDate">The ending date/time for the data series.</param>
	protected function getMonthlyData($ticker, $startDate, $endDate) {
	    #
	    # If you do not have weekly data, you may call "$this->getDailyData(startDate, endDate)" to get daily
	    # data, then call "convertDailyToMonthlyData()" to convert to monthly data.
	    #
	    $this->generateData($ticker, $startDate, $endDate, 86400 * 30);
	}

	#/ <summary>
	#/ A utility to convert daily to weekly data.
	#/ </summary>
	protected function convertDailyToWeeklyData() {

	    global $timeStamps;

	    $tmpArrayMath1 = new ArrayMath($timeStamps);
	    aggregateData($tmpArrayMath1->selectStartOfWeek());
	}

	#/ <summary>
	#/ A utility to convert daily to monthly data.
	#/ </summary>
	protected function convertDailyToMonthlyData() {

	    global $timeStamps;

	    $tmpArrayMath1 = new ArrayMath($timeStamps);
	    aggregateData($tmpArrayMath1->selectStartOfMonth());
	}

	#/ <summary>
	#/ An internal method used to aggregate daily data.
	#/ </summary>
	protected function aggregateData(&$aggregator) {

	    global $timeStamps, $volData, $highData, $lowData, $openData, $closeData;

	    $timeStamps = $aggregator->aggregate($timeStamps, AggregateFirst);
	    $highData = $aggregator->aggregate($highData, AggregateMax);
	    $lowData = $aggregator->aggregate($lowData, AggregateMin);
	    $openData = $aggregator->aggregate($openData, AggregateFirst);
	    $closeData = $aggregator->aggregate($closeData, AggregateLast);
	    $volData = $aggregator->aggregate($volData, AggregateSum);
	}

	#/ <summary>
	#/ Create a financial chart according to user selections. The user selections are
	#/ encoded in the query parameters.
	#/ </summary>
	protected function drawChart() {

	    global $timeStamps, $volData, $highData, $lowData, $openData, $closeData,
	        $compareData, $resolution;
	    # In this demo, we just assume we plot up to the latest time. So end date is now.
	    $endDate = chartTime2(time());

	    # If the trading day has not yet started (before 9:30am), or if the end date is on on Sat or
	    # Sun, we set the end date to 4:00pm of the last trading day
	    while (($this->fmod2($endDate, 86400) < 9 * 3600 + 30 * 60) || (getChartWeekDay($endDate) == 0) || (
	        getChartWeekDay($endDate) == 6)) {
	        $endDate = $endDate - $this->fmod2($endDate, 86400) - 86400 + 16 * 3600;
	    }

	    # The duration selected by the user
	    $durationInDays = (int) $this->TimeRange;

	    # Compute the start date by subtracting the duration from the end date.
	    $startDate = $endDate;
	    if ($durationInDays >= 30) {
	        # More or equal to 30 days - so we use months as the unit
	        $YMD = getChartYMD($endDate);
	        $startMonth = (int)($YMD / 100) % 100 - (int)($durationInDays / 30);
	        $startYear = (int)($YMD / 10000);
	        while ($startMonth < 1) {
	            $startYear = $startYear - 1;
	            $startMonth = $startMonth + 12;
	        }
	        $startDate = chartTime($startYear, $startMonth, 1);
	    } else {
	        # Less than 30 days - use day as the unit. The starting point of the axis is always at the
	        # start of the day (9:30am). Note that we use trading days, so we skip Sat and Sun in
	        # counting the days.
	        $startDate = $endDate - $this->fmod2($endDate, 86400) + 9 * 3600 + 30 * 60;
	        for($i = 1; $i < $durationInDays; ++$i) {
	            if (getChartWeekDay($startDate) == 1) {
	                $startDate = $startDate - 3 * 86400;
	            } else {
	                $startDate = $startDate - 86400;
	            }
	        }
	    }

	    # The moving average periods selected by the user.
	    $avgPeriod1 = 0;
	    $avgPeriod1 = (int) $this->movAvg1;
	    $avgPeriod2 = 0;
	    $avgPeriod2 = (int) $this->movAvg2;

	    if ($avgPeriod1 < 0) {
	        $avgPeriod1 = 0;
	    } else if ($avgPeriod1 > 300) {
	        $avgPeriod1 = 300;
	    }

	    if ($avgPeriod2 < 0) {
	        $avgPeriod2 = 0;
	    } else if ($avgPeriod2 > 300) {
	        $avgPeriod2 = 300;
	    }

	    # We need extra leading data points in order to compute moving averages.
	    $extraPoints = 20;
	    if ($avgPeriod1 > $extraPoints) {
	        $extraPoints = $avgPeriod1;
	    }
	    if ($avgPeriod2 > $extraPoints) {
	        $extraPoints = $avgPeriod2;
	    }


	    # Get the data series to compare with, if any.
	    $compareKey = trim($this->CompareWith);
	    $compareData = null;
	    if ($this->getData($compareKey, $startDate, $endDate, $durationInDays, $extraPoints)) {
	          $compareData = $closeData;
	    }

	    # The data series we want to get.
	    $tickerKey = trim($this->getTickerSymbol());
	    if (!$this->getData($tickerKey, $startDate, $endDate, $durationInDays, $extraPoints)) {
	        return $this->errMsg("Please enter a valid ticker symbol");
	    }

	    # We now confirm the actual number of extra points (data points that are before the start date)
	    # as inferred using actual data from the database.
	    // $extraPoints = count($timeStamps);
	    // for($i = 0; $i < count($timeStamps); ++$i) {
	    //     if ($timeStamps[$i] >= $startDate) {
	    //         $extraPoints = $i;
	    //         break;
	    //     }
	    // }
	    
	    # Check if there is any valid data
	    # 
	    if ($extraPoints >= count($timeStamps)) {
	    	$extraPoints = 0;
	        # No data - just display the no data message.
	        // return $this->errMsg("No data available for the specified time period");
	    }

	    # In some finance chart presentation style, even if the data for the latest day is not fully
	    # available, the axis for the entire day will still be drawn, where no data will appear near the
	    # end of the axis.
	    if ($resolution < 86400) {
	        # Add extra points to the axis until it reaches the end of the day. The end of day is
	        # assumed to be 16:00 (it depends on the stock exchange).
	        $lastTime = $timeStamps[count($timeStamps) - 1];
	        $extraTrailingPoints = (int)((16 * 3600 - $this->fmod2($lastTime, 86400)) / $resolution);
	        for($i = 0; $i < $extraTrailingPoints; ++$i) {
	            $timeStamps[] = $lastTime + $resolution * ($i + 1);
	        }
	    }

	    #
	    # At this stage, all data are available. We can draw the chart as according to user input.
	    #

	    #
	    # Determine the chart size. In this demo, user can select 4 different chart sizes. Default is
	    # the large chart size.
	    #
	    $this->width = $this->maxWidth;
	    $mainHeight = 255;
	    $indicatorHeight = 80;

	    $size = $this->ChartSize;
	    if ($size == "S") {
	        # Small chart size
	        $this->width = 450;
	        $mainHeight = 160;
	        $indicatorHeight = 60;
	    } else if ($size == "M") {
	        # Medium chart size
	        $this->width = 620;
	        $mainHeight = 215;
	        $indicatorHeight = 70;
	    } else if ($size == "H") {
	        # Huge chart size
	        $this->width = $this->maxWidth;
	        $mainHeight = 320;
	        $indicatorHeight = 90;
	    }

	    # Create the chart object using the selected size
	    $this->chart = new \FinanceChart($this->width);

	    # Set the data into the chart object
	    # 
	    $this->chart->setData($timeStamps, $highData, $lowData, $openData, $closeData, $volData, $extraPoints);

	    $this->addPlotText();
	    #
	    # We configure the title of the chart. In this demo chart design, we put the company name as the
	    # top line of the title with left alignment.
	    #

	    # We displays the current date as well as the data resolution on the next line.

	    #
	    # Add the first techical indicator according. In this demo, we draw the first indicator on top
	    # of the main chart.
	    #
	    if($this->getIndicators())
	    {
	    	$this->addIndicator($m, $this->getIndicators(true), $indicatorHeight);
	    }

	    #
	    # Add the main chart
	    #

	    $this->chart->addMainChart($mainHeight);
#
# The following is just an arbitrary algorithm to create some meaningless buySignal and sellSignal.
# They are just for demonstrating the charting engine. Please do not use them for actual trading.
#
/*buy sell signal code start*/
// $buySignal = array_pad(array(), count($closeData), 0);
// $sellSignal = array_pad(array(), count($closeData), 0);
// $tmpArrayMath1 = new \ArrayMath($closeData);
// $tmpArrayMath1->movAvg(20);
// $sma5 = $tmpArrayMath1->result();
// $tmpArrayMath1 = new \ArrayMath($closeData);
// $tmpArrayMath1->movAvg(40);
// $sma20 = $tmpArrayMath1->result();

// for($i = 0; $i < count($sma5); ++$i) {
//     $buySignal[$i] = NoValue;
//     $sellSignal[$i] = NoValue;
//     if ($i > 0) {
//         if (($sma5[$i - 1] <= $sma20[$i - 1]) && ($sma5[$i] > $sma20[$i])) {
//             $buySignal[$i] = $lowData[$i];
//         }
//         if (($sma5[$i - 1] >= $sma20[$i - 1]) && ($sma5[$i] < $sma20[$i])) {
//             $sellSignal[$i] = $highData[$i];
//         }
//     }
// }
// 	    $mainChart = $this->chart->addMainChart($mainHeight);
// 		$buyLayer = $mainChart->addScatterLayer(null, $buySignal, "Buy", ArrowShape(0, 1, 0.4, 0.4), 11,
//     0x00ffff);
// 		$dataSetObj = $buyLayer->getDataSet(0);
// $dataSetObj->setSymbolOffset(0, 20);
// $sellLayer = $mainChart->addScatterLayer(null, $sellSignal, "Sell", ArrowShape(180, 1, 0.4, 0.4),
//     11, 0x9900cc);
//     $dataSetObj = $sellLayer->getDataSet(0);
// $dataSetObj->setSymbolOffset(0, -20);
/*buy sell signal code end*/

	    #
	    # Set log or linear scale according to user preference
	    #
	    if ($this->LogScale == "1") {
	        $this->chart->setLogScale(true);
	    }

	    #
	    # Set axis labels to show data values or percentage change to user preference
	    #
	    if ($this->PercentageScale == "1") {
	        $this->chart->setPercentageAxis();
	    }

	    #
	    # Draw any price line the user has selected
	    #
	    $mainType = $this->ChartType;
	    if ($mainType == "Close") {
	        $this->chart->addCloseLine(0x000040);
	    } else if ($mainType == "TP") {
	        $this->chart->addTypicalPrice(0x000040);
	    } else if ($mainType == "WC") {
	        $this->chart->addWeightedClose(0x000040);
	    } else if ($mainType == "Median") {
	        $this->chart->addMedianPrice(0x000040);
	    }

	    #
	    # Add comparison line if there is data for comparison
	    #
	    if ($compareData != null) {
	        if (count($compareData) > $extraPoints) {
	            $this->chart->addComparison($compareData, 0x0000ff, $compareKey);
	        }
	    }

	    #
	    # Add moving average lines.
	    #
	    $this->addMovingAvg($m, $this->avgType1, $avgPeriod1, 0x663300);
	    $this->addMovingAvg($m, $this->avgType2, $avgPeriod2, 0x9900ff);

	    #
	    # Draw candlesticks or OHLC symbols if the user has selected them.
	    #
	    if ($mainType == "CandleStick") {
	        $this->chart->addCandleStick(0x33ff33, 0xff3333);
	    } else if ($mainType == "OHLC") {
	        $this->chart->addHLOC(0x008800, 0xcc0000);
	    }

	    #
	    # Add parabolic SAR if necessary
	    #
	    if ($this->ParabolicSAR == "1") {
	        $this->chart->addParabolicSAR(0.02, 0.02, 0.2, DiamondShape, 5, 0x008800, 0x000000);
	    }

	    #
	    # Add price band/channel/envelop to the chart according to user selection
	    #
	    $bandType = $this->Band;
	    if ($bandType == "BB") {
	        $this->chart->addBollingerBand(20, 2, 0x9999ff, 0xc06666ff);
	    } else if ($bandType == "DC") {
	        $this->chart->addDonchianChannel(20, 0x9999ff, 0xc06666ff);
	    } else if ($bandType == "Envelop") {
	        $this->chart->addEnvelop(20, 0.1, 0x9999ff, 0xc06666ff);
	    }

	    #
	    # Add volume bars to the main chart if necessary
	    #
	    if ($this->Volume == "1") {
	        $this->chart->addVolBars($indicatorHeight, 0x99ff99, 0xff9999, 0xc0c0c0);
	    }

	    #
	    # Add additional indicators as according to user selection.
	    #
	    foreach ($this->getIndicators() as $value) {
		    $this->addIndicator($this->chart, $value, $indicatorHeight);
	    }

	    //add water mark
	    $this->chart->addText(50, 220, $this->waterMark, 'arial.ttf', 15, 0xc09090, '', 1);
    

	    return $this->chart;
	}

	#/ <summary>
	#/ Add a moving average line to the FinanceChart object.
	#/ </summary>
	#/ <param name="m">The FinanceChart object to add the line to.</param>
	#/ <param name="avgType">The moving average type (SMA/EMA/TMA/WMA).</param>
	#/ <param name="avgPeriod">The moving average period.</param>
	#/ <param name="color">The color of the line.</param>
	#/ <returns>The LineLayer object representing line layer created.</returns>
	protected function addMovingAvg(&$m, $avgType, $avgPeriod, $color) {
	    if ($avgPeriod > 1) {
	        if ($avgType == "SMA") {
	            return $this->chart->addSimpleMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "EMA") {
	            return $this->chart->addExpMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "TMA") {
	            return $this->chart->addTriMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "WMA") {
	            return $this->chart->addWeightedMovingAvg($avgPeriod, $color);
	        }
            else if ($avgType=='trader_dema') {
	            return $this->chart->trader_dema($avgPeriod, $color);
	        }else if ($avgType=='trader_kama') {
	            return $this->chart->trader_kama($avgPeriod, $color);
	        }else if ($avgType=='trader_ht_trendline') {
	            return $this->chart->trader_ht_trendline($color);
	        }else if ($avgType=='trader_mama') {
	            return $this->chart->trader_mama(0.1,0.9,$color,0x0077ff);
	        }else if ($avgType=='trader_midpoint') {
                return $this->chart->trader_midpoint($avgPeriod, $color);
	        }else if ($avgType=='trader_t3') {
                return $this->chart->trader_t3($avgPeriod, $color);
	        }else if ($avgType=='trader_tema') {
                return $this->chart->trader_tema($avgPeriod, $color);
	        }else if ($avgType=='trader_trima') {
                return $this->chart->trader_trima($avgPeriod, $color);
	        }
	    }
	    return null;
	}

	#/ <summary>
	#/ Add an indicator chart to the FinanceChart object. In this demo example, the
	#/ indicator parameters (such as the period used to compute RSI, colors of the lines,
	#/ etc.) are hard coded to commonly used values. You are welcome to design a more
	#/ complex user interface to allow users to set the parameters.
	#/ </summary>
	#/ <param name="m">The FinanceChart object to add the line to.</param>
	#/ <param name="indicator">The selected indicator.</param>
	#/ <param name="height">Height of the chart in pixels</param>
	#/ <returns>The XYChart object representing indicator chart.</returns>
	protected function addIndicator(&$m, $indicator, $height) {
	    if ($indicator == "RSI") {
	        return $this->chart->addRSI($height, 14, 0x800080, 20, 0xff6666, 0x6666ff);
	    } else if ($indicator == "StochRSI") {
	        return $this->chart->addStochRSI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "MACD") {
	        return $this->chart->addMACD($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "FStoch") {
	        return $this->chart->addFastStochastic($height, 14, 3, 0x006060, 0x606000);
	    } else if ($indicator == "SStoch") {
	        return $this->chart->addSlowStochastic($height, 14, 3, 0x006060, 0x606000);
	    } else if ($indicator == "ATR") {
	        return $this->chart->addATR($height, 14, 0x808080, 0x0000ff);
	    } else if ($indicator == "ADX") {
	        return $this->chart->addADX($height, 14, 0x008000, 0x800000, 0x000080);
	    } else if ($indicator == "DCW") {
	        return $this->chart->addDonchianWidth($height, 20, 0x0000ff);
	    } else if ($indicator == "BBW") {
	        return $this->chart->addBollingerWidth($height, 20, 2, 0x0000ff);
	    } else if ($indicator == "DPO") {
	        return $this->chart->addDPO($height, 20, 0x0000ff);
	    } else if ($indicator == "PVT") {
	        return $this->chart->addPVT($height, 0x0000ff);
	    } else if ($indicator == "Momentum") {
	        return $this->chart->addMomentum($height, 12, 0x0000ff);
	    } else if ($indicator == "Performance") {
	        return $this->chart->addPerformance($height, 0x0000ff);
	    } else if ($indicator == "ROC") {
	        return $this->chart->addROC($height, 12, 0x0000ff);
	    } else if ($indicator == "OBV") {
	        return $this->chart->addOBV($height, 0x0000ff);
	    } else if ($indicator == "AccDist") {
	        return $this->chart->addAccDist($height, 0x0000ff);
	    } else if ($indicator == "CLV") {
	        return $this->chart->addCLV($height, 0x0000ff);
	    } else if ($indicator == "WilliamR") {
	        return $this->chart->addWilliamR($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "Aroon") {
	        return $this->chart->addAroon($height, 14, 0x339933, 0x333399);
	    } else if ($indicator == "AroonOsc") {
	        return $this->chart->addAroonOsc($height, 14, 0x0000ff);
	    } else if ($indicator == "CCI") {
	        return $this->chart->addCCI($height, 20, 0x800080, 100, 0xff6666, 0x6666ff);
	    } else if ($indicator == "EMV") {
	        return $this->chart->addEaseOfMovement($height, 9, 0x006060, 0x606000);
	    } else if ($indicator == "MDX") {
	        return $this->chart->addMassIndex($height, 0x800080, 0xff6666, 0x6666ff);
	    } else if ($indicator == "CVolatility") {
	        return $this->chart->addChaikinVolatility($height, 10, 10, 0x0000ff);
	    } else if ($indicator == "COscillator") {
	        return $this->chart->addChaikinOscillator($height, 0x0000ff);
	    } else if ($indicator == "CMF") {
	        return $this->chart->addChaikinMoneyFlow($height, 21, 0x008000);
	    } else if ($indicator == "NVI") {
	        return $this->chart->addNVI($height, 255, 0x0000ff, 0x883333);
	    } else if ($indicator == "PVI") {
	        return $this->chart->addPVI($height, 255, 0x0000ff, 0x883333);
	    } else if ($indicator == "MFI") {
	        return $this->chart->addMFI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "PVO") {
	        return $this->chart->addPVO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "PPO") {
	        return $this->chart->addPPO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "UO") {
	        return $this->chart->addUltimateOscillator($height, 7, 14, 28, 0x800080, 20, 0xff6666, 0x6666ff);
	    } else if ($indicator == "Vol") {
	        return $this->chart->addVolIndicator($height, 0x99ff99, 0xff9999, 0xc0c0c0);
	    } else if ($indicator == "TRIX") {
	        return $this->chart->addTRIX($height, 12, 0x0000ff);
	    }
        else if (strstr($indicator,'trader_')) {
	        //return $this->chart->$indicator(0x9900ff);
	        return $this->chart->trader_cdl($indicator,0x9900ff,'sohail');
	    }
	    return null;
	}

	#/ <summary>
	#/ Creates a dummy chart to show an error message.
	#/ </summary>
	#/ <param name="msg">The error message.
	#/ <returns>The BaseChart object containing the error message.</returns>
	protected function errMsg($msg) {
	    $s = new \MultiChart(400, 200);
	    $textBoxObj = $s->addTitle2(Center, $msg, "arial.ttf", 10);
	    $textBoxObj->setMaxWidth($s->getWidth());
	    return $s;
	}


}