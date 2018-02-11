<?php 
namespace App\Classes;
/**
* StockBangladesh Server Side Ta Chart
* @author Selim
*/
class Chart 
{	
	/**
	 * @var   vars
	 */
	protected $indicators = ['RSI', 'MACD'];
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

	/**
	* Initializing the chart
	*
	* @return void
	*/ 
	 function __construct( $instrument)
	{
		// Require Chart Library By chartDirector
		require_once(app_path() . '/ChartDirector/FinanceChart.php');

		 $this->startDate = date('Y-m-d', strtotime(' -220 days'));
		 $this->endDate = date('Y-m-d');		
		
		# create the finance chart
		$c = $this->drawChart();

		// Output the chart
		 echo "<img src='data:image/png;base64, ". base64_encode($c->makeChart2(PNG)) ."'  usemap=\"#map1\">";
	   $imageMap = $c->getHTMLImageMap("", "", "title='" . $c->getToolTipDateFormat() . " {value|G}'");
		 echo "<map name=\"map1\">$imageMap</map>";
		// a chart with a specific instrument
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
		return $this->TickerSymbol;
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
		if(!$this->indicators)
		{
			return [];
		}

		if($single)
		{
			$value = $this->indicators[0];
			unset($this->indicators[0]);
			return $value;
		}
		return $this->indicators;
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
	    $ohlcData = \App\Repositories\ChartRepository::getAdjustedDailyData(12, $this->startDate, $this->endDate, 21);
        $timeStamps = array_reverse($ohlcData['date']);
        $openData = array_reverse($ohlcData['open']);
        $highData = array_reverse($ohlcData['high']);
        $lowData = array_reverse($ohlcData['low']);
        $closeData = array_reverse($ohlcData['close']);
        $volData = array_reverse($ohlcData['volume']);	    
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
	        get15MinData($ticker, $adjustedStartDate, $endDate);

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
	        getMonthlyData($ticker, $adjustedStartDate, $endDate);

	    } else if ($durationInDays >= 1.5 * 360) {
	        # 1 year or more - use weekly points.
	        $resolution = 7 * 86400;

	        # Adjust startDate backwards to cater for extraPoints
	        $adjustedStartDate = $startDate - $extraPoints * 7 * 86400 - 6 * 86400;

	        # Get the required weekly data
	        getWeeklyData($ticker, $adjustedStartDate, $endDate);

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
	        return errMsg("Please enter a valid ticker symbol");
	    }

	    # We now confirm the actual number of extra points (data points that are before the start date)
	    # as inferred using actual data from the database.
	    $extraPoints = count($timeStamps);
	    for($i = 0; $i < count($timeStamps); ++$i) {
	        if ($timeStamps[$i] >= $startDate) {
	            $extraPoints = $i;
	            break;
	        }
	    }

	    # Check if there is any valid data
	    if ($extraPoints >= count($timeStamps)) {
	        # No data - just display the no data message.
	        return errMsg("No data available for the specified time period");
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
	    $width = 780;
	    $mainHeight = 255;
	    $indicatorHeight = 80;

	    $size = $this->ChartSize;
	    if ($size == "S") {
	        # Small chart size
	        $width = 450;
	        $mainHeight = 160;
	        $indicatorHeight = 60;
	    } else if ($size == "M") {
	        # Medium chart size
	        $width = 620;
	        $mainHeight = 215;
	        $indicatorHeight = 70;
	    } else if ($size == "H") {
	        # Huge chart size
	        $width = 1000;
	        $mainHeight = 320;
	        $indicatorHeight = 90;
	    }

	    # Create the chart object using the selected size
	    $m = new \FinanceChart($width);

	    # Set the data into the chart object
	    $m->setData($timeStamps, $highData, $lowData, $openData, $closeData, $volData, $extraPoints);

	    #
	    # We configure the title of the chart. In this demo chart design, we put the company name as the
	    # top line of the title with left alignment.
	    #
	    $m->addPlotAreaTitle(TopLeft, "SIMPLEPIE_LOCATOR_REMOTE_BODY");

	    # We displays the current date as well as the data resolution on the next line.
	    $resolutionText = "";
	    if ($resolution == 30 * 86400) {
	        $resolutionText = "Monthly";
	    } else if ($resolution == 7 * 86400) {
	        $resolutionText = "Weekly";
	    } else if ($resolution == 86400) {
	        $resolutionText = "Daily";
	    } else if ($resolution == 900) {
	        $resolutionText = "15-min";
	    }

	    $m->addPlotAreaTitle(BottomLeft, sprintf("<*font=arial.ttf,size=8*>%s - %s chart",
	        $m->formatValue(chartTime2(time()), "mmm dd, yyyy"), $resolutionText));

	    # A copyright message at the bottom left corner the title area
	    $m->addPlotAreaTitle(BottomRight, "<*font=arial.ttf,size=8*>(c) ".config('app.name'));

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
	    $m->addMainChart($mainHeight);

	    #
	    # Set log or linear scale according to user preference
	    #
	    if ($this->LogScale == "1") {
	        $m->setLogScale(true);
	    }

	    #
	    # Set axis labels to show data values or percentage change to user preference
	    #
	    if ($this->PercentageScale == "1") {
	        $m->setPercentageAxis();
	    }

	    #
	    # Draw any price line the user has selected
	    #
	    $mainType = $this->ChartType;
	    if ($mainType == "Close") {
	        $m->addCloseLine(0x000040);
	    } else if ($mainType == "TP") {
	        $m->addTypicalPrice(0x000040);
	    } else if ($mainType == "WC") {
	        $m->addWeightedClose(0x000040);
	    } else if ($mainType == "Median") {
	        $m->addMedianPrice(0x000040);
	    }

	    #
	    # Add comparison line if there is data for comparison
	    #
	    if ($compareData != null) {
	        if (count($compareData) > $extraPoints) {
	            $m->addComparison($compareData, 0x0000ff, $compareKey);
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
	        $m->addCandleStick(0x33ff33, 0xff3333);
	    } else if ($mainType == "OHLC") {
	        $m->addHLOC(0x008800, 0xcc0000);
	    }

	    #
	    # Add parabolic SAR if necessary
	    #
	    if ($this->ParabolicSAR == "1") {
	        $m->addParabolicSAR(0.02, 0.02, 0.2, DiamondShape, 5, 0x008800, 0x000000);
	    }

	    #
	    # Add price band/channel/envelop to the chart according to user selection
	    #
	    $bandType = $this->Band;
	    if ($bandType == "BB") {
	        $m->addBollingerBand(20, 2, 0x9999ff, 0xc06666ff);
	    } else if ($bandType == "DC") {
	        $m->addDonchianChannel(20, 0x9999ff, 0xc06666ff);
	    } else if ($bandType == "Envelop") {
	        $m->addEnvelop(20, 0.1, 0x9999ff, 0xc06666ff);
	    }

	    #
	    # Add volume bars to the main chart if necessary
	    #
	    if ($this->Volume == "1") {
	        $m->addVolBars($indicatorHeight, 0x99ff99, 0xff9999, 0xc0c0c0);
	    }

	    #
	    # Add additional indicators as according to user selection.
	    #
	    foreach ($this->getIndicators() as $value) {
		    $this->addIndicator($m, $value, $indicatorHeight);
	    }

	    return $m;
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
	            return $m->addSimpleMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "EMA") {
	            return $m->addExpMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "TMA") {
	            return $m->addTriMovingAvg($avgPeriod, $color);
	        } else if ($avgType == "WMA") {
	            return $m->addWeightedMovingAvg($avgPeriod, $color);
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
	        return $m->addRSI($height, 14, 0x800080, 20, 0xff6666, 0x6666ff);
	    } else if ($indicator == "StochRSI") {
	        return $m->addStochRSI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "MACD") {
	        return $m->addMACD($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "FStoch") {
	        return $m->addFastStochastic($height, 14, 3, 0x006060, 0x606000);
	    } else if ($indicator == "SStoch") {
	        return $m->addSlowStochastic($height, 14, 3, 0x006060, 0x606000);
	    } else if ($indicator == "ATR") {
	        return $m->addATR($height, 14, 0x808080, 0x0000ff);
	    } else if ($indicator == "ADX") {
	        return $m->addADX($height, 14, 0x008000, 0x800000, 0x000080);
	    } else if ($indicator == "DCW") {
	        return $m->addDonchianWidth($height, 20, 0x0000ff);
	    } else if ($indicator == "BBW") {
	        return $m->addBollingerWidth($height, 20, 2, 0x0000ff);
	    } else if ($indicator == "DPO") {
	        return $m->addDPO($height, 20, 0x0000ff);
	    } else if ($indicator == "PVT") {
	        return $m->addPVT($height, 0x0000ff);
	    } else if ($indicator == "Momentum") {
	        return $m->addMomentum($height, 12, 0x0000ff);
	    } else if ($indicator == "Performance") {
	        return $m->addPerformance($height, 0x0000ff);
	    } else if ($indicator == "ROC") {
	        return $m->addROC($height, 12, 0x0000ff);
	    } else if ($indicator == "OBV") {
	        return $m->addOBV($height, 0x0000ff);
	    } else if ($indicator == "AccDist") {
	        return $m->addAccDist($height, 0x0000ff);
	    } else if ($indicator == "CLV") {
	        return $m->addCLV($height, 0x0000ff);
	    } else if ($indicator == "WilliamR") {
	        return $m->addWilliamR($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "Aroon") {
	        return $m->addAroon($height, 14, 0x339933, 0x333399);
	    } else if ($indicator == "AroonOsc") {
	        return $m->addAroonOsc($height, 14, 0x0000ff);
	    } else if ($indicator == "CCI") {
	        return $m->addCCI($height, 20, 0x800080, 100, 0xff6666, 0x6666ff);
	    } else if ($indicator == "EMV") {
	        return $m->addEaseOfMovement($height, 9, 0x006060, 0x606000);
	    } else if ($indicator == "MDX") {
	        return $m->addMassIndex($height, 0x800080, 0xff6666, 0x6666ff);
	    } else if ($indicator == "CVolatility") {
	        return $m->addChaikinVolatility($height, 10, 10, 0x0000ff);
	    } else if ($indicator == "COscillator") {
	        return $m->addChaikinOscillator($height, 0x0000ff);
	    } else if ($indicator == "CMF") {
	        return $m->addChaikinMoneyFlow($height, 21, 0x008000);
	    } else if ($indicator == "NVI") {
	        return $m->addNVI($height, 255, 0x0000ff, 0x883333);
	    } else if ($indicator == "PVI") {
	        return $m->addPVI($height, 255, 0x0000ff, 0x883333);
	    } else if ($indicator == "MFI") {
	        return $m->addMFI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
	    } else if ($indicator == "PVO") {
	        return $m->addPVO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "PPO") {
	        return $m->addPPO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
	    } else if ($indicator == "UO") {
	        return $m->addUltimateOscillator($height, 7, 14, 28, 0x800080, 20, 0xff6666, 0x6666ff);
	    } else if ($indicator == "Vol") {
	        return $m->addVolIndicator($height, 0x99ff99, 0xff9999, 0xc0c0c0);
	    } else if ($indicator == "TRIX") {
	        return $m->addTRIX($height, 12, 0x0000ff);
	    }
	    return null;
	}

	#/ <summary>
	#/ Creates a dummy chart to show an error message.
	#/ </summary>
	#/ <param name="msg">The error message.
	#/ <returns>The BaseChart object containing the error message.</returns>
	protected function errMsg($msg) {
	    $m = new MultiChart(400, 200);
	    $textBoxObj = $m->addTitle2(Center, $msg, "arial.ttf", 10);
	    $textBoxObj->setMaxWidth($m->getWidth());
	    return $m;
	}


}