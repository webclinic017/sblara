{{--http://demo_chart.tradingview.com/--}}


<div id="tv_chart_container"></div>
@push('scripts')
<script src="{{ asset('metronic_custom/charting_library/charting_library.min.js') }}"></script>
<script src="{{ asset('metronic_custom/charting_library/datafeed/udf/datafeed.js') }}"></script>

		<script type="text/javascript">

            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                        results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

var referenceChart = {
    layout: "s",
    charts: [{
        panes: [{
            sources: [{
                type: "MainSeries",
                id: "2QYAE5",
                state: {
                    style: 1,
                    esdShowDividends: !0,
                    esdShowSplits: !0,
                    esdShowEarnings: !0,
                    esdShowBreaks: !1,
                    esdBreaksStyle: {color: "rgba( 226, 116, 91, 1)", style: 2, width: 1},
                    esdFlagSize: 2,
                    showCountdown: !1,
                    showInDataWindow: !0,
                    visible: !0,
                    silentIntervalChange: !1,
                    showPriceLine: !0,
                    priceLineWidth: 1,
                    lockScale: !1,
                    minTick: "default",
                    extendedHours: !1,
                    sessVis: !1,
                    statusViewStyle: {fontSize: 17, showExchange: !0, showInterval: !0, showSymbolAsDescription: !1},
                    candleStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        drawWick: !0,
                        drawBorder: !0,
                        borderColor: "rgba( 55, 134, 88, 1)",
                        borderUpColor: "rgba( 34, 84, 55, 1)",
                        borderDownColor: "rgba( 91, 26, 19, 1)",
                        wickColor: "rgba( 115, 115, 117, 1)",
                        wickUpColor: "rgba( 115, 115, 117, 1)",
                        wickDownColor: "rgba( 115, 115, 117, 1)",
                        barColorsOnPrevClose: !1
                    },
                    hollowCandleStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        drawWick: !0,
                        drawBorder: !0,
                        borderColor: "rgba( 55, 134, 88, 1)",
                        borderUpColor: "rgba( 34, 84, 55, 1)",
                        borderDownColor: "rgba( 91, 26, 19, 1)",
                        wickColor: "rgba( 115, 115, 117, 1)",
                        wickUpColor: "rgba( 115, 115, 117, 1)",
                        wickDownColor: "rgba( 115, 115, 117, 1)"
                    },
                    haStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        drawWick: !0,
                        drawBorder: !0,
                        borderColor: "rgba( 55, 134, 88, 1)",
                        borderUpColor: "rgba( 34, 84, 55, 1)",
                        borderDownColor: "rgba( 91, 26, 19, 1)",
                        wickColor: "rgba( 115, 115, 117, 1)",
                        wickUpColor: "rgba( 115, 115, 117, 1)",
                        wickDownColor: "rgba( 115, 115, 117, 1)",
                        showRealLastPrice: !1,
                        barColorsOnPrevClose: !1
                    },
                    barStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        barColorsOnPrevClose: !1,
                        dontDrawOpen: !1
                    },
                    lineStyle: {
                        color: "rgba( 60, 120, 216, 1)",
                        linestyle: 0,
                        linewidth: 1,
                        priceSource: "close",
                        styleType: 2
                    },
                    areaStyle: {
                        color1: "rgba( 96, 96, 144, 0.5)",
                        color2: "rgba( 1, 246, 245, 0.5)",
                        linecolor: "rgba( 0, 148, 255, 1)",
                        linestyle: 0,
                        linewidth: 1,
                        priceSource: "close",
                        transparency: 50
                    },
                    priceAxisProperties: {
                        autoScale: !0,
                        autoScaleDisabled: !1,
                        percentage: !1,
                        percentageDisabled: !1,
                        log: !1,
                        logDisabled: !1,
                        alignLabels: !0
                    },
                    renkoStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        borderUpColor: "rgba( 34, 84, 55, 1)",
                        borderDownColor: "rgba( 91, 26, 19, 1)",
                        upColorProjection: "rgba( 74, 214, 190, 1)",
                        downColorProjection: "rgba( 214, 73, 207, 1)",
                        borderUpColorProjection: "rgba( 34, 84, 55, 1)",
                        borderDownColorProjection: "rgba( 91, 26, 19, 1)",
                        inputs: {source: "close", boxSize: 3, style: "ATR", atrLength: 14},
                        inputInfo: {
                            source: {name: "Source"},
                            boxSize: {name: "Box size"},
                            style: {name: "Style"},
                            atrLength: {name: "ATR Length"}
                        }
                    },
                    pbStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        borderUpColor: "rgba( 34, 84, 55, 1)",
                        borderDownColor: "rgba( 91, 26, 19, 1)",
                        upColorProjection: "rgba( 74, 214, 190, 1)",
                        downColorProjection: "rgba( 214, 73, 207, 1)",
                        borderUpColorProjection: "rgba( 34, 84, 55, 1)",
                        borderDownColorProjection: "rgba( 91, 26, 19, 1)",
                        inputs: {source: "close", lb: 3},
                        inputInfo: {source: {name: "Source"}, lb: {name: "Number of line"}}
                    },
                    kagiStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        upColorProjection: "rgba( 74, 214, 190, 1)",
                        downColorProjection: "rgba( 214, 73, 207, 1)",
                        inputs: {source: "close", style: "Traditional", atrLength: 14, reversalAmount: 1},
                        inputInfo: {
                            source: {name: "Source"},
                            style: {name: "Style"},
                            atrLength: {name: "ATR Length"},
                            reversalAmount: {name: "Reversal amount"}
                        }
                    },
                    pnfStyle: {
                        upColor: "rgba( 107, 165, 131, 1)",
                        downColor: "rgba( 215, 84, 66, 1)",
                        upColorProjection: "rgba( 74, 214, 190, 1)",
                        downColorProjection: "rgba( 214, 73, 207, 1)",
                        inputs: {sources: "HL", reversalAmount: 3, boxSize: 1, style: "ATR", atrLength: 14},
                        inputInfo: {
                            sources: {name: "Source"},
                            boxSize: {name: "Box size"},
                            reversalAmount: {name: "Reversal amount"},
                            style: {name: "Style"},
                            atrLength: {name: "ATR Length"}
                        }
                    },
                    symbol: "{{request()->has('instrumentCode')?request()->instrumentCode:'DSEX'}}",
                    shortName: "{{request()->has('instrumentCode')?request()->instrumentCode:'DSEX'}}",
                    timeframe: "",
                    onWidget: !1,
                    interval: "D",
                    showSessions: !1
                },
                zorder: -1
            }, {
                type: "Study",
                id: "izr0Sz",
                state: {
                    styles: {
                        vol: {
                            linestyle: 0,
                            linewidth: 1,
                            plottype: 5,
                            trackPrice: !1,
                            transparency: 65,
                            visible: !0,
                            color: "#000080",
                            histogramBase: 0,
                            joinPoints: !1,
                            title: "Volume"
                        },
                        vol_ma: {
                            linestyle: 0,
                            linewidth: 1,
                            plottype: 4,
                            trackPrice: !1,
                            transparency: 65,
                            visible: !0,
                            color: "#0496FF",
                            histogramBase: 0,
                            joinPoints: !1,
                            title: "Volume MA"
                        }
                    },
                    precision: "default",
                    palettes: {
                        volumePalette: {
                            colors: {
                                "0": {color: "#FF0000", width: 1, style: 0, name: "Color 0"},
                                "1": {color: "#008000", width: 1, style: 0, name: "Color 1"}
                            }
                        }
                    },
                    inputs: {
                        "0": {id: "showMA", name: "show MA", defval: !1, type: "bool"},
                        "1": {id: "maLength", name: "MA Length", defval: 20, type: "integer", min: 1, max: 2e3},
                        showMA: !0,
                        maLength: 20
                    },
                    bands: {},
                    area: {},
                    graphics: {},
                    showInDataWindow: !0,
                    visible: !0,
                    showStudyArguments: !0,
                    plots: {
                        "0": {id: "vol", type: "line"},
                        "1": {id: "volumePalette", palette: "volumePalette", target: "vol", type: "colorer"},
                        "2": {id: "vol_ma", type: "line"}
                    },
                    _metainfoVersion: 15,
                    isTVScript: !1,
                    isTVScriptStub: !1,
                    is_hidden_study: !1,
                    transparency: 65,
                    description: "Volume",
                    shortDescription: "Volume",
                    is_price_study: !1,
                    id: "Volume@tv-basicstudies",
                    description_localized: "Volume",
                    shortId: "Volume",
                    packageId: "tv-basicstudies",
                    version: "1",
                    fullId: "Volume@tv-basicstudies-1",
                    productId: "tv-basicstudies",
                    name: "Volume@tv-basicstudies",
                    matchPriority: 2,
                    matchIndex: 0
                },
                zorder: -3,
                metaInfo: {
                    palettes: {volumePalette: {colors: {"0": {name: "Color 0"}, "1": {name: "Color 1"}}}},
                    inputs: [{id: "showMA", name: "show MA", defval: !1, type: "bool"}, {
                        id: "maLength",
                        name: "MA Length",
                        defval: 20,
                        type: "integer",
                        min: 1,
                        max: 2e3
                    }],
                    plots: [{id: "vol", type: "line"}, {
                        id: "volumePalette",
                        palette: "volumePalette",
                        target: "vol",
                        type: "colorer"
                    }, {id: "vol_ma", type: "line"}],
                    graphics: {},
                    defaults: {
                        styles: {
                            vol: {
                                linestyle: 0,
                                linewidth: 1,
                                plottype: 5,
                                trackPrice: !1,
                                transparency: 65,
                                visible: !0,
                                color: "#000080"
                            },
                            vol_ma: {
                                linestyle: 0,
                                linewidth: 1,
                                plottype: 4,
                                trackPrice: !1,
                                transparency: 65,
                                visible: !0,
                                color: "#0496FF"
                            }
                        },
                        precision: 0,
                        palettes: {
                            volumePalette: {
                                colors: {
                                    "0": {color: "#FF0000", width: 1, style: 0},
                                    "1": {color: "#008000", width: 1, style: 0}
                                }
                            }
                        },
                        inputs: {showMA: !1, maLength: 20}
                    },
                    _metainfoVersion: 15,
                    isTVScript: !1,
                    isTVScriptStub: !1,
                    is_hidden_study: !1,
                    transparency: 65,
                    styles: {vol: {title: "Volume", histogramBase: 0}, vol_ma: {title: "Volume MA", histogramBase: 0}},
                    description: "Volume",
                    shortDescription: "Volume",
                    is_price_study: !1,
                    id: "Volume@tv-basicstudies-1",
                    description_localized: "Volume",
                    shortId: "Volume",
                    packageId: "tv-basicstudies",
                    version: "1",
                    fullId: "Volume@tv-basicstudies-1",
                    productId: "tv-basicstudies",
                    name: "Volume@tv-basicstudies"
                }
            }],
            leftAxisState: {
                m_priceRange: {m_minValue: -.5, m_maxValue: .5},
                m_isAutoScale: !0,
                m_isPercentage: !1,
                m_isLog: !1,
                m_height: 509,
                m_topMargin: .05,
                m_bottomMargin: .05
            },
            leftAxisSources: [],
            rightAxisState: {
                m_priceRange: {m_minValue: 4356.34481, m_maxValue: 5739.04308},
                m_isAutoScale: !0,
                m_isPercentage: !1,
                m_isLog: !1,
                m_height: 509,
                m_topMargin: .05,
                m_bottomMargin: .05
            },
            rightAxisSources: ["2QYAE5"],
            overlayPriceScales: {
                izr0Sz: {
                    m_priceRange: {m_minValue: 0, m_maxValue: 218079436},
                    m_isAutoScale: !0,
                    m_isPercentage: !1,
                    m_isLog: !1,
                    m_height: 509,
                    m_topMargin: .75,
                    m_bottomMargin: 0
                }
            },
            stretchFactor: 2e3,
            mainSourceId: "2QYAE5"
        }],
        timeScale: {m_barSpacing: 6, m_rightOffset: 5},
        chartProperties: {
            paneProperties: {
                background: "rgba( 255, 255, 255, 1)",
                gridProperties: {color: "#E6E6E6", style: 0},
                vertGridProperties: {color: "rgba( 230, 230, 230, 1)", style: 0},
                horzGridProperties: {color: "rgba( 230, 230, 230, 1)", style: 0},
                crossHairProperties: {color: "rgba( 183, 183, 183, 1)", style: 2, transparency: 0, width: 1},
                topMargin: 5,
                bottomMargin: 5,
                leftAxisProperties: {
                    autoScale: !0,
                    autoScaleDisabled: !1,
                    percentage: !1,
                    percentageDisabled: !1,
                    log: !1,
                    logDisabled: !1,
                    alignLabels: !0
                },
                rightAxisProperties: {
                    autoScale: !0,
                    autoScaleDisabled: !1,
                    percentage: !1,
                    percentageDisabled: !1,
                    log: !1,
                    logDisabled: !1,
                    alignLabels: !0
                },
                overlayPropreties: {
                    autoScale: !0,
                    autoScaleDisabled: !1,
                    percentage: !1,
                    percentageDisabled: !1,
                    log: !1,
                    logDisabled: !1,
                    alignLabels: !0
                },
                legendProperties: {
                    showStudyArguments: !0,
                    showStudyTitles: !0,
                    showStudyValues: !0,
                    showSeriesTitle: !0,
                    showSeriesOHLC: !0,
                    showLegend: !0
                }
            },
            scalesProperties: {
                showLeftScale: !1,
                showRightScale: !0,
                backgroundColor: "rgba( 255, 255, 255, 1)",
                lineColor: "rgba( 85, 85, 85, 1)",
                textColor: "rgba( 85, 85, 85, 1)",
                fontSize: 11,
                scaleSeriesOnly: !1,
                showSeriesLastValue: !0,
                showStudyLastValue: !0,
                showSymbolLabels: !1,
                showStudyPlotLabels: !0
            },
            chartEventsSourceProperties: {
                visible: !0,
                futureOnly: !0,
                breaks: {color: "rgba(85, 85, 85, 1)", visible: !1, style: 2, width: 1}
            }
        },
        version: 2,
        timezone: "Etc/UTC+6"
    }]
}, symbol = getParameterByName("symbol"), savedWidgetContent = null;


function SymbolisNullOrEmpty(n) {
    return n === undefined || n == null ? !0 : (n = n.trim(), !n || 0 === n.length)
}
			TradingView.onready(function()
			{
				var widget = window.tvWidget = new TradingView.widget({
				    width: "100%",
					symbol:"{{request()->has('instrumentCode')?request()->instrumentCode:'DSEX'}}",
					interval: 'D',
					allow_symbol_change: !0,
                    disable_logo: !0,
                    hideideas: !0,
                    withDateRanges: !1,
					container_id: "tv_chart_container",
					//	BEWARE: no trailing slash is expected in feed URL
					datafeed: new Datafeeds.UDFCompatibleDatafeed("{{ url('/') }}",60000), // update frequency 60 sec

					library_path: "metronic_custom/charting_library/",
					locale: "en",
                    drawings_access: {type: "black", tools: [{name: "Regression Trend"}]},
                    disabled_features: ["use_localstorage_for_settings","widget_logo"],
                    charts_storage_api_version: "1.1",
					client_id: 'stockbangladesh.com',
					user_id: 'stockbangladesh.com'


				});
				widget.onChartReady(function () {
                        try {
                            savedWidgetContent = JSON.parse(localStorage.getItem("tvObject"))
                        } catch (t) {
                            localStorage.removeItem("tvObject");
                            localStorage.setItem("tvObject", JSON.stringify(referenceChart));
                            savedWidgetContent = referenceChart
                        }
SymbolisNullOrEmpty(symbol) ? savedWidgetContent ? widget.load(savedWidgetContent) : widget.load(referenceChart) : (widget.chart().createStudy("Volume", !0, !1, [20]));
                        widget.createButton().attr("title", "Chart layout and all drawing will be saved for next visit").on("click", function () {
                            widget.save(function (widget) {
                                savedWidgetContent = widget;
                                var t = JSON.stringify(widget);
                                localStorage.setItem("tvObject", JSON.stringify(widget));
                                alert("Successfully Saved chart")
                            })
                        }).append($("<span>Save Settings<\/span>"));
                        widget.createButton().attr("title", "previously saved last layouts and drawings will be loaded").on("click", function () {
                            savedWidgetContent && widget.load(savedWidgetContent)
                        }).append($("<span>Load Settings<\/span>"));
                         widget.chart().createStudy('macd-4c', false, true);

                    })
			});

		</script>


@endpush


