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


			TradingView.onready(function()
			{
				var widget = window.tvWidget = new TradingView.widget({
				    width: "100%",
					symbol:"DSEX",
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
                    time_frames: [],
                    drawings_access: {type: "black", tools: [{name: "Regression Trend"}]},
                    disabled_features: ["use_localstorage_for_settings", "create_volume_indicator_by_default", "widget_logo", "timeframes_toolbar"],
                    charts_storage_api_version: "1.1",
					client_id: 'stockbangladesh.com',
					user_id: 'stockbangladesh.com'


				});
			});

		</script>


@endpush


