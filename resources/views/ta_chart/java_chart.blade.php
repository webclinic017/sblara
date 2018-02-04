<?php
include(app_path() . '/interactivechart/iChartSettings.php');
?>
<html>
<head>
    <style>
        *{margin:0;padding:0;}
    </style>
</head>
<body>
<!--div>
<h2>Chart Settings</h2><hr/>
<select>
<option value=""></option>
<option value=""></option>
<option value=""></option>
<option value=""></option>
<option value=""></option>
<option value=""></option>
<option value=""></option>
</select>
</div-->


<p>
    <applet name="FnChartsApplet1" width="100%" height="590" codebase="/custom/interactivechart/fncharts" code="FnChartsApplet.class" archive="fncharts.jar" mayscript="true">
        <!-- APPLET CONFIGURATION PARAMETERS -->
        <param name="AppletName" value="FnChartsApplet1">
        <param name="_UserID" value="sample_id12345">
        <param name="Copyright" value="Copyright (c) 1999-2008 WD SOFTWARE http://www.wdsoftware.com">
        <param name="Encoding" value="ISO8859_1">
        <!-- DATA ACCESS PARAMETERS -->
        <param name="DataSource" value="http://www.new.stockbangladesh.com/TechnicalAnalysis/getEodDataForJavaChart/{SYMBOL}/{Timeframe}/{FirstDataTimestamp}/{LastDataTimestamp}">
        <!--param name="DataSource" value="data/{symbol}.txt"-->
       <param name="IntradayDataSource" value="http://www.new.stockbangladesh.com/TechnicalAnalysis/getIntraDayDataForJavaChart/{SYMBOL}/{Timeframe}/{FirstDataTimestamp}/{LastDataTimestamp}">
        <param name="DataIsTimeCompressed" value="false">
        <param name="DisplayDataRequests" value="false">

        <param name="SetRequestProperty_Cookie" value="">
        <param name="UseBrowserCache" value="false">
        <param name="EnableWeekends" value="true">
        <param name="MaxSymbolLength" value="12">
        <!-- AUTOMATIC DATA REFRESH CONFIGURATION -->
        <param name="AutoRefreshTime" value="60">
        <param name="AutoRefreshBeep" value="false">
        <!-- CACHE MEMORY CONFIGURATION -->
        <param name="UnusedCacheRecycleTime" value="10">
        <!-- PREDEFINED SYMBOLS DISPLAYED AUTOMATICALLY AT STARTUP -->
        <!--param name="Symbol" value="DSEGEN"-->
        <param name="Symbol" value="DSEX">
        <param name="SecondarySymbol" value="">
        <!-- PREDEFINED FAVORITE SYMBOLS -->
        <param name="FavoriteSymbols" value="<?=$instrumentList ?>">
        <!-- USER CONFIGURATION SETTINGS-->
        <param name="_UserConfigurationLoadURL" value="userdata/load_configuration.php?userID={UserID}">
        <param name="_UserConfigurationSaveURL" value="userdata/save_configuration.php?userID={UserID}">
        <param name="LoadUserConfigurationOnStartup" value="true">
        <param name="RestoreSelectedSymbolsFromUserConfiguration" value="false">
        <!-- USER STUDIES SETTINGS-->
        <param name="AutoLoadStudies" value="false">
        <param name="_UserStudiesLoadURL" value="userdata/load_studies.php?userID={UserID}&symbol={symbol}&dataType={Periodicity}">
        <param name="_UserStudiesSaveURL" value="userdata/save_studies.php?userID={UserID}&symbol={symbol}&dataType={Periodicity}">
        <!-- CONFIGURATION OF BUY AND SELL BUTTONS -->
        <param name="BuyURL" value="">
        <param name="SellURL" value="">
        <param name="target" value="_blank">
        <param name="BuySellAction" value="">
        <param name="EnableStatusBarBuySellButtons" value="false">
        <!-- USER-DEFINED INDICATORS -->
        <param name="_PredefinedIndicatorsURL" value="userdata/predefined_indicators.txt">
        <param name="_UserIndicatorsLoadURL" value="userdata/load_indicators.php?userID={UserID}">
        <param name="_UserIndicatorsSaveURL" value="userdata/save_indicators.php?userID={UserID}">
        <param name="EnableUserIndicatorDefinition" value="false">
        <!-- INITIAL TECHNICAL ANALYSIS SETTINGS (OVERRIDABLE BY USERS) -->
        <param name="ChartType" value="candle">
        <param name="Scale" value="LogUncorrelated">
        <param name="UseOldTimeCompressionMethod" value="false">
        <param name="TimeCompression" value="day">
        <!--param name="Indicators" value="VOL;MACD(12,26,9);ROC(5,9);RSI(14,30,70)"-->
        <param name="Indicator1" value="RSI(14,30,70)">
        <param name="Indicator2" value="MACD(12,26,9)">
        <param name="Indicator3" value="vol">
        <param name="PriceIndicators" value="SMA1;SMA2;SMA3">
        <param name="TimeCompressionOptions" value="day,week,month,intraday,intraday_1s,intraday_2s,intraday_3s,intraday_4s,intraday_5s,intraday_10s,intraday_15s,intraday_20s,intraday_30s,intraday_1,intraday_2,intraday_3,intraday_4,intraday_5,intraday_10,intraday_15,intraday_20,intraday_30,intraday_60">
        <!-- INITIAL VISIBLE RANGE (CUSTOMIZABLE BY USERS)-->
        <param name="DisplayRange" value="6months">
        <!-- INITIAL TIMEFRAME SETTINGS (CUSTOMIZABLE BY USERS)-->
        <param name="Timeframe" value="0">
        <param name="IntradayTimeframe" value="0">
        <!-- UI APPEARANCE -->
        <param name="BorderColor" value="0x000000">
        <param name="UIFontName" value="">
        <param name="UIFontSize" value="11">
        <param name="UIFontStyle" value="PLAIN">
        <param name="UIBgColor" value="0x727272">
        <param name="UITextColor" value="0xFFFFFF">
        <param name="StatusBarFontName" value="">
        <param name="StatusBarFontSize" value="11">
        <param name="StatusBarFontStyle" value="PLAIN">
        <param name="ImageButtonBgColor" value="0xFFCC16">
        <param name="ImageButtonFrameColor" value="0x000000">
        <param name="IconType" value="BW">
        <param name="HideSymbolEntryForm" value="false">
        <param name="EnableSymbolListModification" value="true">
        <param name="SymbolEntryFormWidth" value="">
        <param name="DisableAppletDetachment" value="false">
        <param name="DisableSymbolEntryFormVisibilitySwitch" value="false">
        <param name="DisableAutofocusOnMouseOnChart" value="true">
        <!-- CHART APPEARANCE -->
        <param name="DisableMouseWheelScrolling" value="true">
        <param name="DisableAutofocusOnMouseOnChart" value="true">
        <param name="RestrictToolsToChartFg" value="false">
        <param name="ShowTitle" value="true">
        <param name="ShowLegend" value="true">
        <param name="ShowCrosshair" value="true">
        <param name="ShowGrid" value="true">
        <param name="ShowBuySellSignals" value="true">
        <param name="ChartBgColor" value="0x000000">
        <param name="ChartFgColor" value="0x000000">
        <param name="ChartTitleColor" value="0xFFFFFF">
        <param name="ChartTitleBgColor" value="0x808080">
        <param name="ChartTitleFrameColor" value="0xFFFFFF">
        <param name="AxisColor" value="0xA0A0A0">
        <param name="AxisLabelColor" value="0xFFFFFF">
        <param name="AxisLabelBgColor" value="">
        <param name="AxisLabelFrameColor" value="">
        <param name="InfoLineColor" value="0xFFFFFF">
        <param name="InfoLineBgColor" value="">
        <param name="InfoLineFrameColor" value="">
        <param name="ProgressBarColor" value="0xFF0000">
        <param name="BuySignalColor" value="0x00C800">
        <param name="SellSignalColor" value="0xE80000">
        <param name="DecimalPlaces" value="-1">
        <param name="DateDisplayFormat" value="mm/dd/yy">
        <!-- CHART FONTS -->
        <param name="ChartTitleFontName" value="">
        <param name="ChartTitleFontSize" value="10">
        <param name="ChartTitleFontStyle" value="PLAIN">
        <param name="InfoLineFontName" value="">
        <param name="InfoLineFontSize" value="10">
        <param name="InfoLineFontStyle" value="PLAIN">
        <param name="AxisLabelFontName" value="">
        <param name="AxisLabelFontSize" value="10">
        <param name="AxisLabelFontStyle" value="PLAIN">
        <param name="LegendFontName" value="SansSerif">
        <param name="LegendFontStyle" value="BOLD">
        <param name="LegendFontSize" value="11">
        <!-- CHART COLORS (CUSTOMIZABLE BY USERS) -->
        <param name="GridColor" value="0x989898">
        <param name="CrosshairColor" value="0xA00000">
        <param name="PriceColor" value="0xFFFF00">
        <param name="BullishCandleColor" value="0x00D800">
        <param name="BearishCandleColor" value="0xF80000">
        <param name="BgPriceColor" value="0xE7E7FF">
        <param name="ExtraPriceColor" value="0xF80000,0x00E000,0x0000FF,0xFF00FF,0x00FFFF,0xFFA448,0xc0c0c0,0x00A000,0xE1E100,0xCE0500">
        <param name="DMAColor" value="0x808080">
        <param name="OpenInterestColor" value="0x0000A0">
        <param name="EMA1Color" value="0x00B0C0">
        <param name="EMA2Color" value="0xBF00BF">
        <param name="EMA3Color" value="0x1135BF">
        <param name="SMA1Color" value="0xFF0000">
        <param name="SMA2Color" value="0xFF00FF">
        <param name="SMA3Color" value="0x3165FF">
        <param name="WMAColor" value="0x00DD00">
        <param name="BOLColor" value="0xCE65CE">
        <param name="ParabolicSARColor" value="0x5185FF">
        <param name="IndicatorColor" value="0xFFCC00,0x33CCFF,0xFF99FF">
        <param name="TrendLineColor" value="0xFF0000">
        <param name="IndicatorSpecificLineColor" value="0xFFFFFF">
        <!-- CHART LINE WIDTHS (CUSTOMIZABLE BY USERS) -->
        <param name="PriceLineWidth" value="2">
        <param name="BgPriceLineWidth" value="0">
        <param name="ExtraPriceLineWidth" value="0,0,0,0,0,0,0,0,0,0">
        <param name="OpenInterestLineWidth" value="1">
        <param name="EMA1LineWidth" value="0">
        <param name="EMA2LineWidth" value="0">
        <param name="EMA3LineWidth" value="0">
        <param name="SMA1LineWidth" value="0">
        <param name="SMA2LineWidth" value="0">
        <param name="SMA3LineWidth" value="0">
        <param name="WMALineWidth" value="0">
        <param name="BOLLineWidth" value="0,0">
        <param name="ParabolicSARLineWidth" value="1">
        <param name="IndicatorLineWidth" value="1,0,0">
        <!-- THIS MESSAGE IS DISPLAYED WHEN JAVA SUPPORT IS NOT ENABLED -->
        Java support must be enabled in order to display FnCharts.
        <br>You can download Java from <a href="http://www.java.com">http://www.java.com</a>
    </applet>
    <!--
    <br>
    <a href="http://www.wdsoftware.com">
    Interactive Stock Charts provided by WD SOFTWARE
    </a>
    -->
</p>

<p>
<b> Java support must be enabled in order to display Interactive Chart .If java is not installed in your browser </b><a class="btn red" data-target="#stack1" data-toggle="modal"> View how you can install java in your browser  </a>
</p>





<!-- stackable -->
<div id="stack1" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Java support must be enabled in order to display FnCharts.
   <br>You can download Java from <a href="http://www.java.com" target="_blank" >http://www.java.com</a>
  </p>



  <img src="/img/javaInstall/1.downloadJava.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button class="btn blue" data-toggle="modal" href="#stack2">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack2" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Download "jxpiinstall.exe" file
  </p>

  <img src="/img/javaInstall/2.saveExe.JPG" alt="Smiley face" height="500" width="800">

 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack3">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack3" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Go to the folder where the exe file is downloaded
  </p>

  <img src="/img/javaInstall/3.goto the downloadfolder.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack4">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack4" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Install "jxpiinstall.exe"
  </p>

  <img src="/img/javaInstall/4.install.JPG" alt="Smiley face" height="500" width="800">

 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack5">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack5" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   After installation , go to control panel and select java
  </p>

  <img src="/img/javaInstall/5.control panel & java.JPG" alt="Smiley face" height="500" width="800">
 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack6">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack6" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   After opening the java control panel select the tab "security" And click the button "Edit Site List.."
  </p>

  <img src="/img/javaInstall/6.tabSecurity.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack7">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack7" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Click Add button to add an url
  </p>



  <img src="/img/javaInstall/7.add button click.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack8">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack8" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>
   Add the url "http://www.new.stockbangladesh.com" and click "ok" to save it
  </p>



  <img src="/img/javaInstall/8.add domine.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack9">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack9" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack One</h4>
 </div>
 <div class="modal-body">
  <p>Click continue for confirmation
  </p>



  <img src="/img/javaInstall/9.continue Security.JPG" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button class="btn blue" data-toggle="modal" href="#stack10">Next</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>
<div id="stack10" class="modal container fade" tabindex="-1" data-focus-on="input:first">
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">Stack Three</h4>
 </div>
 <div class="modal-body">
  <p>
   Restart the browser and visit the chart again
  </p>



  <img src="/img/javaInstall/10.restartBrowser.jpg" alt="Smiley face" height="500" width="800">


 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-default">Prev</button>
  <button type="button" data-dismiss="modal" class="btn btn-default closeAll">Close All</button>
 </div>
</div>


</body>
</html>
